<?php

namespace Unicorn\Http\Controllers;

use Illuminate\Http\Request;

use Unicorn\Http\Requests;
use Unicorn\Http\Controllers\Controller;
use Unicorn\Repositories\OrderRepository;
use Cart;
use Auth;
use Unicorn\Jobs\SendWelcomeEmail;


class CheckoutController extends Controller
{
    /**
     * The Order Repository instance
     *
     * @var OrderRepository
     */
    protected $orders;

    /**
     * create a constroller instance
     *
     * @return void
     */
    public function __construct(OrderRepository $orders) {

        $this->orders = $orders;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request     
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        try {
            $value = $this->orders->process();
            Cart::emptyCart();

            $user = Auth::user();

            $this->dispatch(new SendWelcomeEmail($user, $value));
            return response()->json(['status' => 1]);
        } catch(\Exception $e) {
            abort(500, $e->getMessage());
        }
        
    }

}
