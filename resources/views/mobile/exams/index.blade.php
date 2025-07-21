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
            <a href="{{url('/home')}}" type="button" class="btn btn-outline-primary mb-3">Go Back</a>
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
            @endif
            @if(Session::has('error'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
            @endif
            <h3>Exam Marks Form</h3>
            <p class="text-secondary">Welcome to the new exam mark entering page. <br>For better experience use <a href="https://www.google.com/chrome/">Google Chrome</a> browser with your mobile phone. Make sure you have a good Internet connection  &#9889; .</p>
            <form class="row g-3 pt-3" method="POST" action="{{url('m/examMark/create')}}">
                <div class="col-md-4">
                  <label for="inputState" class="form-label">What is the Exam?</label>
                  <select id="inputState" class="form-select" name="exam">
                    @foreach ($exams as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">What is the class room?</label>
                    <select id="inputState" class="form-select" name="class_room">
                        @foreach ($class_rooms as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">What is the subject?</label>
                    <select id="inputState" class="form-select" name="subject">
                        @foreach ($subjects as $item)
                        <option value="{{$item->id}}">{{$item->grade->name}} - {{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">What is the gender?</label>
                    <select id="inputState" class="form-select" name="gender">
                        <option value="all">All</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary" type="button">OK</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid mt-2">
        <div class="row align-items-start">
            <div class="card">
                <img src="{{asset('images/adv.jpg')}}" class="card-img-top" alt="Class room app advertistment">
                <div class="card-body">
                  <h5 class="card-title">Parents APP</h5>
                  {{-- <p class="card-text">The 1st in Sri Lanka, the cutting edge Android app for teachers to make their work easier. </p> --}}
                  <a href="https://wa.me/+94779751735" class="btn btn-success">WhatsApp us now</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        // Function to detect mobile devices
        function isMobileDevice() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }
        // Check if it's not a mobile device
        if (!isMobileDevice()) {
            // Show a warning message and redirect to homepage
            alert("Warning: This application is best viewed on a mobile device.");
            window.location.href = "/home"; 
        }
    </script>
    </body>
</html>