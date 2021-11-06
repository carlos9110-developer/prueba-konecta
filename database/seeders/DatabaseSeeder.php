<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $idRolAdministrador = DB::table('roles')->insertGetId(['rol' => 'Administrador']);
        $idRolVendedor      = DB::table('roles')->insertGetId(['rol' => 'Vendedor']);

        DB::table('users')->insert([
            'id_rol' 	        =>	$idRolAdministrador,
            'nombre'			=>	'Carlos Eduardo Hincapie Hidalgo',
            'documento'			=>	'1088008382',
            'correo'			=>	'carlos@hotmail.com',
            'direccion'			=>	'Samaria 2 manzana 2 casa 10',
            'password'	        =>  hash("SHA256",'12345'),
        ]);

        $idModuloUsuarios =  DB::table('modulos')->insertGetId(['modulo' => 'Usuarios', 'ruta' => 'usuarios.index', 'icono' => 'bi bi-person-plus']);
        $idModuloClientes =  DB::table('modulos')->insertGetId(['modulo' => 'Clientes', 'ruta' => 'clientes.index', 'icono' => 'bi bi-person-badge']);

        $modulos_roles = [
            [
                'id_rol' => $idRolAdministrador,
                'id_modulo' => $idModuloUsuarios
            ],
            [
                'id_rol' => $idRolAdministrador,
                'id_modulo' => $idModuloClientes
            ],
            [
                'id_rol' => $idRolVendedor,
                'id_modulo' => $idModuloClientes
            ]
        ];
        DB::table('modulos_roles')->insert($modulos_roles);

    }
}
