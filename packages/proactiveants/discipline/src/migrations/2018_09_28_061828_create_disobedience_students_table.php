<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisobedienceStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disobedience_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('disobedience_id');
            $table->integer('student_id');
            $table->double('point_deduct');
            $table->text('remark')->nullable();
            $table->integer('teacher_id');
            $table->date('date');
            $table->string('charge_sheet_number')->nullable();
            $table->integer('academic_year_id');
            $table->timestamps();
            $table->index(['student_id','disobedience_id','date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disobedience_students');
    }
}
