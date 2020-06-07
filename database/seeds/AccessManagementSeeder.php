<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users

        DB::table('admin_users')->insert([/* id => 1 */'name' => 'Administrator', 'username' => 'admin', 'password' => bcrypt('admin')]);
        DB::table('admin_users')->insert([/* id => 2 */'name' => 'Manager', 'username' => 'manager', 'password' => bcrypt('manager')]);
        DB::table('admin_users')->insert([/* id => 3 */'name' => 'User 1', 'username' => 'user1', 'password' => bcrypt('user1')]);
        DB::table('admin_users')->insert([/* id => 4 */'name' => 'User 2', 'username' => 'user2', 'password' => bcrypt('user2')]);
        DB::table('admin_users')->insert([/* id => 5 */'name' => 'User 3', 'username' => 'user3', 'password' => bcrypt('user3')]);


        // Roles

        DB::table('admin_roles')->insert([/* id => 1 */'name' => 'Administrator', 'slug' => 'administrator']);
        DB::table('admin_roles')->insert([/* id => 2 */'name' => 'Gestor de información', 'slug' => 'info_manager']);
        DB::table('admin_roles')->insert([/* id => 3 */'name' => 'Usuario', 'slug' => 'user']);

        DB::table('admin_role_users')->insert(['role_id' => 1, 'user_id' => 1]);
        DB::table('admin_role_users')->insert(['role_id' => 2, 'user_id' => 2]);
        DB::table('admin_role_users')->insert(['role_id' => 3, 'user_id' => 3]);
        DB::table('admin_role_users')->insert(['role_id' => 3, 'user_id' => 4]);
        DB::table('admin_role_users')->insert(['role_id' => 3, 'user_id' => 5]);


        // Permissions

        DB::table('admin_permissions')->insert([/* id => 1 */'name' => 'Todos los permisos', 'slug' => '*', 'http_method' => '', 'http_path' => '*']);
        DB::table('admin_permissions')->insert([/* id => 2 */'name' => 'Dashboard', 'slug' => 'dashboard', 'http_method' => 'GET', 'http_path' => '/']);
        DB::table('admin_permissions')->insert([/* id => 3 */'name' => 'Login', 'slug' => 'auth.login', 'http_method' => '', 'http_path' => '/auth/login' . "\n" . '/auth/logout']);
        DB::table('admin_permissions')->insert([/* id => 4 */'name' => 'Editar perfil', 'slug' => 'auth.setting', 'http_method' => 'GET,PUT', 'http_path' => '/auth/setting']);
        DB::table('admin_permissions')->insert([/* id => 5 */'name' => 'Administrar accesos', 'slug' => 'auth.management', 'http_method' => '', 'http_path' => '/auth/roles' . "\n" . '/auth/permissions' . "\n" . '/auth/menu' . "\n" . '/auth/logs']);
        DB::table('admin_permissions')->insert([/* id => 6 */'name' => 'Gestionar información', 'slug' => 'info.management', 'http_method' => '', 'http_path' => '/api*']);

        DB::table('admin_role_permissions')->insert(['role_id' => 1, 'permission_id' => 1]);
        DB::table('admin_role_permissions')->insert(['role_id' => 2, 'permission_id' => 2]);
        DB::table('admin_role_permissions')->insert(['role_id' => 2, 'permission_id' => 4]);
        DB::table('admin_role_permissions')->insert(['role_id' => 2, 'permission_id' => 6]);


        // Menu

        DB::table('admin_menu')->insert([/* id => 1 */'parent_id' => 0, 'order' => 1, 'title' => 'Dashboard', 'icon' => 'fa-bar-chart', 'uri' => '/']);
        DB::table('admin_menu')->insert([/* id => 2 */'parent_id' => 0, 'order' => 2, 'title' => 'Administración', 'icon' => 'fa-tasks', 'uri' => '']);
        DB::table('admin_menu')->insert([/* id => 3 */'parent_id' => 2, 'order' => 3, 'title' => 'Usuarios', 'icon' => 'fa-users', 'uri' => 'auth/users']);
        DB::table('admin_menu')->insert([/* id => 4 */'parent_id' => 2, 'order' => 4, 'title' => 'Roles', 'icon' => 'fa-user', 'uri' => 'auth/roles']);
        DB::table('admin_menu')->insert([/* id => 5 */'parent_id' => 2, 'order' => 5, 'title' => 'Permisos', 'icon' => 'fa-ban', 'uri' => 'auth/permissions']);
        DB::table('admin_menu')->insert([/* id => 6 */'parent_id' => 2, 'order' => 6, 'title' => 'Menú', 'icon' => 'fa-bars', 'uri' => 'auth/menu']);
        DB::table('admin_menu')->insert([/* id => 7 */'parent_id' => 2, 'order' => 7, 'title' => 'Logs de Operaciones', 'icon' => 'fa-history', 'uri' => 'auth/logs']);
        DB::table('admin_menu')->insert([/* id => 8 */'parent_id' => 0, 'order' => 8, 'title' => 'Proyectos', 'icon' => 'fa-folder-open', 'uri' => 'api/projects']);
        DB::table('admin_menu')->insert([/* id => 9 */'parent_id' => 0, 'order' => 9, 'title' => 'Funciones', 'icon' => 'fa-book', 'uri' => 'api/standards']);
        DB::table('admin_menu')->insert([/* id => 10 */'parent_id' => 0, 'order' => 10, 'title' => 'Valores Formularios', 'icon' => 'fa-wpforms', 'uri' => 'api/values']);
        DB::table('admin_menu')->insert([/* id => 11 */'parent_id' => 0, 'order' => 11, 'title' => 'Vehículos', 'icon' => 'fa-car', 'uri' => 'api/vehicles']);
        DB::table('admin_menu')->insert([/* id => 12 */'parent_id' => 0, 'order' => 100, 'title' => 'Nomencladores', 'icon' => 'fa-cog', 'uri' => '']);
        DB::table('admin_menu')->insert([/* id => 13 */'parent_id' => 12, 'order' => 101, 'title' => 'Automóviles', 'icon' => 'fa-list', 'uri' => 'api/automoviles']);
        DB::table('admin_menu')->insert([/* id => 14 */'parent_id' => 12, 'order' => 102, 'title' => 'Marcas', 'icon' => 'fa-list', 'uri' => 'api/marcas']);
        DB::table('admin_menu')->insert([/* id => 15 */'parent_id' => 12, 'order' => 103, 'title' => 'Modelos', 'icon' => 'fa-list', 'uri' => 'api/modelos']);
        DB::table('admin_menu')->insert([/* id => 16 */'parent_id' => 12, 'order' => 104, 'title' => 'Tipos de vehículo', 'icon' => 'fa-list', 'uri' => 'api/tipos-vehiculo']);
        DB::table('admin_menu')->insert([/* id => 17 */'parent_id' => 12, 'order' => 105, 'title' => 'Tipos de combustible', 'icon' => 'fa-list', 'uri' => 'api/tipos-combustible']);
        DB::table('admin_menu')->insert([/* id => 18 */'parent_id' => 12, 'order' => 106, 'title' => 'Bombas de Abastecimiento', 'icon' => 'fa-list', 'uri' => 'api/bombas-abastecimiento']);
        DB::table('admin_menu')->insert([/* id => 19 */'parent_id' => 12, 'order' => 107, 'title' => 'Sistemas de Amortiguación', 'icon' => 'fa-list', 'uri' => 'api/sistemas-amortiguacion']);
        DB::table('admin_menu')->insert([/* id => 20 */'parent_id' => 12, 'order' => 108, 'title' => 'Estados de Medición', 'icon' => 'fa-list', 'uri' => 'api/estados-medicion']);
        DB::table('admin_menu')->insert([/* id => 21 */'parent_id' => 12, 'order' => 109, 'title' => 'Generadores de Gasolina', 'icon' => 'fa-list', 'uri' => 'api/generadores-gasolina']);
        DB::table('admin_menu')->insert([/* id => 22 */'parent_id' => 0, 'order' => 90, 'title' => 'Formularios dinámicos', 'icon' => 'fa-cog', 'uri' => '']);
        DB::table('admin_menu')->insert([/* id => 23 */'parent_id' => 22, 'order' => 91, 'title' => 'Formularios', 'icon' => 'fa-list', 'uri' => 'api/formularios']);
        DB::table('admin_menu')->insert([/* id => 24 */'parent_id' => 22, 'order' => 92, 'title' => 'Campos', 'icon' => 'fa-list', 'uri' => 'api/fields']);

        DB::table('admin_role_menu')->insert(['role_id' => 1, 'menu_id' => 2]);
    }
}
