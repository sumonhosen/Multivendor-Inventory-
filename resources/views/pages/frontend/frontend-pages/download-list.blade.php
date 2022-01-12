@extends('layouts.frontend.master')
@section('title', 'Download List' .' < '. get_site_title() )

@section('content')
<div id="testimonial_details" class="container new-container">
	<h1>Downloads</h1>
	
	<div class="row">
	@if(count($download_data) > 0)
		@foreach($download_data as $row)
					<div class="col-sm-6">
				<div class="download-item-wrap">
					<div class="item-details">
						<ul>
							<li><a class="download-item" href="{{ get_image_url($row->brand_logo_img_url) }}" target="_blank"><img alt="" src="{{ url('/public/images/pdf.png') }}"></a></li>
							<li>
								<h4>
									<a href="{{ get_image_url($row->brand_logo_img_url) }}" target="_blank">{!! $row->name !!}</a>
								</h4>
                                <a class="download-btn" href="{{ get_image_url($row->brand_logo_img_url) }}" target="_blank">Download</a>
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