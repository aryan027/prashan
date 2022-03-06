<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Tables;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Getting the booking information through post method.
     *
     * @param Request $request
     * @return Application|Factory|View|string
     */
    public function ListAvailability(Request $request) {
        $data = $this->validate($request, [
            'date' => 'required|date',
            'time' => 'required',
            'guest' => 'required|numeric'
        ]);
        $date = $data['date'];
        $time = $data['time'];
        $guest = $data['guest'];
        $book_date = date('Y-m-d', strtotime($date));
        $book_time = date('H:i', strtotime($time));
        $tables = Tables::whereHas('TableType', function ($q) use ($guest) {$q->where('serving_capacity', '>=', $guest);})->where(['status' => true])->get();
        $tableList = array();
        foreach ($tables as $table) {
            $tableList[] = $table->id;
        }
        $start_time = date('H:i', strtotime('-1 Hours', strtotime($book_time)));
        $end_time = date('H:i', strtotime('+1 Hours', strtotime($book_time)));
        $serviceable = $this->GetNonFunctionalityTime($book_date, $start_time);
        if ($serviceable == true) {
            return 'this is a non service time';
        }
        $bookings = Bookings::whereBetween('booking_time', [$start_time, $end_time])->where(['booking_date' => $book_date, 'status' => true])->get();
        if (count($bookings) > 0) {
            foreach ($bookings as $booking) {
                $sub = array_search($booking['reserved_table_id'], $tableList);
                if (!empty($sub)) {
                    unset($tableList[$sub]);
                }
            }
        }
        return $tableList;
    }

    /**
     * Getting the response if the day and time is serviceable or not.
     *
     * @param $book_date
     * @param $book_time
     * @return bool
     */
    private function GetNonFunctionalityTime($book_date, $book_time) {
        $non_service_days = array(
            'Saturday' => array('start' => 15, 'end' => 20),
            'Sunday' => array('start' => 18, 'end' => 20)
        );
        $non_service_time = false;
        $book_hour = date('H', strtotime($book_time));
        $book_day = date('l', strtotime($book_date));
        foreach ($non_service_days as $key=>$days) {
            if ($book_day == $key) {
                if (($days['start'] <= $book_hour) && ($book_hour <= $days['end'])) {
                    $non_service_time = true;
                }
            }
        }
        return $non_service_time;
    }

    public function GetTableInformation($id) {
        $id = htmlspecialchars(stripslashes($id));
        return Tables::with('TableType')->find($id);
    }
}
