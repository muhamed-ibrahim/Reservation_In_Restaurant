<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            'price' => 'required'

        ]);
        $image = $request->file('image')->store('public/menus');
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->image = $image;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->save();
        if($request->has('categories')){
            $menu->categories()->attach($request->categories);
        }
        return redirect('admin/menus')->with('message','menu Created successfully');
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
        $menus = Menu::find($id);
        $categories = Category::all();


        return view('admin.menus.edit',compact('menus','categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'

        ]);
        $menus = Menu::find($id);
        $image = $menus->image;
        if($request->hasFile('image')){
            Storage::delete($image);
            $image = $request->file('image')->store('public/menus');
        }
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->image = $image;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->save();
        if($request->has('categories')){
            $menu->categories()->sync($request->categories);
        }
        return redirect('admin/menus')->with('message','menu Updated successfully');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menus = Menu::find($id);
        Storage::delete($menus->image);
        $menus->categories()->detach();
        $menus->delete();
        return redirect('admin/menus')->with('message','menu Deleted successfully');

    }
}
