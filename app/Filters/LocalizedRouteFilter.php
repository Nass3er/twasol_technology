<?php

namespace App\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
class LocalizedRouteFilter implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['route'])) {
            $routeName = $item['route'][0];
            $routeParams = $item['route'][1] ?? [];
            $item['href'] = localizedRoute($routeName, $routeParams);
        }
        // dd($item);
        return $item;
    }
}