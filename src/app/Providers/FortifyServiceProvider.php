<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Responses\LogoutResponse;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Laravel\Fortify\Fortify;
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // ログイン画面
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 新規登録画面
        Fortify::registerView(function () {
            return view('auth.register');
        });


        // 登録処理
        Fortify::createUsersUsing(CreateNewUser::class);
    }
}
