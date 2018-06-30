<?php

namespace App\Http\Middleware;

use Closure;
use Lavary\Menu\Facade as Menu;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Menu::make('primary', function ($menu) {
           $menu->add('Inicio');
           $menu->add('Convenios', 'agreements/convenios');
           $menu->add('Contratos', 'agreements/contratos');
           $admin = $menu->add('Admin', 'admin');
           $admin->add('Convenios', 'admin/convenios');
           $admin->add('Contratos', 'admin/contratos');
        });

        return $next($request);
    }
}
