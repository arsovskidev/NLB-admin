<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
        ];

        Admin::create($admin);
    }
}
