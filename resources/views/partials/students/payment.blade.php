<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped">
            <tr class="warning">
                <th>ID</th>
                <th>Date</th>
                <th>Description</th>
                <th>Category</th>
                <th>Amount</th>
                <th></th>
            </tr>
            @foreach ($payments as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->amount}}</td>
                    <td>
                        @if ($item->is_canceled)
                            <div class="label label-danger">
                                Canceled
                            </div>
                        @else
                            <form action="{{route('payment.update',$item->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="student_id" value="{{$student->id}}">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-close"></i></button>
                            </form>
                        @endif
                        
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<a href="#" data-toggle="modal" data-target="#payment-modal" class="float"><i class="fa fa-plus btn-float"></i></a>

<form method="POST" action="{{route('payment.store')}}">
    {{ csrf_field() }}
    <div class="modal fade" tabindex="-1" role="dialog" id="payment-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Student Payment</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" id="date" name="date" required class="form-control" placeholder="Date">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="voucher_number">Voucher Book Number</label>
                            <input type="text" id="voucher_number" name="voucher_number" class="form-control" placeholder="Voucher Book Number">
                        </div>
                    </div>                
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" required class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" id="amount" name="amount" required class="form-control" placeholder="Amount">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="payment_category_id">Payment Type</label>
                            <select name="payment_category_id" id="payment_category_id" required class="form-control">
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                        
                </div>                
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="academic_year_id">Academic Year</label>
                            <select id="academic_year_id" name="academic_year_id" class="form-control">
                                @foreach ($academic_years as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="term_id">Term</label>
                            <select id="term_id" name="term_id" class="form-control">
                                @foreach ($terms as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>     
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="exam_id">Exam</label>
                            <select id="exam_id" name="exam_id" class="form-control">
                                <option value="0"></option>
                                @foreach ($exams as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                        
                </div>                   
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    <input type="hidden" name="student_id" value="{{$student->id}}" />
    </form>

