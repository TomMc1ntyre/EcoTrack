<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Log;
use App\Models\Goal;
use App\Policies\LogPolicy;
use App\Policies\GoalPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Log::class, LogPolicy::class);
        Gate::policy(Goal::class, GoalPolicy::class);
    }
}
