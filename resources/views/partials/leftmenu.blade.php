<ul class="nav nav-default" style="padding-left:8px;">
    @hasanyrole('Administrator|Principal|Data Entry')
        {{--<li><a href="{{url('/home')}}">Dashboard</a></li>--}}
        <li><a href="{{route('student.create')}}"><i class="fa fa-user-plus fa-fw"></i> New Admission</a></li>
        <li><a href="{{route('school.index')}}"><i class="fa fa-university fa-fw"></i>  Basic Info</a></li>
        <li><a href="{{route('student.find')}}"><i class="fa fa-user-circle fa-fw"></i> Students</a></li>
        <li><a href="{{route('teacher.index')}}"><i class="fa fa-user-circle fa-fw"></i> Teachers</a></li>
        <li><a href="{{route('grade.index')}}"><i class="fa fa-list-ol fa-fw"></i>  Grade</a></li>
        <li><a href="{{route('subject.index')}}"><i class="fa fa-book fa-fw"></i>  Subject</a></li>
<li><a href="{{route('examination.index')}}"><i class="fa fa-graduation-cap fa-fw"></i>  Examination @if(isset($rank_incomplete) && $rank_incomplete>0)<span class="label label-danger">{{$rank_incomplete}}</span>@endif</a></li>
        {{--<li><a href="{{route('payment.index')}}"><i class="fa fa-money fa-fw"></i>  Payment</a></li>--}}
        <li><a href="{{route('studentAttendance.index')}}"><i class="fa fa-address-card fa-fw"></i>  Attendance</a></li>
        <li><a href="{{route('user.index')}}"><i class="fa fa-user-circle fa-fw"></i>  User</a></li>
        {{--<li><a href="{{route('studentAttendance.index')}}"><i class="fa fa-cog fa-fw"></i>  Setting</a></li>
        <li><a href="{{route('studentAttendance.index')}}"><i class="fa fa-sitemap fa-fw"></i>  Heirarchy</a></li>
        <li><a href="{{route('studentAttendance.index')}}"><i class="fa fa-id-badge fa-fw"></i>  Job</a></li>--}}
        <li><a href="{{route('coverage.management.index')}}"><i class="fa fa-street-view fa-fw"></i>  Management</a></li>
        <li><a href="{{route('report.educational')}}"><i class="fa fa-line-chart fa-fw"></i>  Report</a></li>
	<li><a href="{{route('teacherAttendance.dailyView')}}"  target="_blank"><i class="fa fa-address-card fa-fw"></i>  Daily Attendance</a></li>
    @endhasanyrole
@hasanyrole('Administrator')
        <li><a href="{{route('parents.index')}}"><i class="fa fa-mobile fa-fw"></i>  Parents App</a></li>
        <li><a href="{{route('videos')}}"><i class="fa fa-play-circle fa-fw"></i>  Videos</a></li>
    @endhasanyrole
</ul>
