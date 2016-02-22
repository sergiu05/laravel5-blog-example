<?php

namespace Unicorn\Repositories;

use Unicorn\Album;

class AlbumRepository {

	/**
	 * Get album by id 
	 *
	 * @param integer $id
	 * @return Model Instance
	 */
	public function findById($id) {
		
		return Album::with('genre')->findOrFail($id);

	}
}