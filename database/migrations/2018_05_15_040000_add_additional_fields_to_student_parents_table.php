<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsToStudentParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_parents', function (Blueprint $table) {
            $table->string('father_id_number')->nullable();
            $table->string('father_designation_type')->nullable();
            $table->string('father_income_level')->nullable();
            $table->string('father_education_level')->nullable();
            $table->string('father_protection_level')->nullable();
            $table->string('mother_id_number')->nullable();
            $table->string('mother_designation_type')->nullable();
            $table->string('mother_income_level')->nullable();
            $table->string('mother_education_level')->nullable();
            $table->string('mother_protection_level')->nullable();
            $table->string('guardian_id_number')->nullable();
            $table->string('guardian_designation_type')->nullable();
            $table->string('guardian_income_level')->nullable();
            $table->string('guardian_education_level')->nullable();
            $table->string('guardian_protection_level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_parents', function (Blueprint $table) {
            //
        });
    }
}
