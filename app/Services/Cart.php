<?php

namespace Unicorn\Services;

class Cart {

	/**
	 * Stores the session key
	 *
	 * @var string
	 */
	protected $cart_name;

	/**
	 * Create a new instance of the controller
	 *
	 * @return void
	 */
	public function __construct() {

		$this->cart_name = config('music-store.cart.session_key') ? : 'cart';

	}

	/**
	 * Get all the albums in the cart
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function getCartItems() {

		return collect(session()->get($this->cart_name, []));

	}

	/**
	 * Updates the quantity of an album 
	 *
	 * @param int $album_id
	 * @param int $qty
	 * @param float $price
	 * @return void
	 */
	public function updateCart($album_id, $qty, $add = true) {
		
		$newCollection = $this->getCartItems()->map(function($album) use ($album_id, $qty, $add) {
			if ($album['album_id'] == $album_id) {
				if ($add) {
					$album['qty'] += $qty;						
				} else {
					$album['qty'] = $qty;
				}							
			}
			return $album;
		})->filter(function($album) {
			return $album['qty'] > 0;
		});

		session()->put($this->cart_name, $newCollection->toArray());		
		
	}

	/**
	 * Adds an album to the cart. If the album already exists in the cart, the quantity is updated, otherwise the album is added
	 *
	 * @param int $album_id
	 * @param int $qty
	 * @param float price
	 * @return void
 	 */
	public function addToCart($album_id, $qty) {

		if ($qty < 1) return;

		if ($this->getCartItems()->contains('album_id', $album_id)) {
			$this->updateCart($album_id, $qty);
		} else {
			session()->push($this->cart_name, [
				'album_id' => $album_id,
				'qty' => $qty
			]);
		}
	}

	/**
	 * Deletes an album in the cart
	 *
	 * @param int $album_id
	 * @param int $qty
	 * @return void
	 */
	public function removeFromCart($album_id) {

		$this->updateCart($album_id, 0, false);

	}

	/**
	 * Get the total number of albums in the cart
	 *
	 * @return int
	 */
	public function getCount() {

		$counter = 0;

		$this->getCartItems()->each(function($album, $key) use (&$counter) {
			$counter += $album['qty'];
		});

		return $counter;	

	}


	/**
	 * Deletes the shopping cart
	 *
	 * @return void	 
	 */
	public function emptyCart() {

		session()->forget($this->cart_name);

	}


}