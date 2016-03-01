<?php

namespace Unicorn\Repositories;

use Unicorn\Artist;

class ArtistRepository {
	
	/**
	 * Get all artists
	 *
	 * @return collection
	 */
	public function all() {

		return Artist::all();

	}
}