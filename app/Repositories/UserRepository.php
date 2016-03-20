<?php

namespace Unicorn\Repositories;

use Unicorn\User;

class UserRepository {

	/**
	 * Get all users and their orders
	 *
	 * @return Collection
	 */
	public function all() {

		return User::with('orders')->get();

	}

	/**
	 * Change status for an user
	 *
	 * @param int $user_id The id of the user
	 * @param int $is_admin The user status
	 * @return boolean
	 */
	public function updateStatusFor($user_id, $is_admin) {

		$user = User::findOrFail($user_id);

		$user->is_admin = $is_admin;

		return $user->save();
	}
}