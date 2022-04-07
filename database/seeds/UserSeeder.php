<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        //Permission::truncate();
        //Role::truncate();
        //User::truncate();

        app()['cache']->forget('spatie.permission.cache');

        $adminRole = Role::create(['name' => 'Admin']);
        $profesorRole = Role::create(['name' => 'Profesor']);
        //$userRole = Role::create(['name' => 'User']);

        $viewPostsPermission = Permission::create(['name' => 'View posts']);
        $createPostsPermission = Permission::create(['name' => 'Create posts']);
        $updatePostsPermission = Permission::create(['name' => 'Update posts']);
        $deletePostsPermission = Permission::create(['name' => 'Delete posts']);

        $viewExamsPermission = Permission::create(['name' => 'View examen']);
        $createExamsPermission = Permission::create(['name' => 'Create examen']);
        $updateExamsPermission = Permission::create(['name' => 'Update examen']);
        $deleteExamsPermission = Permission::create(['name' => 'Delete examen']);

        $allPermissions = [$viewPostsPermission, $createPostsPermission, $updatePostsPermission, $deletePostsPermission, $viewExamsPermission, $createExamsPermission, $updateExamsPermission, $deleteExamsPermission];       
        
        $adminUser = User::create(array(
            'name'      => 'Fabio', 
            'lastName'	=> 'Espin',  
            'email'	=>	'fabioespins@gmail.com', 
            'password'	=>	bcrypt(123456),                  
        ));

        $adminUser->save();

        $adminRole->syncPermissions($allPermissions);
        $adminUser->assignRole($adminRole);


        $adminUser2 = User::create(array(
            'name'      => 'Carlos', 
            'lastName'  => 'Abrisqueta',  
            'email' =>  'dwes@iescierva.net', 
            'password'  =>  bcrypt(123456),                  
        ));

        $adminUser2->save();
        $adminUser2->assignRole($adminRole);
        
        /*
        $profesorUser = User::create(array(
            'name'      => 'Dio', 
            'lastName'  => 'Brando',  
            'email' =>  'mudamuda@gmx.es', 
            'password'  =>  bcrypt(123456),                  
        ));

        $profesorUser->save();

        $profesorRole->syncPermissions($allPermissions);
        $profesorUser->assignRole($profesorRole);

        $user = User::create(array(
            'name'      => 'Lejia', 
            'lastName'  => 'sana',  
            'email' =>  'lejia@gmx.es', 
            'password'  =>  bcrypt(123456),                  
        ));

        $user->save();

        $userRole->givePermissionTo([$viewPostsPermission, $viewExamsPermission]);
        $user->assignRole($userRole);
        */
    }
}
