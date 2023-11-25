<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $language = $request->session()->get('language', null);
        // if ($language !== null) {
        //     app()->setLocale($language);
        // }

        $language = $request->session()->get('language', null);

        if ($language === null) {
            // Get preferred languages from the Accept-Language header
            $preferredLanguages = $request->getLanguages();
            var_dump($preferredLanguages);
            foreach ($preferredLanguages as $preferredLanguage) {
                if (in_array($preferredLanguage, ['en', 'uk'])) {
                    $language = $preferredLanguage;
                    break;
                }
            }

            if ($language === null) {
                $language = 'en';
            }

            app()->setLocale($language);
            session(['language' => $language]);
        } else {
            app()->setLocale($language);
        }
        return $next($request);
    }
}
