<?php

namespace Modules\SubCategoryManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $primary_key = 'id';
    protected $table = 'sub_categories';

    protected $fillable = [
        'name',
        'category_id',
        'image',
        'type'
    ];

    public function category()
    {
        return $this->belongsTo('Modules\CategoryManagement\Entities\Category', 'id');
    }

    public function service()
    {
        return $this->hasMany('Modules\ServiceManagement\Entities\Services', 'subcategory_id');
    }
    
   
}
