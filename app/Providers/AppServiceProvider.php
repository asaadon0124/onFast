<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Services\Admin\ReportsService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\Admin\ReportsInterface;
use App\Http\Controllers\Admin\DashboardController;


class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(ReportsInterface::class,ReportsService::class
        );
    }

    
    public function boot(): void
    {
        Paginator::useBootstrap();
        // View::composer('admin.layouts.master', function ($view)
        // {
        //     $view->with('sidebarCounts', app()->call([DashboardController::class, 'sidebarData']));
        // });

        View::composer('*', function ($view)
        {
            $sidebarCounts = Cache::get('sidebar_data') ?? DashboardController::sidebarData();
            $view->with('sidebarCounts', $sidebarCounts);
        });

    }
}
