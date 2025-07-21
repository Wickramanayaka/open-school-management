<?php

namespace App\Listeners;

use App\Events\AttendanceMarking;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use ProactiveAnts\SMS\SMSMessage;
use ProactiveAnts\SMS\SMSTemplate;
use App\Jobs\SendSMS;
use App\School;
use Auth;

class SendSMSToAbsentStudentParents
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
     * @param  AttendanceMarking  $event
     * @return void
     */
    public function handle(AttendanceMarking $event)
    {
        // Get the student and add sms message to table
        // Queue send sms
        $student = $event->student;
        $school = School::find(1);
        // Get absent template
        $template = SMSTemplate::find(1);
        // Find and replace all the template words
        // <student>, <date>, <school>, <class>, <admission>
        $template_str = $template->message;
        $template_str = str_replace('<student>',$student->fullName,$template_str);
        $template_str = str_replace('<school>',$school->name,$template_str);
        $template_str = str_replace('<class_room>',$student->present_class_room->name,$template_str);
        $template_str = str_replace('<date>',\Carbon\Carbon::now()->format('Y-m-d'),$template_str);
        $template_str = str_replace('<admission>',$student->admission_number,$template_str);
        
        // SMS to Father
        if(!$student->student_parent->father_telephone==null &&  !$student->student_parent->father_telephone=='')
        {
            $sms = SMSMessage::create([
                'message' => $template_str,
                'type' => 'absent',
                'phone_number' => $student->student_parent->father_telephone,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'created_by' => Auth::user()->id,
                'number_of_sms' => ceil(strlen($template_str)/config('sms.max_sms_length')),
                'length' => strlen($template_str),
                'delivery' => 0,
                'student_id' => $student->id,
                'class_room_id' => $student->present_class_room->id,
                'parents' => 'Father',
                'sms_template_id' => 1
            ]);
            // Send sms function here
            SendSMS::dispatch($sms);
        }
        if(!$student->student_parent->mother_telephone==null &&  !$student->student_parent->mother_telephone=='')
        {
            // SMS to Mother
            $sms = SMSMessage::create([
                'message' => $template_str,
                'type' => 'absent',
                'phone_number' => $student->student_parent->mother_telephone,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'created_by' => Auth::user()->id,
                'number_of_sms' => ceil(strlen($template_str)/config('sms.max_sms_length')),
                'length' => strlen($template_str),
                'delivery' => 0,
                'student_id' => $student->id,
                'class_room_id' => $student->present_class_room->id,
                'parents' => 'Mother',
                'sms_template_id' => 1
            ]);
            // Send sms function here
            SendSMS::dispatch($sms);
        }
        if(!$student->student_parent->guardian_telephone==null &&  !$student->student_parent->guardian_telephone=='')
        {
            // SMS to Guardian
            $sms = SMSMessage::create([
                'message' => $template_str,
                'type' => 'absent',
                'phone_number' => $student->student_parent->guardian_telephone,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'created_by' => Auth::user()->id,
                'number_of_sms' => ceil(strlen($template_str)/config('sms.max_sms_length')),
                'length' => strlen($template_str),
                'delivery' => 0,
                'student_id' => $student->id,
                'class_room_id' => $student->present_class_room->id,
                'parents' => 'Guardian',
                'sms_template_id' => 1
            ]);
            // Send sms function here
            SendSMS::dispatch($sms);
        }
    }
}
