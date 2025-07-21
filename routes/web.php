<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Student
Route::get('/form/student/', 'FormController@create')->name('form');
Route::post('/form/student', 'FormController@store')->name('form.post');

// Parents
Route::get('/form/student/get/{id}', 'FormController@getStudent');
Route::get('/form/parents', 'FormController@parents');
Route::post('/form/parents', 'FormController@postParents');

Route::get('/t', 'StudentWebController@login')->name('t');
Route::post('/t', 'StudentWebController@postLogin')->name('t.post_login');
Route::post('/t/profile', 'StudentWebController@postOTP')->name('t.login');
Route::get('/t/subject/{id}', 'StudentWebController@getSubject')->name('t.subject');
Route::get('/t/video/{id}', 'StudentWebController@getVideo')->name('t.video');
Route::get('/t/genie/success', 'StudentWebController@success')->name('t.success');
Route::get('/t/genie/error', 'StudentWebController@error')->name('t.error');
Route::get('/t/info/{id}', 'StudentWebController@getInfo')->name('t.info');
Route::get('/t/exam/student/{id}', 'StudentWebController@getExam')->name('t.exam');
Route::get('/t/result/student/{id}', 'StudentWebController@getResult')->name('t.result');


Route::post('/password/getOTP', 'UserController@getOTP')->name('otp');
Route::get('/password/verifyOTP', 'UserController@verifyOTP')->name('verify_otp');
Route::post('/password/verifyOTP', 'UserController@postVerifyOTP')->name('post_verify_otp');

Route::post('/examMark/getReport','ExamMarkController@getReport')->name('examMark.getReport');

Auth::routes();

$this->get('verify-user/{code}','Auth\RegisterController@activateUser')->name('activate.user');

Route::group(['middleware' => ['auth','web']], function(){
    // Dahsboard
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard/getStudentCount', 'DashboardController@getStudentCount');
    Route::get('/dashboard/getTeacherCount', 'DashboardController@getTeacherCount');
    Route::get('/dashboard/getGradeCount', 'DashboardController@getGradeCount');
    Route::get('/dashboard/getSubjectCount', 'DashboardController@getSubjectCount');
    Route::get('/dashboard/getClassRoomCount', 'DashboardController@getClassRoomCount');
    Route::get('/dashboard/getExamCount', 'DashboardController@getExamCount');
    Route::get('/dashboard/getGradeFirst', 'DashboardController@getGradeFirst');
    Route::get('/dashboard/getSectionHead', 'DashboardController@getSectionHead');
    Route::get('/dashboard/getStudentAttendanceForThisMonth', 'DashboardController@getStudentAttendanceForThisMonth');
    Route::get('/dashboard/getTeacherAttendanceForThisMonth', 'DashboardController@getTeacherAttendanceForThisMonth');
    Route::get('/dashboard/getCount','DashboardController@getCount');

    // Overriding the student show route, otherwise the student/create is consider as student/{id} show route. Do not change the route order here.
    Route::group(['middleware' => ['role:Administrator|Principal|Data Entry']], function(){
        Route::get('/student/create','StudentController@create')->name('student.create');
        Route::post('/student/delete/{id}','StudentController@destroy')->name('student.delete');
    });

    // Student - Class teacher and section head have access
    Route::get('/student/find','StudentController@find')->name('student.find');
    Route::post('/student/getstudent','StudentController@postFind')->name('student.getstudent');
    Route::get('/student/quickFind','StudentController@quick_find')->name('student.quickFind');
    Route::get('/student/{id}','StudentController@show')->name('student.show');
    Route::get('/student/{id}/getParants','StudentController@getParents')->name('student.parents');
    Route::get('/student/{id}/sibling/create','SiblinController@create')->name('sibling.create');
    // Student log
    Route::get('/studentlog/student/{id}','StudentLogController@getLogByStudent');
    Route::resource('studentlog','StudentLogController',[
        'except' => ['edit','show','create']
    ]);
    // Student duty
    Route::get('/studentduty/student/{id}','StudentDutyController@getDutyByStudent');
    Route::resource('studentduty','StudentDutyController',[
        'except' => ['edit','show','create']
    ]);
    // Student attendance
    Route::get('/studentAttendance/bulk','StudentAttendanceController@bulk')->name('studentAttendance.bulk');
    Route::post('/studentAttendance/bulk','StudentAttendanceController@postBulk')->name('studentAttendance.postBulk');
    Route::post('/studentAttendance/getStudent','StudentAttendanceController@getStudent')->name('studentAttendance.getStudent');
    Route::post('/studentAttendance/find','StudentAttendanceController@find')->name('studentAttendance.find');
    Route::get('/studentAttendance/download','StudentAttendanceController@download')->name('studentAttendance.download');
    Route::resource('/studentAttendance','StudentAttendanceController');
    
    // Exam mark
    Route::get('/examMark/update/ajax', 'ExamMarkController@markUpdateAjax');
    Route::get('/examMark/rank/ajax', 'ExamMarkController@rankAjax');
    Route::get('/examMark/grade','ExamMarkController@grade')->name('examMark.grade');
    Route::post('/examMark/getStudent','ExamMarkController@getStudent')->name('examMark.getStudent');
    //Route::post('/examMark/getReport','ExamMarkController@getReport')->name('examMark.getReport');
    Route::post('/examMark/getMark','ExamMarkController@getMark')->name('examMark.getMark');
    Route::post('/examMark/delete','ExamMarkController@delete')->name('examMark.delete');
    Route::get('/examMark/rank','ExamMarkController@rank')->name('examMark.rank');
    Route::resource('/examMark','ExamMarkController');

    // Exam mark mobile views
    Route::get('/m/', 'MobileDeviceController@index');
    Route::post('/m/examMark/create', 'MobileDeviceController@create');
    Route::post('/m/examMark/store', 'MobileDeviceController@store');
    

    Route::group(['middleware' => ['role:Administrator|Principal|Data Entry|Class Teacher']], function(){
        // Teacher
        Route::post('teacher/photoUpload','TeacherController@photo_upload')->name('teacher.photoUpload');
        Route::get('teacher/download','TeacherController@download')->name('teacher.download');
        Route::post('teacher/changeClass','TeacherController@change_class')->name('teacher.changeClass');
        Route::post('teacher/{id}/resign','TeacherController@resign')->name('teacher.resign');
        Route::get('teacher/{id}/teach','TeacherController@teach')->name('teacher.teach');
        Route::post('teacher/{id}/teach','TeacherController@postTeach')->name('teacher.postTeach');
        Route::resource('/teacher','TeacherController');
        // Teacher attendance
        Route::get('/teacherAttendance/bulk','TeacherAttendanceController@bulk')->name('teacherAttendance.bulk');
	    Route::get('/teacherAttendance/daily','TeacherAttendanceController@daily')->name('teacherAttendance.daily');
        Route::post('/teacherAttendance/daily','TeacherAttendanceController@postDaily')->name('teacherAttendance.postDaily');
        Route::get('/teacherAttendance/daily/view','TeacherAttendanceController@dailyView')->name('teacherAttendance.dailyView');
        Route::post('/teacherAttendance/bulk','TeacherAttendanceController@postBulk')->name('teacherAttendance.postBulk');
        Route::post('/teacherAttendance/getTeacher','TeacherAttendanceController@getStudent')->name('teacherAttendance.getStudent');
        Route::post('/teacherAttendance/find','TeacherAttendanceController@find')->name('teacherAttendance.find');
        Route::get('/teacherAttendance/download','TeacherAttendanceController@download')->name('teacherAttendance.download');
        Route::resource('/teacherAttendance','TeacherAttendanceController');
        // Teacher qualification
        Route::get('/qualification/teacher/{id}','TeacherQualificationController@getQualificationByTeacher');
        Route::resource('/qualification','TeacherQualificationController',[
            'except' => ['create','index','update','show','edit']
        ]);
        // Teacher experience
        Route::get('/experience/teacher/{id}','TeacherExperienceController@getExperienceByTeacher');
        Route::resource('/experience','TeacherExperienceController',[
            'except' => ['create','index','update','show','edit']
        ]);
        // Teacher job history
        Route::get('/jobHistory/teacher/{id}','TeacherJobHistoryController@getJobHistoryByTeacher');
        Route::resource('/jobHistory','TeacherJobHistoryController',[
            'except' => ['create','index','update','show','edit']
        ]);
        // Teacher skill
        Route::get('/skill/teacher/{id}','TeacherSkillController@getSkillByTeacher');
        Route::resource('/skill','TeacherSkillController',[
            'except' => ['create','index','update','show','edit']
        ]);
        // Teacher log
        Route::get('/teacherlog/teacher/{id}','TeacherLogController@getLogByTeacher');
        Route::resource('teacherlog','TeacherLogController',[
            'except' => ['edit','show','create']
        ]);
        //Teacher duty
        Route::get('/teacherduty/teacher/{id}','TeacherDutyController@getDutyByTeacher');
        Route::resource('teacherduty','TeacherDutyController',[
            'except' => ['edit','show','create']
        ]);
        // Exam
        Route::resource('/examination','ExaminationController',[
            'except' => ['show','create']
        ]);
        // Exam mark grade
        Route::resource('/markGrade','MarkGradeController',[
            'except' => ['update','show','edit']
        ]);
        //School
        Route::resource('/school','SchoolController',[
            'except' => ['create','destroy','show','store']
        ]);
        // Academimc year
        Route::resource('/academicYear','AcademicYearController',[
            'except' => ['create','show']
        ]);
        // Term
        Route::resource('/term','TermController',[
            'except' => ['create','show']
        ]);
        // Grade
        Route::resource('/grade','GradeController',[
            'except' => ['create','show']
        ]);
        // Division
        Route::resource('/division','DivisionController',[
            'except' => ['create','show']
        ]);
        // Class room
        Route::get('/classRoom/transfer','ClassRoomController@transfer')->name('classRoom.transfer');
        Route::post('/classRoom/getStudent','ClassRoomController@getStudent')->name('classRoom.getStudent');
        Route::post('/classRoom/transfer','ClassRoomController@postTransfer')->name('classRoom.transfer');
        Route::resource('/classRoom','ClassRoomController',[
            'except' => ['create','show','index']
        ]);
        // Subject
        Route::get('/subject/get/ajax', 'SubjectController@getAjax');
        Route::resource('/subject','SubjectController',[
            'except' => ['create','show']
        ]);
        // Subject teacher
        Route::resource('/subjectTeacher','SubjectTeacherController');
        // Subject grade
        Route::resource('/gradeSubject','GradeSubjectController',[
            'except' => ['create','show','edit','update','destroy']
        ]);
        // House
        Route::resource('/house','HouseController',[
            'except' => ['show','create']
        ]);
        // Cluster
        Route::resource('/cluster','ClusterController',[
            'except' => ['show','create']
        ]);
        // Payment
        Route::get('payment/getPaymentForYear','PaymentController@getPaymentForYear')->name('payment.getPaymentForYear');
        Route::get('payment/getFeePaymentForClass','PaymentController@getFeePaymentForClass')->name('payment.getFeePaymentForClass');
        Route::resource('/payment','PaymentController');
        // Section
        Route::resource('section','SectionController');
        // User
        Route::get('user/role','UserController@role')->name('user.role');
        Route::get('user/permission','UserController@permission')->name('user.permission');
        Route::post('user/{id}/password','UserController@updatePassword')->name('user.updatePassword');
        Route::resource('/user','UserController');
        // User roll
        Route::resource('role','RoleController',[
            'except' => ['edit','show','create']
        ]);
        // User role permission
        Route::resource('permission','PermissionController');
        // Report
        Route::get('/report','ReportController@index');
        Route::get('/report/educational','ReportController@educational')->name('report.educational');
        Route::post('/report/educational','ReportController@postEducational');
        Route::get('/report/exam','ReportController@exam')->name('report.exam');
        Route::post('/report/exam','ReportController@postExam');
        Route::get('/report/term','ReportController@term')->name('reports.term');
        Route::get('/report/student','ReportController@student')->name('report.student');
        Route::post('/report/student','ReportController@postStudent');
        Route::get('/report/teacher','ReportController@teacher')->name('report.teacher');
        Route::post('/report/teacher','ReportController@postTeacher');
        Route::get('/report/parents','ReportController@parents')->name('report.parents');
        Route::post('/report/parents','ReportController@postParents');
        Route::get('/report/exam_analyze','ReportController@examAnalyze')->name('report.analyze');
        Route::post('/report/exam_analyze','ReportController@postExamAnalyze');
        Route::get('/report/exam_analyze_class','ReportController@examClassAnalyze')->name('report.analyze_class');
        Route::post('/report/exam_analyze_class','ReportController@postExamClassAnalyze');
        Route::get('/report/exam_analyze_new','ReportController@examAnalyzeNew')->name('report.analyze_new');
        Route::post('/report/exam_analyze_new','ReportController@postExamAnalyzeNew');
        Route::get('/report/shuffled','ReportController@shuffled')->name('report.shuffled');
        Route::post('/report/shuffled','ReportController@postShuffled');
	    Route::get('/report/suraksha','ReportController@suraksha')->name('report.suraksha');
        Route::post('/report/suraksha','ReportController@postSuraksha');
	    Route::get('/report/student_count','ReportController@studentCount')->name('report.student_count');
        Route::post('/report/student_count','ReportController@postStudentCount');

        // New aloysius student report
        Route::get('/report/aloysius_student','ReportController@aloysiusStudent')->name('report.aloysius_student');
        Route::post('/report/aloysius_student','ReportController@postAloysiusStudent');

        // New aloysius teacher report
        Route::get('/report/aloysius_teacher','ReportController@aloysiusTeacher')->name('report.aloysius_teacher');
        
        // Report ajax
        Route::get('/report/get_class','ReportController@getClass')->name('report.get_class');
        Route::get('/report/get_subject','ReportController@getSubject')->name('report.get_subject');
        Route::get('/report/get_subject_medium','ReportController@getSubjectWithMedium')->name('report.get_subject_medium');
        
        
        // Student
        Route::post('student/photoUpload','StudentController@photo_upload')->name('student.photoUpload');
        Route::post('student/{id}/updateParents','StudentController@updateParents')->name('student.update_parents');
        Route::post('student/{id}/addSiblin','StudentController@addSiblin')->name('student.add_siblin');
        Route::post('student/{id}/leave','StudentController@leave')->name('student.leave');
        Route::get('studentr/download','StudentController@download')->name('student.download');
        Route::get('student/{id}/learn','StudentController@learn')->name('student.learn');
        Route::post('student/{id}/learn','StudentController@postLearn')->name('student.postLearn');
        Route::delete('student/{id}/learn/{learn_id}','StudentController@deleteLearn')->name('student.deleteLearn');
        Route::resource('/student','StudentController');
        // Student siblin
        Route::resource('/siblin','SiblinController');
        // Emergency contact
        Route::resource('/emergencyContact' ,'EmergencyContactController',[
            'except' => ['edit','show','create','store','index']
        ]);
        
    });
    
    

    Route::group(['middleware' => ['role:Administrator']], function(){
        // Data import - upload
        Route::get('/dataImport','DataImportController@index')->name('import.index');
        Route::post('/dataImport/academicYear','DataImportController@uploadAcademicYear')->name('import.academic_year');
        Route::post('/dataImport/term','DataImportController@uploadTerm')->name('import.term');
        Route::post('/dataImport/grade','DataImportController@uploadGrade')->name('import.grade');
        Route::post('/dataImport/subject','DataImportController@uploadSubject')->name('import.subject');
        Route::post('/dataImport/student','DataImportController@uploadStudent')->name('import.student');
        Route::post('/dataImport/teacher','DataImportController@uploadTeacher')->name('import.teacher');
        Route::post('/dataImport/parents','DataImportController@uploadParents')->name('import.parents');
        Route::post('/dataImport/siblin','DataImportController@uploadSiblin')->name('import.siblin');
        Route::post('/dataImport/emergencyContact','DataImportController@uploadEmergencyContact')->name('import.emergencyContact');
        // Data import - download template
        Route::get('/dataImport/academicYear','DataImportController@downloadAcademicYear')->name('import.download.academic_year');
        Route::get('/dataImport/term','DataImportController@downloadTerm')->name('import.download.term');
        Route::get('/dataImport/grade','DataImportController@downloadGrade')->name('import.download.grade');
        Route::get('/dataImport/subject','DataImportController@downloadSubject')->name('import.download.subject');
        Route::get('/dataImport/student','DataImportController@downloadStudent')->name('import.download.student');
        Route::get('/dataImport/teacher','DataImportController@downloadTeacher')->name('import.download.teacher');
        Route::get('/dataImport/parents','DataImportController@downloadParents')->name('import.download.parents');
        Route::get('/dataImport/siblin','DataImportController@downloadSiblin')->name('import.download.siblin');
        Route::get('/dataImport/emergencyContact','DataImportController@downloadEmergencyContact')->name('import.download.emergencyContact');
        // Exam mark upload
        Route::get('/dataImport/mark',function(){
            return view('mark');
        });
        Route::post('/dataImport/mark','DataImportController@mark');
        // Video
        Route::get('/videos','VideoController@index')->name('videos');
        Route::get('/videos/get','VideoController@get')->name('videos.get');
        Route::post('/videos/store','VideoController@store')->name('videos.store');
        // Ajax
        Route::get('/videos/grade/{id}','VideoController@getSubject')->name('videos.subject');
        Route::get('/videos/delete/{id}','VideoController@delete')->name('videos.delete');

    });
});

Route::get('try', function(){
    // $data = '17:30';
    // $data = explode(':',$data);
    // $ended_date = \Carbon\Carbon::create(date('Y'),date('m'),date('d'),$data[0],$data[1]);
    // return $ended_date;

    // $week = \Carbon\Carbon::now();
    // return $week->endOfWeek();

        // $date_from = \Carbon\Carbon::createFromFormat('Y-m-d',"2018-08-10")->startOfWeek();
        // echo $date_from . "<br>";
        // $date_to = \Carbon\Carbon::createFromFormat('Y-m-d',"2018-08-16")->endOfWeek();
        // echo $date_to . "<br>";
        // $diff = $date_to->diffInDays($date_from);
        // $week = $diff;
        // return $week;

        //var_dump(openssl_get_cert_locations());
        
        $client = new GuzzleHttp\Client();
        $response = $client->request('GET', 'https://cpsolutions.dialog.lk/index.php/cbs/sms/send?destination=94770219031&q=123456&message=message to send');
        dd($response);
});
