<?php

namespace Modules\SubCategoryManagement\Observers;

use Modules\SubCategoryManagement\Entities\SubCategory;

class SubCategoryObserver
{
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function creating(SubCategory $subcategory)
    {
        $randomNumber = random_int(260600, 3400000);
        $subcategory->reference = "RDV-" .   $randomNumber;
    }
    /**
     * Handle the SubCategory "created" event.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return void
     */
    public function created(SubCategory $subcategory)
    {
       
    }
    /**
     * Handle the SubCategory "updated" event.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return void
     */
    public function updated(SubCategory $subcategory)
    {

    }
    /**
     * Handle the SubCategory "deleted" event.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return void
     */
    public function deleted(SubCategory $subcategory)
    {
        
    }
    /**
     * Handle the SubCategory "restored" event.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return void
     */
    public function restored(SubCategory $subcategory)
    {
    }
    /**
     * Handle the SubCategory "force deleted" event.
     *
     * @param  \App\Models\SubCategory  $subcategory
     * @return void
     */
    public function forceDeleted(SubCategory $subcategory)
    {
    }
}
