<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Lavary\Menu\Facade as Menu;

class AdminMiddle {

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

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

           $agreements = $menu->add('Gestión', 'agreements');

           $views = $menu->add('Vista', 'views');
           $views->add('Convenios', 'views/convenios');
           $views->add('Contratos', 'views/contratos');
           
           $agreements->add('Convenios', 'agreements/convenios');
           $agreements->add('Contratos', 'agreements/contratos');

           $admin = $menu->add('Admin', 'admin');
           $admin->add('Convenios', 'admin/convenios');
           $admin->add('Contratos', 'admin/contratos');
        });

        if ($this->auth->user()->my_role->id != config('app.CONST.SUPER_ROLE'))
        {
            return redirect()->guest('login');
        }
        return $next($request);
    }
}
