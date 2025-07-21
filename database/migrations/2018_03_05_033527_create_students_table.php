<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admission_number')->unique();
            $table->date('admitted_date');
            $table->integer('admitted_academic_year_id');
            $table->integer('admitted_class_room_id');
            $table->integer('house_id');
            $table->integer('cluster_id')->nullable();
            $table->string('surname');
            $table->string('first_name');
            $table->string('other_name')->nullable();
            $table->date('date_of_birth');
            $table->string('id_number')->nullable();
            $table->string('gender');
            $table->string('photo')->nullable();
            $table->integer('address_id')->nullable();
            $table->integer('student_parent_id')->nullable();
            $table->integer('emergency_contact_id')->nullable();
            $table->integer('present_class_room_id')->nullable();
            $table->boolean('is_left')->nullable();
            $table->date('date_left')->nullable();
            $table->text('reason_left')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE students ADD FULLTEXT fulltext_index(surname,first_name,other_name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
