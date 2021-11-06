<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'documento', 'correo', 'direccion', 'created_at', 'updated_at'];

    protected $guarded = ['id'];
    protected $table    = "clientes";


    public function listar()
    {
        return Clientes::get();
    }

    public function guardar(Request $datos) : bool
    {
        try{
            $clientes = new Clientes();
            $clientes->nombre = $datos->nombre;
            $clientes->documento = $datos->documento;
            $clientes->correo = $datos->correo;
            $clientes->direccion = $datos->direccion;
            return $clientes->save();
        }catch(Exception $ex){
            return false;
        }
    }

    public function info(int $id) : Clientes
    {
        return  Clientes::find($id);
    }

    public function editar(Request $datos) : bool
    {
        try{
            $clientes = Clientes::find($datos->id);
            $clientes->nombre = $datos->nombre;
            $clientes->documento = $datos->documento;
            $clientes->correo = $datos->correo;
            $clientes->direccion = $datos->direccion;
            return $clientes->save();
        }catch(Exception $ex){
            return false;
        }
    }

    public function eliminar(Request $datos) : bool
    {
        try{
            $clientes = Clientes::find($datos->id);
            return $clientes->delete();
        }catch(Exception $ex){
            return false;
        }
    }
}
