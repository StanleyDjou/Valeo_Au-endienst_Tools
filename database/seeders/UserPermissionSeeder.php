<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserPermissionSeeder extends Seeder
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
            \DB::table('user_permissions')->insert([
               'user_id' => 1,
               'permission_id'=>$permission->id,
            ]);
        }
    }
}
