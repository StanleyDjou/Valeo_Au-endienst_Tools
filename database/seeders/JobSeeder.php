<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/csv/job.json");
        $jobs = json_decode($json);

        foreach ($jobs as $job) {
            $skill = Skill::create([
                'name' => ucfirst($job->name),
            ]);

            foreach ($job->occupations as $ac) {
                Skill::create([
                    'name' => $ac,
                    'skill_id'=>$skill->id
                ]);
            }
        }
    }
}
