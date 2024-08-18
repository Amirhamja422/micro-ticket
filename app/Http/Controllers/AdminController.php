<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
