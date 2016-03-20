<?php

namespace Unicorn\Http\Controllers;

use Illuminate\Http\Request;
use Unicorn\Http\Requests;
use Unicorn\Http\Controllers\Controller;

use Unicorn\Repositories\AlbumRepository;
use Unicorn\Repositories\ArtistRepository;
use Unicorn\Repositories\UserRepository;
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
    protected $artists;

    /**
     * The users repository instance
     *
     * @var UserRepository
     */
    protected $users;

	/**
	 * Create a new controller instance
	 *
	 * @param AlbumRepository $albums
	 * @return void
	 */
	public function __construct(AlbumRepository $albums, ArtistRepository $artists, UserRepository $users) {

		$this->albums = $albums;
		$this->artists = $artists;
        $this->users = $users;

	}

	/**
	 * Display welcome dashboard page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function welcome() {

		return view('backend.dashboard');

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

    /**
     * Fetch all users     
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers() {

        $users = $this->users->all();
        
        return view('backend.users.index', compact('users'));
    }

    /**
     * Change user status (admin or non-admin)
     *
     * @param Request $request
     * @return Response
     */
    public function updateUserStatus(Request $request) {

        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'is_admin' => 'required|boolean'
        ]);

        $this->users->updateStatusFor($request->input('user_id'), $request->input('is_admin'));

        return response()->json(['success' => true]);
    }
}
