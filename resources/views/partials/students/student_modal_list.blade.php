<div class="modal fade" tabindex="-1" role="dialog" id="student-modal-list">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Student List</h3>
        </div>
        <div class="modal-body">
            <table class="table table-compact">
                <thead>
                    <tr>
                        <th>Admission Number</th>
                        <th>Name</th>
                        <th>Class Room</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student_list as $student)
                        <tr>
                            <td>{{$student->admission_number}}</td>
                            <td>{{$student->fullName}}</td>
                            <td>{{$student->present_class_room->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>