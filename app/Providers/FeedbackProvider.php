<?php

namespace App\Providers;

use App\Contracts\Repositories\FeedbackRepositoryInterface;
use App\Contracts\Services\Local\AbstractFeedbackService;
use App\Repositories\FeedbackRepository;
use App\Services\Local\FeedbackService;
use Illuminate\Support\ServiceProvider;

class FeedbackProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AbstractFeedbackService::class, FeedbackService::class);
        $this->app->bind(FeedbackRepositoryInterface::class, FeedbackRepository::class);
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
