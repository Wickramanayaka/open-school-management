<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->text('description');
            $table->date('date');
            $table->decimal('amount');
            $table->string('method')->nullable();
            $table->integer('payment_category_id');
            $table->integer('term_id')->nullable();
            $table->integer('academic_year_id')->nullable();
            $table->integer('exam_id')->nullable();
            $table->string('voucher_number')->nullable();
            $table->boolean('is_canceled')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
