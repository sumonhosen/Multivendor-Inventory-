@extends('layouts.frontend.master')

@section('title', 'Registration' .' - '. get_site_title())
@section('content')

@if($settings_data['general_options']['allow_registration_for_frontend'])
<div class="container custom-extra-top-style">
  <div class="row justify-content-center">
    <div class="col-md-12 text-center registration-home">
        
                <div class="user-login-content">
                  <div class="login-information clearfix">


                        <div class="login-content-sub">
                            <h3>Become a Ceyone <br><span>Customer</span></h3>
                            <!-- <h3 class="page-subheading">Already registered?</h3> -->
                            <div class="form_content">
                              <p>Register yourself with Ceyone as a Customer</p>
                              <!-- <p>If you have account, please click the link to signin as a user.</p> -->
                              <a class="btn btn-secondary custom-button-login-signup" href="<?php echo url("/user/registration");?>">Register as Customer</a>
                            </div>
                        </div>

                        <div class="login-register-divider"><span>OR</span></div>  

                      <div class="login-content-sub">
                          <h3>Become a Ceyone <br><span>Distributor</span></h3>
                          <!-- <h3 class="page-subheading">Create an account</h3> -->
                          <div class="form_content">
                            <p>Register yourself with Ceyone as a Distributor</p>
                            <!-- <p>If you have no account, please click the link to create an account.</p> -->
                            <a class="btn btn-secondary custom-button-login-signup" href="<?php echo url("/vendor/registration");?>">Register as Distributor</a>
                          </div>
                      </div>
                    
                  </div>  
                </div>
      
    </div>
  </div>
</div>  
@else
<br>
<p>{{ trans('frontend.user_reg_not_available_label') }}</p>
@endif
@endsection  