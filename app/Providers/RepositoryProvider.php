<?php


namespace App\Providers;

use App\Models\Order;
use App\Repository\Eloquent as Eloquent;
use App\Repository\QueryBuilder as QueryBuilder;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            Eloquent\OrderRepositoryInterface::class,
            function ($app) {
                return new Eloquent\OrderRepository($app->make(Order::class));
            }
        );

        $this->app->bind(
            QueryBuilder\OrderRepositoryInterface::class,
            function ($app) {
                return new QueryBuilder\OrderRepository('orders');
            }
        );
    }
}
