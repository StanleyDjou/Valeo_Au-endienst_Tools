<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new \DateTime();
        foreach(\App\Models\Permissions::all() as $permission){
            \DB::table('role_permissions')->insert([
               'role_id' => 1,
               'permissions_id'=>$permission->id,
            ]);
        }
    }
}
