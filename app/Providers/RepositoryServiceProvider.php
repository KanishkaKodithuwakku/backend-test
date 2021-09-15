<?php


namespace App\Providers;

use App\Repository\Eloquent\BaseEloquentRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseEloquentRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }
}
