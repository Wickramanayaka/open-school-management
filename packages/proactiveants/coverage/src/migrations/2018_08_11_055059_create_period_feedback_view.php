<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodFeedbackView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("CREATE VIEW period_feedback AS SELECT periods.id,periods.date,periods.class_room_id,periods.teacher_id,periods.subject_id, sum(point)/count(point) as rating FROM `periods` left join feedback on periods.id=feedback.period_id where periods.type='TEACHING' group by periods.id;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
