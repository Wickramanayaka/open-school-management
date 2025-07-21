Installation instructions
-------------------------
Update composer.json

Repository

{
    "type": "path",
    "url": "packages/proactiveants/sms",
    "options": {
        "symlink": true
    }
}

require

"proactiveants/sms": "dev-master"

Run composer update command

Menu
----
app.blade.php

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        SMS <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        @hasanyrole('Administrator|Principal')
        <li><a href="{{url('sms/')}}"><i class="fa fa-plus-circle fa-fw"></i> Short Message</a></li>
        <li class="divider"></li>
        <li><a href="{{url('sms/template/')}}"><i class="fa fa-plus-circle fa-fw"></i> Template</a></li>
        <li class="divider"></li>
        <li><a href="{{url('sms/report/')}}"><i class="fa fa-plus-circle fa-fw"></i> Report</a></li>
        @endhasanyrole
    </ul>
</li>

Database
--------

Run php artisan migrate
Run php artisan db:seed --class=ProactiveAnts\\SMS\\Seeds\\DatabaseSeeder

Config
------
Update the value in sms.php file

Queue
-----
Run php artisan queue:table
Run php artisan migrate
Run php artisan make:job SendSMS // Do not run at installation, developer need to be run at development.
Copy "jobs/SendSMS.php" to base code

Event/Listner
-------------
Add below line to EventServiceProvider

'App\Events\AttendanceMarking' => [
            'App\Listeners\SendSMSToAbsentStudentParents',
        ],

Copy 'App\Events\AttendanceMarking.php' and 'App\Listeners\SendSMSToAbsentStudentParents.php'

StudentAttendanceController
---------------------------
// If the SMS module installed use the event
if(class_exists('\App\Events\AttendanceMarking'))
{
    // Get absebt students
    $students = Student::where('present_class_room_id', $request->class_room_id)->whereNotIn('id',$request->present)->get();
    foreach($students as $student){
        event(new \App\Events\AttendanceMarking($student));
    }
}

CoverageController
------------------
// If the SMS module installed use the event
if(class_exists('\App\Events\AttendanceMarking'))
{
    // Get absebt students
    $students = Student::where('present_class_room_id', $request->class_room_id)->whereNotIn('id',$request->student_ids)->get();
    foreach($students as $student){
        event(new \App\Events\AttendanceMarking($student));
    }
}

VerifyCsrfToken
---------------
'sms/report/*',


-------------------------END---------------------------------------