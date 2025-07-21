<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'student/getstudent/',
        'classRoom/',
        'studentAttendance/getStudent',
        'studentAttendance/find',
        'classRoom/getStudent',
        'examMark/getStudent',
        'examMark/getReport',
        'examMark/getMark',
        'teacherlog/*',
        'studentlog/*',
        'report/*',
        'coverage/report/*',
        'discipline/report/*',
        'sms/report/*',
        'videos/*',
    ];
}
