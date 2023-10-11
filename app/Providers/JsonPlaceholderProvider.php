<?php

namespace App\Providers;

use App\Services\JsonPlaceholderService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class JsonPlaceholderProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(JsonPlaceholderService::class, function () {
            return new JsonPlaceholderService(config('services.jsonplaceholder.uri'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * List Service classes
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [JsonPlaceholderService::class];
    }
}
