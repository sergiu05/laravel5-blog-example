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
		
		return Album::with('genre', 'artist')->findOrFail($id);

	}

	/**
	 * Get all albums
	 *
	 * @return Collection	 
	 */
	public function all($order = 'desc') {

		return Album::with('genre')->orderBy('id', $order)->get();

	}

	/*
	 * Create a new instance of Album model
	 *
	 * @param array Array of field_name => value pairs
	 * @return Model instance
	 */
	public function create(array $data) {

		return Album::create($data);

	}

	/*
	 * Delete an instance of Album model
	 *
	 * @param int
	 * @return int
	 */
	public function delete($id) {

		return Album::destroy($id);
		
	}

	/**
	 * Update the model instance
	 *
	 * @param array $data
	 * @return bool|int
	 */
	public function update(array $data) {
		
		$album = Album::findOrFail($data['id']);

		foreach($data as $key => $value) {
			if ($key != 'id') {
				$album->$key = $value;
			}
		}

		return $album->save();
	}
}