<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\JwtAuth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function verificarToken($guia = 0) : bool
    {
        $token    = session('sesion_usuario');
        if(isset($token) && $token!=null )
        {
            if($guia==0)
            {
                $jwt = new JwtAuth();
                $validar = $jwt->verificarToken($token["token"]);
                if($validar==true){
                    return true;
                }
                return false;
            }
            // aca validamos los permisos exclusivos para los administradores
            else if($guia==1)
            {
                if($token["id_rol"]=="1")
                {
                    return true;
                }
                session()->forget('sesion_usuario');// limpiar sesiones
                return false;
            }
        }
        else
        {
            return false;
        }
    }


    public function retornarMenu()
    {

    }

}
