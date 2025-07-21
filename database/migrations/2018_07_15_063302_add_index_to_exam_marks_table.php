<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexToExamMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_marks', function (Blueprint $table) {
            $table->index(['student_id','exam_id','subject_id','class_room_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_marks', function (Blueprint $table) {
            $table->dropIndex(['student_id','exam_id','subject_id','class_room_id']);
        });
    }
}
