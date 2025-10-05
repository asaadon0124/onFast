<?php

namespace App\Traits\Admin;

use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Admin\DashboardController;

trait ClearsSidebarCache
{
    protected static function bootClearsSidebarCache()
    {
        static::created(function ()
        {
            self::refreshSidebarCache();
        });

        static::updated(function ()
        {
            self::refreshSidebarCache();
        });

        static::deleted(function ()
        {
            self::refreshSidebarCache();
        });

        static::restored(function ()
        {
            self::refreshSidebarCache();
        });
    }

    protected static function refreshSidebarCache()
    {
        Cache::forget('sidebar_data');
        // أعد بناء الكاش على طول
        DashboardController::sidebarData();
    }
}
