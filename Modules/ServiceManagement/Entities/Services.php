<?php

namespace Modules\ServiceManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $primary_key = 'id';
    protected $table = 'services';

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'high_quality',
        'real_quality',
        'duration',
    ];

    protected $casts = [
        'high_quality' => 'json',
        'real_quality' => 'json',
    ];

    public function category()
    {
        return $this->belongsTo('Modules\CategoryManagement\Entities\Category', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo('Modules\SubCategoryManagement\Entities\SubCategory', 'id');
    }
}
