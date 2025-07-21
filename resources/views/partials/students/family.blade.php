<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Parents/Guardian
                    <span class="pull-right"><a href="#" data-toggle="modal" data-target="#parents-modal"><i class="fa fa-edit fa-fw"></i> Edit</a></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table table-no-border">
                                <tr><td><h3>Father Information</h3></td><td></td></tr>
                                <tr><td>Name</td><td>{{$student->student_parent->father_name}}</td></tr>
                                <tr><td>Mobile</td><td>{{$student->student_parent->father_telephone}}</td></tr>
                                <tr><td>E-Mail</td><td>{{$student->student_parent->father_email}}</td></tr>
                                <tr><td>Occupation</td><td>{{$student->student_parent->f_occupation==null?'':$student->student_parent->f_occupation->name}}</td></tr>
                                <tr><td>Name of Employment</td><td>{{$student->student_parent->father_name_of_employment}}</td></tr>
                                <tr><td>Address of Employment</td><td>{{$student->student_parent->father_address_of_employment}}</td></tr>
                                <tr><td>Office Telephone</td><td>{{$student->student_parent->father_office_telephone}}</td></tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-no-border">
                                <tr><td><h3>Mother Information</h3></td><td></td></tr>
                                <tr><td>Name</td><td>{{$student->student_parent->mother_name}}</td></tr>
                                <tr><td>Mobile</td><td>{{$student->student_parent->mother_telephone}}</td></tr>
                                <tr><td>E-Mail</td><td>{{$student->student_parent->mother_email}}</td></tr>
                                <tr><td>Occupation</td><td>{{$student->student_parent->m_occupation==null?'':$student->student_parent->m_occupation->name}}</td></tr>
                                <tr><td>Name of Employment</td><td>{{$student->student_parent->mother_name_of_employment}}</td></tr>
                                <tr><td>Address of Employment</td><td>{{$student->student_parent->mother_address_of_employment}}</td></tr>
                                <tr><td>Office Telephone</td><td>{{$student->student_parent->mother_office_telephone}}</td></tr>
                            </table>            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table table-no-border">
                                <tr><td><h3>Guardian Information</h3></td><td></td></tr>
                                <tr><td>Name</td><td>{{$student->student_parent->guardian_name}}</td></tr>
                                <tr><td>Mobile</td><td>{{$student->student_parent->guardian_telephone}}</td></tr>
                                <tr><td>E-Mail</td><td>{{$student->student_parent->guardian_email}}</td></tr>
                                <tr><td>Occupation</td><td>{{$student->student_parent->g_occupation==null?'':$student->student_parent->g_occupation->name}}</td></tr>
                                <tr><td>Name of Employment</td><td>{{$student->student_parent->guardian_name_of_employment}}</td></tr>
                                <tr><td>Address of Employment</td><td>{{$student->student_parent->guardian_address_of_employment}}</td></tr>
                                <tr><td>Office Telephone</td><td>{{$student->student_parent->guardian_office_telephone}}</td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Siblins <span class="pull-right"><a href="{{url("/student/$student->id/sibling/create")}}"><i class="fa fa-plus-circle fa-fw"></i> Add</a></span>
                </div>
                <div class="panel-body">
                    <table class="table table-no-border">
                        <tr>
                            <th>Admission Number</th><th>Name</th><th>Class Room</th><th></th>
                        </tr>
                        @foreach ($student->siblins as $siblin)
                            <tr>
                                <td>{{$siblin->rightStudent->admission_number}}</td>
                                <td><a href="{{route('student.show',$siblin->rightStudent->id)}}">{{$siblin->rightStudent->fullName}}</a></td>
                                <td>{{$siblin->rightStudent->present_class_room->name}}</td>
                                <td>
                                    <form action="{{route('siblin.destroy',$siblin->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
                
        </div>
    </div>
<form method="POST" action="{{route('student.update_parents',$student->id)}}">
    {{ csrf_field() }}    
    <div class="modal fade" id="parents-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Parents Information</h4>
            </div>
            <div class="modal-body">
                <h3 style="color:teal">Father Info</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="father_name">Name</label>
                        <input class="form-control" type="text" id="father_name" name="father_name" value="{{$student->student_parent->father_name}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="father_name">Mobile</label>
                            <input class="form-control" type="text" id="father_telephone" name="father_telephone" placeholder="+94123456789" value="{{$student->student_parent->father_telephone}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="father_name">E-Mail</label>
                            <input class="form-control" type="text" id="father_email" name="father_email" value="{{$student->student_parent->father_email}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="father_id_number">ID Number</label>
                            <input class="form-control" type="text" id="father_id_number" name="father_id_number" value="{{$student->student_parent->father_id_number}}">
                        </div>
                    </div>
                    {{-- <div class="col-lg-3">
                        <div class="form-group">
                            <label for="father_name">Occupation</label>
                            <input class="form-control" type="text" id="father_occupation" name="father_occupation" value="{{$student->student_parent->father_occupation}}">
                        </div>
                    </div> --}}
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="father_name">Occupation</label>
                            <select class="form-control" id="father_occupation" name="father_occupation">
                                @foreach ($occupations as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="father_name">Name of Employment</label>
                            <input class="form-control" type="text" id="father_name_of_employment" name="father_name_of_employment" value="{{$student->student_parent->father_name_of_employment}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="father_name">Office Telephone</label>
                            <input class="form-control" type="text" id="father_office_telephone" name="father_office_telephone" value="{{$student->student_parent->father_office_telephone}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="father_name">Office Address</label>
                            <input class="form-control" type="text" id="father_address_of_employment" name="father_address_of_employment" value="{{$student->student_parent->father_address_of_employment}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="father_designation_type">Designation Type</label>
                            <select class="form-control" id="father_designation_type" name="father_designation_type">
                                <option value="Government" {{$student->student_parent->father_designation_type=='Government'?'selected':''}}>Government</option>
                                <option value="Private" {{$student->student_parent->father_designation_type=='Private'?'selected':''}}>Private</option>
                                <option value="Own Business" {{$student->student_parent->father_designation_type=='Own Business'?'selected':''}}>Own Business</option>
                                <option value="Unemployeed" {{$student->student_parent->father_designation_type=='Unemployeed'?'selected':''}}>Unemployeed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="father_income_level">Level of Income </label>
                            <select class="form-control" id="father_income_level" name="father_income_level">
                                <option value="0-25,000" {{$student->student_parent->father_income_level=='0-25,000'?'selected':''}}>0-25,000</option>
                                <option value="26,000-50,000" {{$student->student_parent->father_income_level=='26,000-50,000'?'selected':''}}>26,000-50,000</option>
                                <option value="51,000-75,000" {{$student->student_parent->father_income_level=='51,000-75,000'?'selected':''}}>51,000-75,000</option>
                                <option value="76,000-100,000" {{$student->student_parent->father_income_level=='76,000-100,000'?'selected':''}}>76,000-100,000</option>
                                <option value="above 100,000" {{$student->student_parent->father_income_level=='above 100,000'?'selected':''}}>above 100,000</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="father_education_level">Level of Education</label>
                            <select class="form-control" id="father_education_level" name="father_education_level">
                                <option value="O/L" {{$student->student_parent->father_education_level=='O/L'?'selected':''}}>O/L</option>
                                <option value="A/L" {{$student->student_parent->father_education_level=='A/L'?'selected':''}}>A/L</option>
                                <option value="Bachelor Degree" {{$student->student_parent->father_education_level=='Bachelor Degree'?'selected':''}}>Bachelor Degree</option>
                                <option value="Master Degree" {{$student->student_parent->father_education_level=='Master Degree'?'selected':''}}>Master Degree</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="father_protection_level">Level of Protection</label>
                            <select class="form-control" id="father_protection_level" name="father_protection_level">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <h3 style="color:teal">Mother Info</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="mother_name">Name</label>
                            <input class="form-control" type="text" id="mother_name" name="mother_name" value="{{$student->student_parent->mother_name}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="mother_name">Mobile</label>
                            <input class="form-control" type="text" id="mother_telephone" name="mother_telephone" placeholder="+94123456789" value="{{$student->student_parent->mother_telephone}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="mother_name">E-Mail</label>
                            <input class="form-control" type="text" id="mother_email" name="mother_email" value="{{$student->student_parent->mother_email}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="mother_id_number">ID Number</label>
                            <input class="form-control" type="text" id="mother_id_number" name="mother_id_number" value="{{$student->student_parent->mother_id_number}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="mother_name">Occupation</label>
                            <select class="form-control" id="mother_occupation" name="mother_occupation">
                                @foreach ($occupations as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="mother_name">Name of Employment</label>
                            <input class="form-control" type="text" id="mother_name_of_employment" name="mother_name_of_employment" value="{{$student->student_parent->mother_name_of_employment}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="mother_name">Office Telephone</label>
                            <input class="form-control" type="text" id="mother_office_telephone" name="mother_office_telephone" value="{{$student->student_parent->mother_office_telephone}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="mother_name">Office Address</label>
                            <input class="form-control" type="text" id="mother_address_of_employment" name="mother_address_of_employment" value="{{$student->student_parent->mother_address_of_employment}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="mother_designation_type">Designation Type</label>
                            <select class="form-control" id="mother_designation_type" name="mother_designation_type">
                                <option value="Government" {{$student->student_parent->mother_designation_type=='Government'?'selected':''}}>Government</option>
                                <option value="Private" {{$student->student_parent->mother_designation_type=='Private'?'selected':''}}>Private</option>
                                <option value="Own Business" {{$student->student_parent->mother_designation_type=='Own Business'?'selected':''}}>Own Business</option>
                                <option value="Unemployeed" {{$student->student_parent->mother_designation_type=='Unemployeed'?'selected':''}}>Unemployeed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mother_income_level">Level of Income </label>
                            <select class="form-control" id="mother_income_level" name="mother_income_level">
                                <option value="0-25,000" {{$student->student_parent->mother_income_level=='0-25,000'?'selected':''}}>0-25,000</option>
                                <option value="26,000-50,000" {{$student->student_parent->mother_income_level=='26,000-50,000'?'selected':''}}>26,000-50,000</option>
                                <option value="51,000-75,000" {{$student->student_parent->mother_income_level=='51,000-75,000'?'selected':''}}>51,000-75,000</option>
                                <option value="76,000-100,000" {{$student->student_parent->mother_income_level=='76,000-100,000'?'selected':''}}>76,000-100,000</option>
                                <option value="above 100,000" {{$student->student_parent->mother_income_level=='above 100,000'?'selected':''}}>above 100,000</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mother_education_level">Level of Education</label>
                            <select class="form-control" id="mother_education_level" name="mother_education_level">
                                <option value="O/L" {{$student->student_parent->mother_education_level=='O/L'?'selected':''}}>O/L</option>
                                <option value="A/L" {{$student->student_parent->mother_education_level=='A/L'?'selected':''}}>A/L</option>
                                <option value="Bachelor Degree" {{$student->student_parent->mother_education_level=='Bachelor Degree'?'selected':''}}>Bachelor Degree</option>
                                <option value="Master Degree" {{$student->student_parent->mother_education_level=='Master Degree'?'selected':''}}>Master Degree</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mother_protection_level">Level of Protection</label>
                            <select class="form-control" id="mother_protection_level" name="mother_protection_level">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <h3 style="color:teal">Guardian Info</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="guardian_name">Name</label>
                            <input class="form-control" type="text" id="guardian_name" name="guardian_name" value="{{$student->student_parent->guardian_name}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="guardian_name">Mobile</label>
                            <input class="form-control" type="text" id="guardian_telephone" name="guardian_telephone" placeholder="+94123456789" value="{{$student->student_parent->guardian_telephone}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="guardian_name">E-Mail</label>
                            <input class="form-control" type="text" id="guardian_email" name="guardian_email" value="{{$student->student_parent->guardian_email}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="guardian_id_number">ID Number</label>
                            <input class="form-control" type="text" id="guardian_id_number" name="guardian_id_number" value="{{$student->student_parent->guardian_id_number}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="guardian_relation_to_student">Relation to Student</label>
                            <input class="form-control" type="text" id="guardian_relation_to_student" name="guardian_relation_to_student" value="{{$student->student_parent->guardian_relation_to_student}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="guardian_name">Occupation</label>
                            <select class="form-control" type="text" id="guardian_occupation" name="guardian_occupation">
                                @foreach ($occupations as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="guardian_name">Name of Employment</label>
                            <input class="form-control" type="text" id="guardian_name_of_employment" name="guardian_name_of_employment" value="{{$student->student_parent->guardian_name_of_employment}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="guardian_name">Office Telephone</label>
                            <input class="form-control" type="text" id="guardian_office_telephone" name="guardian_office_telephone" value="{{$student->student_parent->guardian_office_telephone}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="guardian_name">Office Address</label>
                            <input class="form-control" type="text" id="guardian_address_of_employment" name="guardian_address_of_employment" value="{{$student->student_parent->guardian_address_of_employment}}">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="guardian_designation_type">Designation Type</label>
                            <select class="form-control" id="guardian_designation_type" name="guardian_designation_type">
                                <option value="Government" {{$student->student_parent->guardian_designation_type=='Government'?'selected':''}}>Government</option>
                                <option value="Private" {{$student->student_parent->guardian_designation_type=='Private'?'selected':''}}>Private</option>
                                <option value="Own Business" {{$student->student_parent->guardian_designation_type=='Own Business'?'selected':''}}>Own Business</option>
                                <option value="Unemployeed" {{$student->student_parent->guardian_designation_type=='Unemployeed'?'selected':''}}>Unemployeed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="guardian_income_level">Level of Income </label>
                            <select class="form-control" id="guardian_income_level" name="guardian_income_level">
                                <option value="0-25,000" {{$student->student_parent->guardian_income_level=='0-25,000'?'selected':''}}>0-25,000</option>
                                <option value="26,000-50,000" {{$student->student_parent->guardian_income_level=='26,000-50,000'?'selected':''}}>26,000-50,000</option>
                                <option value="51,000-75,000" {{$student->student_parent->guardian_income_level=='51,000-75,000'?'selected':''}}>51,000-75,000</option>
                                <option value="76,000-100,000" {{$student->student_parent->guardian_income_level=='76,000-100,000'?'selected':''}}>76,000-100,000</option>
                                <option value="above 100,000" {{$student->student_parent->guardian_income_level=='above 100,000'?'selected':''}}>above 100,000</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="guardian_education_level">Level of Education</label>
                            <select class="form-control" id="guardian_education_level" name="guardian_education_level">
                                <option value="O/L" {{$student->student_parent->guardian_education_level=='O/L'?'selected':''}}>O/L</option>
                                <option value="A/L" {{$student->student_parent->guardian_education_level=='A/L'?'selected':''}}>A/L</option>
                                <option value="Bachelor Degree" {{$student->student_parent->guardian_education_level=='Bachelor Degree'?'selected':''}}>Bachelor Degree</option>
                                <option value="Master Degree" {{$student->student_parent->guardian_education_level=='Master Degree'?'selected':''}}>Master Degree</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="guardian_protection_level">Level of Protection</label>
                            <select class="form-control" id="guardian_protection_level" name="guardian_protection_level">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
            <hr>
            <h3 style="color:teal">Old Boy/Girl</h3>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="old_student">Old Boy/Girl</label>
                        <select class="form-control" id="old_student" name="old_student">
                            <option value="None" {{$student->student_parent->old_student=='None'?'selected':''}}>None</option>
                            <option value="Father" {{$student->student_parent->old_student=='Father'?'selected':''}}>Father</option>
                            <option value="Mother" {{$student->student_parent->old_student=='Mother'?'selected':''}}>Mother</option>
                            <option value="Guardian" {{$student->student_parent->old_student=='Guardian'?'selected':''}}>Guardian</option>
                        </select>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value="{{$student->student_parent->id}}" />
</form>
