Installation instructions
-------------------------
Update composer.json

Repository

{
    "type": "path",
    "url": "packages/proactiveants/discipline",
    "options": {
        "symlink": true
    }
}

require

"proactiveants/discipline": "dev-master"

Menu
----
app.blade.php

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        Discipline <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        <li><a href="{{url('/discipline/category/')}}"><i class="fa fa-info-circle fa-fw"></i> Category</a></li>
        <li class="divider"></li>
        <li><a href="{{url('discipline/disobedience/')}}"><i class="fa fa-plus-circle fa-fw"></i> Disobedience</a></li>
        <li class="divider"></li>
        <li><a href="{{url('discipline/student/')}}"><i class="fa fa-lock fa-fw"></i> Student Disobedience</a></li>
        <li class="divider"></li>
        <li><a href="{{url('discipline/report/disobedience')}}"><i class="fa fa-lock fa-fw"></i> Disobedience Report</a></li>
        <li class="divider"></li>
        <li><a href="{{url('discipline/report/student')}}"><i class="fa fa-lock fa-fw"></i> Student Discipline Report</a></li>
    
    </ul>
</li>

Profile discipline
------------------
resource->view->student->view.blade.php

@if (view()->exists("discipline::students.discipline"))
    <li role="presentation"><a href="#discipline" aria-controls="discipline" role="tab" data-toggle="tab"><i class="fa fa-cog fa-fw"></i> Discipline</a></li>
@endif

@if (view()->exists("discipline::students.discipline"))
    <div role="tabpanel" class="tab-pane" id="discipline">
        @include('discipline::students.discipline')
    </div>
@endif

Update progress report blades
-----------------------------
<td rowspan="3" style="font-size:8px;">
    Discipline Point Balance :
    <div class="col-md-3" style="background-color: {{getDisciplineColorCode($student,$exam)}} !important; width:50px height:100px; font-size:12px; margin-right:5px;">
        {{getDisciplinePointBalance($student,$exam)}}
    </div>
</td>

-------------------------END---------------------------------------