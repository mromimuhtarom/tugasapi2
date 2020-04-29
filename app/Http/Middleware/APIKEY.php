<?php

namespace App\Http\Middleware;

use Closure;
use Hash;

class APIKEY
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
        $token = $request->header('APP_KEY');
        $key = '$2y$10$AtP2ACGwx/Hz.usNFoIn7umLXQoWb6TQb5uIHJJ12jhnQGiH3msZS';
        
        if(!Hash::check($token, $key)): 
            return response()->json(['message' => 'App Key Tidak Ditemukan'], 401);
        endif;
        
        return $next($request);
    }
}
