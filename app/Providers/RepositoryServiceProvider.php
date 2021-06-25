<?php

namespace App\Providers;

use App\Repository\BarangRepositoryInterface;
use App\Repository\DokumentasiBarangRepositoryInterface;
use App\Repository\Eloquent\BarangRepository;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\DokumentasiBarangRepository;
use App\Repository\Eloquent\MerkBarangRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\MerkBarangRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(BarangRepositoryInterface::class, BarangRepository::class);
        $this->app->bind(MerkBarangRepositoryInterface::class, MerkBarangRepository::class);
        $this->app->bind(DokumentasiBarangRepositoryInterface::class, DokumentasiBarangRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
