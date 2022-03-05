<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::if('teacher', function () {
            return auth()->user()->type === User::TYPE_TEACHER;
        });

        Blade::if('student', function () {
            return auth()->user()->type === User::TYPE_STUDENT;
        });

        Blade::if('parent', function () {
            return auth()->user()->type === User::TYPE_PARENT;
        });

        Blade::if('project', function ($model) {
            return $model->category === Activity::CATEGORY_PROJECT;
        });

        Blade::if('activity', function ($model) {
            return get_class($model) === Activity::class;
        });
    }
}
