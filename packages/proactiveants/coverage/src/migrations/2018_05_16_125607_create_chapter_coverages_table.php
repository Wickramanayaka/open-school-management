<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapterCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_coverages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chapter_id');
            $table->double('covered')->default(0); // Presentage of how much complete the chapter, not the subject
            $table->integer('teacher_id');
            $table->integer('period_id');
            $table->integer('class_room_id');
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
        Schema::dropIfExists('chapter_coverages');
    }
}
