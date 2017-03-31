<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HabitsController extends Controller
{

    public function index() {

        $user = auth()->user();

    }

}
