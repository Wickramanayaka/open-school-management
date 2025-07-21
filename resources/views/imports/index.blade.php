@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info">Do not modify, delete, add, or re-arrage the headers on data template. If some data rows failed while uploading, in order to upload them again please use different data template. 
                Do not try to upload the same data again that will duplicate the data. The file extension of the data templete should be *.csv. Follow the below order for data upload, Academic Year > Term > Subject > Class > Student > Teacher
            </div>
        </div>
    </div>
    @include('partials.alert')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
            <form method="POST" action="{{route('import.academic_year')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel-heading">
                    Academic Year Basic Data
                </div>
                <div class="panel-body">
                    <p>Follow the steps to upload grades data.</p>
                    <ul>
                        <li>Click here to download <a href="{{route('import.academic_year')}}">data template</a></li>
                        <li>Follow the instruction in the template</li>
                    </ul>
                    <div class="form-group">
                        <label for="photo">Data Template</label>
                        <input type="file" id="upload_file" name="upload_file" accept=".csv">
                        <p class="help-block">*.csv only</p>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="reset" class="btn btn-default">Clear</button>
                </div>
            </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                    <form method="POST" action="{{route('import.term')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                <div class="panel-heading">
                    Term Basic Data
                </div>
                <div class="panel-body">
                    <p>Follow the steps to upload grades data.</p>
                    <ul>
                        <li>Click here to download <a href="{{route('import.term')}}">data template</a></li>
                        <li>Follow the instruction in the template</li>
                    </ul>
                    <div class="form-group">
                        <label for="photo">Data Template</label>
                        <input type="file" id="upload_file" name="upload_file" accept=".csv">
                        <p class="help-block">*.csv only</p>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="reset" class="btn btn-default">Clear</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-primary">
                        <form method="POST" action="{{route('import.grade')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                    <div class="panel-heading">
                        Class Basic Data
                    </div>
                    <div class="panel-body">
                        <p>Follow the steps to upload grades data.</p>
                        <ul>
                            <li>Click here to download <a href="{{route('import.grade')}}">data template</a></li>
                            <li>Follow the instruction in the template</li>
                        </ul>
                        <div class="form-group">
                            <label for="photo">Data Template</label>
                            <input type="file" id="upload_file" name="upload_file" accept=".csv">
                            <p class="help-block">*.csv only</p>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <button type="reset" class="btn btn-default">Clear</button>
                    </div>
                        </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-primary">
                        <form method="POST" action="{{route('import.subject')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="panel-heading">
                                Subject Basic Data
                            </div>
                            <div class="panel-body">
                                <p>Follow the steps to upload grades data.</p>
                                <ul>
                                    <li>Click here to download <a href="{{route('import.subject')}}">data template</a></li>
                                    <li>Follow the instruction in the template</li>
                                </ul>
                                <div class="form-group">
                                    <label for="photo">Data Template</label>
                                    <input type="file" id="upload_file" name="upload_file" accept=".csv">
                                    <p class="help-block">*.csv only</p>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <button type="reset" class="btn btn-default">Clear</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                    <form method="POST" action="{{route('import.student')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="panel-heading">
                            Students Data
                        </div>
                        <div class="panel-body">
                            <p>Follow the steps to upload student basic data.</p>
                            <ul>
                                <li>Click here to download <a href="{{route('import.student')}}">data template</a></li>
                                <li>Follow the instruction in the template</li>
                            </ul>
                            <div class="form-group">
                                <label for="photo">Data Template</label>
                                <input type="file" id="upload_file" name="upload_file" accept=".csv">
                                <p class="help-block">*.csv only</p>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button type="reset" class="btn btn-default">Clear</button>
                        </div>
                    </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                    <form method="POST" action="{{route('import.teacher')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                <div class="panel-heading">
                    Teachers Data
                </div>
                <div class="panel-body">
                    <p>Follow the steps to upload teacher basic data.</p>
                    <ul>
                        <li>Click here to download <a href="{{route('import.teacher')}}">data template</a></li>
                        <li>Follow the instruction in the template</li>
                    </ul>
                    <div class="form-group">
                        <label for="photo">Data Template</label>
                        <input type="file" id="upload_file" name="upload_file" accept=".csv">
                        <p class="help-block">*.csv only</p>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="reset" class="btn btn-default">Clear</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                    <form method="POST" action="{{route('import.parents')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="panel-heading">
                            Parents Data
                        </div>
                        <div class="panel-body">
                            <p>Follow the steps to upload student basic data.</p>
                            <ul>
                                <li>Click here to download <a href="{{route('import.parents')}}">data template</a></li>
                                <li>Follow the instruction in the template</li>
                            </ul>
                            <div class="form-group">
                                <label for="photo">Data Template</label>
                                <input type="file" id="upload_file" name="upload_file" accept=".csv">
                                <p class="help-block">*.csv only</p>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button type="reset" class="btn btn-default">Clear</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
        {{--
        <div class="col-lg-6">
            <div class="panel panel-primary">
                    <form method="POST" action="{{route('import.siblin')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                <div class="panel-heading">
                    Siblins Data
                </div>
                <div class="panel-body">
                    <p>Follow the steps to upload teacher basic data.</p>
                    <ul>
                        <li>Click here to download <a href="{{route('import.siblin')}}">data template</a></li>
                        <li>Follow the instruction in the template</li>
                    </ul>
                    <div class="form-group">
                        <label for="photo">Data Template</label>
                        <input type="file" id="upload_file" name="upload_file" accept=".csv">
                        <p class="help-block">*.csv only</p>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="reset" class="btn btn-default">Clear</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                    <form method="POST" action="{{route('import.emergencyContact')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                <div class="panel-heading">
                    Emegency Contact Data
                </div>
                <div class="panel-body">
                    <p>Follow the steps to upload teacher basic data.</p>
                    <ul>
                        <li>Click here to download <a href="{{route('import.emergencyContact')}}">data template</a></li>
                        <li>Follow the instruction in the template</li>
                    </ul>
                    <div class="form-group">
                        <label for="photo">Data Template</label>
                        <input type="file" id="upload_file" name="upload_file" accept=".csv">
                        <p class="help-block">*.csv only</p>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="reset" class="btn btn-default">Clear</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
    --}}
    
@endsection