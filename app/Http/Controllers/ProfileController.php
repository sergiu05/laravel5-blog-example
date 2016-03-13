<?php

namespace Unicorn\Http\Controllers;

use Illuminate\Http\Request;

use Unicorn\Http\Requests;
use Unicorn\Http\Controllers\Controller;

use Unicorn\Repositories\OrderRepository;

class ProfileController extends Controller
{
    /**
     * The OrderRepository instance
     *
     * @var OrderRepository
     */
    protected $orders;

    /**
     * Create a controller instance
     *
     * @return void
     */
    public function __construct(OrderRepository $orders) {

        $this->middleware('auth');
        $this->orders = $orders;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orders->getOrdersFor(\Auth::user());
        
        return view('frontend.my-orders', compact('orders'));
    }

    
}
