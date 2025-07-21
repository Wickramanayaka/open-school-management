<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exam Marks Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
        <div class="row align-items-start">
          <div class="col p-2">
            <a href="{{url('/m/')}}" type="button" class="btn btn-outline-primary mb-3">Go Back</a>
            <h3>Exam Marks Form</h3>
            <p class="text-secondary">Welcome to the new exam mark entering page. <br>For better experience use <a href="https://www.google.com/chrome/">Google Chrome</a> browser with your mobile phone. Make sure you have a good Internet connection  &#9889; .</p>
            <form class="row g-3 pt-3" method="POST" action="{{url('m/examMark/store')}}">
                <div class="col-md-4">
                  <label for="inputState" class="form-label">Exam: {{$exam->name}}</label><br>
                  <label for="inputState" class="form-label">Class Room: {{$class_room->name}}</label><br>
                  <label for="inputState" class="form-label">Subject: {{$subject->grade->name}} - {{$subject->name}}</label>
                </div>
                @foreach ($students as $item)
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">{{$item->admission_number}} - {{$item->full_name}}</label>
                        <input type="text" class="form-control" id="{{$item->id}}" name="marks[{{$item->id}}]" value="{{$item->mark==null? "" : ($item->mark->is_absent==1? "AB" : $item->mark->mark)}}">
                    </div>
                @endforeach
                <div class="d-grid gap-2 d-md-block">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="exam" value="{{ $exam->id }}">
                    <input type="hidden" name="class_room" value="{{ $class_room->id }}">
                    <input type="hidden" name="subject" value="{{ $subject->id }}">
                    <button type="submit" class="btn btn-primary" type="button">Save the change</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>