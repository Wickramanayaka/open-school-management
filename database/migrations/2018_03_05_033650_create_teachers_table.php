<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname');
            $table->string('first_name');
            $table->string('other_name')->nullable();
            $table->date('date_of_birth');
            $table->string('id_number');
            $table->string('gender');
            $table->integer('address_id');
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->integer('present_class_room_id')->nullable();
            $table->boolean('is_left')->nullable();
            $table->date('date_left')->nullable();
            $table->text('reason_left')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
