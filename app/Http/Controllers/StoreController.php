<?php

namespace Unicorn\Http\Controllers;

use Illuminate\Http\Request;
use Unicorn\Http\Requests;
use Unicorn\Http\Controllers\Controller;
use Unicorn\Repositories\GenreRepository;
use Unicorn\Repositories\AlbumRepository;

class StoreController extends Controller
{
    /**
     * The genre repository implementation
     *
     * @var GenreRepository
     */
    protected $genres;

    /**
     * The album repository implementation
     *
     * @var AlbumRepository
     */
    protected $albums;

    /*
     * A new instance of StoreController
     *
     * @return void
     */
    public function __construct(GenreRepository $genres, AlbumRepository $albums) {

        $this->genres = $genres;
        $this->albums = $albums;
    }

    /**
     * Display all genders
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        return view('frontend.store-index');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function browse(Request $request) {
        
        if ( $request->has('genre') && ($genre = $this->genres->getAlbumsFor($request->input('genre'))) ) {
            return view('frontend.store-browse', [
                'genre' => $genre
            ]);
        }

        return redirect()->route('store::index');        
        
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $album = $this->albums->findById($id);
        
        return view('frontend.store-details', compact('album'));

    }

    
}
