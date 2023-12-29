<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\SubCategoryManagement\Repositaries\SubCategoryServicesImplements;
use Modules\SubCategoryManagement\Repositaries\SubCategoryServicesInterfaces;
use Modules\CategoryManagement\Repositaries\CategoryServicesImplements;
use Modules\CategoryManagement\Repositaries\CategoryServicesInterfaces;
use Modules\ServiceManagement\Repositaries\ServicesManagementImplements;
use Modules\ServiceManagement\Repositaries\ServicesManagementInterfaces;
use Modules\UserManagement\Repositaries\UserServicesImplements;
use Modules\UserManagement\Repositaries\UserServicesInterfaces;
use Modules\OrderManagement\Repositaries\OrderServicesImplements;
use Modules\OrderManagement\Repositaries\OrderServicesInterfaces;
use Modules\PaymentManagement\Repositaries\PaymentServicesImplements;
use Modules\PaymentManagement\Repositaries\PaymentServicesInterfaces;
use Modules\ReviewManagement\Repositaries\ReviewServicesImplements;
use Modules\ReviewManagement\Repositaries\ReviewServicesInterfaces;
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
        $this->app->bind(UserServicesInterfaces::class, UserServicesImplements::class);
        $this->app->bind(ReviewServicesInterfaces::class, ReviewServicesImplements::class);
        $this->app->bind(PaymentServicesInterfaces::class, PaymentServicesImplements::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultstringLength(191);
    }
}
