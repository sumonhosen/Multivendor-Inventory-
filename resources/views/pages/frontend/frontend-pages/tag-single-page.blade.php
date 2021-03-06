@extends('layouts.frontend.master')
@section('title',  trans('frontend.tag_details_page_label') .' < '. get_site_title() )

@section('content')
<br>
<div class="container new-container">
  <div id="tag_single_page_main">
    <div class="row">
      <div class="col-md-4 extra-padding">
        @if(count($popular_tags_list) > 0)
        <div class="tags-product-list">
          <h2>{{ trans('frontend.popular_tags_label') }} <span class="responsive-accordian"></span></h2>
          <div class="tag-list">
            <ul>
              @foreach($popular_tags_list as $tags)
                @if($tags->slug == $tag_single_details['tag_details']['slug'])
                  <li><a class="tag-active" href="{{ route('tag-single-page', $tags->slug) }}"><i class="fa fa-angle-right"></i> {{ ucfirst($tags->name) }}</a></li>
                @else
                  <li><a href="{{ route('tag-single-page', $tags->slug) }}"><i class="fa fa-angle-right"></i> {{ ucfirst($tags->name) }}</a></li>
                @endif
              @endforeach
            </ul>
          </div>
        </div>
        @endif
      </div>
      <div class="col-md-8">
        @if($tag_single_details['products']->count() > 0)
          <div class="product-content clearfix">
            <div class="row">
            @foreach($tag_single_details['products'] as $products)
            
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 extra-padding">
                <div class="hover-product">
                  <div class="hover">
                    @if(get_product_image($products->id))
                    <a href ="{{ route('details-page', $products->slug) }}"><img class="img-responsive" src="{{ get_image_url(get_product_image($products->id)) }}" alt="{{ basename(get_product_image($products->id)) }}" /></a>
                    @else
                    <a href ="{{ route('details-page', $products->slug) }}"><img class="img-responsive" src="{{ default_placeholder_img_src() }}" alt="" /></a>
                    @endif

                    <!-- <div class="overlay">
                      <button class="info quick-view-popup" data-id="{{ $products->id }}">{{ trans('frontend.quick_view_label') }}</button>
                    </div> -->
                  </div> 

                  <div class="single-product-bottom-section">
                    <div class="product-info-detail">
                    <h3><a href ="{{ route('details-page', $products->slug) }}">{!! get_product_title($products->id) !!}</a></h3>

                    @if(get_product_type($products->id) == 'simple_product')
                      <p>{!! price_html( get_product_price_html_by_filter(get_role_based_price_by_product_id($products->id, $products->price)), get_frontend_selected_currency())  !!}</p>
                    @elseif(get_product_type($products->id) == 'configurable_product')
                      <p>{!! get_product_variations_min_to_max_price_html(get_frontend_selected_currency(), $products->id) !!}</p>
                    @elseif(get_product_type($products->id) == 'customizable_product' || get_product_type($products->id) == 'downloadable_product')
                      @if(count(get_product_variations($products->id))>0)
                        <p>{!! get_product_variations_min_to_max_price_html(get_frontend_selected_currency(), $products->id) !!}</p>
                      @else
                        <p>{!! price_html( get_product_price_html_by_filter(get_role_based_price_by_product_id($products->id, $products->price)), get_frontend_selected_currency()) !!}</p>
                      @endif
                    @endif
                </div>

                    <!-- <div class="title-divider"></div> -->
                    <div class="single-product-add-to-cart">
                      @if(get_product_type($products->id) == 'simple_product')
                        <a href="" data-id="{{ $products->id }}" class="btn btn-sm btn-style add-to-cart-bg" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_cart_label') }}"><i class="fa fa-shopping-cart"></i></a>
                        <a href="" class="btn btn-sm btn-style product-wishlist" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_wishlist_label') }}"><i class="fa fa-heart"></i></a>
                        <!-- <a href="" class="btn btn-sm btn-style product-compare" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_compare_list_label') }}"><i class="fa fa-exchange"></i></a>
                        <a href="{{ route('details-page', $products->slug) }}" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.product_details_label') }}"><i class="fa fa-eye"></i></a> -->

                      @elseif(get_product_type($products->id) == 'configurable_product')
                        <a href="{{ route('details-page', $products->slug) }}" class="btn btn-sm btn-style select-options-bg" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.select_options') }}"><i class="fa fa-hand-o-up"></i></a>
                        <a href="" class="btn btn-sm btn-style product-wishlist" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_wishlist_label') }}"><i class="fa fa-heart"></i></a>
                        <a href="" class="btn btn-sm btn-style product-compare" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_compare_list_label') }}"><i class="fa fa-exchange"></i></a>
                        <a href="{{ route('details-page', $products->slug) }}" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.product_details_label') }}"><i class="fa fa-eye"></i></a>

                      @elseif(get_product_type($products->id) == 'customizable_product')
                        @if(is_design_enable_for_this_product($products->id))
                          <a href="{{ route('customize-page', $products->slug) }}" class="btn btn-sm btn-style product-customize-bg" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.select_options') }}"><i class="fa fa-gears"></i></a>
                          <a href="" class="btn btn-sm btn-style product-wishlist" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_wishlist_label') }}"><i class="fa fa-heart"></i></a>
                          <a href="" class="btn btn-sm btn-style product-compare" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_compare_list_label') }}"><i class="fa fa-exchange"></i></a>
                          <a href="{{ route('details-page', $products->slug) }}" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.product_details_label') }}"><i class="fa fa-eye"></i></a>

                        @else
                          <a href="" data-id="{{ $products->id }}" class="btn btn-sm btn-style add-to-cart-bg" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_cart_label') }}"><i class="fa fa-shopping-cart"></i></a>
                          <a href="" class="btn btn-sm btn-style product-wishlist" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_wishlist_label') }}"><i class="fa fa-heart"></i></a>
                          <a href="" class="btn btn-sm btn-style product-compare" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_compare_list_label') }}"><i class="fa fa-exchange"></i></a>
                          <a href="{{ route('details-page', $products->slug) }}" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.product_details_label') }}"><i class="fa fa-eye"></i></a>
                        @endif
                      @elseif(get_product_type( $products->id ) == 'downloadable_product') 
                        @if(count(get_product_variations( $products->id ))>0)
                        <a href="{{ route( 'details-page', $products->slug ) }}" class="btn btn-sm btn-style select-options-bg" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.select_options') }}"><i class="fa fa-hand-o-up"></i></a>
                        <a href="" class="btn btn-sm btn-style product-wishlist" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_wishlist_label') }}"><i class="fa fa-heart"></i></a>
                        <a href="" class="btn btn-sm btn-style product-compare" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_compare_list_label') }}"><i class="fa fa-exchange" ></i></a>
                        <a href="{{ route('details-page', $products->slug ) }}" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.product_details_label') }}"><i class="fa fa-eye"></i></a>
                        @else
                        <a href="" data-id="{{ $products->id }}" class="btn btn-sm btn-style add-to-cart-bg" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_cart_label') }}"><i class="fa fa-shopping-cart"></i></a>
                        <a href="" class="btn btn-sm btn-style product-wishlist" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_wishlist_label') }}"><i class="fa fa-heart"></i></a>
                        <a href="" class="btn btn-sm btn-style product-compare" data-id="{{ $products->id }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_compare_list_label') }}"><i class="fa fa-exchange" ></i></a>
                        <a href="{{ route('details-page', $products->slug ) }}" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.product_details_label') }}"><i class="fa fa-eye"></i></a>
                        @endif                         
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            </div>  
          </div>
          <div class="products-pagination">{!! $tag_single_details['products']->appends(Request::capture()->except('page'))->render() !!}</div>
        @else
        <br><p>{{ trans('frontend.no_product_for_tag_label') }}</p>
        @endif
      </div>
    </div>
  </div>
</div>    
@endsection