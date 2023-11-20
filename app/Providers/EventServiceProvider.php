<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\CategoryManagement\Entities\Category;
use Modules\SubCategoryManagement\Entities\SubCategory;
use Modules\ServiceManagement\Entities\Services;
use Modules\OrderManagement\Entities\Order;
use Modules\CategoryManagement\Observers\CategoryObserver;
use Modules\SubCategoryManagement\Observers\SubCategoryObserver;
use Modules\ServiceManagement\Observers\ServicesObserver;
use Modules\OrderManagement\Observers\OrderObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Category::observe(CategoryObserver::class);
        SubCategory::observe(SubCategoryObserver::class);
        Services::observe(ServicesObserver::class);
        Order::observe(OrderObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
