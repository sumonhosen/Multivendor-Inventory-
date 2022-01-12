@extends('layouts.frontend.master')
@section('title',  trans('frontend.cat_post_label') .' < '. get_site_title() )
@section('content')
<br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" />
<script>
  $(document).on("click", '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
  
});
</script>
<div class="container new-container">

  <div id="blog-cat-content-main">  
	<h1>{!! $cat_details->name !!}</h1>
    <div class="row">
        @if(count($blogs_cat_post['posts']) > 0)  

          @foreach($blogs_cat_post['posts'] as $row)

          <?php $total = get_comments_rating_details($row->id, 'blog');?>

          <div class="col-sm-3 blog-content-elements-main">

            <div class="row">

              <div class="col-md-12">

                <div class="blog-media">

                  @if(get_blog_postmeta_data($row->id, 'featured_image'))
                  <?php if($cat_details->parent==10){?>
                  <a href="{{ get_image_url(get_blog_postmeta_data($row->id, 'featured_image')) }}"  data-toggle="lightbox" data-gallery="gallery"><?php }?>
                  <img class="img-responsive" src="{{ get_image_url(get_blog_postmeta_data($row->id, 'featured_image')) }}" alt="{{ basename(get_blog_postmeta_data($row->id, 'featured_image')) }}">
                  <?php if($cat_details->parent==10){?></a><?php }?>
                  @else

                  <img class="img-responsive" src="{{ default_placeholder_img_src() }}"  alt=""> 

                  @endif

                </div>

              </div>


			@if($cat_details->parent!=10)
              <div class="col-md-12">

                <div class="blog-text">

                  <!-- <p>

                    <span class="blog-date"><i class="fa fa-calendar"></i>&nbsp;{{ Carbon\Carbon::parse($row->created_at)->format('d F, Y') }}</span> &nbsp;&nbsp;

                    <span class="blog-comments"> <i class="fa fa-comment"></i>&nbsp; {!! $total['total'] !!} {!! trans('frontend.comments_label') !!}</span>

                  </p> -->

                  <p class="blog-title">{!! $row->post_title !!}</p>

                  <p class="blog-description">

                    {!! get_limit_string(string_decode($row->post_content), get_blog_postmeta_data($row->id, 'allow_max_number_characters_at_frontend')) !!}

                  </p>

                  <!-- <div class="btn-read-more"><a class="btn btn-block btn-default" href="{{ route('blog-single-page', $row->post_slug)}}">{!! trans('frontend.read_more_label') !!}</a></div> -->

                </div>

              </div>
			@endif
            </div>

          </div>

          @endforeach

        @else

          <p>{!! trans('frontend.no_post_blog_cat_yet_label') !!}</p>

        @endif

      <!--<div class="products-pagination">{!! $blogs_cat_post['posts']->appends(Request::capture()->except('page'))->render() !!}</div>-->  

    </div>

  </div>  

</div>    

@endsection