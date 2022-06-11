<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EditAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'Admin', 
            'name' => 'Admin', 
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
        $user->assignRole('Admin');
    
        $user1 = User::create([
            'username' => 'amilhead', 
            'name' => 'Amil Head', 
            'email' => 'amil@amil.com',
            'password' => bcrypt('123456')
        ]);
        $user1->assignRole('Outsource Head');
    
        $user2 = User::create([
            'username' => 'amilstaf', 
            'name' => 'Amil Staf', 
            'email' => 'amil@amil1.com',
            'password' => bcrypt('123456')
        ]);
        $user2->assignRole('Outsource Staf');
        
        $user3 = User::create([
            'username' => 'Bendahara', 
            'name' => 'Bendahara Masjid', 
            'email' => 'behndara@masjid.com',
            'password' => bcrypt('123456')
        ]);
        $user3->assignRole('DKM-Bendahara');
    }
}
