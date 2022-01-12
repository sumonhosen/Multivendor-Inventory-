@extends('layouts.frontend.master')

  @section('title', 'Active Offers' .' < '. get_site_title() )

@section('content')
<div id="user_account" class="container new-container">
  <br> 
  <div class="row">
    <div class="col-md-12 account-type"><h5><i class="fa fa-user-plus"></i>
      @if(Session::get('shopist_frontend_user_role') == 'Vendor')
      {!! 'Distributor Dashboard' !!}
    @else
       {!! trans('frontend.user_account_label') !!}
    @endif
    
    </h5><hr></div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
      <div class="account-tab-main">
        <ul class="nav flex-column">
          @if(Request::is('user/account/dashboard') || Request::is('user/account'))
          <li class="nav-item"><a class="nav-link active" href="{{ route('user-dashboard-page') }}"><i class="fa fa-dashboard"></i> {{ trans('frontend.dashboard') }}</a></li>
          @else
          <li class="nav-item"><a class="nav-link" href="{{ route('user-dashboard-page') }}"><i class="fa fa-dashboard"></i> {{ trans('frontend.dashboard') }}</a></li>
          @endif
          
          @if( Request::is('user/account/my-address') ||  Request::is('user/account/my-address/add') ||  Request::is('user/account/my-address/edit') )
            <li class="nav-item"><a class="nav-link active" href="{{ route('my-address-page') }}"><i class="fa fa-map-marker"></i> {{ trans('frontend.my_address') }}</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('my-address-page') }}"><i class="fa fa-map-marker"></i> {{ trans('frontend.my_address') }}</a></li>
          @endif
          
          @if(Request::is('user/account/my-orders') || Request::is('user/account/order-details/**'))
            <li class="nav-item"><a class="nav-link active" href="{{ route('my-orders-page') }}"><i class="fa fa-file-text-o"></i> {{ trans('frontend.my_orders') }}</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('my-orders-page') }}"><i class="fa fa-file-text-o"></i> {{ trans('frontend.my_orders') }}</a></li>
          @endif
          
          @if(Request::is('user/account/my-saved-items'))
            <li class="nav-item"><a class="nav-link active" href="{{ route('my-saved-items-page') }}"><i class="fa fa-save"></i> {{ trans('frontend.my_saved_items') }}</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('my-saved-items-page') }}"><i class="fa fa-save"></i> {{ trans('frontend.my_saved_items') }}</a></li>
          @endif
          
          @if(Request::is('user/account/my-coupons'))
            <li class="nav-item"><a class="nav-link active" href="{{ route('my-coupons-page') }}"><i class="fa fa-scissors"></i> {{ trans('frontend.my_coupons') }}</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('my-coupons-page') }}"><i class="fa fa-scissors"></i> {{ trans('frontend.my_coupons') }}</a></li>
          @endif
          @if(Request::is('user/account/affiliation_points'))
          <li class="nav-item"><a class="nav-link active" href="{{ route('affiliation_points') }}"><i class="fa fa-gift"></i>Affiliations</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('affiliation_points') }}"><i class="fa fa-gift"></i>Affiliations</a></li>
          @endif
          @if(Request::is('user/account/aff_pro_points'))
          <li class="nav-item"><a class="nav-link active" href="{{ route('aff_pro_points') }}"><i class="fa fa-gift"></i>Affiliations Points</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('aff_pro_points') }}"><i class="fa fa-gift"></i>Affiliations Points</a></li>
          @endif
          
          @if(is_frontend_user_logged_in() && Session::get('shopist_frontend_user_role') == 'Vendor')
            @if(Request::is('user/account/bv-points'))
              <li class="nav-item"><a class="nav-link active" href="{{ route('my-points') }}"><i class="fa fa-gift"></i>BV Points History</a></li>
            @else
              <li class="nav-item"><a class="nav-link" href="{{ route('my-points') }}"><i class="fa fa-gift"></i>BV Points History</a></li>
            @endif


            @if(Request::is('user/account/my-offers'))
              <li class="nav-item"><a class="nav-link active" href="{{ route('my-offers') }}"><i class="fa fa-gift"></i>My Offers</a></li>
            @else
              <li class="nav-item"><a class="nav-link" href="{{ route('my-offers') }}"><i class="fa fa-gift"></i>My Offers</a></li>
            @endif
            
          @endif

          @if(Request::is('user/account/download'))
            <li class="nav-item"><a class="nav-link active" href="{{ route('download-page') }}"><i class="fa fa-download"></i> {{ trans('frontend.user_account_download_title') }}</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('download-page') }}"><i class="fa fa-download"></i> {{ trans('frontend.user_account_download_title') }}</a></li>
          @endif
          
          @if(Request::is('user/account/my-profile'))
            <li class="nav-item"><a class="nav-link active" href="{{ route('my-profile-page') }}"><i class="fa fa-user"></i> {{ trans('frontend.my_profile') }}</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('my-profile-page') }}"><i class="fa fa-user"></i> {{ trans('frontend.my_profile') }}</a></li>
          @endif
          
          @if(is_frontend_user_logged_in())
          <form method="post" action="{{ route('user-logout') }}" enctype="multipart/form-data">
            @include('includes.csrf-token')
            <li><button type="submit" class="btn btn-default btn-block"><i class="fa fa-circle-o-notch"></i> {!! trans('admin.sign_out') !!}</button>  </li>
          </form>
          @endif
        </ul>
      </div>  
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
      <div class="panel panel-default">
        <div class="panel-heading text-right">
          <div class="new-media">
            <div class="new-media-left">
           
               </div>
              
            <div class="new-media-body">
              <h5 class="new-media-heading">{{ $login_user_details['user_display_name'] }}</h5>
              <h6 class="new-media-heading">{!! trans('frontend.member_since_label') !!} {!! Carbon\Carbon::parse($login_user_details['member_since'])->format('d, M Y') !!}</h6>
             </div>
          </div>
        </div>
        @php $aff_id = $login_user_details['appliation_id']; @endphp
        <div class="panel-body">
          <div class="row">
            <div class="col-12">
                <h5><label>Affiliation Products</label></h5><hr>
                <br>
                <table id="table_user_account_order_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <th>Product  Image</th>
                    <th>Product Title</th>
                    <th>Product Price</th>
                    <th>Action </th>

                </thead>
                <tbody>
                  @foreach($affiliation_products as $key=>$affiliation)
                  <tr>
                    @if(!empty($affiliation->image_url))
                    <td>
                      <img src="{{ get_image_url($affiliation->image_url) }}" alt="{{ basename ($affiliation->image_url) }}" height="60px" width="70px">
                    </td>
                    @else
                      <td><img src="{{ default_placeholder_img_src() }}" alt="" height="60px" width="70px"></td>
                    @endif
  
                    <td>{{ $affiliation->title }}</td>
                    <td>{{ $affiliation->price }}</td>
                    <input type="hidden" id="aff_link{{$key}}" value="{{ url('/product/affiliation_details/' . $affiliation->slug . '/' . $aff_id ) }}" >
                    <td>
                      <button type="button" id="tool{{$key}}" onclick="myFunction({{$key}})" class="btn btn-success btn-flat">Copy Link</button>
                    </td>

                    </tr>
                  @endforeach
                 
                </tbody>
                <tfoot>
                  <tr>
                    <th>Product  Image</th>
                    <th>Product Title</th>
                    <th>Product Price</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>


function myFunction(id){
var copyText = $('#aff_link'+id).val();

  navigator.clipboard.writeText(copyText);
  $('#tool'+id).text("Copied");

}
</script>
@endsection  
