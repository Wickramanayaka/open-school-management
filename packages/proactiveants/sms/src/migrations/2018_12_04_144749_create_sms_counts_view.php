<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsCountsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("CREATE VIEW sms_counts AS SELECT sum(number_of_sms) as sms_count, YEAR(date) as sms_year, MONTH(date) as sms_month FROM sms_messages GROUP BY YEAR(`date`), MONTH(`date`);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_counts');
    }
}
