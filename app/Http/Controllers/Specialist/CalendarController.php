<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('specialist.pages.calendar.index');
    }
}
