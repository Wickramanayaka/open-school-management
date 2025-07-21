<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentDisciplinePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_discipline_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->double('point');
            $table->string('type'); // ALLOCATION is the amount get beginning of the every year, ACCRUED is monthly accrued amount of point.
            $table->integer('academic_year_id');
            $table->date('date');
            $table->timestamps();
            $table->index(['student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_discipline_points');
    }
}
