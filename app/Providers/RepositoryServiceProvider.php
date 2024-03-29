<?php

namespace App\Providers;

use App\Interface\TicketInterface;
use App\Interface\TicketLogInterface;
use App\Interface\UserInterface;
use App\Repositories\TicketLogRepository;
use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TicketInterface::class, TicketRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(TicketLogInterface::class, TicketLogRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
