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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->foreignId('instructor_id')->constrained('users');
            $table->decimal('price', 8, 2);
            $table->decimal('discount_price', 8, 2)->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('promo_video')->nullable();
            $table->string('level')->default('beginner'); // beginner, intermediate, advanced
            $table->string('language')->default('english');
            $table->boolean('certificate_included')->default(false);
            $table->integer('total_duration')->default(0); // in minutes
            $table->integer('total_lessons')->default(0);
            $table->json('requirements')->nullable(); // array of requirements
            $table->json('what_you_learn')->nullable(); // array of learning points
            $table->string('status')->default('draft'); // draft, published, unpublished
            $table->boolean('featured')->default(false);
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
        Schema::dropIfExists('courses');
    }
};
