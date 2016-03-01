<?php

namespace Unicorn\Repositories;

use Unicorn\Genre;

class GenreRepository {

	/**
     * Get all of the genres
     *
     * @return Collection
     */

	public function all($eager = false) {

		if ( ! $eager) {
			return Genre::all();	
		}
		
		return Genre::with('albums')->get();
	}

	public function getAlbumsFor($genre) {

		return Genre::with('albums')->where('name', $genre)->first();		

	}

	/**
	 * Save a new model and return the instance
	 *
	 * @param array Attributes
	 * @return Genre model instance
	 */
	public function create(array $data) {

		return Genre::create($data);

	}

}