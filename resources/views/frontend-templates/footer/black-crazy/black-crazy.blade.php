<div class="footer-top full-width">
  <div class="footer-top-background">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5">
          <h3 class="widget-title">{!! trans('frontend.footer_about_us') !!}</h3>
          <div class="is-divider small"></div>
          <!-- <div class="footer-desc">{!! $appearance_all_data['footer_details']['footer_about_us_description'] !!}</div> -->
          <div class="footer-desc">Ceyone Nutri India Private Limited is an excellent platform for self-determined professionals who seek to discover new highs in entrepreneurial.. 
            <a href="<?php echo url("/page/about");?>" class="footer-read-more">read more</a></div>
         
          <h3 class="widget-title">{!! trans('frontend.footer_follow_us') !!}</h3>
          <div class="is-divider small"></div>
          <ul class="social-media">
            <li><a class="facebook" href="https://www.facebook.com/ceyonenutriindia/" target="_blank" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.fb_tooltip_msg') }}"><i class="fa fa-facebook"></i></a></li>
            <!-- <li><a class="twitter" href="//{{ $appearance_all_data['footer_details']['follow_us_url']['twitter'] }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.twitter_tooltip_msg') }}"><i class="fa fa-twitter"></i></a></li> -->
            <!-- <li><a class="youtube-play" href="//{{ $appearance_all_data['footer_details']['follow_us_url']['youtube'] }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.youtube_play_tooltip_msg') }}"><i class="fa fa-youtube-play"></i></a></li> -->
            <li><a class="linkedin" href="https://www.linkedin.com/company/ceyone-nutri-india-pvt-ltd"  target="_blank" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.linkedin_tooltip_msg') }}"><i class="fa fa-linkedin"></i></a></li>
            <!-- <li><a class="dribbble" href="//{{ $appearance_all_data['footer_details']['follow_us_url']['dribbble'] }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.dribbble_tooltip_msg') }}"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="google-plus" href="//{{ $appearance_all_data['footer_details']['follow_us_url']['google_plus'] }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.google_plus_tooltip_msg') }}"><i class="fa fa-google-plus"></i></a></li>-->
            <li><a class="instagram" href="https://instagram.com/ceyone_official?igshid=1ga4vcwuk2m2i"  target="_blank" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.instagram_tooltip_msg') }}"><i class="fa fa-instagram"></i></a></li> 
            
          </ul>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-2">
          <h3 class="widget-title">Account</h3>
          <div class="is-divider small"></div>
          <div class="latest-footer-blogs">
            <ul>
              <li><a href="<?php echo url("/user/account/my-saved-items");?>">Wishlist</a></li>
              <!-- <li><a href="#">Your Cart</a></li> -->
              <li><a href="<?php echo url("/checkout");?>">Checkout</a></li>
              <li><a href="<?php echo url("/user/login");?>">Login</a></li>
            </ul>
          </div>
        </div>
        

        <div class="col-xs-12 col-sm-12 col-md-2">
          <h3 class="widget-title">Information</h3>
          <div class="is-divider small"></div>
          <div class="latest-footer-blogs">
            <ul>
              <!-- <li><a href="#">FAQ's</a></li> -->
              <li><a href="<?php echo url("/page/sitemap");?>">Sitemap</a></li>
              <li><a href="<?php echo url("/page/privacy-policy");?>">Privacy Policy</a></li>
              <li><a href="<?php echo url("/page/terms-and-conditions");?>">Terms of Use</a></li>
              <li><a href="<?php echo url("/page/return-policy");?>">Return Policy</a></li>
              <li><a href="<?php echo url("/page/shipping-and-pickup");?>">Shipping and Pickup</a></li>
              <li><a href="<?php echo url("/page/refund-cancellation");?>">Refund/Cancellation</a></li>
              <li><a href="<?php echo url("/contact-us");?>">Contact Us</a></li>
            </ul>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-3">
          <h3 class="widget-title">Contact Us</h3>
          <div class="is-divider small"></div>
          <div class="latest-footer-blogs footer-address">
            <p>
            Ceyone Nutri India Pvt Ltd<br/>
            2nd Floor, Triti Apartment, <br/>
            100 Manohar Pukur Road, <br/>
            Kolkata-700029,<br/>
            West Bengal, India<br/>
            </p>
            <p>
            Land No. : 033 40631211<br/>
            Email at. : <a href="mailto:info@ceyone.co.in" class="email-address">info@ceyone.co.in</a>
            </p>
          </div>
        </div>
        
        <!-- <div class="col-xs-12 col-sm-12 col-md-5">
          <h3 class="widget-title">{!! trans('frontend.latest_news_label') !!}</h3>
          <div class="is-divider small"></div>
          <div class="latest-footer-blogs">
            @if(count($blogs_data) > 0)
            <ul>
              @foreach($blogs_data as $rows)
              <li>
                <div class="footer-latest-blog-row">
                  <div class="footer-blogs-widget-title footer-blogs-left-boxs"><span>{{ Carbon\Carbon::parse($rows['created_at'])->format('d') }}</span><br><span>{{ Carbon\Carbon::parse($rows['created_at'])->format('M') }}</span></div>
                  <div class="footer-blogs-widget-title footer-blogs-right-text"><a href="{{ route('blog-single-page', $rows['post_slug']) }}">{{ $rows['post_title'] }}</a> <br><span><a href="{{ route('blog-single-page', $rows['post_slug']) }}"><strong>{!! $rows['comments_details']['total'] !!}</strong>&nbsp;{!! trans('frontend.comments_label') !!}</a></span></div>
                </div>
              </li>
              @endforeach
            </ul>
            @else
            <p class="not-available">{!! trans('frontend.no_latest_news_label') !!}</p>
            @endif
          </div>
        </div> -->
        
        <!-- <div class="col-xs-12 col-sm-12 col-md-4">
          <h3 class="widget-title">{!! trans('frontend.footer_tags_label') !!}</h3>
          <div class="is-divider small"></div>
          <div class="footer-tags-list">
            @if(count($popular_tags_list) > 0)
              @foreach($popular_tags_list as $tags)
                <a href="{{ route('tag-single-page', $tags->slug)}}">{!! $tags->name !!}</a>
              @endforeach
            @else
            <p class="not-available">{!! trans('frontend.footer_no_tags_label') !!}</p>
            @endif
          </div>
        </div> -->





      </div>
    </div>
  </div>
  
</div>
<div class="footer-copyright full-width">
  <div class="footer-copyright-background">
    <div class="container">
      <div class="row">
        <div class="col-md-6 footer-text">
          <div class="">Copyright © 2021 Ceyone Nutri India Pvt. Ltd.. All rights reserved.</div>
          <!-- <div class="">{!! trans('frontend.footer_msg', ['title' => get_site_title()]) !!}</div> -->
          <!-- <div class="text-center">{!! trans('frontend.footer_powered_by') !!} {!! get_site_title() !!}</div> -->
        </div>
        <div class="col-md-6 footer-text">
          <div class="text-right"><a href="https://instagram.com/designcloud.in?igshid=1folj0378izrk" target="_blank">Designed & Developed by Design Cloud</a></div>
          <!-- <div class="text-center">{!! trans('frontend.footer_powered_by') !!} {!! get_site_title() !!}</div> -->
        </div>
      </div>
    </div>
  </div>  
</div>