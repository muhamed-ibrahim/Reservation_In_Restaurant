<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table = Table::all();
        return view('admin.tables.index',compact('table'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tables.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'guest_number' => 'required|numeric',
            'status' => 'required',
            'location' => 'required',

        ]);
        $table = new Table();
        $table->name = $request->name;
        $table->guest_number = $request->guest_number;
        $table->status = $request->status;
        $table->location = $request->location;
        $table->save();
        return redirect('admin/tables')->with('message','Table Created successfully');

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
        $table = Table::find($id);
        return view('admin.tables.edit',compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'guest_number' => 'required|numeric',
            'status' => 'required',
            'location' => 'required',

        ]);
        $table = Table::find($id);
        $table->name = $request->name;
        $table->guest_number = $request->guest_number;
        $table->status = $request->status;
        $table->location = $request->location;
        $table->save();
        return redirect('admin/tables')->with('message','Table Updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $table = Table::find($id);
        $table->reservation()->delete();
        $table->delete();
        return redirect('admin/tables')->with('message','Table Deleted successfully');

    }
}
