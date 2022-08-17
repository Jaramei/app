<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 19.02.2018
 * Time: 23:29
 */

namespace Application\Core\Http\Middlewares;

use Closure;


class RolesMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $role
     * @param null $permission
     *
     * @return mixed
     *
     */

    protected $user;


    public function handle($request, Closure $next, $role, $permission = null)
    {

        if(!$request->user()->hasRole($role)) {

        abort(404);

        }
        if($permission !== null && !$request->user()->can($permission)) {
            abort(404);
        }


        return $next($request);
    }

}