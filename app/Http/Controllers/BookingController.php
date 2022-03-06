<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Tables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function ListAvailability()
    {
        $now = Carbon::now()->toDateTimeString();
        $guest = 3;
        $book_date = date('Y-m-d', strtotime($now));
        $book_time = date('H:i', strtotime($now));
        $games = Tables::whereHas('TableType', function($q) {$q->where('serving_capacity','>=', 1);})->get();
        $tables = Tables::where(['status' => true])->get();
        $end_time = date('H:i', strtotime('+1 Hours', strtotime($book_time)));
        $serviceable = $this->GetNonFunctionalityTime($book_date, $book_time);
        if ($serviceable == true) {
            return 'this is a non service time';
        }
        $bookings = Bookings::whereBetween('booking_time', [$book_time, $end_time])->where(['booking_date' => $book_date, 'status' => true])->get();
        if (count($bookings) > 0) {
            foreach ($bookings as $booking) {
                $games = Game::whereHas('video', function($q)
                {
                    $q->where('available','=', 1);
                })->get();
                dd($booking->ReservedTable->TableType->serving_capacity);
            }
        } else {
            return 'seats are not booked list all the tables.';
        }
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
            'Sunday' => array('start' => 8, 'end' => 20)
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
}
