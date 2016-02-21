<?php

namespace Unicorn\Http\Controllers;

use Illuminate\Http\Request;
use Unicorn\Http\Requests;
use Unicorn\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.homepage');
    }

    
}
