<?php

namespace Unicorn\Http\ViewComposers;

use Unicorn\Repositories\GenreRepository;
use Illuminate\Contracts\View\View;

class StoreComposer {

	/**
     * The genre repository implementation.
     *
     * @var GenreRepository
     */
    protected $genres;

    /*
     * Create a new StoreComposer
     *
     * @param GenreRepository $genres 
     * @return void
     */
    public function __construct(GenreRepository $genres) {

    	$this->genres = $genres;

    }

    /*
     * Bind data to the view
     *
     * @param View #view
     * @return void
     */
    public function compose(View $view) {

    	$view->with('genres', $this->genres->all());

    }

}