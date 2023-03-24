<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Programador']);
        $role2 = Role::create(['name' => 'Admin']);      

        Permission::create(['name' => 'home', 'grupo' => 'Inicio', 'descripcion' => 'Home'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'clientes.index','grupo' => 'CLIENTES', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'clientes.create','grupo' => 'CLIENTES', 'descripcion' => 'Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'clientes.edit','grupo' => 'CLIENTES', 'descripcion' => 'Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'clientes.destroy','grupo' => 'CLIENTES', 'descripcion' => 'Eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'entregas.index','grupo' => 'ENTREGAS', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'entregas.entregasmanuales','grupo' => 'ENTREGAS', 'descripcion' => 'Entregas Manuales'])->syncRoles([$role1]);
        Permission::create(['name' => 'entregas.crearentregas','grupo' => 'ENTREGAS', 'descripcion' => 'Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'entregas.anular','grupo' => 'ENTREGAS', 'descripcion' => 'Anular'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'clientesturnos.listado','grupo' => 'CLIENTES TURNOS', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'clientesturnos.adicionar','grupo' => 'CLIENTES TURNOS', 'descripcion' => 'Adicionar'])->syncRoles([$role1]);
        Permission::create(['name' => 'clientesturnos.cambia','grupo' => 'CLIENTES TURNOS', 'descripcion' => 'Cambia turno'])->syncRoles([$role1]);
        Permission::create(['name' => 'clientesturnos.elimina','grupo' => 'CLIENTES TURNOS', 'descripcion' => 'Eliminar'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'reservas.index','grupo' => 'RESERVAS', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'reservas.approve','grupo' => 'RESERVAS', 'descripcion' => 'Aprobaciones'])->syncRoles([$role1]);
        Permission::create(['name' => 'reservas.destroy','grupo' => 'RESERVAS', 'descripcion' => 'Eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'franjas.index','grupo' => 'FRANJAS', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'franjas.create','grupo' => 'FRANJAS', 'descripcion' => 'Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'franjas.edit','grupo' => 'FRANJAS', 'descripcion' => 'Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'franjas.destroy','grupo' => 'FRANJAS', 'descripcion' => 'Eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'turnos.index','grupo' => 'TURNOS', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'turnos.create','grupo' => 'TURNOS', 'descripcion' => 'Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'turnos.edit','grupo' => 'TURNOS', 'descripcion' => 'Editar'])->syncRoles([$role1]);        
        Permission::create(['name' => 'turnos.destroy','grupo' => 'TURNOS', 'descripcion' => 'Eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'empresas.index','grupo' => 'EMPRESAS', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'empresas.create','grupo' => 'EMPRESAS', 'descripcion' => 'Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'empresas.edit','grupo' => 'EMPRESAS', 'descripcion' => 'Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'empresas.destroy','grupo' => 'EMPRESAS', 'descripcion' => 'Eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'reportes.index','grupo' => 'REPORTES', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'reportes.general','grupo' => 'REPORTES', 'descripcion' => 'General'])->syncRoles([$role1]);
        Permission::create(['name' => 'reportes.diario','grupo' => 'REPORTES', 'descripcion' => 'Diario'])->syncRoles([$role1]);
        Permission::create(['name' => 'reportes.prodxemp','grupo' => 'REPORTES', 'descripcion' => 'Prod. por Empresas'])->syncRoles([$role1]);
        Permission::create(['name' => 'reportes.aprovreservas','grupo' => 'REPORTES', 'descripcion' => 'Aprob. Reservas'])->syncRoles([$role1]);

        Permission::create(['name' => 'users.index', 'grupo' => 'USUARIOS', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.edit', 'grupo' => 'USUARIOS', 'descripcion' => 'Asignar Rol'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'roles.index', 'grupo' => 'ROLES', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.create', 'grupo' => 'ROLES', 'descripcion' => 'Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.edit', 'grupo' => 'ROLES', 'descripcion' => 'Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.destroy', 'grupo' => 'ROLES', 'descripcion' => 'Eliminar'])->syncRoles([$role1]);

        Permission::create(['name' => 'mensualidades.index', 'grupo' => 'MENSUALIDADES', 'descripcion' => 'Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'mensualidades.create', 'grupo' => 'MENSUALIDADES', 'descripcion' => 'Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'mensualidades.edit', 'grupo' => 'MENSUALIDADES', 'descripcion' => 'Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'mensualidades.destroy', 'grupo' => 'MENSUALIDADES', 'descripcion' => 'Eliminar'])->syncRoles([$role1]);
    }
}
