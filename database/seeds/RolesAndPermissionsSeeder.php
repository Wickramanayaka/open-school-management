<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');


        Permission::create(['name' => 'module all']);
        Permission::create(['name' => 'admin dashboard']);
        Permission::create(['name' => 'teacher dashboard']);

        Permission::create(['name' => 'module teachers']);
        Permission::create(['name' => 'create teachers']);
        Permission::create(['name' => 'edit teachers']);
        Permission::create(['name' => 'view teachers']);
        Permission::create(['name' => 'delete teachers']);
        Permission::create(['name' => 'update teachers']);
        Permission::create(['name' => 'index teachers']);
        Permission::create(['name' => 'view teachers attendance']);
        Permission::create(['name' => 'upload teachers attendance']);
        Permission::create(['name' => 'change class teachers']);
        Permission::create(['name' => 'leaving teachers']);
        Permission::create(['name' => 'choose subject for teachers']);

        Permission::create(['name' => 'module students']);
        Permission::create(['name' => 'create students']);
        Permission::create(['name' => 'edit students']);
        Permission::create(['name' => 'view students']);
        Permission::create(['name' => 'delete students']);
        Permission::create(['name' => 'update students']);

        Permission::create(['name' => 'module grades']);
        Permission::create(['name' => 'module exams']);
        Permission::create(['name' => 'module reports']);
        Permission::create(['name' => 'module subjects']);
        Permission::create(['name' => 'module users']);
        Permission::create(['name' => 'module attendance']);
        Permission::create(['name' => 'module settings']);
        Permission::create(['name' => 'module school']);
        Permission::create(['name' => 'module academic years']);
        Permission::create(['name' => 'module terms']);

        
        $role = Role::create(['name' => 'Administrator']);
        $role->givePermissionTo(['module all','admin dashboard']);

        $role = Role::create(['name' => 'Principal']);
        $role->givePermissionTo(['module teachers','module students','module grades','module exams','module reports','module subjects','admin dashboard']);

        $role = Role::create(['name' => 'Admin Deputy']);
        $role->givePermissionTo(['module teachers','module students','admin dashboard']);

        // $role = Role::create(['name' => 'Finance Deputy']);
        // $role->givePermissionTo(['module teachers','module stuudents']);

        $role = Role::create(['name' => 'Development Deputy']);
        $role->givePermissionTo(['module teachers','module students','module grades','module exams','module reports','module subjects','admin dashboard']);

        $role = Role::create(['name' => 'Section Head']);
        $role->givePermissionTo(['view students', 'teacher dashboard']);

        $role = Role::create(['name' => 'Grade Coordinator']);
        $role->givePermissionTo(['view students', 'teacher dashboard']);

        $role = Role::create(['name' => 'Class Teacher']);
        $role->givePermissionTo(['view students', 'teacher dashboard']);

        $role = Role::create(['name' => 'Student']);




        // $role = Role::create(['name' => 'Finance Deputy']);
        // $role = Role::create(['name' => 'SDS Committee']);
        // $role = Role::create(['name' => 'Treasurer']);
        // $role = Role::create(['name' => 'Finance Staff']);

        // $role = Role::create(['name' => 'Development Deputy']);
        // $role = Role::create(['name' => 'Assistant Principal Development']);
        // $role = Role::create(['name' => 'Assistant Principal Co-curricular']);
        // $role = Role::create(['name' => 'Development Head Primary']);
        // $role = Role::create(['name' => 'Development Head Junior']);
        // $role = Role::create(['name' => 'Development Head Senior']);
        // $role = Role::create(['name' => 'Development Head A/L']);
        // $role = Role::create(['name' => 'Subject Teacher']);
        // $role = Role::create(['name' => 'POG']);
        // $role = Role::create(['name' => 'POS']);
        // $role = Role::create(['name' => 'MIC']);


    }
}
