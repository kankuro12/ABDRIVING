<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ABDRIVING',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@123'),
            'center'=>''
        ]);
    }
}
