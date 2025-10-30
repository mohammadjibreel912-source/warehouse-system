<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Lease;
use App\Models\User;
use App\Models\Notification;

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

    public function boot()
    {
        // مشاركة البيانات مع جميع الـ views
        View::composer('*', function ($view) {

            $totalWarehouses  = Warehouse::count();
            $totalProducts    = Product::count();
            $totalSuppliers   = Supplier::count();
            $totalCustomers   = Customer::count();
            $totalPurchases   = Purchase::count();
            $totalSales       = Sale::count();
            $totalLeases      = Lease::count();
                $unreadCount = Notification::whereNull('read_at')->count();
    $unreadNotifications = Notification::whereNull('read_at')->latest()->take(5)->get();


            // الإيرادات لهذا الشهر (تأكد أن عمود المبلغ في جدول sales هو 'amount')
            $monthlyRevenue = Sale::whereMonth('created_at', now()->month)
                                  ->sum('price');

            $view->with([
                'totalWarehouses' => $totalWarehouses,
                'totalProducts'   => $totalProducts,
                'totalSuppliers'  => $totalSuppliers,
                'totalCustomers'  => $totalCustomers,
                'totalPurchases'  => $totalPurchases,
                'totalSales'      => $totalSales,
                'totalLeases'     => $totalLeases,
                'monthlyRevenue'  => $monthlyRevenue,
                'unreadCount' => $unreadCount,
                'unreadNotifications' =>$unreadNotifications
            ]);
        });
    }
}
