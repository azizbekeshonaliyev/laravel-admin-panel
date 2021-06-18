<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Domain\Language\Entities\Language;

/**
 * Class LocaleMiddleware.
 */
class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $languages = Cache::get('languages')) {
            $languages = Language::orderBy('rank', 'asc')->get();
            Cache::put('languages', $languages);
        }
        $languages = $languages->pluck('locale')->toArray();
        // Locale is enabled and allowed to be changed
        if (config('locale.status') && session()->has('locale') && in_array(session()->get('locale'), $languages)) {
            // Set the Laravel locale
            app()->setLocale(session()->get('locale'));

//            // setLocale for php. Enables ->formatLocalized() with localized values for dates
//            setlocale(LC_TIME, config('locale.languages')[session()->get('locale')][1]);

            // setLocale to use Carbon source locales. Enables diffForHumans() localized
            Carbon::setLocale(session()->get('locale'));

            /*
             * Set the session variable for whether or not the app is using RTL support
             * for the current language being selected
             * For use in the blade directive in BladeServiceProvider
             */
//            if (config('locale.languages')[session()->get('locale')][2]) {
//                session(['lang-rtl' => true]);
//            } else {
//                session()->forget('lang-rtl');
//            }
        }

        return $next($request);
    }
}
