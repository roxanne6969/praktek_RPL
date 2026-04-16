<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share menu data for all frontend views
        View::composer('frontend.*', function ($view) {
            $frontMenus = Menu::whereNull('parent_menu')
                ->where('status_menu', 1)
                ->with([
                    'submenu' => fn ($q) => $q->where('status_menu', 1)->orderBy('urutan_menu', 'asc'),
                ])
                ->orderBy('urutan_menu', 'asc')
                ->get();

            $view->with('frontMenus', $frontMenus);
        });
    }
}
