@extends('student_web.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12 text-center">
                <div class="card" style="width: 36rem;">
                    <img class="card-img-top" src="{{asset('images/ipg_error.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                      <h3 class="card-title"><b>Card payment error</b></h3>
                        <p class="card-text">
                            Yor card payment didn't go well, please click on the below button to try again. 
                          </p>
                      <a href="{{url('/t')}}" class="btn btn-primary">Try again</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection