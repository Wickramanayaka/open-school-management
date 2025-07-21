@extends('student_web.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12 text-center">
                <div class="card" style="width: 36rem;">
                    <img class="card-img-top" src="{{asset('images/thank_you.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                      <h3 class="card-title">Card payment was success</h3>
                        <p class="card-text">
                            Your card payment was success, please click on the below button to login.
                        </p>
                      <a href="{{url('/t')}}" class="btn btn-primary">Go to Login</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection