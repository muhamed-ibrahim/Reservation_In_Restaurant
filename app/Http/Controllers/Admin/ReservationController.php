<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use App\Rules\DateBetweenRule;
use App\Rules\timeBetweenRule;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservation = Reservation::all();
        return view('admin.reservations.index',compact('reservation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $table = Table::where('status','avaliable')->get();
        return view('admin.reservations.create',compact('table'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'tel_number' => 'required|numeric',
            'res_date' => ['required','date',new DateBetweenRule,new timeBetweenRule()],
            'table_id' => 'required',
            'guest_number' => 'required|numeric'


        ]);
        $table = Table::find($request->table_id);
        $request_date = Carbon::parse($request->res_date);
        foreach ($table->reservation as $res) {
            $req_date = Carbon::parse($res->res_date);
            if ($req_date->format('Y-m-d') == $request_date->format('Y-m-d')) {
                return redirect('admin/reservations/create')->with('message','This table is reserved for this date.');
            }
        }
        $reservation = new Reservation();
        $reservation->first_name = $request->first_name;
        $reservation->last_name = $request->last_name;
        $reservation->email = $request->email;
        $reservation->tel_number = $request->tel_number;
        $reservation->res_date = $request->res_date;
        $reservation->table_id = $request->table_id;
        $reservation->guest_number = $request->guest_number;
        $av = Table::find($reservation->table_id);
        if($request->guest_number>$av->guest_number){
            return redirect('admin/reservations/create')->with('message','you must choose table base on guests');
        }
        $reservation->save();
        return redirect('admin/reservations')->with('message','Reservation Created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservation = Reservation::find($id);
        $table = Table::where('status','avaliable')->get();
        return view('admin.reservations.edit',compact('reservation','table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'tel_number' => 'required|numeric',
            'res_date' => ['required','date',new DateBetweenRule,new timeBetweenRule()],
            'table_id' => 'required',
            'guest_number' => 'required|numeric'


        ]);
        $reservation = Reservation::find($id);
        $reservation->first_name = $request->first_name;
        $reservation->last_name = $request->last_name;
        $reservation->email = $request->email;
        $reservation->tel_number = $request->tel_number;
        $reservation->res_date = $request->res_date;
        $reservation->table_id = $request->table_id;
        $reservation->guest_number = $request->guest_number;
        $av = Table::find($reservation->table_id);
        if($request->guest_number>$av->guest_number){
            return redirect('admin/reservations/create')->with('message','you must choose table base on guests');
        }

        $reservation->save();
        return redirect('admin/reservations')->with('message','Reservation Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return redirect('admin/reservations')->with('message','Reservation Deleted successfully');

    }
}
