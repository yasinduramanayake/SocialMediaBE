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
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }
}
