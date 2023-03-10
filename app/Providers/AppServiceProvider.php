<?php

namespace App\Providers;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
    
        Cache::rememberForever('active_semester', fn () => Semester::active() );
                                

        Relation::enforceMorphMap([
            'award' => 'App\Models\Award',
            'office' => 'App\Models\Office',
        ]);
    }
}
