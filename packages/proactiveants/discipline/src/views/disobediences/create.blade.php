@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">New Disobedience</div>
                <div class="panel-body">
                    @include('partials.alert')
                    <form method="POST" action="{{ url('discipline/disobedience/') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea id="description" type="text" class="form-control" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="disobedience_category_id" class="control-label">Category</label>
                                    <select name="disobedience_category_id" id="disobedience_category_id" class="form-control">
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>       
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    $('.select2').select2();
});
</script>
@endsection
