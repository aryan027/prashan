<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Tables;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;

class BookingController extends Controller
{

    public function bookingList(){
        $bookingList=Bookings::where('status',true)->get();
        return view('index',compact('bookingList'));
    }

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
        $response = array(
            'status' => true,
            'message' => 'fetched successfully'
        );
        $date = $data['date'];
        $time = $data['time'];
        $guest = $data['guest'];
        $book_date = date('Y-m-d', strtotime($date));
        $book_time = date('H:i', strtotime($time));
        $TimeStamp = Carbon::now()->toDateTimeString();
        $TodayDate = date('Y-m-d', strtotime($TimeStamp));
        if ((strtotime($book_date) - strtotime($TodayDate)) == 0) {
            $prior = $this->CheckIfReservationIsBeforeTwoHours($book_time);
            if ($prior !== true) {
                $response = array(
                    'status' => false,
                    'message' => 'Booking Before 2 hours are not allowed',
                );
            }
        }
        $tables = Tables::whereHas('TableType', function ($q) use ($guest) {$q->where('serving_capacity', '>=', $guest);})->where(['status' => true])->get();
        $tableList = array();
        foreach ($tables as $table) {
            $tableList[] = $table->id;
        }
        $start_time = date('H:i', strtotime('-1 Hours', strtotime($book_time)));
        $end_time = date('H:i', strtotime('+1 Hours', strtotime($book_time)));
        $serviceable = $this->GetNonFunctionalityTime($book_date, $start_time);
        if ($serviceable == true) {
            $response = array(
                'status' => false,
                'message' => 'Restaurant is closed during this time period'
            );
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
        Session::forget('tables');
        Session::put('tables', $tableList);
        return response($response);
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

    public function GetTableInformation($id) {
        return Tables::find($id);
    }

    public function LoadTablesInside() {
        $tables = Session::get('tables');
        return view('table', compact('tables'));
    }

    public function CheckIfReservationIsBeforeTwoHours($time) {
        $book_time = date('H:i', strtotime($time));
        $TimeStamp = Carbon::now()->toDateTimeString();
        $nowTime = date('H:i', strtotime($TimeStamp));
        $duration = (strtotime($book_time) - strtotime($nowTime)) / 3600;
        if ($duration >= '2') {
            return true;
        }
        return false;
    }

    public function ReserveTable(Request $request) {

        $data= $this->validate($request,[
             'first_name'=>'required|string|min:3',
             'last_name'=>'required|string|min:3',
            'email'=>'required|email',
            'phone_no'=>'required|min:10',
        ]);
            $data['reserved_table_id']=$request->table_id;
            $data['booking_date']=$request->date;
            $data['booking_time']=$request->time;
            $data['number_of_guests']=$request->number_of_guests;
             $insert=Bookings::create( $data);
             return redirect()->route('booking.list')->with('success','Booking has been done successfully!');
    }

    public function destroy($id){
        $booking = Bookings::find(Crypt::decrypt($id));

            $delete = $booking->update([
                'status' => false,
            ]);
        return redirect()->route('booking.list')->with('success','Booking has been Deleted successfully!');
    }


}
