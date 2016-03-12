<?php

namespace Unicorn;

use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{
    /**
     * The fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['order_id', 'album_id', 'quantity', 'price'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Orderdetails';

    /**
     * The order this orderitem belongs to
     *
     * @return 
     */
    public function order() {

    	return $this->belongsTo('Unicorn\Order');

    }
}
