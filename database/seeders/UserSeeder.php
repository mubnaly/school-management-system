<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{

    public function run()
    {
        // Define the three users with different roles and passwords
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@lms.test',
                // Assuming 'admin' is the required role value
                'role' => 'admin',
                'password' => 'admin123',
                // 'password' => Hash::make('password'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jane Instructor',
                'email' => 'instructor@lms.test',
                // Assuming 'instructor' (or 'teacher') is the required role value
                'role' => 'instructor',
                // 'password' => Hash::make('password'),
                'password' => 'ins123',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Student Learner',
                'email' => 'student@lms.test',
                // Assuming 'student' is the required role value
                'role' => 'student',
                // 'password' => Hash::make('password'),
                'password' => 'stud123',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        // Insert the users into the database
        DB::table('users')->insert($users);

        $this->command->info('Three test users (Admin, Instructor, Student) seeded successfully!');
    }
}
