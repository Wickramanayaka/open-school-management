@extends('student_web.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            @php
                $merchantPgIdentifier = config('app.merchantPgIdentifier');
                $currency = config('app.currency');
                $paymentMethod = config('app.paymentMethod');
                $secretCode = config('app.secretCode');
                $storeName = config('app.storeName');
                $url = config('app.url');
                $transactionType = 'SALE';
                $language = 'en';
                $successUrl = config('app.successUrl');
                $errorUrl = config('app.errorUrl');
                $now = date('Y-m-d H:i:s');
                $amount = $payment->amount;
                $id = $payment->id;
                $invoice = config('app.prefix').$id;
                $token = $storeName.$currency.$secretCode.$now.$amount.$invoice;
                $token = hash('sha256', $token);
            @endphp
            <h3>This is a paid service. You have to pay <u><span style="color: red">Rs. {{$amount}}</span></u> in order to use this service.</h3>
            <h3>Pay by Genie</h3>
            <img src="{{asset('images/Genie_Final_LOGO_EPS.JPG')}}" alt="Genie logo" width="150">
            <hr>
            <form id="ext-merchant-frm" name="ext-merchant-frm" action="{{$url}}" method="post" accept-charset="UTF-8"
                enctype="application/x-www-form-urlencoded">
                <input type="hidden" id="merchantPgIdentifier" name="merchantPgIdentifier" value="{{$merchantPgIdentifier}}">
                <input type="hidden" id="chargeTotal" name="chargeTotal" value="{{$amount}}" readonly>
                <input type="hidden" id="currency" name="currency" value="{{$currency}}">
                <input type="hidden" id="paymentMethod" name="paymentMethod" value="Genie">
                <input type="hidden" id="orderId" name="orderId" value="{{$id}}">
                <input type="hidden" id="invoiceNumber" name="invoiceNumber" value="{{$invoice}}">
                <input type="hidden" id="successUrl" name="successUrl" value="{{$successUrl}}">
                <input type="hidden" id="errorUrl" name="errorUrl" value="{{$errorUrl}}">
                <input type="hidden" id="storeName" name="storeName" value="{{$storeName}}">
                <input type="hidden" id="transactionType" name="transactionType" value="{{$transactionType}}">
                <input type="hidden" id="timeout" name="timeout" value="">
                <input type="hidden" id="transactionDateTime" name="transactionDateTime" value="{{$now}}">
                <input type="hidden" id="language" name="language" value="{{$language}}">
                <input type="hidden" id="txnToken" name="txnToken" value="{{$token}}">
                <input type="hidden" id="itemList" name="itemList" value=""> <!--added new-->
                <input type="hidden" id="otherInfo" name="otherInfo" value="">
                <input type="hidden" id="merchantCustomerPhone" name="merchantCustomerPhone" value="">
                <input type="hidden" id="merchantCustomerEmail" name="merchantCustomerEmail" value="">
                <input type="hidden" id="disableWebCheckoutQr" name="disableWebCheckoutQr" value="">
                <input type="hidden" id="disableWebCheckoutGuest" name="disableWebCheckoutGuest" value="">
                <input type="hidden" id="disableWebCheckoutSignIn" name="disableWebCheckoutSignIn" value="">
                <input type="submit" class="btn btn-danger" value="Pay with Genie">
            </form>
        </div>
    </div>
</div>
@endSection
@section('javascript')
    <script>
        // window.onload = function(){
        //    document.getElementById("ext-merchant-frm").submit();
        // }
    </script>
@endsection