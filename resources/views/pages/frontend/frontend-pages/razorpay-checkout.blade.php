@extends('layouts.frontend.master')
@section('title', trans('frontend.shopist_checkout') .' < '. get_site_title() )

@section('content')
  <div id="razorpay_checkout_page" class="container">
      @if(Session::has('razorpayAmount'))
        <!-- <form action="http://localhost/vyrazu/shopist/checkout" method="POST" style="margin-top: 70px;"> -->
        {!! Form::open(['route' => 'razorpay-checkout-button', 'class' => 'form-control']) !!}
        {{ csrf_field() }}
          <script src="https://checkout.razorpay.com/v1/checkout.js"
              data-key="rzp_live_yzVMrPJMZ22phj"
              data-amount="{{ Session::get('razorpayAmount') }}"
              data-currency="INR"
              data-order_id="{{ Session::get('razorpayOrderId') }}"
              data-buttontext="Pay with Razorpay"
              data-name="ceyone"
              data-description="Cart payment"
              data-image="https://ceyone.co.in/public/images/shopist-icon.png"
              data-prefill.name="{{ Session::get('razorpayName') }}"
              data-prefill.email="{{ Session::get('razorpayEmail') }}"
              data-prefill.contact="{{ Session::get('razorpayContact') }}"
              data-theme.color="#F37254"
              data-callback_url="https://ceyone.co.in/rsuccess.php"
              data-redirect=true
          ></script>
          <input type="hidden" custom="Hidden Element" name="hidden"> 
        {!! Form::close() !!}
      @endif
  </div>
@endsection