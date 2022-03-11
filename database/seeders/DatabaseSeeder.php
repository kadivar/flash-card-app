<?php

namespace Database\Seeders;

use Database\Factories\AdminFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin_exist = User::where('name', 'Super Admin')->exists();
        if (!$admin_exist) {
            User::admin_factory()->count(1)->create();
        }
    }
}
