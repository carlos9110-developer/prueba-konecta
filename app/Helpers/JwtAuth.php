<?php
namespace App\Helpers;
use Firebase\JWT\JWT;
use Firebase\JWT\JWT\SignatureInvalidException;
use Firebase\JWT\JWT\UnexpectedValueException;
use Firebase\JWT\JWT\DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Exception;

class JwtAuth{

    private $secret         = "konecta-2021-1991";
    private $algoritmoCod   =  "HS256";

    public function  login(string $user,string $pass,string $rol) : array {

        $usuario = DB::table('users')
            ->join('roles','users.id_rol','=','roles.id')
            ->where(array('users.correo' => $user, 'users.password'=> hash("SHA256",$pass), 'users.id_rol' => $rol))
            ->select('users.*','roles.rol')
            ->first();

        if(is_object($usuario)){

            $payload = array(
                'sub'    => $usuario->id,
                'nombre' => $usuario->nombre,
                'usr'    => $usuario->correo,
                'iat'    => time(),
                'exp'    => time() + (60 * 60 * 2)
            );

            try{
                $modulos = DB::table('modulos_roles')
                            ->join('modulos','modulos_roles.id_modulo','=','modulos.id')
                            ->where('modulos_roles.id_rol',$usuario->id_rol)
                            ->select('modulos.*')
                            ->get();

                $jwt   = JWT::encode($payload,$this->secret,$this->algoritmoCod);

                $user = User::find($usuario->id);
                $user->token =$jwt;
                $user->save();

                $response = array(
                    'res' => true,
                    'token'   => $jwt,
                    'id_user' => $usuario->id,
                    'id_rol'     => $usuario->id_rol,
                    'nombre'  => $usuario->nombre,
                    'rol' => $usuario->rol,
                    'modulos' => $modulos
                );
            }catch(Exception $ex){
                $response = array(
                    'res' => false,
                    'msg'     => "Error, se presento un problema en el servidor, por favor intentelo de nuevo"
                );
            }
        } else {
            $response = array(
                'res' => false,
                'msg'     => "Error, usuario o contraseña incorrectos"
            );
        }
        return $response;

    } // aca temrina el login




    public function verificarToken($token, $decodificados = false){
        $auth       = false;
        $payload    = null;

        try{
            $payload = JWT::decode($token,$this->secret,array($this->algoritmoCod));
            $auth       = true;
        }catch (SignatureInvalidException $ex){ // este case es cuando pasan un token con una firma invalida
            $auth = false;
        }catch (\UnexpectedValueException $ex){
            $auth = false;
        }  catch (\DomainException $ex){
            $auth = false;
        }
        catch (Exception $ex){
            $auth = false;
        }

        if($decodificados == true){
            return $payload;
        } else {
            return $auth;
        }
    }


}
