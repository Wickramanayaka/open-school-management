<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/png" href="{{url('images/logo.png')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <style>
        @media print{
            body{
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <img src="{{url('images/brand-logo.png')}}" style="max-width:136px; margin-top:0px;" />
                        {{-- config('app.name', 'Bluesmart') --}}
                    </a>
                    
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{url('/home')}}">Dashboard</a>                       
                        </li>
                        @hasanyrole('Administrator|Principal|Data Entry')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                School <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @hasanyrole('Administrator|Principal|Data Entry')
                                <li><a href="{{route('school.index')}}"><i class="fa fa-info-circle fa-fw"></i> Basic Info</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('academicYear.index')}}"><i class="fa fa-hourglass fa-fw"></i> Academic Year</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('term.index')}}"><i class="fa fa-calendar fa-fw"></i> Term</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('grade.index')}}"><i class="fa fa-list-ol fa-fw"></i> Grade</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle-submenu" tabindex="-1">
                                        <i class="fa fa-book fa-fw"></i> Subject <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="{{route('subject.index')}}"><i class="fa fa-sign-out fa-fw"></i> Subject List</a></li>
                                        <li class="divider"></li>
                                        {{-- This function has been remove. Implemented now function with grade has it's own subject
                                        TODO: Refactoring need to be done.
                                        <li><a tabindex="-1" href="{{route('gradeSubject.index')}}"><i class="fa fa-sign-out fa-fw"></i> Subjects for Grade</a></li>
                                        <li class="divider"></li>
                                        --}}
                                        {{-- <li><a tabindex="-1" href="{{route('chapter.index')}}"><i class="fa fa-sign-out fa-fw"></i> Syllabus</a></li> --}}
                                        {{-- <li class="divider"></li> --}}
                                        <li><a tabindex="-1" href="{{route('subjectTeacher.index')}}"><i class="fa fa-sign-out fa-fw"></i> Subjects Teacher</a></li>
                                    </ul>
                                </li>
                                <li class="divider"></li>
                                @endhasanyrole
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle-submenu" tabindex="-1">
                                        <i class="fa fa-graduation-cap fa-fw"></i> Examination <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="{{route('examination.index')}}"><i class="fa fa-sign-out fa-fw"></i> Exam List</a></li>
                                        <li class="divider"></li>
                                        {{--<li><a tabindex="-1" href="{{route('examMark.index')}}"><i class="fa fa-sign-out fa-fw"></i> Marks</a></li>--}}
                                        <li><a tabindex="-1" href="{{route('examMark.create')}}"><i class="fa fa-sign-out fa-fw"></i> Marks</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="{{url('/m/')}}"><i class="fa fa-sign-out fa-fw"></i> Marks (Mobile)</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="{{route('examMark.rank')}}"><i class="fa fa-sign-out fa-fw"></i> Ranks</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="{{route('markGrade.create')}}"><i class="fa fa-sign-out fa-fw"></i> Mark Grades</a></li>
                                    </ul>
                                </li>
                                @hasanyrole('Administrator|Principal|Data Entry')
                                <li class="divider"></li>
                                <li><a href="{{route('house.index')}}"><i class="fa fa-home  fa-fw"></i> House</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('cluster.index')}}"><i class="fa fa-cubes  fa-fw"></i> Cluster</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('section.index')}}"><i class="fa fa-database  fa-fw"></i> Section</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('import.index')}}"><i class="fa fa-upload fa-fw"></i> Data Import</a></li>
                                @endhasanyrole
                            </ul>
                        </li>
                        @endhasanyrole
                        @hasanyrole('Class Teacher')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Examinaion <span class="caret"></span>
                            </a>
    
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="{{route('examMark.create')}}"><i class="fa fa-sign-out fa-fw"></i> Marks</a></li>
                                <li class="divider"></li>
                                <li><a tabindex="-1" href="{{url('/m/')}}"><i class="fa fa-sign-out fa-fw"></i> Marks (Mobile)</a></li>
                                <li class="divider"></li>
                                <li><a tabindex="-1" href="{{route('examMark.rank')}}"><i class="fa fa-sign-out fa-fw"></i> Ranks</a></li>
                            </ul>
                        </li>
                        @endhasanyrole
                        @hasanyrole('Administrator|Principal|Data Entry')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Teacher <span class="caret"></span>
                            </a>
    
                            <ul class="dropdown-menu">
                                <li><a href="{{route('teacher.index')}}"><i class="fa fa-info-circle fa-fw"></i> Teacher Info</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('teacher.create')}}"><i class="fa fa-plus-circle fa-fw"></i> New Teacher</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle-submenu" tabindex="-1">
                                        <i class="fa fa-address-card fa-fw"></i> Attendance <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="{{route('teacherAttendance.index')}}"><i class="fa fa-sign-out fa-fw"></i> View Attendance</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="{{route('teacherAttendance.daily')}}"><i class="fa fa-sign-out fa-fw"></i> Daily Attendance</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="{{route('teacherAttendance.bulk')}}"><i class="fa fa-sign-out fa-fw"></i> Upload Attendance</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
                        @hasanyrole('Administrator|Principal|Data Entry')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Student <span class="caret"></span>
                            </a>
        
                            <ul class="dropdown-menu">
                                <li><a href="{{route('student.find')}}"><i class="fa fa-info-circle fa-fw"></i> Student Info</a></li>
                                <li class="divider"></li>
                                @hasanyrole('Administrator|Principal|Data Entry')
                                    <li><a href="{{route('student.create')}}"><i class="fa fa-plus-circle fa-fw"></i> New Admission</a></li>
                                    <li class="divider"></li>
                                @endhasanyrole
                                <li><a href="{{route('classRoom.transfer')}}"><i class="fa fa-exchange fa-fw"></i> Class Transfer</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle-submenu" tabindex="-1">
                                        <i class="fa fa-address-card fa-fw"></i> Attendance <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="{{route('studentAttendance.index')}}"><i class="fa fa-sign-out fa-fw"></i> View Attendance</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="{{route('studentAttendance.create')}}"><i class="fa fa-sign-out fa-fw"></i> Daily Attendance</a></li>
                                        {{-- This function has not been QA, therefore temparary desabled --}}
                                        {{--<li class="divider"></li>
                                        <li><a tabindex="-1" href="{{route('studentAttendance.bulk')}}"><i class="fa fa-sign-out fa-fw"></i> Upload Attendance</a></li>--}}
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        @endhasanyrole
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Discipline <span class="caret"></span>
                            </a>
    
                            <ul class="dropdown-menu">
                                @hasanyrole('Administrator|Principal|Data Entry')
                                <li><a href="{{url('/discipline/category/')}}"><i class="fa fa-plus-circle fa-fw"></i> Category</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('discipline/disobedience/')}}"><i class="fa fa-plus-circle fa-fw"></i> Disobedience</a></li>
                                <li class="divider"></li>
                                @endhasanyrole
                                <li><a href="{{url('discipline/student/')}}"><i class="fa fa-plus-circle fa-fw"></i> Student Disobedience</a></li>
                                @hasanyrole('Administrator|Principal')
                                <li class="divider"></li>
                                <li><a href="{{url('discipline/report/disobedience')}}"><i class="fa fa-file fa-fw"></i> Disobedience Report</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('discipline/report/student')}}"><i class="fa fa-file fa-fw"></i> Student Discipline Report</a></li>
                                @endhasanyrole
                            </ul>
                        </li>
                        @hasanyrole('Administrator|Principal|Data Entry')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                SMS <span class="caret"></span>
                            </a>
    
                            <ul class="dropdown-menu">
                                <li><a href="{{url('sms/')}}"><i class="fa fa-comments fa-fw"></i> Short Message</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('sms/template/')}}"><i class="fa fa-comment fa-fw"></i> Template</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('sms/report/')}}"><i class="fa fa-file fa-fw"></i> Report</a></li>
                            </ul>
                        </li>
                        @endhasanyrole
                        @hasanyrole('Administrator|Principal|Data Entry')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                User <span class="caret"></span>
                            </a>
    
                            <ul class="dropdown-menu">
                                <li><a href="{{route('user.index')}}"><i class="fa fa-info-circle fa-fw"></i> User List</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('user.create')}}"><i class="fa fa-plus-circle fa-fw"></i> New User</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('coverage.pincode.index')}}"><i class="fa fa-lock fa-fw"></i> Pin Code</a></li>
                                {{-- These user roles and permission are available in the system and not visible to user. --}}
                                {{--<li class="divider"></li>
                                <li><a href="{{route('user.role')}}"><i class="fa fa-plus-circle fa-fw"></i> User Role</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('permission.index')}}"><i class="fa fa-plus-circle fa-fw"></i> User Permission</a></li>--}}
                            </ul>
                        </li>
                        @endhasanyrole
                        @hasanyrole('Administrator|Principal|Data Entry')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Report <span class="caret"></span>
                            </a>
    
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/report')}}"><i class="fa fa-file fa-fw"></i> Progress Report</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/educational')}}"><i class="fa fa-file fa-fw"></i> Educational</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/exam')}}"><i class="fa fa-file fa-fw"></i> Exam</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/student')}}"><i class="fa fa-file fa-fw"></i> Student</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/teacher')}}"><i class="fa fa-file fa-fw"></i> Teacher</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/parents')}}"><i class="fa fa-file fa-fw"></i> Parents</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/exam_analyze')}}"><i class="fa fa-file fa-fw"></i> Exam Mark Analyze</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/exam_analyze_class')}}"><i class="fa fa-file fa-fw"></i> Exam Mark Analyze (Class wise)</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/exam_analyze_new')}}"><i class="fa fa-file fa-fw"></i> Exam Mark Analyze (S1)</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/coverage/report/teach')}}"><i class="fa fa-file fa-fw"></i> Teaching</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/coverage/report/attendance')}}"><i class="fa fa-file fa-fw"></i> Period Attendance</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/coverage/report/feedback')}}"><i class="fa fa-file fa-fw"></i> Feedback</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/shuffled')}}"><i class="fa fa-file fa-fw"></i> Shuffled Class</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/suraksha')}}"><i class="fa fa-file fa-fw"></i> Suraksha</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/student_count')}}"><i class="fa fa-file fa-fw"></i> Student Count</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/aloysius_student')}}"><i class="fa fa-file fa-fw"></i> Student(New)</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/aloysius_teacher')}}"><i class="fa fa-file fa-fw"></i> Teacher(New)</a></li>
                            </ul>
                        </li>
                        @endhasanyrole
                        @hasanyrole('Class Teacher')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Report <span class="caret"></span>
                            </a>
    
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/report')}}"><i class="fa fa-file fa-fw"></i> Progress Report</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/educational')}}"><i class="fa fa-file fa-fw"></i> Educational</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/exam')}}"><i class="fa fa-file fa-fw"></i> Exam</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/student')}}"><i class="fa fa-file fa-fw"></i> Student</a></li>
                                <li class="divider"></li>
                                {{--<li><a href="{{url('/report/teacher')}}"><i class="fa fa-file fa-fw"></i> Teacher</a></li>
                                <li class="divider"></li>--}}
                                {{-- <li><a href="{{url('/report/parents')}}"><i class="fa fa-file fa-fw"></i> Parents</a></li>
                                <li class="divider"></li> --}}
                                <li><a href="{{url('/report/exam_analyze')}}"><i class="fa fa-file fa-fw"></i> Exam Mark Analyze</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/exam_analyze_class')}}"><i class="fa fa-file fa-fw"></i> Exam Mark Analyze (Class wise)</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/exam_analyze_new')}}"><i class="fa fa-file fa-fw"></i> Exam Mark Analyze (S1)</a></li>
                                <li class="divider"></li>
                                {{-- <li><a href="{{url('/coverage/report/teach')}}"><i class="fa fa-file fa-fw"></i> Teaching</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/coverage/report/attendance')}}"><i class="fa fa-file fa-fw"></i> Period Attendance</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/coverage/report/feedback')}}"><i class="fa fa-file fa-fw"></i> Feedback</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/shuffled')}}"><i class="fa fa-file fa-fw"></i> Shuffled Class</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/suraksha')}}"><i class="fa fa-file fa-fw"></i> Suraksha</a></li>
                                <li class="divider"></li> --}}
                                <li><a href="{{url('/report/student_count')}}"><i class="fa fa-file fa-fw"></i> Student Count</a></li>
                                {{-- <li class="divider"></li>
                                <li><a href="{{url('/report/aloysius_student')}}"><i class="fa fa-file fa-fw"></i> Aloysius Student</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/report/aloysius_teacher')}}"><i class="fa fa-file fa-fw"></i> Aloysius Teacher</a></li> --}}
                            </ul>
                        </li>
                        @endhasanyrole
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                        @guest
                            
                        @else
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out fa-fw"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div>
            <div class="row-eq-height"  style="margin-bottom: 15px; border-bottom:none;">
                <div class="col-lg-2" style="padding-bottom:5px;padding-top:5px;" id="global-search">
                    @hasanyrole('Administrator|Principal|Data Entry')
                    <form class="form-inline" method="GET" action="{{route('student.quickFind')}}">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail3">Lookup</label>
                            <div class="input-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Find here" value="{{isset($name)?$name:''}}">
                            <div class="input-group-addon"><a href="#" onclick="$(this).closest('form').submit()"><i class="fa fa-search"></i></a></div>
                            </div>  
                        </div>
                    </form>
                    @endhasanyrole
                </div>
                <div class="col-lg-10" style="padding-top:0;">
                <h5 style="font-size:18px;"><b>{{preg_replace('/([a-z])([A-Z])/s','$1 $2',ucfirst(Request::segment(1)))}}</b></h5> 
                </div>
            </div>
            <div class="row-eq-height">
                <div class="col-lg-2" id="left-menu">
                    @include('partials.leftmenu')
                </div>
                <div class="col-lg-10">
                        @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('js/jquery.tabletoCSV.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".dropdown-submenu a.dropdown-toggle-submenu").on('click',function(e){
                $(this).next('ul').toggle();
                $(".dropdown-submenu a.dropdown-toggle-submenu").not($(this)).each(function(){
                    $(this).next('ul').hide();
                })
                e.stopPropagation();
                e.preventDefault();
            });
            $('.delete').on('click', function(){
                if(confirm('Do you want to delete this item?')){
                    return true;
                }
                return false;
            });
        });
        $(function(){
            $('[data-toggle="popover"]').popover();
        });
        $(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        $(function(){
            $('.datatable').dataTable();
        });
    </script>
    @yield('javascript')
</body>
</html>
