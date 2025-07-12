<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar la caché de roles y permisos para asegurar que los cambios se apliquen
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Definir y crear todos los permisos necesarios
        // Permisos relacionados con la gestión de equipos (Administrador)
        Permission::firstOrCreate(['name' => 'manage equipment']); // Gestionar equipos (CRUD)
        Permission::firstOrCreate(['name' => 'manage maintenance types']); // Gestionar tipos de mantenimiento
        Permission::firstOrCreate(['name' => 'manage incident types']); // Gestionar tipos de incidencias
        Permission::firstOrCreate(['name' => 'manage equipment status']); // Gestionar estados de equipo
        Permission::firstOrCreate(['name' => 'manage areas/departments']); // Gestionar áreas/departamentos
        Permission::firstOrCreate(['name' => 'manage technicians/providers']); // Gestionar técnicos/proveedores
        Permission::firstOrCreate(['name' => 'view all reports']); // Ver todos los reportes

        // Permisos relacionados con mantenimientos e incidencias (Técnico)
        Permission::firstOrCreate(['name' => 'register maintenance']); // Registrar mantenimientos
        Permission::firstOrCreate(['name' => 'edit maintenance']); // Editar mantenimientos
        Permission::firstOrCreate(['name' => 'delete maintenance']); // Eliminar mantenimientos
        Permission::firstOrCreate(['name' => 'register incident']); // Registrar incidencias
        Permission::firstOrCreate(['name' => 'edit incident']); // Editar incidencias
        Permission::firstOrCreate(['name' => 'delete incident']); // Eliminar incidencias
        Permission::firstOrCreate(['name' => 'view assigned reports']); // Ver reportes asignados (si aplica)

        // Permisos relacionados con usuario final
        Permission::firstOrCreate(['name' => 'view own equipment']); // Consultar su propio equipo
        Permission::firstOrCreate(['name' => 'report incident']); // Reportar incidencias (crear)
        Permission::firstOrCreate(['name' => 'view own incidents']); // Consultar sus propias incidencias
        Permission::firstOrCreate(['name' => 'view own maintenance history']); // Consultar historial de mantenimiento de su equipo

        // Permiso global para la gestión de usuarios (solo Administrador)
        Permission::firstOrCreate(['name' => 'manage users']); // Gestionar usuarios (CRUD de usuarios, asignar roles)


        // 2. Definir y crear los roles
        $adminRole = Role::firstOrCreate(['name' => 'administrador']);
        $tecnicoRole = Role::firstOrCreate(['name' => 'tecnico']);
        $userRole = Role::firstOrCreate(['name' => 'usuario']);

        // 3. Asignar Permisos a cada Rol

        // Administrador (gestiona todo)
        $adminRole->givePermissionTo(Permission::all()); // Asigna *todos* los permisos al administrador

        // Técnico (registra mantenimientos e incidencias)
        $tecnicoRole->givePermissionTo([
            'register maintenance',
            'edit maintenance',
            'delete maintenance', // Decide si el técnico puede eliminar o solo editar/registrar
            'register incident',
            'edit incident',
            'delete incident', // Decide si el técnico puede eliminar
            'view assigned reports', // Si hay reportes específicos para técnicos
            'manage equipment', // Si el técnico puede asignar equipos, etc. (ajusta según necesites)
            'view own equipment', // Un técnico también podría querer ver sus equipos
        ]);

        // Usuario (consulta su equipo y puede reportar incidencias)
        $userRole->givePermissionTo([
            'view own equipment',
            'report incident',
            'view own incidents',
            'view own maintenance history',
        ]);

        // Opcional: Asignar un rol a un usuario existente (por ejemplo, tu propio usuario de desarrollo)
        // Asegúrate de que tu usuario ya exista en la base de datos (tabla 'users').
        // Podrías tener un seeder separado para crear usuarios si aún no lo tienes.
        $yourAdminUser = \App\Models\User::find(1); // Busca tu usuario de desarrollo por ID
        if ($yourAdminUser) {
            $yourAdminUser->assignRole('administrador'); // Asigna el rol 'administrador' a tu usuario
        }

        $yourAdminUser = \App\Models\User::find(2); // Busca tu usuario de desarrollo por ID
        if ($yourAdminUser) {
            $yourAdminUser->assignRole('tecnico'); // Asigna el rol 'tecnico' a tu usuario
        }
        
        $yourAdminUser = \App\Models\User::find(3); // Busca tu usuario de desarrollo por ID
        if ($yourAdminUser) {
            $yourAdminUser->assignRole('usuario'); // Asigna el rol 'usuarios' a tu usuario
        }


    }
}