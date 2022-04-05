<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FlashcardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Console\Commands\Interfaces\FlashcardPromptInterface', 'App\Console\Commands\Classes\Flashcard\PromptCardQuestion');
        $this->app->bind('App\Console\Commands\Interfaces\FlashcardPromptInterface', 'App\Console\Commands\Classes\Flashcard\PromptCardAnswer');
        $this->app->bind('App\Console\Commands\Interfaces\FlashcardPromptInterface', 'App\Console\Commands\Classes\Flashcard\PromptCardId');
        $this->app->bind('App\Console\Commands\Interfaces\FlashcardPromptInterface', 'App\Console\Commands\Classes\Flashcard\PromptOperationId');
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
