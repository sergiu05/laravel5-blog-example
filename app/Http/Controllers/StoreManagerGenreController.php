<?php

namespace Unicorn\Http\Controllers;

use Illuminate\Http\Request;
use Unicorn\Http\Requests;
use Unicorn\Http\Controllers\Controller;
use Unicorn\Repositories\GenreRepository;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Unicorn\Genre;
use Unicorn\Http\Requests\GenreCreateRequest;
use Unicorn\Services\UploadsManager;

use Unicorn\Repositories\GenreRepository;

class StoreManagerGenreController extends Controller
{
	/**
	 * The genre repository instance
	 *
	 * @var GenreRepository
	 */
	protected $genres;

	/**
	 * Create a new controller instance
	 *
	 * @param GenreRepository $genres
	 * @return void
	 */
	public function __construct(GenreRepository $genres) {

		$this->genres = $genres;

	}

    /**
     * The genre repository
     *
     * @var GenreRepository
     */
    protected $genres;

    /**
     * Get an instance of StoreManagerGenreController
     *
     * @param GenreRepository $genres
     * @return void
     */
    public function __construct(GenreRepository $genres) {
        $this->genres = $genres;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('backend.genres.index', [
            'genres' => $this->genres->all(true)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreCreateRequest $request, UploadsManager $manager)
    {
        $image_name = $manager->uploadFile($request->file('image'));

        $genre = $this->genres->create([
        	'name' => $request->input('name'),
        	'image' => $image_name
        ]);

        alert()->overlay('Success', 'A new music gender with id of ' . $genre->id . ' has been created.', 'success');

        return redirect('/admin/genres');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $genrename
     * @return \Illuminate\Http\Response
     */
    public function show($genrename)
    {
        if ($genre = $this->genres->getAlbumsFor($genrename)) {
        	return view('backend.genres.show', compact('genre'));	
        }

        throw new NotFoundHttpException('url not found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $this->authorize('destroy', $genre);

        $genre->delete();

        alert()->overlay('Info', 'The genre ' . $genre->name .' has been deleted.', "info");
        
        return redirect('/admin/genres');
    }
}
