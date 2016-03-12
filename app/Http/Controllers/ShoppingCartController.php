<?php

namespace Unicorn\Http\Controllers;

use Illuminate\Http\Request;

use Unicorn\Http\Requests;
use Unicorn\Http\Controllers\Controller;

use Cart;
use Unicorn\Repositories\AlbumRepository;

class ShoppingCartController extends Controller
{
    /**
     * The album repository instance
     *
     * @var AlbumRepository
     */
    protected $albums;

    /**
     * Create a new controller instance
     *
     * @param AlbumRepository $albums
     * @return void
     */
    public function __construct(AlbumRepository $albums) {

        $this->albums = $albums;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartTotal = 0;

        $cartItems = Cart::getCartItems()->map(function($item, $key) use (&$cartTotal) {
            $album = $this->albums->findById($item['album_id']);
            
            $item['album_name'] = $album->title;
            $item['artist_name'] = $album->artist->name;
            $item['price'] = $album->price;
            $item['image'] = $album->image;
            $cartTotal += $item['qty'] * $item['price'];

            return $item;
        });
        
        
        return view('frontend.checkout', compact('cartItems', 'cartTotal'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array JSON
     */
    public function addToCart($id)
    {
        if ($this->albums->findById($id)) {
            Cart::addToCart($id, 1);
            return response()->json(['count' => Cart::getCount()]);
        }
        abort(404, 'Requested URL was not founded');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCart($id, $qty)
    {
        if ($this->albums->findById($id)) {
            Cart::updateCart($id, $qty, false);
            return response()->json(['count' => Cart::getCount()]);
        }
        abort(404, 'Requested URL was not found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array JSON
     */
    public function removeFromCart($id)
    {
        if ($this->albums->findById($id)) {
            Cart::removeFromCart($id);
            return response()->json(['count' => Cart::getCount()]);
        }
        abort(404, 'Requested URL was not found');
    }
}
