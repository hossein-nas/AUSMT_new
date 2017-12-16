<?php

namespace App\Providers;

use App\Post;
use App\Setting;
use Illuminate\Support\ServiceProvider;
use Morilog\Jalali\jDate;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('jalali', jDate::forge());
        view()->composer('home', '\App\Http\Composers\HomepageComposer@latestNews');
        view()->composer('layouts.post_master', '\App\Http\Composers\HomepageComposer@hotNews');
        view()->composer('layouts.site_master', '\App\Http\Composers\HomepageComposer@navbarItems');
        view()->composer('home', '\App\Http\Composers\HomepageComposer@fastmenuItems');
        view()->composer('home', '\App\Http\Composers\HomepageComposer@allActiveSliderItems');
        view()->composer('layouts.post_master', '\App\Http\Composers\HomepageComposer@fastmenuItems');
//        view()->composer('partial.footer','\App\Http\Composers\NavigationComposer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('fa_IR');
        });
    }
}
