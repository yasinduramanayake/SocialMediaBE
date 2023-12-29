<?php

namespace Modules\ReviewManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contacts extends Model
{
    use HasFactory;

    protected $primary_key = 'id';
    protected $table = 'contacts';

    protected $fillable = [
        'first_name',
        'last_name',
        'message',
        'email',
        'file',
        'subject'
    ];
}
