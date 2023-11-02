<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Table;
use App\Enums\TableStatus;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Rules\DateBetweenRule;
use App\Rules\timeBetweenRule;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function stepone(Request $request){
        $reservation = $request->session()->get('reservation');
        return view('reservations.stepone',compact('reservation'));
    }

    public function storestepone(Request $request){
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'tel_number' => 'required|numeric',
            'guest_number' => 'required|numeric'


        ]);

        if(empty($request->session()->get('reservation'))){
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);


        }else{
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);


        }
        return redirect('reservations/steptwo');

    }

    public function steptwo(Request $request){
        $reservation = $request->session()->get('reservation');
        $table = Table::where('status','avaliable')->where('guest_number','>=',$reservation->guest_number)->get();
        return view('reservations.steptwo',compact('reservation','table'));
    }

    public function storesteptwo(Request $request){
        $validated = $request->validate([
            'table_id' => 'required',
            'res_date' => ['required','date',new DateBetweenRule,new timeBetweenRule()],
        ]);
        $reservation = $request->session()->get('reservation');
        $reservation->fill($validated);

        $res = Reservation::all();
        foreach($res as $data){
            $Res1 = Carbon::parse($data->res_date);
            $Res2 = Carbon::parse($reservation->res_date);
            if($Res1->format('Y-m-d') == $Res2->format('Y-m-d')){
                    return redirect('reservations/steptwo')->with('message','This table is reserved for this date.');
            }

        }

        $reservation->save();
        // $request->session()->forget('reservation');
        return redirect('reservations/steptwo')->with('message','Thank you, your reservation is reserved successfully ^_^');
    }

}
