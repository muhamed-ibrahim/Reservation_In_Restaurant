<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    function index() {
        $special = Category::where('name','=','special offer')->first();

        return view('welcome',compact('special'));
    }
}
