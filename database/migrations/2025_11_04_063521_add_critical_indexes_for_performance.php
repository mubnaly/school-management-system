<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - Add critical indexes for performance     *
     * @return void
     */
public function up()
    {
        // Users table indexes
        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
            $table->index('status');
            $table->index(['role', 'status']);
            $table->index('code');
        });

        // Assign students indexes
        Schema::table('assign_students', function (Blueprint $table) {
            $table->index('student_id');
            $table->index('year_id');
            $table->index('class_id');
            $table->index(['year_id', 'class_id']); // Composite index for common queries
            $table->index(['student_id', 'year_id']);
        });

        // Discount students indexes
        Schema::table('discount_students', function (Blueprint $table) {
            $table->index('assign_student_id');
            $table->index('fee_category_id');
        });

        // Assign subjects indexes
        Schema::table('assign_subjects', function (Blueprint $table) {
            $table->index('class_id');
            $table->index('subject_id');
            $table->index(['class_id', 'subject_id']);
        });

        // Fee category amounts indexes
        Schema::table('fee_category_amounts', function (Blueprint $table) {
            $table->index('fee_category_id');
            $table->index('class_id');
            $table->index(['fee_category_id', 'class_id']);
        });

        // Course-related indexes for online learning
        if (Schema::hasTable('courses')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->index('instructor_id');
                $table->index('status');
                $table->index('featured');
                $table->index(['status', 'featured']);
            });
        }

        if (Schema::hasTable('enrollments')) {
            Schema::table('enrollments', function (Blueprint $table) {
                $table->index('user_id');
                $table->index('course_id');
                $table->index(['user_id', 'course_id']);
                $table->index('payment_status');
            });
        }

        if (Schema::hasTable('lessons')) {
            Schema::table('lessons', function (Blueprint $table) {
                $table->index('section_id');
                $table->index('order');
            });
        }

        if (Schema::hasTable('sections')) {
            Schema::table('sections', function (Blueprint $table) {
                $table->index('course_id');
                $table->index('order');
            });
        }

        if (Schema::hasTable('lesson_progress')) {
            Schema::table('lesson_progress', function (Blueprint $table) {
                $table->index('user_id');
                $table->index('lesson_id');
                $table->index('course_id');
                $table->index(['user_id', 'course_id']);
                $table->index('completed');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop indexes in reverse order
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['status']);
            $table->dropIndex(['role', 'status']);
            $table->dropIndex(['code']);
        });

        Schema::table('assign_students', function (Blueprint $table) {
            $table->dropIndex(['student_id']);
            $table->dropIndex(['year_id']);
            $table->dropIndex(['class_id']);
            $table->dropIndex(['year_id', 'class_id']);
            $table->dropIndex(['student_id', 'year_id']);
        });

        Schema::table('discount_students', function (Blueprint $table) {
            $table->dropIndex(['assign_student_id']);
            $table->dropIndex(['fee_category_id']);
        });

        Schema::table('assign_subjects', function (Blueprint $table) {
            $table->dropIndex(['class_id']);
            $table->dropIndex(['subject_id']);
            $table->dropIndex(['class_id', 'subject_id']);
        });

        Schema::table('fee_category_amounts', function (Blueprint $table) {
            $table->dropIndex(['fee_category_id']);
            $table->dropIndex(['class_id']);
            $table->dropIndex(['fee_category_id', 'class_id']);
        });

        if (Schema::hasTable('courses')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->dropIndex(['instructor_id']);
                $table->dropIndex(['status']);
                $table->dropIndex(['featured']);
                $table->dropIndex(['status', 'featured']);
            });
        }

        if (Schema::hasTable('enrollments')) {
            Schema::table('enrollments', function (Blueprint $table) {
                $table->dropIndex(['user_id']);
                $table->dropIndex(['course_id']);
                $table->dropIndex(['user_id', 'course_id']);
                $table->dropIndex(['payment_status']);
            });
        }

        if (Schema::hasTable('lessons')) {
            Schema::table('lessons', function (Blueprint $table) {
                $table->dropIndex(['section_id']);
                $table->dropIndex(['order']);
            });
        }

        if (Schema::hasTable('sections')) {
            Schema::table('sections', function (Blueprint $table) {
                $table->dropIndex(['course_id']);
                $table->dropIndex(['order']);
            });
        }

        if (Schema::hasTable('lesson_progress')) {
            Schema::table('lesson_progress', function (Blueprint $table) {
                $table->dropIndex(['user_id']);
                $table->dropIndex(['lesson_id']);
                $table->dropIndex(['course_id']);
                $table->dropIndex(['user_id', 'course_id']);
                $table->dropIndex(['completed']);
            });
        }
    }
};
