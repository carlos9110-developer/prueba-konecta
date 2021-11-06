<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\View\View;

class ClientesController extends Controller
{
    public function index(Request $request,Clientes $clientes)
    {
        if(!$this->verificarToken() == false){
            if($request->ajax())
            {
                $data = $clientes->listar();
                return DataTables::of($data)
                ->addColumn('action', function($data){
                    $button = '<a title="Editar" href="'.route('clientes.edit', ['id' => $data->id]).'" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a> ';
                    $button .= '<a title="Eliminar" href="'.route('clientes.delete', ['id' => $data->id]).'" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('modulos.clientes.index');
        }else{
            return redirect()->route('login');
        }
    }

    public function create() : View
    {
        if(!$this->verificarToken() == false){
            return view('modulos.clientes.create');
        }else{
            return redirect()->route('login');
        }
    }

    public function store(Request $request,Clientes $clientes)
    {
        if(!$this->verificarToken() == false){
            if($clientes->guardar($request)){
                $request->session()->flash('flash_succees', 'Cliente registrado exitosamente');
                return redirect()->route('clientes.index');
            }else{
                $request->session()->flash('flash_error', $clientes->guardar($request));
                return redirect()->route('clientes.create');
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function edit(Request $request, Clientes $clientes)
    {
        if(!$this->verificarToken() == false){
            return view('modulos.clientes.edit')->with("cliente", $clientes->info($request->id));
        }else{
            return redirect()->route('login');
        }
    }

    public function update(Request $request, Clientes $clientes)
    {
        if(!$this->verificarToken() == false){
            if($clientes->editar($request)){
                $request->session()->flash('flash_succees', 'Información cliente editada exitosamente');
                return redirect()->route('clientes.index');
            }else{
                $request->session()->flash('flash_error', 'Error, no fue posible editar la información del cliente, verifique que no hay un registro con el mismo correo o documento');
                return redirect()->route('clientes.edit',['id' => $request->id]);
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function delete(Request $request, Clientes $clientes)
    {
        if(!$this->verificarToken() == false){
            return view('modulos.clientes.delete')->with("cliente", $clientes->info($request->id));
        }else{
            return redirect()->route('login');
        }
    }

    public function delete_proceso(Request $request, Clientes $clientes)
    {
        if(!$this->verificarToken() == false){
            if($clientes->eliminar($request)){
                $request->session()->flash('flash_succees', 'Cliente eliminado exitosamente');
                return redirect()->route('clientes.index');
            }else{
                $request->session()->flash('flash_error', 'Error, no fue posible eliminar la información del cliente, por favor intentelo de nuevo');
                return redirect()->route('clientes.delete',['id' => $request->id]);
            }
        }else{
            return redirect()->route('login');
        }
    }
}
