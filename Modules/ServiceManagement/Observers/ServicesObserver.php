<?php

namespace Modules\ServiceManagement\Observers;

use Modules\ServiceManagement\Entities\Services;

class ServicesObserver
{
    /**
     * Handle the Services "created" event.
     *
     * @param  \App\Models\Services  $services
     * @return void
     */
    public function creating(Services $services)
    {
        $randomNumber = random_int(160600, 9400000);
        $services->reference = "RDV-" .   $randomNumber;
    }
    /**
     * Handle the Services "created" event.
     *
     * @param  \App\Models\Services  $services
     * @return void
     */
    public function created(Services $services)
    {
    }
    /**
     * Handle the Services "updated" event.
     *
     * @param  \App\Models\Services  $services
     * @return void
     */
    public function updated(Services $services)
    {
    }
    /**
     * Handle the Services "deleted" event.
     *
     * @param  \App\Models\Services  $services
     * @return void
     */
    public function deleted(Services $services)
    {
    }
    /**
     * Handle the Services "restored" event.
     *
     * @param  \App\Models\Services  $services
     * @return void
     */
    public function restored(Services $services)
    {
    }
    /**
     * Handle the Services "force deleted" event.
     *
     * @param  \App\Models\Services  $services
     * @return void
     */
    public function forceDeleted(Services $services)
    {
    }
}
