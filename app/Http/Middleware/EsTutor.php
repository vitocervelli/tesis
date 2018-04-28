<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class EsTutor
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function __construct(Guard $auth)
    {

        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if(!$this->auth->user()->esTutor()){
            return redirect('/home');
        }
        return $next($request);

    }
}
