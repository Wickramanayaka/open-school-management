<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransportIdScholarshipMarkDistanceTownToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->integer('transport_id')->nullable();
            $table->double('scholarship_mark')->nullable();
            $table->double('distance')->nullable();
            $table->string('town')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('transport_id');
            $table->dropColumn('scholarship_mark');
            $table->dropColumn('distance');
            $table->dropColumn('town');
        });
    }
}
