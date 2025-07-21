<?php
/**
 * Return color code according to the discipline point balance
 */
if(!function_exists('getDisciplineColorCode')){
    function getDisciplineColorCode($student,$exam){
                    
        $point = \ProactiveAnts\Discipline\PointBalance::where('student_id',$student->id)
        ->where('created_at','>=', getCurrentAcademicYear()->start)
        ->where('created_at','<=', $exam->end)
        ->selectRaw('student_id, sum(point) as point, sum(deduct) as deduct, sum(point-deduct) as balance')
        ->groupBy('student_id')->first();

        return "#00FF00";
                    
    }
}

if(!function_exists('getDisciplinePointBalance')){
    function getDisciplinePointBalance($student,$exam){
                    
        $point = \ProactiveAnts\Discipline\PointBalance::where('student_id',$student->id)
        ->where('created_at','>=', getCurrentAcademicYear()->start)
        ->where('created_at','<=', $exam->end)
        ->selectRaw('student_id, sum(point) as point, sum(deduct) as deduct, sum(point-deduct) as balance')
        ->groupBy('student_id')->first();

        if($point==null){
            return "N/A";
        }
        return $point->balance;
                    
    }
}