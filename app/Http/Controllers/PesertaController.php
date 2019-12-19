<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public static function index()
    {
    	return view('pages.home');
    }
}
