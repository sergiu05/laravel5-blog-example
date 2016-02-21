<?php

namespace Unicorn;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
    * The attributes that are mass assignable
    *
    * @var array
    */
    protected $fillable = ['name'];

    /**
    * Get the artist's albums
    */
    public function albums() {

    	return $this->hasMany('Unicorn\Album');

    }
}
