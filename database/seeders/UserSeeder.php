<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' =>  Str::uuid(),
                'name' => 'Admin',
                'username' => 'superadmin',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'User',
                'username' => 'user1',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'John Doe',
                'username' => 'user3',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Jane Smith',
                'username' => 'user4',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Michael Johnson',
                'username' => 'user5',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Emily Davis',
                'username' => 'user6',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'David Brown',
                'username' => 'user7',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'M. Buriram Jordan',
                'username' => 'user8',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Michael Buriram Jordan',
                'username' => 'user9',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Michael B. Jordan',
                'username' => 'user10',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Sophia Williams',
                'username' => 'user11',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Ethan Thomas',
                'username' => 'user12',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Olivia Martinez',
                'username' => 'user13',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Ava White',
                'username' => 'user14',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'James Harris',
                'username' => 'user15',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Isabella Clark',
                'username' => 'user16',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Liam Lewis',
                'username' => 'user17',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Mia Walker',
                'username' => 'user18',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Noah Hall',
                'username' => 'user19',
                'password' => bcrypt('password'),
            ],
            [
                'id' =>  Str::uuid(),
                'name' => 'Lucas Young',
                'username' => 'user20',
                'password' => bcrypt('password'),
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $admin = User::where('username', 'superadmin')->first();
        $user1 = User::where('username', 'user1')->first();
        $user3 = User::where('username', 'user3')->first();
        $user4 = User::where('username', 'user4')->first();
        $user5 = User::where('username', 'user5')->first();
        $user6 = User::where('username', 'user6')->first();
        $user7 = User::where('username', 'user7')->first();
        $user8 = User::where('username', 'user8')->first();
        $user9 = User::where('username', 'user9')->first();
        $user10 = User::where('username', 'user10')->first();
        $user11 = User::where('username', 'user11')->first();
        $user12 = User::where('username', 'user12')->first();
        $user13 = User::where('username', 'user13')->first();
        $user14 = User::where('username', 'user14')->first();
        $user15 = User::where('username', 'user15')->first();
        $user16 = User::where('username', 'user16')->first();
        $user17 = User::where('username', 'user17')->first();
        $user18 = User::where('username', 'user18')->first();
        $user19 = User::where('username', 'user19')->first();
        $user20 = User::where('username', 'user20')->first();

        $admin->assignRole('admin');
        $user1->assignRole('user');
        $user3->assignRole('user');
        $user4->assignRole('user');
        $user5->assignRole('user');
        $user6->assignRole('user');
        $user7->assignRole('user');
        $user8->assignRole('user');
        $user9->assignRole('user');
        $user10->assignRole('user');
        $user11->assignRole('user');
        $user12->assignRole('user');
        $user13->assignRole('user');
        $user14->assignRole('user');
        $user15->assignRole('user');
        $user16->assignRole('user');
        $user17->assignRole('user');
        $user18->assignRole('user');
        $user19->assignRole('user');
        $user20->assignRole('user');
    }
}
