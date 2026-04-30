<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthPageController extends Controller
{
    public function index()
    {
        return view('api.auth.index');
    }
}
