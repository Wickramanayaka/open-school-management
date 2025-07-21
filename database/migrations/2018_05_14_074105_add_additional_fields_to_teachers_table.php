<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsToTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->integer('temporary_address_id')->nullable();
            $table->string('town')->nullable();
            $table->string('civil_status')->nullable();
            $table->double('distance')->nullable();
            $table->integer('transport_id')->nullable();
            $table->string('appointment_category')->nullable();
            $table->date('appointment_date')->nullable();
            $table->date('appointment_date_this_school')->nullable();
            $table->string('appointment_subject')->nullable();
            $table->text('highest_education_qualification')->nullable();
            $table->text('highest_professional_qualification')->nullable();
            $table->string('given_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('temporary_address_id');
            $table->dropColumn('town');
            $table->dropColumn('civil_status');
            $table->dropColumn('distance');
            $table->dropColumn('transport_id');
            $table->dropColumn('appointment_category');
            $table->dropColumn('appointment_date');
            $table->dropColumn('appointment_date_this_school');
            $table->dropColumn('appointment_subject');
            $table->dropColumn('highest_education_qualification');
            $table->dropColumn('highest_professional_qualification');
            $table->dropColumn('given_name');
        });
    }
}
