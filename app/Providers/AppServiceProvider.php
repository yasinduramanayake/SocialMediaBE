<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\SubCategoryManagement\Repositaries\SubCategoryServicesImplements;
use Modules\SubCategoryManagement\Repositaries\SubCategoryServicesInterfaces;
use Modules\CategoryManagement\Repositaries\CategoryServicesImplements;
use Modules\CategoryManagement\Repositaries\CategoryServicesInterfaces;
use Modules\ServiceManagement\Repositaries\ServicesManagementImplements;
use Modules\ServiceManagement\Repositaries\ServicesManagementInterfaces;

use Modules\OrderManagement\Repositaries\OrderServicesImplements;
use Modules\OrderManagement\Repositaries\OrderServicesInterfaces;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SubCategoryServicesInterfaces::class, SubCategoryServicesImplements::class);
        $this->app->bind(CategoryServicesInterfaces::class, CategoryServicesImplements::class);
        $this->app->bind(ServicesManagementInterfaces::class, ServicesManagementImplements::class);
        $this->app->bind(OrderServicesInterfaces::class, OrderServicesImplements::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultstringLength(191);
    }
}
