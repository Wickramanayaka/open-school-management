<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Emergency Contact
                <span class="pull-right"><a href="#" data-toggle="modal" data-target="#emergency-modal"><i class="fa fa-edit fa-fw"></i> Edit</a></span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-no-border">
                            <tr><td>Name:</td><td>{{$student->emergency_contact->name}}</td></tr>
                            <tr><td>Address:</td><td>{{$student->emergency_contact->address}}</td></tr>
                            <tr><td>Telephone:</td><td>{{$student->emergency_contact->telephone}}</td></tr>
                            <tr><td>Relation to student:</td><td>{{$student->emergency_contact->relationship}}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="{{route('emergencyContact.update',$student->emergency_contact->id)}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}    
    <div class="modal fade" id="emergency-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Emergency Contact</h4>
            </div>
            <div class="modal-body">
                <h3>Father Info</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                        <input class="form-control" type="text" id="name" name="name" value="{{$student->emergency_contact->name}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input class="form-control" type="text" id="telephone" name="telephone" value="{{$student->emergency_contact->telephone}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" type="text" id="address" name="address" required>{{$student->emergency_contact->address}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="relationship">Relation to student</label>
                            <input class="form-control" type="text" id="relationship" name="relationship" value="{{$student->emergency_contact->relationship}}" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="student_id" value="{{$student->id}}">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
</form>
