<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = new User();
        $user->first_name = 'Admin';
        $user->last_name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make(123456);
        $user->bio = 'Admin';
        $user->role = 1;
        $user->save();
    }
}
