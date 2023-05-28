<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AvailableSlotsController extends Controller
{
    public function index(Request $request){
        $availableSlots = Slot::select('day_no','start_time','end_time')->orderBy('day_no')->get()->groupBy('day_no')->toArray();
        return view('available_slots',compact('availableSlots'));
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
            $availableSlot->start_time = $item;
            $availableSlot->end_time = $endArray[$key];
            $availableSlot->save();
        }
        Session::flash('success','Available slots updated successfully.');
        return back();
    }
}
