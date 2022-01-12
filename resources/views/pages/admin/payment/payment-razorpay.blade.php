@extends('layouts.admin.master')
@section('title', trans('admin.update_razorpay_payment') .' < '. get_site_title())

@section('content')
@if(count($payment_method_data) > 0)

@include('pages-message.notify-msg-success')

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  @include('includes.csrf-token')
  <input type="hidden" name="_payment_method_type" value="razorpay">
  
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">{{ trans('admin.razorpay') }}</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-primary pull-right btn" type="submit">{{ trans('admin.update') }}</button>
      </div>
    </div>
  </div>
  
 <div class="box box-solid">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          
          <div class="form-group">
            <div class="row">  
              <div class="col-sm-5">
                {{ trans('admin.enable_disable') }}
              </div>
              <div class="col-sm-7">
                @if($payment_method_data['razorpay']['enable_option'] == 'yes')
                <input type="checkbox" checked="checked" class="shopist-iCheck" name="inputEnablePaymentRazorpayMethod" id="inputEnablePaymentRazorpayMethod">  {!! trans('admin.enable_razorpay') !!}
                @else
                <input type="checkbox" class="shopist-iCheck" name="inputEnablePaymentRazorpayMethod" id="inputEnablePaymentRazorpayMethod"> {!! trans('admin.enable_razorpay') !!}
                @endif
              </div>
            </div>    
          </div>
            
          <div class="form-group">
            <div class="row">  
              <div class="col-sm-5">
                {{ trans('admin.method_title') }}
              </div>
              <div class="col-sm-7">
                <input type="text" placeholder="{{ trans('admin.title') }}" class="form-control" name="inputRazorpayTitle" id="inputRazorpayTitle" value="{{ $payment_method_data['razorpay']['method_title'] }}">
              </div>
            </div>    
          </div>
          
          <div class="form-group">
            <div class="row">  
              <div class="col-sm-5">
                {{ trans('admin.razorpay_app_client_id') }}
              </div>
              <div class="col-sm-7">
                <input type="text" placeholder="{{ trans('admin.razorpay_app_client_id') }}" class="form-control" name="inputRazorpayClientId" id="inputRazorpayClientId" value="{{ $payment_method_data['razorpay']['razorpay_client_id'] }}">
              </div>
            </div>    
          </div>
          
          <div class="form-group">
            <div class="row">  
              <div class="col-sm-5">
                {{ trans('admin.razorpay_app_secret') }}
              </div>
              <div class="col-sm-7">
                <input type="text" placeholder="{{ trans('admin.razorpay_app_secret') }}" class="form-control" name="inputRazorpaySecret" id="inputRazorpaySecret" value="{{ $payment_method_data['razorpay']['razorpay_secret'] }}">
              </div>
            </div>    
          </div>
          
          <div class="form-group">
            <div class="row">  
              <div class="col-sm-5">
                {{ trans('admin.enable_disable_razorpay_sandbox') }}
              </div>
              <div class="col-sm-7">
                @if($payment_method_data['razorpay']['razorpay_sandbox_enable_option'] == 'yes')
                <input type="checkbox" checked="checked" class="shopist-iCheck" name="inputEnableRazorpaySandboxOption" id="inputEnableRazorpaySandboxOption">  {{ trans('admin.enable_razorpay_sandbox') }}
                @else
                <input type="checkbox" class="shopist-iCheck" name="inputEnableRazorpaySandboxOption" id="inputEnableRazorpaySandboxOption">  {{ trans('admin.enable_razorpay_sandbox') }}
                @endif
              </div>
            </div>    
          </div>
            
          <div class="form-group">
            <div class="row">  
              <div class="col-sm-5">
                {{ trans('admin.method_description') }}
              </div>
              <div class="col-sm-7">
                  <textarea id="inputRazorpayDescription" name="inputRazorpayDescription" placeholder="{{ trans('admin.method_description') }}" class="form-control">{{ $payment_method_data['razorpay']['method_description'] }}</textarea>
              </div>
            </div>    
          </div>
            
        </div>
      </div>  
    </div>
  </div>
</form>

@endif
@endsection