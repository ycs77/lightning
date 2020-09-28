<?php

namespace App\Providers;

use App\Pagination\Paginator;
use App\Presenters\UserPresenter;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerInertia();
        $this->registerLengthAwarePaginator();
    }

    public function boot()
    {
        if (App::isProduction()) {
            URL::forceScheme('https');
        }

        $this->registerMacroMethods();
    }

    protected function registerInertia()
    {
        Inertia::version(fn () => md5_file(public_path('mix-manifest.json')));

        Inertia::share([
            'title' => config('app.name'),
            'auth' => fn () => [
                'user' => UserPresenter::make(Auth::user())->get(),
            ],
            'flash' => fn () => [
                'success' => session('success'),
                'error' => session('error'),
            ],
        ]);
    }

    protected function registerLengthAwarePaginator()
    {
        $this->app->bind(LengthAwarePaginator::class, Paginator::class);
    }

    protected function registerMacroMethods()
    {
        UploadedFile::macro('storeFile', function ($path, $options = []) {
            return config('filesystems.default') === 'cloudinary'
                ? $this->storeOnCloudinary($path)->getSecurePath()
                : Storage::url($this->store($path, $options));
        });
    }
}
