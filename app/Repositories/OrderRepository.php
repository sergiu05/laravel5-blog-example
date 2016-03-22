<?php

namespace Unicorn\Repositories;

use Unicorn\Order;
use Unicorn\Orderdetails;
use Unicorn\User;
use Auth;
use Cart;
use Unicorn\Album;

class OrderRepository {

	/**
	 * Process the cart content
	 *
	 * @return int Total order value
	 */	
	public function process() {
		
		$cartTotal = 0;

        $cartItems = Cart::getCartItems()->map(function($item, $key) use (&$cartTotal) {
            $album = Album::findOrFail($item['album_id']);
            
            $item['album_name'] = $album->title;
            $item['artist_name'] = $album->artist->name;
            $item['price'] = $album->price;            
            $cartTotal += $item['qty'] * $item['price'];

            return $item;
        });
        
        $user = Auth::user();

        $order = new Order;
        $order->total = $cartTotal;
        $order->user()->associate($user);
        $order->save();

        $cartItems->each(function($item, $key) use ($order) {
        	$orderDetail = new Orderdetails;
        	$orderDetail->album_id = $item['album_id'];
        	$orderDetail->quantity = $item['qty'];
        	$orderDetail->price = $item['price'];
        	$orderDetail->order()->associate($order);
        	$orderDetail->save();
        });

        return $cartTotal;
	}

	/**
	 * Get all the orders for a user
	 *
	 * @param Unicorn\User $user
	 * @return Collection of Order instances
	 */
	public function getOrdersFor(User $user) {

		return Order::with('items')->where('user_id', $user->id)->get();
	}

}