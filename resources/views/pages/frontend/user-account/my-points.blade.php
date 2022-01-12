@extends('layouts.frontend.master')

  @section('title', 'Points History' .' < '. get_site_title() )

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
          
          @if(is_frontend_user_logged_in() && Session::get('shopist_frontend_user_role') == 'Vendor')
            @if(Request::is('user/account/bv-points'))
              <li class="nav-item"><a class="nav-link active" href="{{ route('my-points') }}"><i class="fa fa-gift"></i>BV Points History</a></li>
            @else
              <li class="nav-item"><a class="nav-link" href="{{ route('my-points') }}"><i class="fa fa-gift"></i>BV Points History</a></li>
            @endif
            @if(Request::is('user/account/affiliation_points'))
            <li class="nav-item"><a class="nav-link active" href="{{ route('affiliation_points') }}"><i class="fa fa-gift"></i>Affiliation  Points</a></li>
            @else
              <li class="nav-item"><a class="nav-link" href="{{ route('affiliation_points') }}"><i class="fa fa-gift"></i>Affiliation  Points</a></li>
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
           
              @if($login_user_details['user_photo_url'])
                <img class="new-media-object" src="{{ get_image_url($login_user_details['user_photo_url']) }}" alt="">
              @else
                <img class="new-media-object" src="{{ default_avatar_img_src() }}" alt="">
              @endif
            </div>
              
            <div class="new-media-body">
              <h5 class="new-media-heading">{{ $login_user_details['user_display_name'] }}</h5>
              <h6 class="new-media-heading">{!! trans('frontend.member_since_label') !!} {!! Carbon\Carbon::parse($login_user_details['member_since'])->format('d, M Y') !!}</h6>
             </div>
          </div>
        </div>
        <div class="panel-body">
        <div class="row">
                    <div class="col-12">
                        <h5><label>Points History</label></h5><hr>
                        <br>
                        <table id="table_user_account_order_list" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                            <th>{{ trans('admin.user_account_order_id') }}</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Point Per Qty</th> 
                            <th>Total Earned Points</th> 
                            <th>Date</th> 
                            <!-- <th>{{ trans('admin.user_account_order_action') }}</th>   -->
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($orders_list_data) > 0) 
                            @foreach($orders_list_data as $row)
                                <tr>
                                <td>#{!! $row->order_id !!}</td>
                                <td><a href="{{ route( 'details-page', $row->slug ) }}" target="_blank">{!! $row->title !!}</a></td>
                                <td>{!!  $row->qty !!}</td>
                                <td>{!!  $row->point_per_qty !!}</td>
                                <td>{!!  $row->credited_points !!}</td>  
                               <td>{!!  $row->cdate !!}</td> 
                                <!-- <td><a class="btn btn-default btn-sm" href="{{ route('account-order-details-page', [$row->order_id, $row->order_id]) }}">{!! trans('frontend.user_account_view_label') !!}</a></td> -->
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>{{ trans('admin.user_account_order_id') }}</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Point Per Qty</th> 
                            <th>Total Earned Points</th> 
                            <th>Date</th> 
                            <!-- <th>{{ trans('admin.user_account_order_action') }}</th>   -->
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
@endsection  