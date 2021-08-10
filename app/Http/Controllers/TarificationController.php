<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TarificationController extends Controller
{
    public function index()
    {
        return view('superadmin.tarification');
    }
}
