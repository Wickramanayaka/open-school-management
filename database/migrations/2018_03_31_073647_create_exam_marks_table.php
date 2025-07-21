<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('exam_id');
            $table->integer('subject_id');
            $table->double('mark')->nullable();
            $table->boolean('is_absent')->default(0);
            $table->boolean('not_relavent')->default(0); //This is define whether student is not doing the particular subject
            $table->string('mark_grade')->nullable();
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
        Schema::dropIfExists('exam_marks');
    }
}
