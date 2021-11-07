<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\View\View;
use App\Http\Requests\ValidarFormularioUsuarios;
use App\Http\Requests\ValidarFormularioUsuariosEditar;


class UsuariosController extends Controller
{
    public function login(Request $request)
    {

        $email=$request->email;
        $password=$request->clave;
        $rol=$request->rol;

        if(!is_null($email) && !is_null($password) &&  !is_null($rol))
        {
            $jwt    = new JwtAuth();
            $result = $jwt->login($email,$password,$rol);

            if($result['res']){
               session(['sesion_usuario' => $result]);
               return redirect()->route('usuarios.inicio');
            }else{
                $request->session()->flash('flash_error', $result['msg']);
                return redirect()->route('login');
            }
        }
    }

    public function inicio(Request $request)
    {
        if(!$this->verificarToken() == false){
            return view('modulos.inicio');
        }else{
            return redirect()->route('login');
        }
    }


    public function index(Request $request,User $user)
    {
        if(!$this->verificarToken(1) == false){
            if($request->ajax())
            {
                $data = $user->listar();
                return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<a title="Editar" href="'.route('usuarios.edit', ['id' => $data->id]).'" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a> ';
                    $button .= '<a title="Eliminar" href="'.route('usuarios.delete', ['id' => $data->id]).'" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('modulos.usuarios.index');
        }else{
            return redirect()->route('login');
        }
    }

    public function create(Roles $roles) : View
    {
        if(!$this->verificarToken(1) == false){
            return view('modulos.usuarios.create')->with("roles",$roles->listarSelect());
        }else{
            return redirect()->route('login');
        }
    }

    public function store(ValidarFormularioUsuarios $request,User $user)
    {
        if(!$this->verificarToken(1) == false){
            if($user->guardar($request)){
                $request->session()->flash('flash_succees', 'Usuario registrado exitosamente, recuerde que la contraseña para entrar al sistema es la cédula registrada');
                return redirect()->route('usuarios.index');
            }else{
                $request->session()->flash('flash_error', 'Error, no fue posible registrar el usuario, verifique que no hay un registro con el mismo correo o documento');
                return redirect()->route('usuarios.create');
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function edit(Request $request, User $user, Roles $roles)
    {
        if(!$this->verificarToken(1) == false){
            $roles   = $roles->listarSelect();
            $usuario = $user->info($request->id);
            return view('modulos.usuarios.edit', compact('roles','usuario'));
        }else{
            return redirect()->route('login');
        }
    }

    public function update(ValidarFormularioUsuariosEditar $request, User $user)
    {
        if(!$this->verificarToken(1) == false){
            if($user->editar($request)){
                $request->session()->flash('flash_succees', 'Información usuario editada exitosamente, recuerde que la contraseña para entrar al sistema es la cédula registrada');
                return redirect()->route('usuarios.index');
            }else{
                $request->session()->flash('flash_error', 'Error, no fue posible editar la información del usuario, verifique que no hay un registro con el mismo correo o documento');
                return redirect()->route('usuarios.edit',['id' => $request->id]);
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function delete(Request $request, User $user, Roles $roles)
    {
        if(!$this->verificarToken(1) == false){
            $roles   = $roles->listarSelect();
            $usuario = $user->info($request->id);
            return view('modulos.usuarios.delete', compact('roles','usuario'));
        }else{
            return redirect()->route('login');
        }
    }

    public function delete_proceso(Request $request, User $user)
    {
        if(!$this->verificarToken(1) == false){
            if($user->eliminar($request)){
                $request->session()->flash('flash_succees', 'Usuario eliminado exitosamente');
                return redirect()->route('usuarios.index');
            }else{
                $request->session()->flash('flash_error', 'Error, no fue posible eliminar la información del usuario, por favor intentelo de nuevo');
                return redirect()->route('usuarios.delete',['id' => $request->id]);
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function cerrar()
    {
        session()->forget('sesion_usuario');// limpiar sesiones
        return redirect()->route('login');
    }


}
