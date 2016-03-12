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

    	return $this->hasMany('Unicorn\Orderdetail');

    }

}
