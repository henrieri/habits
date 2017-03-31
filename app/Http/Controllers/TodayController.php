<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodayController extends Controller
{
    public function index() {
        return view('app.today');
    }
}
