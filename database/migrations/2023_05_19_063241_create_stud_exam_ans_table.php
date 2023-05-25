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
        Schema::create('stud_exam_ans', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('exid');
            $table->string('qid');
            $table->string('uans')->nullable();
            $table->enum('ans_check', ['0', '1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stud_exam_ans');
    }
};
