<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $cartCount = $user->carts()->sum('quantity');
                $view->with('cartCount', $cartCount);

                if ($user->role == 'admin') {
                    $unreadNotificationsCount = \App\Models\AdminNotification::where('is_read', false)->count();
                    $view->with('unreadNotificationsCount', $unreadNotificationsCount);
                    $view->with('latestNotifications', \App\Models\AdminNotification::latest()->take(5)->get());
                } else {
                    $view->with('unreadNotificationsCount', 0);
                }
            } else {
                $view->with('cartCount', 0);
                $view->with('unreadNotificationsCount', 0);
            }
        });
    }
}
