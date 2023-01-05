<?php

namespace App\Providers;

use App\Models\AcademicSession;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        
        Cache::rememberForever('current_academic_sessions', function () {
            return AcademicSession::current();
        });

        Relation::enforceMorphMap([
            'award' => 'App\Models\Award',
            'office' => 'App\Models\Office',
        ]);

        Schema::defaultStringLength(191);
    }
}
