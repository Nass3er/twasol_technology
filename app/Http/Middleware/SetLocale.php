<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
        // First check the URL segment (this should be the priority)
        $urlLocale = $request->segment(1);

        // If URL doesn't have a valid locale, redirect to session locale
        if (!$urlLocale || !in_array($urlLocale, ['ar', 'en'])) {
            $sessionLocale = Session::get('locale', 'ar'); // Default to Arabic
            
            // Get the current path without the invalid locale
            $currentPath = $request->path();
            $segments = explode('/', $currentPath);
            
            // If the path is just the invalid locale, $segments will have 1 element
            // If it's something like /other-path, it might not have a locale at all
            // The logic below assumes the first segment is an invalid locale and tries to remove it
            // Let's refine this: if the first segment is not ar/en, we should probably keep it if it's not a locale
            // But the middleware is applied to a group with prefix {locale}, so this might be tricky.
            
            // Actually, if we are here, Laravel didn't match the {locale} route because it's not ar/en?
            // No, the prefix {locale} matches ANY string. Then the middleware checks it.
            
            array_shift($segments);
            $newPath = implode('/', $segments);
            
            // Redirect to the same page with valid session locale
            $newUrl = '/' . $sessionLocale . ($newPath ? '/' . $newPath : '');
            return redirect($newUrl);
        }
        
        // URL has valid locale, use it
        $locale = $urlLocale;
        
        // Set the application locale
        app()->setLocale($locale);
        Session::put('locale', $locale);
        
        // Set URL defaults for generated links
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
