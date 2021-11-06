<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;

class VerificacionToken
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

        if($this->verificarToken($request)){
            return $next($request);
        }

        echo "no existe";

        /*
        $response = array('success' => false,'msg' => 'Error, no tiene permisos para utilizar nuestra api');
        return new JsonResponse($response,401);
        */

    }

    private function verificarToken($request)
    {
        $token    = session('sesion_usuario');
        if(isset($token) && $token!=null )
        {
            return true;
            /*
            $jwt = new JwtAuth();
            $validar = $jwt->verificarToken($token);
            if($validar==true)
                return true;
            return false;
            */
        }else
        {
            return false;
        }
    }
}
