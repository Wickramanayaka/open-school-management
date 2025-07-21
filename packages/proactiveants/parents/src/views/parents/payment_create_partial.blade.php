<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New payment</h4>
      </div>
      <div class="modal-body">
          <table class="table table-bordered">
            <tr>
                <th class="col-md-3">Full Name</th>
                <td id="modal_name"></td>
            </tr>
            <tr>
                <th>Telephone</th>
                <td id="modal_telephone"></td>
            </tr>
            <tr>
                <th>Purchase Date</th>
                <td id="modal_p_date"></td>
            </tr>
            <tr>
                <th>Expiry Date</th>
                <td id="modal_e_date"></td>
            </tr>
            <tr>
                <th>Amount</th>
                <td id="modal_amount"></td>
            </tr>
          </table>
        <form class="form-horizontal" method="POST" action="{{route('parents.payment.store')}}">
            {{ csrf_field() }}
            <p>Are you sure want to make a payment?</p>
            <input type="hidden" name="modal_user_id" id="modal_user_id">
            <button type="submit" class="btn btn-primary">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>