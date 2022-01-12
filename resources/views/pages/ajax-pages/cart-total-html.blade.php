{!! Session::get('eBazar_shipping_method') !!}
<li class="row cart-total-main">


@if(!empty($offer_product) && Session::get('shopist_frontend_user_role') == 'Vendor')
<table class="table-responsive table">
  
    <!-- <p style="color:#FF994B;font-weight: bold;">Congratulations! You have got a deal on your purchase. Grab it Now</p> -->
   

@foreach($offer_product as $key => $latest_product)

   @if(Cart::getTotal() >= $latest_product->from_price && Cart::getTotal() <= $latest_product->to_price )
 
  @if($key == 1)
    <p style="color:#FF994B;font-weight: bold;">Congratulations! You have got a deal on your purchase. Grab it Now</p>
  @endif

  <tr id="{{ $latest_product->discounted_price }}">
    <td>
      @if(!empty($latest_product->image_url))
        <a target="_blank" href ="{{ route('details-page', $latest_product->slug) }}"><img class="d-block" src="{{ get_image_url( $latest_product->image_url ) }}" alt="{{ basename( get_image_url( $latest_product->image_url ) ) }}" style="height: 30px;"  /></a>
        @else
        <a target="_blank" href ="{{ route('details-page', $latest_product->slug) }}"><img class="d-block" src="{{ default_placeholder_img_src() }}" alt="" style="height: 30px;" /></a>
        @endif
    </td>
    <td>
      <p><a target="_blank" href ="{{ route('details-page', $latest_product->slug) }}">{!! $latest_product->offer_title !!} - {!! $latest_product->title !!} </a>
        <br>
        <b><i> Applicable on Shopping from <i class="fa fa-inr"></i> {{ $latest_product->from_price }} To <i class="fa fa-inr"></i> {{ $latest_product->to_price }} </i>  </b>
      </p>
    </td>
    <td>
       <p><i class="fa fa-inr"></i> <del><span style="color:red">{!! $latest_product->price !!}</span></del> <span style="color:green">{{ $latest_product->discounted_price }}</span> </p>
    </td>
    <td>
      <a href="" data-name="{{ $latest_product->offer_title }} ({!! $latest_product->title !!})" data-id="{{ $latest_product->id }}" class="btn btn-sm btn-style add-to-cart-offer" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_cart_label') }}">
       <button class="btn btn-warning"> <i class="fa fa-shopping-cart"></i></button></a>
    </td>
  </tr>
  @endif

 @endforeach
</table>
@endif

  <div class="cart-total-area-overlay"></div>  
  <div id="loader-1-cart"></div>
  <div class="cart-total-content">
      <div class="cart-sub-total"><div class="label">{!! trans('frontend.cart_sub_total') !!}:   
       </div><div class="value">{!! price_html( get_product_price_html_by_filter(Cart::getTotal()), get_frontend_selected_currency() ) !!}</div></div>
      
      <!--<div class="cart-tax"><div class="label">{!! trans('frontend.tax') !!}:</div><div class="value">{!! price_html( get_product_price_html_by_filter(Cart::getTax()), get_frontend_selected_currency() ) !!}</div></div>-->
      
        @if((!$shipping_data['shipping_option']['enable_shipping']) || ($shipping_data['shipping_option']['enable_shipping'] && !$shipping_data['flat_rate']['enable_option'] && !$shipping_data['free_shipping']['enable_option'] && !$shipping_data['local_delivery']['enable_option']))
        
        <div class="cart-shipping-total"><div class="label">{!! trans('frontend.shipping_cost') !!}:</div><div class="value">{!! trans('frontend.free') !!}</div></div>

        @elseif(($shipping_data['shipping_option']['enable_shipping']) && ($shipping_data['flat_rate']['enable_option'] || $shipping_data['free_shipping']['enable_option'] || $shipping_data['local_delivery']['enable_option']) )
        
        
          <?php $str = '';?>

          @if(Session::get('shopist_frontend_user_role') == 'Vendor')
             @if(Cart::getSubTotalAndTax() < 6000 )

                <?php 
                $str .= '<div><span>'. price_html( get_product_price_html_by_filter(100), get_frontend_selected_currency() ).'</span></div>';?>
              @endif
          @else
            @if( Cart::getSubTotalAndTax() < 1500 )
              <?php 
              $str .= '<div><span>'. price_html( get_product_price_html_by_filter(100), get_frontend_selected_currency() ).'</span></div>';?>
            @endif
          @endif
          <input type="hidden" name="local_delivery_fee" value="{{ $delivery_fee ??''}}" id="delivery_fee">
          <input type="hidden" value="{{ Session::get('pickup') }}" id="pickup">

          <input type="hidden" value="{!! get_product_price_html_by_filter(Cart::getTotal()) !!}" id="cart_sub_total">
          <div class="local_pickup_cost" style="display: none">
            <div class="cart-shipping-total">
              <div class="label">Local pickup:
              </div>
              <div class="value">
                Rs.{{ round($delivery_fee??'',2) }}
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          @if($str)
  
          <div class="cart-shipping-total normal_shipping_cost">
            <div class="label">{!! trans('frontend.shipping_cost') !!}:</div>
            <div class="value"><?php echo $str;?></div>
          </div>
          <div class="clearfix"></div>
  
          @else
          <div class="cart-shipping-total">
            <div class="label">{!! trans('frontend.shipping_cost') !!}:</div>
            <div class="value">{!! trans('frontend.free') !!}</div>
          </div>
          @endif
          
        @endif
        
      @if(Cart::is_coupon_applyed())  
      <div class="cart-coupon"><div class="label">{!! trans('frontend.coupon_label') !!}:</div><div class="value">- {!! price_html( get_product_price_html_by_filter(Cart::couponPrice()), get_frontend_selected_currency() ) !!}</div> <div><button class="remove-coupon btn btn-default btn-xs" type="button">{!! trans('frontend.remove_coupon_label') !!}</button></div></div>
      @endif
      
      <div class="cart-grand-total">
        <div class="label">{{ trans('frontend.grand_total') }}:</div>
        {{-- <div class="value granded_cart_total"></div> --}}
        <div class="value granded_cart_total">{!! price_html( get_product_price_html_by_filter(Cart::getCartTotal()), get_frontend_selected_currency() ) !!}</div></div>
      </div>
  
  <!-- @if(Request::is('cart'))
  <div class="clearfix">
    <input style="float:right;" type="submit" name="checkout" class="btn btn-secondary check_out" value="{{ trans('frontend.check_out') }}">
  </div>  
  @endif -->
</li>





@if(Request::is('cart'))
  @include('pages.frontend.frontend-pages.crosssell-products')
@endif
