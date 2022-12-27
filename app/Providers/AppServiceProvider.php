<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // sử dụng bootstrap cho phân trang, nếu k có là lỗi
        // import đúng \Pagination\Paginator chứ k phải cái j khác
        Paginator::useBootstrapFive();
    }
}
