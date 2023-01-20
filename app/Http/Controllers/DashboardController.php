<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function show($number)
    {
        return view('number', ['angka' => $number]);
    }
}
