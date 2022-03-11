<?php

namespace Database\Seeders;

use App\Models\Box;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_box = Box::where('id', 1)->exists();
        if (!$default_box) {
            Box::factory()->count(1)->create();
        }
    }
}
