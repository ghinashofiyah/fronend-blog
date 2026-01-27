<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EjurnalController extends Controller
{
    public function index()
    {
        return view('pages.ejurnal');
    }
}
