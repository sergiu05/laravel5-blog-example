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
     * Set the price in cents
     *
     * @param float $price
     * @return void
     */
    public function setPriceAttribute($price) {

        $this->attributes['price'] = round($price, 2) * 100;

    }

    /**
     * Get the price in dollars
     *
     * @param int $value
     * @return float
     */
    public function getPriceAttribute($value) {

        return round($value / 100, 2);

    }

    /**
     * The order this orderitem belongs to
     *
     * @return 
     */
    public function order() {

    	return $this->belongsTo('Unicorn\Order');

    }
}
