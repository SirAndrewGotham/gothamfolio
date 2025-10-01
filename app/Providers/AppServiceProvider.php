<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Language::class => \App\Models\Policies\LanguagePolicy::class,
        \App\Models\Tag::class => \App\Models\Policies\TagPolicy::class,
        \App\Models\User::class => \App\Models\Policies\UserPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // app()->usePublicPath(base_path('/../public_html')); // for changed directories
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Support auto-discovery for policies under App\Models\Policies
        Gate::guessPolicyNamesUsing(static function (string $modelClass): string {
            return str_replace('App\\Models\\', 'App\\Models\\Policies\\', $modelClass).'Policy';
        });
        // We will register policies here after all other service providers have been registered
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}
