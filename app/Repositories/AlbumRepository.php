<?php

namespace Unicorn\Repositories;

use Unicorn\Album;
use DB;

class AlbumRepository {

	/**
	 * Get all the albums of a gender
	 *
	 * @param string
	 * @return collection
	 */
	public function forGenre($genre) {
		//dd($genre);
		//$albums = DB::table('albums')->get();
		//$gender = 
		//$albums = Album::with(['genre' => function($query) use ($genre) {
		//	$query->where('genres.name', '=', $genre);
		//}])->get();

		//dd($albums);

	}
}