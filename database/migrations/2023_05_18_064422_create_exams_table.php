<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->string('session');
            $table->string('class');
            $table->string('type');
            $table->string('question_type');
            $table->string('marks_per_question');
            $table->string('pass_marks');
            $table->enum('status', ['0', '1'])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
