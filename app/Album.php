<?php

namespace Unicorn;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'albums';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['title', 'price', 'image', 'genre_id', 'artist_id'];

    /**
    * Get the artist that owns the album    
    */
    public function artist() {

    	return $this->belongsTo('Unicorn\Artist');

    }

    /**
    * Get the genre that the album belongs to    
    */
    public function genre() {

    	return $this->belongsTo('Unicorn\Genre');

    }
}