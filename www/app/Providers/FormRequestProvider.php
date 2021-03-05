<?php

namespace App\Providers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\ServiceProvider;

class FormRequestProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * Automatically add all route parameters to a FormRequest.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->resolving(FormRequest::class, function ($request) {
            $request->merge($request->route()->parameters());
        });
    }
}
