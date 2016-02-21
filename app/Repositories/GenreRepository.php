<?php

namespace Unicorn\Repositories;

use Unicorn\Genre;

class GenreRepository {

	/**
     * Get all of the genres
     *
     * @return Collection
     */
	public function all() {

		return Genre::all();

	}

	public function getAlbumsFor($genre) {

		return Genre::with('albums')->where('name', $genre)->first();		

	}

}