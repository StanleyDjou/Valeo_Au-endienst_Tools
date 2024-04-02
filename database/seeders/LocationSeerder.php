<?php

namespace Database\Seeders;

use App\Models\Cities;
use App\Models\Product;
use App\Models\Regions;
use Illuminate\Database\Seeder;

class LocationSeerder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvData = fopen(base_path('database/csv/worldcities.csv'), 'r');
        $transRow = true;
        $i = 0;

        while (($data = fgetcsv($csvData, 1000, ',')) !== false) {
            if ($i > 0) {
                if (!$transRow) {
                  if( $data[4] === "Cameroon"){
                      $region  = Regions::where(['name' => $data[7]])->first();
                      if(!isset($region)){
                          $region  = Regions::create(['name' => $data[7]]);
                      }
                      $city = Cities::create(['name' => $data[0], 'region_id'=>$region->id]);
                  }
                }
            }
            $transRow = false;
            $i++;
        }
        fclose($csvData);
    }
}
