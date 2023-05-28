<?php

namespace App\Http\Controllers;

use App\Models\UnavailableDays;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnavailableDaysController extends Controller
{
    public function index(Request $request){
        $unavailableDays = UnavailableDays::all();
        return view('unavailable_days',compact('unavailableDays'));
    }

    public function store(Request $request){

        $days = $request->days;
        UnavailableDays::whereNotNull('id')->delete();

        foreach ($days as $date)
        {
            if($date != null)
            {
                $unavailableDays = new UnavailableDays();
                $date = Carbon::createFromFormat('d/m/Y',$date)->format('Y-m-d');
                $unavailableDays->date = $date;
                $unavailableDays->save();
            }

        }
        Session::flash('success','Unavailable Days updated successfully.');
        return back();
    }
}
