<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->string('type');
            $table->integer('student_id')->nullable();
            $table->integer('class_room_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->string('phone_number');
            $table->integer('sms_template_id')->nullable();
            $table->date('date');
            $table->integer('created_by');
            $table->integer('number_of_sms'); // 1|2|3
            $table->integer('length'); // Number of characters
            $table->string('parents')->nullable(); // Father|Mother|Guarian
            $table->integer('delivery'); // 0=no|1=yes
            $table->string('gateway_token')->nullable();
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
        Schema::dropIfExists('sms_messages');
    }
}
