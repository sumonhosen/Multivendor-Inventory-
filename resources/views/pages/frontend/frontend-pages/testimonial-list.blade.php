@extends('layouts.frontend.master')
@section('title', trans('frontend.testimonials_details_page_title') .' < '. get_site_title() )

@section('content')
<div id="testimonial_details" class="container new-container">
	<h1>Testimonials</h1>
	<div class="row">
	@if(count($testimonials_data) > 0)
		@foreach($testimonials_data as $row)
		<div class="col-sm-6">
			<div class="download-item-wrap">
				<div class="item-details">
					<ul>
						<li>
						@if($row->testimonial_image_url)
							<img alt="" src="{{ get_image_url($row->testimonial_image_url) }}">
						@else
	                      	<img src="{{ default_placeholder_img_src() }}" alt="">
	                      @endif
						</li>
						<li>
							<h4>{!! $row->post_title !!}</h4>
							<p>{!! get_limit_string(string_decode($row->post_content), 200) !!}</p>
			                <a class="btn btn-sm testimonials-read" href="{{ route('testimonial-single-page', $row->post_slug)}}">View More</a>
						</li>
						
					</ul>
				</div>
				<div class="clearfix">&nbsp;</div>
			</div>
		</div>
		@endforeach
	@endif
	</div>
</div>
@endsection  