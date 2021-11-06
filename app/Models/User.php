<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['id_rol', 'nombre', 'documento', 'correo', 'direccion', 'password', 'token', 'created_at', 'updated_at'];

    protected $guarded = ['id'];
    protected $table    = "users";

    public function listar()
    {
        return DB::table('users')
            ->join('roles','users.id_rol','=','roles.id')
            ->select('users.*','roles.rol')
            ->get();
    }

    public function guardar(Request $datos) : bool
    {
        try{
            $usuarios = new User();
            $usuarios->id_rol = $datos->rol;
            $usuarios->nombre = $datos->nombre;
            $usuarios->documento = $datos->documento;
            $usuarios->correo = $datos->correo;
            $usuarios->direccion = $datos->direccion;
            $usuarios->password =  hash("SHA256",$datos->documento);
            return $usuarios->save();
        }catch(Exception $ex){
            return false;
        }
    }

    public function info(int $id) : User
    {
        return  User::find($id);
    }


    public function editar(Request $datos) : bool
    {
        try{
            $usuarios = User::find($datos->id);
            $usuarios->id_rol = $datos->rol;
            $usuarios->nombre = $datos->nombre;
            $usuarios->documento = $datos->documento;
            $usuarios->correo = $datos->correo;
            $usuarios->direccion = $datos->direccion;
            $usuarios->password =  hash("SHA256",$datos->documento);
            return $usuarios->save();
        }catch(Exception $ex){
            return false;
        }
    }

    public function eliminar(Request $datos) : bool
    {
        try{
            $usuarios = User::find($datos->id);
            return $usuarios->delete();
        }catch(Exception $ex){
            return false;
        }
    }

}
