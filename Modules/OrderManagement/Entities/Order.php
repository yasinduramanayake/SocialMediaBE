<?php

namespace Modules\OrderManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primary_key = 'id';
    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'order_details',
        'status',
        'tempory_cart_id'
    ];
    protected $casts = [
        'order_details' => 'json',
    ];


    public function user()
    {
        return $this->belongsTo('Modules\UserManagement\Entities\User', 'customer_id');
    }
}
