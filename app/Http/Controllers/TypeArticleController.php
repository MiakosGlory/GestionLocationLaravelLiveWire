<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeArticleController extends Controller
{
    public function index()
    {
        return view('superadmin.type_article');
    }
}
