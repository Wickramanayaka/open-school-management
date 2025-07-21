<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinePointBalanceView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("CREATE VIEW point_balance AS SELECT  student_id, point, 0 as deduct, `date` as created_at, '0' as teacher_id, 0 as disobedience_id, type FROM student_discipline_points UNION SELECT student_id,0 as point, point_deduct as deduct, `date` as created_at, teacher_id, disobedience_id, 'DEDUCT' as type FROM disobedience_students;");
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
