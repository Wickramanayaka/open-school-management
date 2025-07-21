<?php

namespace App\Listeners;

use App\Events\ExamMarkUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\StudentExamRank;
use App\ExamMark;
use App\Student;
use App\ClassRoom;
use App\ClassRoomStudent;

class CalculateRank
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ExamMarkUpdate  $event
     * @return void
     */
    public function handle(ExamMarkUpdate $event)
    {
        $exam = $event->exam;
        $class_room = $event->class_room;
        //$students = ClassRoomStudent::where('class_room_id',$class_room->id)->where('academic_year_id',$exam->academic_year_id)->pluck('student_id')->toArray();
        $students = Student::where('present_class_room_id',$class_room->id)->pluck('id')->toArray();
        // Clear all previous data belongs to exam and the class
        StudentExamRank::where('exam_id',$exam->id)->where('class_room_id',$class_room->id)->delete();
        // Get all students marks for the same class
        $exam_marks = ExamMark::where('exam_id',$exam->id)
        ->whereIn('student_id',$students)
        ->selectRaw('student_id, sum(mark) as sum, sum(case when not_relavent = 0 then 1 else 0 end) as number')
        ->groupBy('student_id')
        ->orderByDesc('sum')
        ->get();

        $i=1;
        $rank_one_average = 0;
        $previous_rank = 0;
        $previous_total = 0;

        foreach ($exam_marks as $key => $mark) {
            if($i==1){
                $rank_one_average = $mark->sum / $mark->number;
            }
            StudentExamRank::create([
                'student_id' => $mark->student_id,
                'rank' => $previous_total==$mark->sum?$previous_rank:$i,
                'exam_id' => $exam->id,
                'total' => $mark->sum==''?0:$mark->sum,
                'average' => number_format($mark->sum / $mark->number,2),
                'number_of_subject' => $mark->number,
                'rank_one_average' => number_format($rank_one_average,2),
                'class_room_id' => $class_room->id
            ]);
            $previous_rank = $previous_total==$mark->sum?$previous_rank:$i;
            $previous_total = $mark->sum;
            $i++;
        }

    }
}
