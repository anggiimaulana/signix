<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'SIGNIX ATMIN',
            'email' => 'robi@atmin.com',
            'password' => Hash::make('password'),
        ]);
    }
}