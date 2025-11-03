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
        // Delete existing test users (safer than truncate)
        DB::table('users')->whereIn('email', [
            'admin@lms.test',
            'instructor@lms.test',
            'student@lms.test'
        ])->delete();

        // Admin User
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@lms.test',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('admin123'),
            'usertype' => 'Admin',
            'code' => 'ADM00001',
            'role' => 'Admin',
            'mobile' => '08123456789',
            'address' => 'School Address',
            'gender' => 'Laki-Laki',
            'status' => 1,
            'father' => null,
            'mother' => null,
            'religion' => null,
            'id_no' => null,
            'birth' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Instructor User
        DB::table('users')->insert([
            'name' => 'Jane Instructor',
            'email' => 'instructor@lms.test',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('ins123'),
            'usertype' => 'Admin',
            'code' => 'INS00001',
            'role' => 'Operator',
            'mobile' => '08123456780',
            'address' => 'Instructor Address',
            'gender' => 'Perempuan',
            'status' => 1,
            'father' => null,
            'mother' => null,
            'religion' => null,
            'id_no' => null,
            'birth' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Student User
        DB::table('users')->insert([
            'name' => 'Student Learner',
            'email' => 'student@lms.test',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('stud123'),
            'usertype' => 'Student',
            'code' => 'STD00001',
            'role' => 'User',
            'mobile' => '08123456781',
            'address' => 'Student Address',
            'gender' => 'Laki-Laki',
            'status' => 1,
            'id_no' => '20220001',
            'birth' => Carbon::parse('2005-01-01'),
            'religion' => 'Islam',
            'father' => 'Father Name',
            'mother' => 'Mother Name',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $this->command->info('✅ Three test users seeded successfully!');
        $this->command->newLine();
        $this->command->info('Login Credentials:');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('Admin:      admin@lms.test      / admin123');
        $this->command->info('Instructor: instructor@lms.test / ins123');
        $this->command->info('Student:    student@lms.test    / stud123');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    }
}
