<?php

namespace Modules\CategoryManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primary_key = 'id';
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'icon',
        'color_code'
    ];

    public function subcategory()
    {
        return $this->hasMany('Modules\SubCategoryManagement\Entities\SubCategory', 'category_id');
    }
    public function subcategorynew()
    {
        return $this->hasMany('Modules\SubCategoryManagement\Entities\SubCategory', 'category_id');
    }
    public function service()
    {
        return $this->hasMany('Modules\ServiceManagement\Entities\Services', 'category_id');
    }
}
