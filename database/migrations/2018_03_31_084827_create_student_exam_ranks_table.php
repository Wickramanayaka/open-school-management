<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentExamRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_exam_ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('exam_id');
            $table->integer('rank');
            $table->double('total');
            $table->double('average');
            $table->integer('number_of_subject');
            $table->double('rank_one_average')->nullable();
            $table->timestamps();
            $table->index(['student_id','exam_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_exam_ranks');
    }
}
