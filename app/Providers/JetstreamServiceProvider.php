<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions([
            'product:read',
            'product:list',
            'product:buy',

            'category:read',
            'category:list',

            'comment:read',
            'comment:list',
        ]);

        Jetstream::permissions([
            'product:create',
            'product:read',
            'product:update',
            'product:delete',
            'product:list',
            'product:buy',

            'category:create',
            'category:read',
            'category:update',
            'category:delete',
            'category:list',

            'comment:create',
            'comment:read',
            'comment:update',
            'comment:delete',
            'comment:list',
        ]);
    }
}
