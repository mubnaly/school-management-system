<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('user_name')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile');
            $table->string('address')->nullable();
            $table->string('notes')->nullable(); // added
            $table->enum('gender', ['male', 'female']);
            $table->string('image')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->enum('religion', ['muslim', 'christian'])->default('muslim');
            $table->string('id_no')->nullable();
            $table->date('birth')->nullable();
            $table->string('code')->nullable();
            $table->enum('role', ['admin', 'instructor', 'student'])->default('student')->comment('admin=head of software,Instructor=Course Creator,Student=the main user');
            $table->date('join_date')->nullable();
            $table->integer('designation_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=inactive,1=active');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
