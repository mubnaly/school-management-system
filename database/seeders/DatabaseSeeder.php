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

        // New tables for online learning platform
        $this->seedCategories();
        $this->seedCourses();
        $this->seedCourseCategories();
        $this->seedSections();
        $this->seedLessons();
        $this->seedEnrollments();
        $this->seedLessonProgress();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✅ Database seeded successfully!');
        $this->displayCredentials();
    }

    private function clearTables()
    {
        $tables = [
            'lesson_progress',
            'enrollments',
            'lessons',
            'sections',
            'course_category',
            'courses',
            'categories',
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
                'user_name' => 'admin',
                'email' => 'admin@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin123'),
                // 'usertype' => 'admin',
                'code' => 'ADM00001',
                'role' => 'admin',
                'mobile' => '08123456789',
                'address' => '123 Education Street, Jakarta',
                'gender' => 'male',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Instructor 1
            [
                'name' => 'Dr. Sarah Johnson',
                'user_name' => 'sarahjohnson',
                'email' => 'instructor@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('ins123'),
                // 'usertype' => 'instructor',
                'code' => 'INS00001',
                'role' => 'instructor',
                'mobile' => '08123456780',
                'address' => '45 Teacher Street, Jakarta',
                'gender' => 'female',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Instructor 2
            [
                'name' => 'Prof. Ahmad Rahman',
                'user_name' => 'ahmadrahman',
                'email' => 'ahmad.rahman@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('ins123'),
                // 'usertype' => 'instructor',
                'code' => 'INS00002',
                'role' => 'instructor',
                'mobile' => '08123456781',
                'address' => '78 Educator Street, Jakarta',
                'gender' => 'male',
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
                'user_name' => 'johndoe',
                'email' => 'student@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('std123'),
                // 'usertype' => 'student',
                'code' => 'STD00001',
                'role' => 'student',
                'mobile' => '08111111111',
                'address' => '123 Student Street',
                'gender' => 'male',
                'id_no' => '20250001',
                'birth' => Carbon::parse('2000-01-15'),
                'religion' => 'muslim',
                'father' => 'Mr. Doe',
                'mother' => 'Mrs. Doe',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Jane Smith',
                'user_name' => 'janesmith',
                'email' => 'jane@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('std123'),
                // 'usertype' => 'student',
                'code' => 'STD00002',
                'role' => 'student',
                'mobile' => '08222222222',
                'address' => '456 Student Street',
                'gender' => 'female',
                'id_no' => '20250002',
                'birth' => Carbon::parse('2001-03-20'),
                'religion' => 'christian',
                'father' => 'Mr. Smith',
                'mother' => 'Mrs. Smith',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ahmad Ashraf',
                'user_name' => 'ahmedashraf',
                'email' => 'ahmad.student@lms.test',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('std123'),
                // 'usertype' => 'student',
                'code' => 'STD00003',
                'role' => 'student',
                'mobile' => '08333333333',
                'address' => '789 Student Street',
                'gender' => 'male',
                'id_no' => '20250003',
                'birth' => Carbon::parse('1999-07-10'),
                'religion' => 'muslim',
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

    // NEW METHODS FOR ONLINE LEARNING PLATFORM

    private function seedCategories()
    {
        $categories = [
            ['name' => 'Web Development', 'slug' => 'web-development', 'description' => 'Learn frontend and backend web development', 'is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mobile Development', 'slug' => 'mobile-development', 'description' => 'Build iOS and Android applications', 'is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Data Science', 'slug' => 'data-science', 'description' => 'Master data analysis and machine learning', 'is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'UI/UX Design', 'slug' => 'ui-ux-design', 'description' => 'Learn user interface and experience design', 'is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Digital Marketing', 'slug' => 'digital-marketing', 'description' => 'Master online marketing strategies', 'is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Entrepreneurship and business management', 'is_active' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }

    private function seedCourses()
    {
        $courses = [
            [
                'title' => 'Complete Web Development Bootcamp',
                'description' => 'Learn web development from scratch. HTML, CSS, JavaScript, React, Node.js, MongoDB and more!',
                'short_description' => 'Become a full-stack web developer with this comprehensive course',
                'instructor_id' => 2, // Dr. Sarah Johnson
                'price' => 299000,
                'discount_price' => 199000,
                'thumbnail' => null,
                'promo_video' => 'https://www.youtube.com/watch?v=example1',
                'level' => 'beginner',
                'language' => 'english',
                'certificate_included' => 1,
                'total_duration' => 4200,
                'total_lessons' => 45,
                'requirements' => json_encode(['Basic computer knowledge', 'No programming experience required']),
                'what_you_learn' => json_encode(['Build responsive websites', 'Create web applications', 'Deploy to production']),
                'status' => 'published',
                'featured' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Advanced JavaScript and React',
                'description' => 'Master modern JavaScript and React with hooks, context, and advanced patterns',
                'short_description' => 'Take your JavaScript skills to the next level',
                'instructor_id' => 3, // Prof. Ahmad Rahman
                'price' => 249000,
                'discount_price' => 179000,
                'thumbnail' => null,
                'promo_video' => 'https://www.youtube.com/watch?v=example2',
                'level' => 'intermediate',
                'language' => 'english',
                'certificate_included' => 1,
                'total_duration' => 2800,
                'total_lessons' => 32,
                'requirements' => json_encode(['Basic JavaScript knowledge', 'HTML & CSS experience']),
                'what_you_learn' => json_encode(['Advanced React patterns', 'State management', 'Performance optimization']),
                'status' => 'published',
                'featured' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Python for Data Science and Machine Learning',
                'description' => 'Complete Python course for data analysis, visualization, and machine learning',
                'short_description' => 'Become a data scientist with Python',
                'instructor_id' => 2, // Dr. Sarah Johnson
                'price' => 349000,
                'discount_price' => 249000,
                'thumbnail' => null,
                'promo_video' => 'https://www.youtube.com/watch?v=example3',
                'level' => 'intermediate',
                'language' => 'english',
                'certificate_included' => 1,
                'total_duration' => 3600,
                'total_lessons' => 38,
                'requirements' => json_encode(['Basic programming knowledge', 'High school math']),
                'what_you_learn' => json_encode(['Data analysis with Pandas', 'Machine learning models', 'Data visualization']),
                'status' => 'published',
                'featured' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'UI/UX Design Fundamentals',
                'description' => 'Learn the principles of user interface and user experience design',
                'short_description' => 'Start your career in UI/UX design',
                'instructor_id' => 3, // Prof. Ahmad Rahman
                'price' => 199000,
                'discount_price' => 149000,
                'thumbnail' => null,
                'promo_video' => 'https://www.youtube.com/watch?v=example4',
                'level' => 'beginner',
                'language' => 'english',
                'certificate_included' => 1,
                'total_duration' => 1800,
                'total_lessons' => 24,
                'requirements' => json_encode(['No design experience required', 'Creative thinking']),
                'what_you_learn' => json_encode(['Design principles', 'Wireframing', 'Prototyping', 'User research']),
                'status' => 'published',
                'featured' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($courses as $course) {
            DB::table('courses')->insert($course);
        }
    }

    private function seedCourseCategories()
    {
        $courseCategories = [
            ['course_id' => 1, 'category_id' => 1], // Web Dev Bootcamp -> Web Development
            ['course_id' => 2, 'category_id' => 1], // Advanced JS -> Web Development
            ['course_id' => 3, 'category_id' => 3], // Python Data Science -> Data Science
            ['course_id' => 4, 'category_id' => 4], // UI/UX Design -> UI/UX Design
            ['course_id' => 3, 'category_id' => 6], // Python Data Science -> Business (for analytics)
        ];

        foreach ($courseCategories as $courseCategory) {
            DB::table('course_category')->insert($courseCategory);
        }
    }

    private function seedSections()
    {
        $sections = [
            // Course 1: Web Development Bootcamp
            ['course_id' => 1, 'title' => 'HTML & CSS Fundamentals', 'description' => 'Learn the building blocks of web development', 'order' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['course_id' => 1, 'title' => 'JavaScript Basics', 'description' => 'Master the fundamentals of JavaScript', 'order' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['course_id' => 1, 'title' => 'Frontend with React', 'description' => 'Build modern user interfaces with React', 'order' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['course_id' => 1, 'title' => 'Backend with Node.js', 'description' => 'Create server-side applications', 'order' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Course 2: Advanced JavaScript
            ['course_id' => 2, 'title' => 'Modern JavaScript Features', 'description' => 'ES6+ and beyond', 'order' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['course_id' => 2, 'title' => 'React Advanced Patterns', 'description' => 'Master complex React concepts', 'order' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Course 3: Python Data Science
            ['course_id' => 3, 'title' => 'Python Basics', 'description' => 'Python programming fundamentals', 'order' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['course_id' => 3, 'title' => 'Data Analysis with Pandas', 'description' => 'Working with data frames and analysis', 'order' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Course 4: UI/UX Design
            ['course_id' => 4, 'title' => 'Design Principles', 'description' => 'Fundamentals of good design', 'order' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['course_id' => 4, 'title' => 'Wireframing & Prototyping', 'description' => 'Creating design mockups', 'order' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($sections as $section) {
            DB::table('sections')->insert($section);
        }
    }

    private function seedLessons()
    {
        $lessons = [
            // Course 1, Section 1: HTML & CSS
            ['section_id' => 1, 'title' => 'Introduction to HTML', 'description' => 'Learn the basics of HTML structure', 'video_url' => 'https://www.youtube.com/watch?v=html1', 'duration' => 25, 'order' => 1, 'is_preview' => 1, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['section_id' => 1, 'title' => 'CSS Styling Basics', 'description' => 'Introduction to CSS and styling', 'video_url' => 'https://www.youtube.com/watch?v=css1', 'duration' => 35, 'order' => 2, 'is_preview' => 0, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['section_id' => 1, 'title' => 'Responsive Design', 'description' => 'Making websites work on all devices', 'video_url' => 'https://www.youtube.com/watch?v=responsive1', 'duration' => 40, 'order' => 3, 'is_preview' => 0, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Course 1, Section 2: JavaScript
            ['section_id' => 2, 'title' => 'JavaScript Variables & Data Types', 'description' => 'Understanding JavaScript basics', 'video_url' => 'https://www.youtube.com/watch?v=js1', 'duration' => 30, 'order' => 1, 'is_preview' => 1, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['section_id' => 2, 'title' => 'Functions and Scope', 'description' => 'Working with functions in JavaScript', 'video_url' => 'https://www.youtube.com/watch?v=js2', 'duration' => 35, 'order' => 2, 'is_preview' => 0, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Course 2, Section 1: Modern JavaScript
            ['section_id' => 5, 'title' => 'ES6+ Features Overview', 'description' => 'New JavaScript features', 'video_url' => 'https://www.youtube.com/watch?v=es61', 'duration' => 45, 'order' => 1, 'is_preview' => 1, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['section_id' => 5, 'title' => 'Async/Await Patterns', 'description' => 'Modern asynchronous programming', 'video_url' => 'https://www.youtube.com/watch?v=async1', 'duration' => 50, 'order' => 2, 'is_preview' => 0, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Course 3, Section 1: Python Basics
            ['section_id' => 7, 'title' => 'Python Installation & Setup', 'description' => 'Getting started with Python', 'video_url' => 'https://www.youtube.com/watch?v=python1', 'duration' => 20, 'order' => 1, 'is_preview' => 1, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['section_id' => 7, 'title' => 'Python Data Structures', 'description' => 'Lists, dictionaries, and tuples', 'video_url' => 'https://www.youtube.com/watch?v=python2', 'duration' => 40, 'order' => 2, 'is_preview' => 0, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Course 4, Section 1: Design Principles
            ['section_id' => 9, 'title' => 'Color Theory Basics', 'description' => 'Understanding color in design', 'video_url' => 'https://www.youtube.com/watch?v=design1', 'duration' => 30, 'order' => 1, 'is_preview' => 1, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['section_id' => 9, 'title' => 'Typography Principles', 'description' => 'Working with fonts and text', 'video_url' => 'https://www.youtube.com/watch?v=design2', 'duration' => 35, 'order' => 2, 'is_preview' => 0, 'resources' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($lessons as $lesson) {
            DB::table('lessons')->insert($lesson);
        }
    }

    private function seedEnrollments()
    {
        $enrollments = [
            // Student 4 (John Doe) enrolled in Course 1 and 2
            ['user_id' => 4, 'course_id' => 1, 'paid_amount' => 199000, 'payment_status' => 'completed', 'enrolled_at' => Carbon::now()->subDays(10), 'progress' => 25, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['user_id' => 4, 'course_id' => 2, 'paid_amount' => 179000, 'payment_status' => 'completed', 'enrolled_at' => Carbon::now()->subDays(5), 'progress' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Student 5 (Jane Smith) enrolled in Course 1 and 3
            ['user_id' => 5, 'course_id' => 1, 'paid_amount' => 199000, 'payment_status' => 'completed', 'enrolled_at' => Carbon::now()->subDays(15), 'progress' => 60, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['user_id' => 5, 'course_id' => 3, 'paid_amount' => 249000, 'payment_status' => 'completed', 'enrolled_at' => Carbon::now()->subDays(8), 'progress' => 30, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Student 6 (Ahmad Ashraf) enrolled in Course 4
            ['user_id' => 6, 'course_id' => 4, 'paid_amount' => 149000, 'payment_status' => 'completed', 'enrolled_at' => Carbon::now()->subDays(3), 'progress' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($enrollments as $enrollment) {
            DB::table('enrollments')->insert($enrollment);
        }
    }

    private function seedLessonProgress()
    {
        $progress = [
            // Student 4 (John Doe) progress in Course 1
            ['user_id' => 4, 'lesson_id' => 1, 'course_id' => 1, 'completed' => 1, 'watch_time' => 1500, 'started_at' => Carbon::now()->subDays(9), 'completed_at' => Carbon::now()->subDays(9), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['user_id' => 4, 'lesson_id' => 2, 'course_id' => 1, 'completed' => 1, 'watch_time' => 2100, 'started_at' => Carbon::now()->subDays(8), 'completed_at' => Carbon::now()->subDays(8), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['user_id' => 4, 'lesson_id' => 3, 'course_id' => 1, 'completed' => 0, 'watch_time' => 1200, 'started_at' => Carbon::now()->subDays(7), 'completed_at' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            // Student 5 (Jane Smith) progress in Course 1
            ['user_id' => 5, 'lesson_id' => 1, 'course_id' => 1, 'completed' => 1, 'watch_time' => 1500, 'started_at' => Carbon::now()->subDays(14), 'completed_at' => Carbon::now()->subDays(14), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['user_id' => 5, 'lesson_id' => 2, 'course_id' => 1, 'completed' => 1, 'watch_time' => 2100, 'started_at' => Carbon::now()->subDays(13), 'completed_at' => Carbon::now()->subDays(13), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['user_id' => 5, 'lesson_id' => 3, 'course_id' => 1, 'completed' => 1, 'watch_time' => 2400, 'started_at' => Carbon::now()->subDays(12), 'completed_at' => Carbon::now()->subDays(12), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['user_id' => 5, 'lesson_id' => 4, 'course_id' => 1, 'completed' => 1, 'watch_time' => 1800, 'started_at' => Carbon::now()->subDays(11), 'completed_at' => Carbon::now()->subDays(11), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['user_id' => 5, 'lesson_id' => 5, 'course_id' => 1, 'completed' => 0, 'watch_time' => 900, 'started_at' => Carbon::now()->subDays(10), 'completed_at' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        foreach ($progress as $item) {
            DB::table('lesson_progress')->insert($item);
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
        $this->command->info('Instructor:  ahmad.rahman@lms.test / ins123');
        $this->command->info('Student:     student@lms.test      / std123');
        $this->command->info('Student:     jane@lms.test         / std123');
        $this->command->info('Student:     ahmad.student@lms.test / std123');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->newLine();
        $this->command->info('📚 Sample Courses Created:');
        $this->command->info('   • Complete Web Development Bootcamp');
        $this->command->info('   • Advanced JavaScript and React');
        $this->command->info('   • Python for Data Science and Machine Learning');
        $this->command->info('   • UI/UX Design Fundamentals');
        $this->command->newLine();
    }
}
