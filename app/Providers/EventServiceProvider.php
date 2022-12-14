<?php

namespace App\Providers;

use App\Jobs\ProductCreated;
use App\Jobs\ProductDeleted;
use App\Jobs\ProductUpdated;
use App\Jobs\TestJob;
use Illuminate\Support\Facades\App;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // App::bindMethod(TestJob::class . '@handle', function ($job) {
        //     return $job->handle();
        // });
        App::bindMethod(ProductCreated::class . '@handle', function ($job) {
            return $job->handle();
        });
        App::bindMethod(ProductDeleted::class . '@handle', function ($job) {
            return $job->handle();
        });
        App::bindMethod(ProductUpdated::class . '@handle', function ($job) {
            return $job->handle();
        });
    }
}
