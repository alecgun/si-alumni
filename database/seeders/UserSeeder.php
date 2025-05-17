<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'John Doe',
                'email' => 'user3@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'user4@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Michael Johnson',
                'email' => 'user5@gmail.com',
                'password' => bcrypt('password'),
            ],
                        [
                'name' => 'Emily Davis',
                'email' => 'user6@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'David Brown',
                'email' => 'user7@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'M. Buriram Jordan',
                'email' => 'user8@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Michael Buriram Jordan',
                'email' => 'user9@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Michael B. Jordan',
                'email' => 'user10@gmail.com',
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $user = User::find(1);
        $user->assignRole('admin');
        $user = User::find(2);
        $user->assignRole('user');
        $user = User::find(3);
        $user->assignRole('user');
        $user = User::find(4);
        $user->assignRole('user');
        $user = User::find(5);
        $user->assignRole('user');
        $user = User::find(6);
        $user->assignRole('user');
        $user = User::find(7);
        $user->assignRole('user');
        $user = User::find(8);
        $user->assignRole('user');
        $user = User::find(9);
        $user->assignRole('user');
        $user = User::find(10);
        $user->assignRole('user');
    }
}
