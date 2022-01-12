<div id="header_content">
  <div class="header-content-top">
    <div class="container">
        <div class="row">
          <div class="col-5 col-md-6">
            <div class="currency-lang">
              <div class="dropdown change-multi-currency">
                @if(get_frontend_selected_currency())
                <a class="dropdown-toggle" href="#" data-hover="dropdown" data-toggle="dropdown">
                  <span class="d-none d-md-inline">{!! get_currency_name_by_code( get_frontend_selected_currency() ) !!}</span>
                  <span class="d-md-none d-xs-inline  fa fa-money money-icon"></span>
                  @if(count(get_frontend_selected_currency_data()) >0)
                  <span class="caret"></span>
                  @endif
                </a>
                @endif
                <div class="dropdown-content">
                  @if(count(get_frontend_selected_currency_data()) >0)
                    @foreach(get_frontend_selected_currency_data() as $val)
                      <a href="#" data-currency_name="{{ $val }}">{!! get_currency_name_by_code( $val ) !!}</a>
                    @endforeach
                  @endif
                </div>
              </div>

              <div class="dropdown language-list">
                @if(count(get_frontend_selected_languages_data()) > 0)
                  @if(get_frontend_selected_languages_data()['lang_code'] == 'en')
                    <a class="dropdown-toggle" href="#" data-hover="dropdown" data-toggle="dropdown">
                      <img src="{{ asset('public/images/'. get_frontend_selected_languages_data()['lang_sample_img']) }}" alt="lang"> <span class="d-none d-md-inline"> &nbsp; {!! get_frontend_selected_languages_data()['lang_name'] !!}</span> <span class="caret"></span>
                    </a>
                  @else
                    <a class="dropdown-toggle" href="#" data-hover="dropdown" data-toggle="dropdown">
                      <img src="{{ get_image_url(get_frontend_selected_languages_data()['lang_sample_img']) }}" alt="lang"> <span class="d-none d-md-inline"> &nbsp; {!! get_frontend_selected_languages_data()['lang_name'] !!}</span> <span class="caret"></span>
                    </a>
                  @endif
                @endif
                <?php $available_lang = get_available_languages_data_frontend();?>  

                @if(is_array($available_lang) && count($available_lang) >0)
                  <div class="dropdown-content">
                    @foreach(get_available_languages_data_frontend() as $key => $val)
                      @if($val['lang_code'] == 'en')
                        <a href="#" data-lang_name="{{ $val['lang_code'] }}"><img src="{{ asset('public/images/'. $val['lang_sample_img']) }}" alt="lang"> &nbsp;{!! ucwords($val['lang_name']) !!}</a>
                      @else
                        <a href="#" data-lang_name="{{ $val['lang_code'] }}"><img src="{{ get_image_url($val['lang_sample_img']) }}" alt="lang"> &nbsp;{!! ucwords($val['lang_name']) !!}</a>
                      @endif
                    @endforeach
                  </div>
                @endif
              </div>
            </div>
          </div>
            
          <div class="col-7 col-md-6" style="display:none">
            <div class="float-right">
              <ul class="right-menu top-right-menu">
                <li><a href="<?php echo url("/user/login");?>">Sign In</a></li>
                <li><a href="<?php echo url("/user/registration");?>">Register</a></li>
                <li class="wishlist-content">
                  <a class="main" href="{{ route('my-saved-items-page') }}">
                    <i class="fa fa-heart"></i> 
                    <span class="d-none d-md-inline">{!! trans('frontend.frontend_wishlist') !!}</span> 
                  </a>    
                </li>  

                <li class="users-vendors-login dropdown"><a href="#" class="main selected dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="fa fa-user" aria-hidden="true"></i> <span class="d-none d-md-inline">{!! trans('frontend.menu_my_account') !!}</span><span class="caret"></span></a>
                  <div class="new-dropdown-menu dropdown-content my-account-menu">
                    @if (Session::has('shopist_frontend_user_id'))
                    <a href="{{ route('user-account-page') }}">{!! trans('frontend.user_account_label') !!}</a>
                    @else
                    <a href="{{ route('user-login-page') }}">{!! trans('frontend.frontend_user_login') !!}</a>
                    @endif

                    @if (Session::has('shopist_admin_user_id') && !empty(get_current_vendor_user_info()['user_role_slug']) && get_current_vendor_user_info()['user_role_slug'] == 'vendor')
                     <a target="_blank" href="{{ route('admin.dashboard') }}">{!! trans('frontend.vendor_account_label') !!}</a>
                    @else
                     <a target="_blank" href="{{ route('admin.login') }}">{!! trans('frontend.frontend_vendor_login') !!}</a>
                    @endif

                    <a href="{{ route('vendor-registration-page') }}">{!! trans('frontend.vendor_registration') !!}</a>
                  </div>
                </li>

                <li class="mini-cart-content no-pad-right">
                  @include('pages.ajax-pages.mini-cart-html2')
                </li>
              </ul>
            </div> 
          </div>   
        </div>
    </div>
  </div>
  <div class="header-content-middle">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3">
          @if(get_site_logo_image())
            <div class="logo text-left"><a href="<?php echo url("/");?>"><img src="{{ get_site_logo_image() }}" title="{{ trans('frontend.your_store_label') }}" alt="{{ trans('frontend.your_store_label') }}" width="180"></a></div>
          @endif
        </div> 

      <!--Sticky Nav-->  
  
        

      <!--Sticky Nav-->  











        <div class="col-sm-12 col-md-12 col-lg-9 text-right search-and-compare-item">
        <div class="float-right">
              <ul class="right-menu top-right-menu">
                <li><a href="<?php echo url("/user/login");?>" class="main">Sign In</a></li>
                <li><a href="<?php echo url("/user/registration");?>" class="main">Register</a></li>
                <li class="wishlist-content">
                  <a class="main" href="{{ route('my-saved-items-page') }}">
                    <i class="fa fa-heart"></i> 
                    <span class="d-none d-md-inline">{!! trans('frontend.frontend_wishlist') !!}</span> 
                  </a>    
                </li>  

                <li class="users-vendors-login dropdown d-none"><a href="#" class="main selected dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i class="fa fa-user" aria-hidden="true"></i> <span class="d-none d-md-inline">{!! trans('frontend.menu_my_account') !!}</span><span class="caret"></span></a>
                  <div class="new-dropdown-menu dropdown-content my-account-menu">
                    @if (Session::has('shopist_frontend_user_id'))
                    <a href="{{ route('user-account-page') }}">{!! trans('frontend.user_account_label') !!}</a>
                    @else
                    <a href="{{ route('user-login-page') }}">{!! trans('frontend.frontend_user_login') !!}</a>
                    @endif

                    @if (Session::has('shopist_admin_user_id') && !empty(get_current_vendor_user_info()['user_role_slug']) && get_current_vendor_user_info()['user_role_slug'] == 'vendor')
                     <a target="_blank" href="{{ route('admin.dashboard') }}">{!! trans('frontend.vendor_account_label') !!}</a>
                    @else
                     <a target="_blank" href="{{ route('admin.login') }}">{!! trans('frontend.frontend_vendor_login') !!}</a>
                    @endif

                    <a href="{{ route('vendor-registration-page') }}">{!! trans('frontend.vendor_registration') !!}</a>
                  </div>
                </li>

                <li class="mini-cart-content no-pad-right">
                  @include('pages.ajax-pages.mini-cart-html2')
                </li>
                <!--<li><a href="http://ceyonebiz.co.in/" class="main" target="_blank">Distributor Login</a></li>-->
                <li><a href="{{ route('distributor-login-page') }}" class="main">Distributor Login</a></li>
              </ul>
            </div> 
          <div class="terms-search-option">  
            <form id="search_option" action="{{ route('shop-page') }}" method="get">
              <div class="input-group">
                <input type="text" id="srch_term" name="srch_term" class="form-control" placeholder="{{ trans('frontend.search_for_label') }}">
                <span class="input-group-btn">
                  <button id="btn-search" type="submit" class="btn btn-light search-btn">
                    <span class="fa fa-search"></span>
                  </button>
                </span>
              </div>
            </form>
          </div>
          <div class="items-compare-list"><a href="{{ route('product-comparison-page') }}" class="btn btn-light btn-compare"><i class="fa fa-exchange"></i> <span class="d-none d-lg-inline"> &nbsp; {!! trans('frontend.compare_label') !!}</span> <span class="compare-value"> (<?php echo $total_compare_item;?>)</span></a></div>  
        </div> 
      </div>
      <!-- <div class="row">
        <div class="col text-center search-and-compare-item">
          <div class="terms-search-option">  
            <form id="search_option" action="{{ route('shop-page') }}" method="get">
              <div class="input-group">
                <input type="text" id="srch_term" name="srch_term" class="form-control" placeholder="{{ trans('frontend.search_for_label') }}">
                <span class="input-group-btn">
                  <button id="btn-search" type="submit" class="btn btn-light search-btn">
                    <span class="fa fa-search"></span>
                  </button>
                </span>
              </div>
            </form>
          </div>
          <div class="items-compare-list"><a href="{{ route('product-comparison-page') }}" class="btn btn-light btn-compare"><i class="fa fa-exchange"></i> <span class="d-none d-lg-inline"> &nbsp; {!! trans('frontend.compare_label') !!}</span> <span class="compare-value"> (<?php echo $total_compare_item;?>)</span></a></div>  
        </div>  
      </div>   -->

    </div>
  </div> 
  <div class="header-content-menu">
    <div id="sticky_nav">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-dark nav-main" id="navbar">
              <a class="navbar-brand" href="#"></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-menu-small">{!! trans('frontend.menu_label') !!}</span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto nav-list-main">
                
                	<li class="nav-item shopmenu dropdown">
                		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop
                    <i class="fa fa-angle-down"></i>
                    </a>
                		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                			<div class="row">
                				<div class="col">
                					<div class="cat-content">
                						<img src="<?php echo url("/public/uploads/1611156734-h-150-ayush_kwath.png");?>">
                					</div>
                					<div class="cat-content"><h5><a href="<?php echo url("/product/categories/health-care");?>">Health Care</a></h5><hr></div>
                				</div>
                				<div class="col">
                					<div class="cat-content"><img src="<?php echo url("/public/uploads/1611151822-h-500-Cristaa.png");?>"></div>
                					<div class="cat-content"><h5><a href="<?php echo url("/product/categories/oral-care");?>">Oral Care</a></h5><hr></div>
                				</div>
                			</div>
                			<div class="row">
                				<div class="col">
                					<div class="cat-content"><img src="<?php echo url("/public/uploads/1611151733-h-500-CropGrow.png");?>"></div>
                					<div class="cat-content"><h5><a href="<?php echo url("/product/categories/agri-care");?>">Agri Care</a></h5><hr></div>
                				</div>
                				<div class="col">
                					<div class="cat-content"><img src="<?php echo url("/public/uploads/1611154034-h-500-ALWAYS%2021%20FACE%20WASH.png");?>"></div>
                					<div class="cat-content"><h5><a href="<?php echo url("/product/categories/personal-care");?>">Personal care</a></h5><hr></div>
                				</div>
                			</div>
                		</div>
                	</li>
                  <li class="nav-item dropdown">
                    <a href="javascript:;" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About
                    <i class="fa fa-angle-down"></i>
                    </a>
                  
                  <div class="dropdown-menu sml-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo url("/page/about");?>">Company Profile </a>
                        <a class="dropdown-item" href="<?php echo url("/page/vision-mission");?>">Vision and Mission</a>                        
                        <a class="dropdown-item" href="#">Manufacturing Process</a>
                      </div>
                  </li>
                  
                	<!-- <li class="nav-item"><a href="javascript:;" class="nav-link">Promotions</a></li> -->
                	<li class="nav-item dropdown">
                    <a href="javascript:;" class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">News
                    <i class="fa fa-angle-down"></i>
                    </a>
                      <div class="dropdown-menu sml-menu" aria-labelledby="navbarDropdown">
                        <ul>
                            <li><a class="dropdown-item has-submenu" href="#">Achievers</a>
                            <ul class="submenu dropdown-menu third-lavel">     
                                  <li><a class="dropdown-item" href="<?php echo url("/categories/executive-director");?>">Executive Director</a></li>
                                  <li><a class="dropdown-item" href="<?php echo url("/categories/executive-senior-director");?>">Executive Senior Director</a></li>
                                  <li><a class="dropdown-item" href="<?php echo url("/categories/executive-silver-director");?>">Executive Silver Director</a></li>
                                  <li><a class="dropdown-item" href="<?php echo url("/categories/executive-gold-director");?>">Executive Gold Director</a></li>
                                  <li><a class="dropdown-item" href="<?php echo url("/categories/executive-ruby-director");?>">Executive Ruby Director</a></li>
                                  <li><a class="dropdown-item" href="<?php echo url("/categories/executive-emerald-director");?>">Executive Emerald Director</a></li>
                                  <li><a class="dropdown-item" href="<?php echo url("/categories/executive-diamond-director");?>">Executive Diamond Director</a></li>
                                  <li><a class="dropdown-item" href="<?php echo url("/categories/chairmans-club");?>">Chairman's Club</a></li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#">Notices</a> </li>                       
                            <li><a class="dropdown-item" href="#">Promotions and offers</a></li>
                            <li><a class="dropdown-item" href="<?php echo url("/testimonials");?>">Testimonials</a></li>
                            <li><a class="dropdown-item" href="<?php echo url("/gallery");?>">Gallery</a></li>
                        </ul>
                      </div>                  
                  </li>
                	<li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opportunity
                    <i class="fa fa-angle-down"></i>
                    </a>
                       <div class="dropdown-menu sml-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo url("/page/opportunity");?>">Business Plan</a>
                        <a class="dropdown-item" href="<?php echo url("/downloads");?>">Download</a>                        
                      </div>
                  	</li>
                	<!-- <li class="nav-item"><a href="" class="nav-link">Testimonials</a></li> -->
                	<!-- <li class="nav-item"><a href="javascript:;" class="nav-link">Achievers</a></li> -->
                	<!-- <li class="nav-item"><a href="<?php echo url("/page/contact");?>" class="nav-link">Contact</a></li> -->
                </ul> 
              </div>
            </nav>
          </div>
        </div>
      </div>

    </div>       
  </div>  
    
  @if($appearance_all_data['header_details']['slider_visibility'] == true && Request::is('/'))
  <?php $count = count(get_appearance_header_settings_data());?>
  @if($count > 0)
  <div class="header-with-slider home-slider" style="display:none">
    <div id="slider_carousel_1" class="carousel slide " data-ride="carousel">
      <a class="carousel-control-prev" href="#slider_carousel_1" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#slider_carousel_1" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

      <?php $numb = 1; ?>
      <div class="carousel-inner">
        @foreach(get_appearance_header_settings_data() as $img)
          @if($numb == 1)
            <div class="carousel-item active">
              @if($img->img_url)
              <a href="<?php echo url("/shop");?>"><img src="{{ get_image_url($img->img_url) }}" class="d-block w-100" alt="" /></a>
              @endif
            </div>
          @else
            <div class="carousel-item">
              @if($img->img_url)
              <a href="<?php echo url("/shop");?>"><img src="{{ get_image_url($img->img_url) }}" class="d-block w-100" alt="" /></a>
              @endif
            </div>
          @endif
          <?php $numb++ ; ?>
        @endforeach
      </div>
    </div>
  </div>

  <div class="header-with-slider home-slider mobile" style="display:none">
    <div id="slider_carousel_2" class="carousel slide " data-ride="carousel">
      <a class="carousel-control-prev" href="#slider_carousel_2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#slider_carousel_2" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

            <div class="carousel-inner">
                              <div class="carousel-item active">
                            <a href="<?php echo url("/shop");?>">
                            <img src="{{ asset('public/images/banner-mobile.jpg') }}" class="d-block w-100" alt=""></a>
                          </div>
                                                  <div class="carousel-item">
                            <a href="<?php echo url("/shop");?>">
                            <img src="{{ asset('public/images/banner-mobile-2.jpg') }}" class="d-block w-100" alt=""></a>
                          </div>
                                                  <div class="carousel-item ">
                            <a href="<?php echo url("/shop");?>">
                            <img src="{{ asset('public/images/banner-mobile-3.jpg') }}" class="d-block w-100" alt=""></a>
                          </div>
                                  </div>
    </div>
  </div>


  @else
  <div class="header-with-slider" style="display: none;">
    <div id="slider_carousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('public/images/sunglass.jpg') }}" class="d-block w-100" alt="" />
        </div>
      </div>
    </div>
  </div>
  @endif
@endif  
</div>