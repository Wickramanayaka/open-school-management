<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents_app_users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('full_name');
            $table->string('telephone',30);
            $table->string('country_code');
            $table->string('phone_number');
            $table->integer('suspended')->default(0);
            $table->enum('relation',['NULL', 'FATHER', 'MOTHER', 'GUARDIAN']);
            $table->string('token',64);
            $table->timestamps();
            $table->index(['token','telephone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parents_app_users');
    }
}
