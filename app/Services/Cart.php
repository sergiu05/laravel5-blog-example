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
	public function albums() {

		return collect(session()->get($this->cart_name, []));

	}

	/**
	 * Updates the quantity of an album 
	 *
	 * @param int $album_id
	 * @param int $qty
	 * @return void
	 */
	public function update($album_id, $qty) {

		if ($qty < 0) return;

		if ($this->albums()->contains('album_id', $album_id)) {
			$newCollection = $this->albums()->map(function($album) use ($album_id, $qty) {
				if ($album['album_id'] == $album_id) {
					$album['qty'] = $qty;
				}
				return $album;
			})->filter(function($album) {
				return $album['qty'] > 0;
			});

			session()->put($this->cart_name, $newCollection->toArray());
		} else {
			session()->push($this->cart_name, [
				'album_id' => $album_id,
				'qty' => $qty
			]);
		}
		
	}

	/**
	 * Counts the unique items in the cart	 
	 *
	 * @return int
	 */
	public function count() {

		return $this->albums()->count();

	}

	/**
	 * Deletes the shopping cart
	 *
	 * @return void	 
	 */
	public function destroy() {

		session()->forget($this->cart_name);

	}

	public function index() {
		return 'foo';
	}
}