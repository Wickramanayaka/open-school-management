<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->datetime('in')->nullable(); // Can use traditional in with date and time
            $table->datetime('out')->nullable(); // Can use traditional out with date and time
            $table->integer('frequency')->default(0); // Define how frequent attendance upload. Traditional in/out(0) Monthly(30), Weekly(7), Daily(1)
            $table->date('begin_date')->nullable();
            $table->date('end_date')->nullable();
            $table->double('attendance')->default(0);
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('student_attendances');
    }
}
