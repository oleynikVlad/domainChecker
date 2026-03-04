<?php

namespace App\Modules\DomainChecker;

use Illuminate\Support\ServiceProvider;

class DomainCheckerProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }

    public function register(): void
    {
        //
    }
}
