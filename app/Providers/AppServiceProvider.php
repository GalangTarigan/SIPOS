<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Laporan_Instalasi;
use App\Notifications\reportCreated;

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
        setlocale(LC_ALL, 'id_ID.utf8');
        \Carbon\Carbon::setLocale('id_ID.utf8');
    }
}
