<?php

namespace Unicorn\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Unicorn\Genre;
use Unicorn\User;

class GenrePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determines if a particular genre can be deleted
     *
     * @param Genre;
     * @return boolean
     */
    public function destroy(User $user, Genre $genre) {
    	
    	return 0 == count($genre->albums) && $user->isAdmin();
    }
}
