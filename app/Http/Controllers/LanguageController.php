<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($routeLocale, $targetLang = null)
    {
        if ($targetLang === null) {
            $targetLang = $routeLocale == 'en' ? 'ar' : 'en';
        }

        $lang = $targetLang;

        if (!in_array($lang, ['en', 'ar'])) {
            $lang = 'ar';
        }

        Session::put('locale', $lang);
        App::setLocale($lang);

        $previousUrl = url()->previous();
        $path = parse_url($previousUrl, PHP_URL_PATH);
        $attributes = parse_url($previousUrl, PHP_URL_QUERY);
        $segments = explode('/', trim($path, '/'));

        if (!empty($segments)) {
            if (in_array($segments[0], ['ar', 'en'])) {
                $segments[0] = $lang;
            } else {
                array_unshift($segments, $lang);
            }
        } else {
            $segments = [$lang];
        }

        $newUrl = '/' . implode('/', $segments);
        if ($attributes) {
            $newUrl = $newUrl . '?' . $attributes;
        }

        return redirect($newUrl);
    }
}