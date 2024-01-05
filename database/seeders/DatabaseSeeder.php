<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'guard_name'=>'web','created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'seller', 'guard_name'=>'web','created_at'=>now(), 'updated_at'=>now()],
        ];

         Role::insert($roles);

       $user = User::create([
            'name'=>'Admin',
            'phone'=>'9800000000',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('password'),
            'email_verified_at'=>now(),
            'active'=>1
       ]);
       $user->assignRole('admin');
    }
}
