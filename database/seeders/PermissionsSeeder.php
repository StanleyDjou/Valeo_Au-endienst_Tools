<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new \DateTime();
        foreach(config('constants.PERMISSION_GROUPS') as $group){
            \DB::table('permissions')->insert([
                'name' => "Manage ".$group['name'],
                'slug' =>  strtolower("manage_".$group['name']),
            ]);
        }
    }
}
