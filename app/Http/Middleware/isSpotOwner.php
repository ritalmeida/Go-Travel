<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isSpotOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->id == $request->spot->villager) {

            return $next($request);
        }

        return redirect('home')->with('error', 'Não tem acesso a esta página.');
    }
}
