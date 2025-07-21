<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_parents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('father_name')->nullable();
            $table->string('father_telephone')->nullable();
            $table->string('father_email')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_name_of_employment')->nullable();
            $table->text('father_address_of_employment')->nullable();
            $table->string('father_office_telephone')->nullable();

            $table->text('mother_name')->nullable();
            $table->string('mother_telephone')->nullable();
            $table->string('mother_email')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_name_of_employment')->nullable();
            $table->text('mother_address_of_employment')->nullable();
            $table->string('mother_office_telephone')->nullable();

            $table->text('guardian_name')->nullable();
            $table->string('guardian_telephone')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_name_of_employment')->nullable();
            $table->text('guardian_address_of_employment')->nullable();
            $table->string('guardian_office_telephone')->nullable();
            $table->string('guardian_relation_to_student')->nullable();
            
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
        Schema::dropIfExists('student_parents');
    }
}
