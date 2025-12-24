<?php

namespace App\Providers;

use App\Models\Link;
use App\Models\Menu;
use App\Models\AboutUs;
use App\Models\Setting;
use App\Models\DrawerNavigation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        View::composer('frontend.layouts.app', function ($view) {
            $setting = Setting::select(
                'primary_logo',
                'secondary_logo',
                'experience_logo',
                'favicon',
                'facebook',
                'instagram',
                'linkedin',
                'x',
                'youtube',
                'address_en',
                'address_np'
            )
                ->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(emails, '$[0]')) as email")
                ->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(contacts, '$[0]')) as contact1")
                ->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(contacts, '$[1]')) as contact2")
                ->first();

            $menus = Menu::with([
                'children' => function ($q) {
                    $q->published()->displayOrder();
                },
                'children.children' => function ($q) {
                    $q->published()->displayOrder();
                }
            ])
                ->whereNull('parent_id')
                ->published()
                ->displayOrder()
                ->get();

            $quickLinks = Link::with('menu')->published()->displayOrder()->get()->chunk(6);
            $aboutUs = AboutUs::select('description_en', 'description_np')->first();

            $drawerNavigations = DrawerNavigation::with('menu')->published()->displayOrder()->get();

            $view->with([
                'setting' => $setting,
                'menus' => $menus,
                'quickLinks' => $quickLinks,
                'aboutUs' => $aboutUs,
                'drawerNavigations' => $drawerNavigations,
            ]);
        });

        View::composer('frontend.partials.hero', function ($view) {
            $setting = Setting::select('school_overview_image')->first();

            $view->with([
                'setting' => $setting,
            ]);
        });
    }
}
