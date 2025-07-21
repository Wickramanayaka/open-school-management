@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form class="form-inline">
                        <div class="form-group">
                          <label for="exampleInputName2">Grade &nbsp; </label>
                          <select class="form-control" id="grade" name="grade">
                                <option value="0">Choose a grade</option>
                                @foreach ($grades as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                          </select>
                        </div>
                        <div class="form-group" style="margin-left: 20px; margin-right:20px;">
                          <label for="exampleInputEmail2">Subject &nbsp; </label>
                          <select class="form-control" id="subject" name="subject">
                                <option value="0">Choose a subject</option>
                          </select>
                        </div>
                        <button type="button" onclick="getData()" class="btn btn-primary">Get Data</button>
                    </form>
                </div>
                <div class="panel-body" id="data">
                                          
                </div>
            </div>
        </div>
    </div>  
@endsection
@section('javascript')
<script>
function getData(){
    $.get('{{url('/videos/get')}}?grade=' + $('#grade').val() + '&subject=' + $('#subject').val(), function(result){
        $('#data').html(result);
    });
}
$("#grade").on('change', function(){
    $('#subject').html('');
    $.get('{{url('/videos/grade')}}/' + $("#grade").val(), function(result){
        result.forEach(element => {
            $('#subject').append(`<option value='${element.id}'>${element.name}</option>`);
        });
    });
});
function save(){
    $.post('{{url('videos/store')}}',
    {
        'number' : $('#number').val(),
        'name' : $('#vname').val(),
        'url' : $('#url').val(),
        'grade' : $('#grade').val(),
        'subject' : $('#subject').val()
    }
    ,function(result){
        getData();
    })
}
function vDelete(id){
    var x = confirm("Are you sure to delete?");
    if(x==1){
        $.get('{{url("/videos/delete")}}/' + id, function(result){
            getData();
        });
    }
}
</script>
@endsection