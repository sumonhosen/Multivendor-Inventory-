@extends('layouts.frontend.master')
@section('title', 'Distributor Login' .' - '. get_site_title())
@section('content')

<div class="container custom-extra-top-style">  
  <div class="row justify-content-center">
    <div class="col-md-6 text-center">
      <div class="panel panel-login">
        <div class="panel-heading">
          <div class="row justify-content-center">
            <div class="col-xs-12 text-center">
              <h3>Mobile Number Verification</h3>
            </div>
          </div>
          <hr>
        </div>
        <div class="panel-body">
          @include('pages-message.notify-msg-error')
          @include('pages-message.form-submit')
          <form method="post" action="{{route('distributor-login-post')}}" enctype="multipart/form-data">
            @include('includes.csrf-token')

            <input name="login_username" id="login_username" tabindex="1" class="form-control" placeholder="Unique ID" value="{{ Session::get('login_username')}}" type="hidden">

            <input name="login_password" id="login_password" tabindex="2" class="form-control" placeholder="Password" value="{{ Session::get('login_password')}}" type="hidden">


            <div class="form-group has-feedback">
              <input name="otp" id="otp" tabindex="3" class="form-control" placeholder="Please enter otp here" value="" type="text">
              <span class="fa fa-user form-control-feedback"></span>
            </div>

          
            <!-- @if($frontend_login_data['is_enable_recaptcha'] == true)
            <div class="form-group">
              <div class="captcha-style">{!! app('captcha')->display(); !!}</div>
              <div class="captcha-style"><div data-sitekey="6LcSmakaAAAAAE6rrQjGJauOXeQrn0qYY6tK7dDc" class="g-recaptcha"></div></div>
            </div>
            @endif -->

            <div class="form-group text-center">
              @if (Cookie::has('frontend_remember_me_data'))
              <input tabindex="3" class="shopist-iCheck" name="login_remember_me" id="login_remember_me" type="checkbox" checked>
              <label for="remember"> {{ trans('frontend.remember_me') }}</label>
              @else
              <input tabindex="3" class="shopist-iCheck" name="login_remember_me" id="login_remember_me" type="checkbox">
              <label for="remember"> {{ trans('frontend.remember_me') }}</label>
              @endif  
            </div>

            <div class="form-group">
              <div class="row justify-content-center">
                <div class="col-sm-6 text-center">
                  <input name="login_submit" id="login_submit" tabindex="4" class="form-control btn btn-secondary" value="Validate" type="submit">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-lg-12">
                  <div class="text-center">
                    <a href="{{ route('user-forgot-password-page') }}" tabindex="5" class="forgot-password">{{ trans('frontend.forgot_password') }}</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    @if($settings_data['general_options']['allow_registration_for_frontend'])
                    <a href="{{ route('vendor-registration-page') }}" tabindex="5" class="register-new-user">Register as a new distributor</a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>  
@endsection