<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\UnavailableDays;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BookedSlotsController extends Controller
{
    public function index(Request $request){
        return view('booked_slots');
    }

    public function getBookedSlot(Request $request){
        $selectedDate = Carbon::parse($request->date);
        $selectedDateFormated = $selectedDate->format('Y-m-d');
        $dayName = $selectedDate->format('l');

        $unavailableDays = UnavailableDays::whereDate('date',$selectedDateFormated)->first();
        if(!filled($unavailableDays))
        {

            $getNumberDay = array_search($dayName,Slot::$DAYS);
            $daySlots = Slot::where('day_no',$getNumberDay)->first();

            $startTime = Carbon::createFromFormat('Y-m-d H:i',$selectedDateFormated.' '.$daySlots->start_time);
            $endTime = Carbon::createFromFormat('Y-m-d H:i',$selectedDateFormated.' '.$daySlots->end_time);

            $startHour = (int)$startTime->format('H');
            $endHour = (int)$endTime->format('H');
            $availableArray = [];
            for($i=$startHour; $i<$endHour; $i++)
            {
                $startHour = ($i == 0) ? $startHour : $i;
                $start = Carbon::createFromFormat('H:i',$startHour.':00')->format('H:i');
                $end = Carbon::createFromFormat('H:i',($i+1).':00')->format('H:i');
                $availableArray[] = $start.' - '.$end;
                $startHour = $i;
            }

            $startTime = Carbon::createFromFormat('Y-m-d H:i',$selectedDateFormated.' '.$daySlots->unavailable_start_time);
            $endTime = Carbon::createFromFormat('Y-m-d H:i',$selectedDateFormated.' '.$daySlots->unavailable_end_time);
            $startHour = (int)$startTime->format('H');
            $endHour = (int)$endTime->format('H');
            $unavailableArray = [];

            for($i=$startHour; $i<$endHour; $i++)
            {
                $startHour = ($i == 0) ? $startHour : $i;
                $start = Carbon::createFromFormat('H:i',$startHour.':00')->format('H:i');
                $end = Carbon::createFromFormat('H:i',($i+1).':00')->format('H:i');
                $unavailableArray[] = $start.' - '.$end;
                $startHour = $i;
            }

            $result = array_diff($availableArray, $unavailableArray);
        }else{
            $result = [];
        }

        return response()->json([
            'status' => true,
            'response' => $result,
            'message' => 'success',
        ]);
    }
}
