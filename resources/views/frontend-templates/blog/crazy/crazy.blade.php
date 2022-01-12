<?php $news_categories = $categoriesTree[1]['children'];?>



<div id="blog-cat-content-main">

	<h1 class="mb-4">Gallery</h1>

  <div class="row">

  	@if(count($news_categories) > 0)

  		@foreach($news_categories as $row)

          <div class="col-sm-3 blog-content-elements-main image-galley-news">

            <div class="row">

              <div class="col-md-12">

                <div class="blog-media">

                  <a href="<?php echo url("/categories/".$row['slug']);?>"><img class="img-responsive" src="{{ get_image_url($row['img_url']) }}"></a>

                </div>

              </div>

              <div class="col-md-12">

                <div class="blog-text">

                  <p class="blog-title"><a href="<?php echo url("/categories/".$row['slug']);?>">{!! $row['name'] !!}</a></p>

                </div>

              </div>

            </div>

          </div> 

        @endforeach

        @endif   

    </div>

</div>