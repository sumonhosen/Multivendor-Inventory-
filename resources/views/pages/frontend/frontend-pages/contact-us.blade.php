@extends('layouts.frontend.master')
@section('title', 'Contact Us < '. get_site_title() )
@section('content')
<div id="custom_single_page" class="custom_single_page">
<div class="container">
	<h1>Contact Us</h1>
	<div class="row">
		<div class="col-sm-6">
			<h4>Customer Care Number</h4>
	<p><span>For All Regions - 033 40631211</span></p>
	<h4>Ceyone Head Office Addresses</h4>
	<p><i class="fa fa-map-marker">&nbsp;</i>&nbsp;2nd Floor, Triti Apartment, 100 Manohar Pukur Road, <br/>Kolkata-700029, West Bengal, India</p>
	<p><i class="fa fa-phone">&nbsp;</i> Phone: 033 40631211</p>
	<p><i class="fa fa-envelope">&nbsp;</i> Email: <a href="mailto:info@mjo.com">info@ceyone.co.in</a></p>
	<p><i class="fa fa-globe">&nbsp;</i> Web: <a href="http://www.ceyone.co.in" target="_blank">www.ceyone.co.in</a></p>
	<p><strong>Branch Ofice (Imphal)</strong><br>Nagamapal Lamabam Leikai<br>Opp Magic Parking, Imphal: Manipur-795004<br>Phone: 0385 2410314</p>
	<p><strong>Branch Office (Guwahati)</strong><br>13 Nilomani Phokan Path<br>Sree Nagar, Guwahati, Assam 781006<br>Contact No.7002803190</p>
		</div>
		<div class="col-sm-6">
		   <!--  <form action="" method="post"> -->
			<form name="comment_form" id="comment_form" onsubmit="return validateForm()" action="<?php echo url('contact-send-mail')?>" method="post">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    <div class="form-group">
				<label>Name</label>	
				<input type="text" name="full_name" class="form-control" value="" required="required">
			</div>
			<div class="form-group">
				<label>E-mail Address</label>	
				<input type="email" name="customer_email" class="form-control" value="" required="required">
			</div>
			<div class="form-group">
				<label>Mobile</label>	
				<input type="tel" name="mobile" class="form-control" value="" required="required">
			</div>
			<div class="form-group">
				<label>Message</label>	
				<textarea cols="5" rows="3" class="form-control" name="message"></textarea>
			</div>
			
           <div class="g-recaptcha" data-sitekey="6Lc55iQbAAAAAHpHvmT89FICQZBwQIwBF1aAhRew"></div>
           <br/>
            
			
			<!-- <a  class="btn btn-primary" style="color:#fff !important">Submit</a> -->
			<button type="submit" class="btn btn-primary">Submit</button>
		    </form>
		</div>
	</div>
<br>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14742.409399436052!2d88.350182!3d22.519098!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4e8a255b4822cba3!2sCeyone%20Nutri%20India%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1610722061894!5m2!1sen!2sin" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" width="100%" height="250" frameborder="0"></iframe>
</div>
</div>
@endsection  