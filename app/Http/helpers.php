<?php

if(!function_exists('getNextAdmissionNumber')){
    function getNextAdmissionNumber(){
        $student = App\Student::max('admission_number');
        return $student + 1;
    }
}

if(!function_exists('getCurrentAcademicYear')){
    function getCurrentAcademicYear(){
        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $academic_year = App\AcademicYear::where('start','<=',$today)->where('end','>=',$today)->first();
        if($academic_year==null){
            return new App\AcademicYear(['start'=>$today, 'end'=>$today]);
        }
        return $academic_year;
    }
}

if(!function_exists('getActiveColor')){
    function getActiveColor($bool){
        if($bool==0) return "default";
        else return "danger"; 
    }
}

if(!function_exists('chart_data')){
    function chart_data(\App\Student $student, \App\Exam $exam){
        if($exam->has_grade_average==1){
            $chart = "['Subject', '". 'Term One'."','Grade Average']";
            $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$exam->id)->orderBy('subject_id')->get();
            $i = 1;
            foreach($data as $item){
                $grade_subject_total =  \App\ExamMark::where('subject_id',$item->subject_id)->where('exam_id',$exam->id)->sum('mark');
                $grade_subject_count =  \App\ExamMark::where('subject_id',$item->subject_id)->where('exam_id',$exam->id)->where('is_absent',0)->count('mark');
                $grade_subject_avg = $grade_subject_total/$grade_subject_count;
                $chart .= ",['".$i."',".$item->mark.",".$grade_subject_avg."]";
                $i++;
            }
            return $chart;
        }
        else{
            switch ($exam->term->sequence) {
                case '1':
                    // If the term is one only display term one chart
                    $chart = "['Subject','Term One']";
                    $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$exam->id)->get();
                    $i = 1;
                    foreach($data as $item){
                        $chart .= ",['".$i."',".$item->mark."]";
                        $i++;
                    }
                    return $chart;
                    break;
                case '2':
                    // If the term is 2 then diplay term 1 & 2
                    $term_one = \App\Term::where('academic_year_id',$exam->term->academic_year_id)->where('sequence',1)->first();
                    $chart = "['Subject','Term One','Term Two']";
                    $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$exam->id)->orderBy('subject_id')->get();
                    $i = 1;
                    foreach($data as $item){
                        // Check for term one exam
                        $term_one_exam = \App\Exam::where('term_id',$term_one->id)->first();
                        if($term_one_exam==null){
                            $term_one_mark_val = 0;
                        }
                        else{
                            // Get term one mark
                            $term_one_mark = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_one_exam->id)->where('subject_id',$item->subject->id)->first();
                            if($term_one_mark==null){
                                $term_one_mark_val = 0;
                            }
                            else{
                                $term_one_mark_val = $term_one_mark->mark;
                            }
                            $chart .= ",['".$i."',".$term_one_mark_val.",".$item->mark."]";
                            $i++;
                        }
                        
                    }
                    return $chart;
                    break;
                    case '3':
                    // If the term is 3 then diplay term 1 , 2 & 3
                    $term_one = \App\Term::where('academic_year_id',$exam->term->academic_year_id)->where('sequence',1)->first();
                    $term_two = \App\Term::where('academic_year_id',$exam->term->academic_year_id)->where('sequence',2)->first();
                    $chart = "['Subject','1st Term','2nd Term','Current Marks']";
                    $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$exam->id)->orderBy('subject_id')->get();
                    $i = 1;
                    foreach($data as $item){
                        // Check for term one exam
                        $term_one_exam = \App\Exam::where('term_id',$term_one->id)->first();
                        if($term_one_exam==null){
                            $term_one_exam_val = 0;
                        }
                        else{
                            // Get term one mark
                            $term_one_mark = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_one_exam->id)->where('subject_id',$item->subject->id)->first();
                            if($term_one_mark==null){
                                $term_one_exam_val = 0;
                            }
                            else{
                                $term_one_exam_val = $term_one_mark->mark;
                            }
                        }
                        // Check for term two exam
                        $term_two_exam = \App\Exam::where('term_id',$term_two->id)->first();
                        if($term_two_exam==null){
                            $term_two_exam_val = 0;
                        }
                        else{
                            // Get term two mark
                            $term_two_mark = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_two_exam->id)->where('subject_id',$item->subject->id)->first();
                            if($term_two_mark==null){
                                 $term_two_exam_val = 0;
                            }
                            else{
                                 $term_two_exam_val = $term_two_mark->mark;
                            }
                        }                    
                        $chart .= ",['".$i."',".$term_one_exam_val.",".$term_two_exam_val.",".$item->mark."]";
                        $i++;
                    }
                    return $chart;
                    break;              
                default:
                    # code...
                    break;
            }
        }
    }
}
if(!function_exists('getExamStatusColor')){
    function getExamStatusColor($exam){
        switch ($exam->status) {
            case 'Pending':
                return 'text-danger';
                break;
            case 'Ongoing':
                return 'text-success';
                break;
            case 'Completed':
                return 'text-default';
                break;
            default:
                # code...
                break;
        }
    }
}
if(!function_exists('getMarkColor')){
    function getMarkColor($mark){
        if($mark=="null"){
            if($mark=='0'){
                return "#ff8080";
            }
            return "#FFF";
        }
        elseif($mark=="AB" || $mark=="ab"){
            return "#b3d9ff";
        }
        elseif($mark <= 40){
            return "#ff8080";
        }
        elseif($mark <= 65){
            return "#ffa500";
        }
        elseif($mark <= 75){
            return "#ffff00";
        }
        else
        {
            return "#b3ffb3";
        }
    }
}

if(!function_exists('term_one')){
    function term_one(\App\Student $student, \App\Exam $exam, \App\Subject $subject){
        // Get term one mark
        $term_one = \App\Term::where('academic_year_id',$exam->term->academic_year_id)->where('sequence',1)->first();
        $term_one_exam = \App\Exam::where('term_id',$term_one->id)->first();
        $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_one_exam->id)->where('subject_id',$subject->id)->first();
        if($data==null){
            return "";
        }
        elseif($data->is_absent==1){
            return "AB";
        }
        else{
            return $data->mark;
        }
    }
}

if(!function_exists('term_grade')){
    function term_one_grade(\App\Student $student, \App\Exam $exam, \App\Subject $subject){
        // Get term one mark
        $term_one = \App\Term::where('academic_year_id',$exam->term->academic_year_id)->where('sequence',1)->first();
        $term_one_exam = \App\Exam::where('term_id',$term_one->id)->first();
        $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_one_exam->id)->where('subject_id',$subject->id)->first();
        if($data==null){
            return "";
        }
        elseif($data->is_absent==1){
            return "AB";
        }
        else{
            return $data->mark_grade;
        }
    }
}

if(!function_exists('term_two')){
    function term_two(\App\Student $student, \App\Exam $exam, \App\Subject $subject){
        // Get term two mark
        $term_two = \App\Term::where('academic_year_id',$exam->term->academic_year_id)->where('sequence',2)->first();
        $term_two_exam = \App\Exam::where('term_id',$term_two->id)->first();
        $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_two_exam->id)->where('subject_id',$subject->id)->first();
        if($data==null){
            return "";
        }
        elseif($data->is_absent==1){
            return "AB";
        }
        else{
            return $data->mark;
        }
    }
}

if(!function_exists('term_two_grade')){
    function term_two_grade(\App\Student $student, \App\Exam $exam, \App\Subject $subject){
        // Get term two mark
        $term_two = \App\Term::where('academic_year_id',$exam->term->academic_year_id)->where('sequence',2)->first();
        $term_two_exam = \App\Exam::where('term_id',$term_two->id)->first();
        $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_two_exam->id)->where('subject_id',$subject->id)->first();
        if($data==null){
            return "";
        }
        elseif($data->is_absent==1){
            return "AB";
        }
        else{
            return $data->mark_grade;
        }
    }
}

if(!function_exists('subject_grade_average')){
    function subject_grade_average(\App\Exam $exam, \App\Subject $subject){
        //if($exam->has_grade_average==1){
            $grade_subject_total =  \App\ExamMark::where('subject_id',$subject->id)->where('exam_id',$exam->id)->sum('mark');
            $grade_subject_count =  \App\ExamMark::where('subject_id',$subject->id)->where('exam_id',$exam->id)->where('is_absent',0)->count('mark');
            $grade_subject_avg = $grade_subject_total/$grade_subject_count;
            return number_format($grade_subject_avg,2);
        //}
    }
}

if(!function_exists('chart_data_al')){
    function chart_data_al(\App\Student $student, \App\Exam $exam){
        switch ($exam->term->sequence) {
            case '2':
                $chart = "['Subject', 'Term One','Grade Average',]";
                $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$exam->id)->orderBy('subject_id')->get();
                $i = 1;
                foreach($data as $item){
                    $grade_subject_total =  \App\ExamMark::where('subject_id',$item->subject_id)->where('exam_id',$exam->id)->sum('mark');
                    $grade_subject_count =  \App\ExamMark::where('subject_id',$item->subject_id)->where('exam_id',$exam->id)->where('is_absent',0)->count('mark');
                    $grade_subject_avg = $grade_subject_total/$grade_subject_count;
                    $chart .= ",['".$i."',".$item->mark.",".$grade_subject_avg."]";
                    $i++;
                }
                return $chart;
                break;
            case '3':
                // If the term is 3 then diplay term 1 & 2
                $term_one = \App\Term::where('academic_year_id',$exam->term->academic_year_id)->where('sequence',2)->first();
                $chart = "['Subject','1st Term','Current Marks']";
                $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$exam->id)->orderBy('subject_id')->get();
                $i = 1;
                foreach($data as $item){
                    // Check for term one exam
                    $term_one_exam = \App\Exam::where('term_id',$term_one->id)->first();
                    if($term_one_exam==null){
                        $term_one_mark_val = 0;
                    }
                    else{
                        // Get term one mark
                        $term_one_mark = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_one_exam->id)->where('subject_id',$item->subject->id)->first();
                        if($term_one_mark==null){
                            $term_one_mark_val = 0;
                        }
                        else{
                            $term_one_mark_val = $term_one_mark->mark;
                        }
                        $chart .= ",['".$i."',".$term_one_mark_val.",".$item->mark."]";
                        $i++;
                    }
                    
                }
                return $chart;
                break;
                case '1':
                // If the term is 1 then diplay term 1 , 2 & 3
                // Get one year back from exam academic year
                $academic_year = \App\AcademicYear::find($exam->term->academic_year_id);
                $year = substr($academic_year->start,0,4);
                $year = $year - 1;
                $academic_year_last = \App\AcademicYear::where('start','like','%' . $year . '%')->first();
                $term_one = \App\Term::where('academic_year_id',$academic_year_last->id)->where('sequence',2)->first();
                $term_two = \App\Term::where('academic_year_id',$academic_year_last->id)->where('sequence',3)->first();
                $chart = "['Subject','1st Term','2nd Term','Current Marks']";
                $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$exam->id)->orderBy('subject_id')->get();
                $i = 1;
                foreach($data as $item){
                    // Check for term one exam
                    $term_one_exam = \App\Exam::where('term_id',$term_one->id)->first();
                    if($term_one_exam==null){
                        $term_one_exam_val = 0;
                    }
                    else{
                        // Get term one mark
                        $term_one_mark = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_one_exam->id)->where('subject_id',$item->subject->id)->first();
                        if($term_one_mark==null){
                            $term_one_exam_val = 0;
                        }
                        else{
                            $term_one_exam_val = $term_one_mark->mark;
                        }
                    }
                    // Check for term two exam
                    $term_two_exam = \App\Exam::where('term_id',$term_two->id)->first();
                    if($term_two_exam==null){
                        $term_two_exam_val = 0;
                    }
                    else{
                        // Get term two mark
                        $term_two_mark = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_two_exam->id)->where('subject_id',$item->subject->id)->first();
                        if($term_two_mark==null){
                                $term_two_exam_val = 0;
                        }
                        else{
                                $term_two_exam_val = $term_two_mark->mark;
                        }
                    }                    
                    $chart .= ",['".$i."',".$term_one_exam_val.",".$term_two_exam_val.",".$item->mark."]";
                    $i++;
                }
                return $chart;
                break;              
            default:
                # code...
                break;
        }
    }
}

if(!function_exists('term_one_al')){
    function term_one_al(\App\Student $student, \App\Exam $exam, \App\Subject $subject){
        // Get term one mark
        $term_one = \App\Term::where('academic_year_id',$exam->term->academic_year_id)->where('sequence',2)->first();
        $term_one_exam = \App\Exam::where('term_id',$term_one->id)->first();
        $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_one_exam->id)->where('subject_id',$subject->id)->first();
        if($data==null){
            return "";
        }
        elseif($data->is_absent==1){
            return "AB";
        }
        else{
            return $data->mark;
        }
    }
}

if(!function_exists('term_two_al')){
    function term_two_al(\App\Student $student, \App\Exam $exam, \App\Subject $subject){
        // Get term two mark
        $term_two = \App\Term::where('academic_year_id',$exam->term->academic_year_id)->where('sequence',3)->first();
        $term_two_exam = \App\Exam::where('term_id',$term_two->id)->first();
        $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_two_exam->id)->where('subject_id',$subject->id)->first();
        if($data==null){
            return "";
        }
        elseif($data->is_absent==1){
            return "AB";
        }
        else{
            return $data->mark;
        }
    }
}

if(!function_exists('term_one_al_3')){
    function term_one_al_3(\App\Student $student, \App\Exam $exam, \App\Subject $subject){
        // Get term one mark
        // Get one year back from exam academic year
        $academic_year = \App\AcademicYear::find($exam->term->academic_year_id);
        $year = substr($academic_year->start,0,4);
        $year = $year - 1;
        $academic_year_last = \App\AcademicYear::where('start','like','%' . $year . '%')->first();
        $term_one = \App\Term::where('academic_year_id',$academic_year_last->id)->where('sequence',2)->first();
        $term_one_exam = \App\Exam::where('term_id',$term_one->id)->first();
        $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_one_exam->id)->where('subject_id',$subject->id)->first();
        if($data==null){
            return "";
        }
        elseif($data->is_absent==1){
            return "AB";
        }
        else{
            return $data->mark;
        }
    }
}

if(!function_exists('term_two_al_3')){
    function term_two_al_3(\App\Student $student, \App\Exam $exam, \App\Subject $subject){
        // Get term two mark
        // Get one year back from exam academic year
        $academic_year = \App\AcademicYear::find($exam->term->academic_year_id);
        $year = substr($academic_year->start,0,4);
        $year = $year - 1;
        $academic_year_last = \App\AcademicYear::where('start','like','%' . $year . '%')->first();
        $term_two = \App\Term::where('academic_year_id',$academic_year_last->id)->where('sequence',3)->first();
        $term_two_exam = \App\Exam::where('term_id',$term_two->id)->first();
        $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$term_two_exam->id)->where('subject_id',$subject->id)->first();
        if($data==null){
            return "";
        }
        elseif($data->is_absent==1){
            return "AB";
        }
        else{
            return $data->mark;
        }
    }
}

if(!function_exists('chart_data_ex')){
    function chart_data_ex(\App\Student $student, \App\Exam $exam){
        switch ($exam->term->sequence) {
            case '2':
                $chart = "['Subject', 'Term One',]";
                $data = \App\ExamMark::where('student_id',$student->id)->where('exam_id',$exam->id)->get();
                $i = 1;
                foreach($data as $item){
                    $chart .= ",['".$i."',".$item->mark."]";
                    $i++;
                }
                return $chart;
                break;
            default:
                # code...
                break;
        }
    }
}
