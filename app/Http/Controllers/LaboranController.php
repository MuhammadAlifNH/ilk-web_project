<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaboranController extends Controller
{
    public function index()
    {
        return view('laboran.index');
    }
}
