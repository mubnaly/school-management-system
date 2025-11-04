<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing data
        $this->clearTables();

        // Seed all tables
        $this->seedUsers();
        $this->seedStudentClasses();
        $this->seedStudentYears();
        $this->seedStudentGroups();
        $this->seedStudentShifts();
        $this->seedFeeCategories();
        $this->seedExamTypes();
        $this->seedSchoolSubjects();
        $this->seedDesignations();
        $this->seedStudents();
        $this->seedAssignSubjects();
        $this->seedFeeAmounts();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✅ Database seeded successfully!');
        $this->displayCredentials();
    }

    private function clearTables()
    {
        $tables = [
            'fee_category_amounts',
            'assign_subjects',
            'discount_students',
            'assign_students',
            'designations',
            'school_subjects',
            'exam_types',
            'fee_categories',
            'student_shifts',
            'student_groups',
            'student_years',
            'student_classes',
            'users',
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
    }

    private function seedUsers()
    {
        $users = [
            // Admin User
            [
                'name' => 'Admin User',
                'email' => 'admin@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin123'),
                // 'usertype' => 'admin',
                'code' => 'ADM00001',
                'role' => 'admin',
                'mobile' => '08123456789',
                'address' => '123 Education Street, Jakarta',
                'gender' => 'Male',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Instructor 1
            [
                'name' => 'Dr. Sarah Johnson',
                'email' => 'instructor@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('ins123'),
                // 'usertype' => 'admin',
                'code' => 'INS00001',
                'role' => 'Instructor',
                'mobile' => '08123456780',
                'address' => '45 Teacher Street, Jakarta',
                'gender' => 'Female',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Instructor 2
            [
                'name' => 'Prof. Ahmad Rahman',
                'email' => 'ahmad@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('ins123'),
                // 'usertype' => 'admin',
                'code' => 'INS00002',
                'role' => 'Instructor',
                'mobile' => '08123456781',
                'address' => '78 Educator Street, Jakarta',
                'gender' => 'Male',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }

    private function seedStudentClasses()
    {
        $classes = [
            ['name' => 'Beginner Level', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Intermediate Level', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Advanced Level', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Professional Level', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($classes as $class) {
            DB::table('student_classes')->insert($class);
        }
    }

    private function seedStudentYears()
    {
        $years = [
            ['name' => '2023', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '2024', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => '2025', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($years as $year) {
            DB::table('student_years')->insert($year);
        }
    }

    private function seedStudentGroups()
    {
        $groups = [
            ['name' => 'Programming', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Design', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Business', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Languages', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($groups as $group) {
            DB::table('student_groups')->insert($group);
        }
    }

    private function seedStudentShifts()
    {
        $shifts = [
            ['name' => 'Morning (08:00 - 12:00)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Afternoon (13:00 - 17:00)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Evening (18:00 - 21:00)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($shifts as $shift) {
            DB::table('student_shifts')->insert($shift);
        }
    }

    private function seedFeeCategories()
    {
        $categories = [
            ['name' => 'Registration Fee', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Monthly Tuition', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Course Materials', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Certification Fee', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($categories as $category) {
            DB::table('fee_categories')->insert($category);
        }
    }

    private function seedExamTypes()
    {
        $examTypes = [
            ['name' => 'Mid Term', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Final Exam', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Practical Test', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Project Assessment', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($examTypes as $examType) {
            DB::table('exam_types')->insert($examType);
        }
    }

    private function seedSchoolSubjects()
    {
        $subjects = [
            ['name' => 'Web Development', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mobile App Development', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'UI/UX Design', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Digital Marketing', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Data Science', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'English Language', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($subjects as $subject) {
            DB::table('school_subjects')->insert($subject);
        }
    }

    private function seedDesignations()
    {
        $designations = [
            ['name' => 'Senior Instructor', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Junior Instructor', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Course Coordinator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Lab Assistant', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($designations as $designation) {
            DB::table('designations')->insert($designation);
        }
    }

    private function seedStudents()
    {
        $students = [
            [
                'name' => 'John Doe',
                'email' => 'student@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('std123'),
                // 'usertype' => 'student',
                'code' => 'STD00001',
                'role' => 'student',
                'mobile' => '08111111111',
                'address' => '123 Student Street',
                'gender' => 'Male',
                'id_no' => '20250001',
                'birth' => Carbon::parse('2000-01-15'),
                'religion' => 'Islam',
                'father' => 'Mr. Doe',
                'mother' => 'Mrs. Doe',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('std123'),
                // 'usertype' => 'student',
                'code' => 'STD00002',
                'role' => 'student',
                'mobile' => '08222222222',
                'address' => '456 Student Street',
                'gender' => 'Female',
                'id_no' => '20250002',
                'birth' => Carbon::parse('2001-03-20'),
                'religion' => 'Christian',
                'father' => 'Mr. Smith',
                'mother' => 'Mrs. Smith',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ahmad Ashraf',
                'email' => 'ahmad@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('std123'),
                // 'usertype' => 'student',
                'code' => 'STD00003',
                'role' => 'student',
                'mobile' => '08333333333',
                'address' => '789 Student Street',
                'gender' => 'Male',
                'id_no' => '20250003',
                'birth' => Carbon::parse('1999-07-10'),
                'religion' => 'Islam',
                'father' => 'Mr. Ashraf',
                'mother' => 'Mrs. Ashraf',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($students as $student) {
            $userId = DB::table('users')->insertGetId($student);

            // Assign student to class
            $assignId = DB::table('assign_students')->insertGetId([
                'student_id' => $userId,
                'roll' => 1 + ($userId - 4),
                'class_id' => 1 + (($userId - 4) % 3),
                'year_id' => 2, // 2024
                'group_id' => 1,
                'shift_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Add discount
            DB::table('discount_students')->insert([
                'assign_student_id' => $assignId,
                'fee_category_id' => 1,
                'discount' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    private function seedAssignSubjects()
    {
        $assignments = [
            // Beginner Level
            ['class_id' => 1, 'subject_id' => 1, 'full_mark' => 100, 'pass_mark' => 60, 'subjective_mark' => 40],
            ['class_id' => 1, 'subject_id' => 3, 'full_mark' => 100, 'pass_mark' => 60, 'subjective_mark' => 40],

            // Intermediate Level
            ['class_id' => 2, 'subject_id' => 1, 'full_mark' => 100, 'pass_mark' => 65, 'subjective_mark' => 50],
            ['class_id' => 2, 'subject_id' => 2, 'full_mark' => 100, 'pass_mark' => 65, 'subjective_mark' => 50],

            // Advanced Level
            ['class_id' => 3, 'subject_id' => 2, 'full_mark' => 100, 'pass_mark' => 70, 'subjective_mark' => 60],
            ['class_id' => 3, 'subject_id' => 5, 'full_mark' => 100, 'pass_mark' => 70, 'subjective_mark' => 60],
        ];

        foreach ($assignments as $assignment) {
            DB::table('assign_subjects')->insert(array_merge($assignment, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }

    private function seedFeeAmounts()
    {
        $feeAmounts = [
            // Registration Fee
            ['fee_category_id' => 1, 'class_id' => 1, 'amount' => 500000],
            ['fee_category_id' => 1, 'class_id' => 2, 'amount' => 750000],
            ['fee_category_id' => 1, 'class_id' => 3, 'amount' => 1000000],

            // Monthly Tuition
            ['fee_category_id' => 2, 'class_id' => 1, 'amount' => 1500000],
            ['fee_category_id' => 2, 'class_id' => 2, 'amount' => 2000000],
            ['fee_category_id' => 2, 'class_id' => 3, 'amount' => 2500000],
        ];

        foreach ($feeAmounts as $amount) {
            DB::table('fee_category_amounts')->insert(array_merge($amount, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }

    private function displayCredentials()
    {
        $this->command->newLine();
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('                  LOGIN CREDENTIALS                    ');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('Admin:       admin@lms.test        / admin123');
        $this->command->info('Instructor:  instructor@lms.test   / ins123');
        $this->command->info('Instructor:  ahmad@lms.test        / ins123');
        $this->command->info('Student:     student@lms.test      / std123');
        $this->command->info('Student:     jane@lms.test         / std123');
        $this->command->info('Student:     ahmad@lms.test        / std123');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->newLine();
    }
}
