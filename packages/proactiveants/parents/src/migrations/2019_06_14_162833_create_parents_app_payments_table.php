<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsAppPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents_app_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('payment_date');
            $table->date('expiry_date');
            $table->decimal('amount');
            $table->integer('parents_app_user_id');
            $table->integer('canceled')->default(0);
            $table->enum('method',array('ONLINE','OFFLINE'));
            $table->integer('status'); // 0-pending 1-confired
            $table->string('invoice_number')->nullable();
            $table->decimal('charge_total')->nullable();
            $table->decimal('gross_amount')->nullable();
            $table->string('trx_ref_number')->nullable();
            $table->dateTime('trx_date_time')->nullable();
            $table->string('message')->nullable();
            $table->string('code')->nullable();
            $table->string('ipg_status')->nullable();
            $table->string('resp_token')->nullable();
            $table->string('other_info')->nullable();
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
        Schema::dropIfExists('parents_app_payments');
    }
}
