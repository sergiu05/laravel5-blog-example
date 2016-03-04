<?php

namespace Unicorn\Http\Controllers;

use Illuminate\Http\Request;
use Unicorn\Http\Requests;
use Unicorn\Http\Controllers\Controller;

use Unicorn\Repositories\AlbumRepository;
use Unicorn\Repositories\ArtistRepository;
use Unicorn\Http\Requests\AlbumCreateRequest;

use Unicorn\Services\UploadsManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Cart;
use Session;

class StoreManagerController extends Controller
{
	/**
	 * The albums repository instance
	 *
	 * @var AlbumRepository
	 */
	protected $albums;

	/*
	 * The artists repository instance
	 *
	 * @var ArtistRepository
	 */

	/**
	 * Create a new controller instance
	 *
	 * @param AlbumRepository $albums
	 * @return void
	 */
	public function __construct(AlbumRepository $albums, ArtistRepository $artists) {

		$this->albums = $albums;
		$this->artists = $artists;

	}

	/**
	 * Display welcome dashboard page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function welcome() {

		//session()->push(config('music-store.cart.session_key'), ['album_id' => 18, 'qty' => 1]);
		//session()->forget(config('music-store.cart.session_key'));
		$session = collect(session()->get(config('music-store.cart.session_key')));
		
		$album_id = 18;
		$qty = 9;

		var_dump($session->contains('album_id', $album_id));

		$newcollection = $session->map(function($album) use ($album_id, $qty){
			if ($album['album_id'] == $album_id) {
				$album['qty'] = $qty;
			}
			return $album;
		});

		var_dump($newcollection->toArray());

		session()->put(config('music-store.cart.session_key'), $newcollection->toArray());
		
		$session = collect(session()->get(config('music-store.cart.session_key')));
		
		return view('backend.dashboard', compact('session'));

	}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('backend.albums.index', [
    		'albums' => $this->albums->all()
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$artists = $this->artists->all();
        return view('backend.albums.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumCreateRequest $request, UploadsManager $manager)
    {   	
    	dd($request);
    	$image_name = $manager->uploadFile($request->file('image'));

    	$album = $this->albums->create([
    		'title' => $request->input('title'),
    		'price' => $request->input('price'),
    		'image' => $image_name,
    		'genre_id' => $request->input('genre'),
    		'artist_id' => $request->input('artist'),
    		'description' => $request->input('description')
    	]);    	        

    	alert()->overlay('Success', 'A new album with id of ' . $album->id .' has been created.', "success");

        return redirect()->route('admin.albums.index');
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ( ! $album = $this->albums->findById($id)) {
        	throw new NotFoundHttpException('url not found'); 
        }
        $artists = $this->artists->all();
        return view('backend.albums.edit', compact('album', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumCreateRequest $request, $id)
    {
        $album = $this->albums->update([
        	'id' => $id,
        	'title' => $request->title,
        	'price' => $request->price,
        	'genre_id' => $request->genre,
        	'artist_id' => $request->artist,
        	'description' => $request->description
        ]);

        if ($album) {
        	alert()->overlay('Success', 'The album ' . $request->title . ' was updated.', "success");
        }

        return redirect()->route('admin.albums.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
        return $this->albums->delete($id);        
    }
}
