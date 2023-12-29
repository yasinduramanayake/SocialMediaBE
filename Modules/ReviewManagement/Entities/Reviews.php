<?php

namespace Modules\ReviewManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $primary_key = 'id';
    protected $table = 'reviews';

    protected $fillable = [
        'first_name',
        'last_name',
        'rate',
        'email',
        'service',
        'review'
    ];
}
