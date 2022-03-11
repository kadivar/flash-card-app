<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
