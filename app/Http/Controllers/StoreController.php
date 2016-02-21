<?php

namespace Unicorn\Http\Controllers;

use Illuminate\Http\Request;
use Unicorn\Http\Requests;
use Unicorn\Http\Controllers\Controller;
use Unicorn\Repositories\GenreRepository;

class StoreController extends Controller
{
    /**
     * The album repository implementation
     *
     * @var GenreRepository
     */
    protected $genres;

    /*
     * A new instance of StoreController
     *
     * @return void
     */
    public function __construct(GenreRepository $genres) {

        $this->genres = $genres;

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
        
        return view('frontend.store-details');

    }

    
}
