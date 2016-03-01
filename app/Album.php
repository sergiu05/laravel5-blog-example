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
    protected $fillable = ['title', 'price', 'image', 'genre_id', 'artist_id', 'description'];

     /**
     * Get the albums's price in dollars (in db is stored in cents).
     *
     * @param  integer  $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        return round($value / 100, 2);
    }

    /*
     * Set the album's price in cents
     *
     * @param float number
     * @return int
     */
    public function setPriceAttribute($value) {

    	$this->attributes['price'] = round($value, 2) * 100;
    	
    }

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