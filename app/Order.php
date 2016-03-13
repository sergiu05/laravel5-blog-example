<?php

namespace Unicorn;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['user_id', 'total'];

    /**
     * Store the total price in cents
     *
     * @param float $total
     * @return void
     */
    public function setTotalAttribute($total) {

        $this->attributes['total'] = round($total, 2) * 100;
    }

    /**
     * Transform the stored price in cents in dollars
     *
     * @param int $value
     * @return float
     */
    public function getTotalAttribute($value) {

        return round($value / 100, 2);

    }

    /**
     * Get the user that owns the order
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {

    	return $this->belongsTo('Unicorn\User');

    }

    /**
     * Get the order details
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items() {

    	return $this->hasMany('Unicorn\Orderdetails');

    }



}
