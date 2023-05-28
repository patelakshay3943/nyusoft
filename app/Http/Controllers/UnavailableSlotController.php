<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnavailableSlotController extends Controller
{
    public function index(Request $request){
        $unavailableSlots = Slot::select('day_no','unavailable_start_time','unavailable_end_time')->orderBy('day_no')->get()->groupBy('day_no')->toArray();
        return view('unavailable_slots',compact('unavailableSlots'));
    }

    public function store(Request $request){
        $startArray = $request->start;
        $endArray = $request->end;
        foreach ($startArray as $key => $item)
        {
            $availableSlot = Slot::where('day_no',$key)->first();
            if(!filled($availableSlot))
            {
                $availableSlot = new Slot();
            }
            $availableSlot->day_no = $key;
            $availableSlot->unavailable_start_time = $item;
            $availableSlot->unavailable_end_time = $endArray[$key];
            $availableSlot->save();
        }
        Session::flash('success','Unavailable slots updated successfully.');
        return back();
    }
}
