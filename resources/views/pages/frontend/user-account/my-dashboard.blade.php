<div class="user-dashboard-notice">
  <h4>{{ trans('frontend.hi_single_label') }} {{ $login_user_details['user_display_name'] }}</h4>
  <p>{{ trans('frontend.user_db_notice_label') }}</p>
</div><br>
 
<div class="row">

  <div class="col-lg-3 col-xs-12">
    <div class="small-box bg-gray">
      <div class="inner">
        <h3>{!! $dashboard_data['todays_order'] !!}</h3>
        <p>{{ trans('frontend.user_account_todays_order_label') }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-area-chart"></i>
      </div>
      <a href="{{ route('my-orders-page') }}" class="small-box-footer">{{ trans('frontend.user_account_more_info_label') }} <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
    
  <div class="col-lg-3 col-xs-12">
    <div class="small-box bg-gray">
      <div class="inner">
        <h3>{!! $dashboard_data['total_order'] !!}</h3>
        <p>{{ trans('frontend.user_account_totals_order_label') }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-area-chart"></i>
      </div>
      <a href="{{ route('my-orders-page') }}" class="small-box-footer">{{ trans('frontend.user_account_more_info_label') }} <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
    
  <div class="col-lg-3 col-xs-12">
    <div class="small-box bg-gray">
      <div class="inner">
        <h3>{!! $dashboard_data['recent_coupon'] !!}</h3>
        <p>{{ trans('frontend.user_account_recent_coupon_label') }}</p>
      </div>
      <div class="icon">
        <i class="fa fa-percent"></i>
      </div>
      <a href="{{ route('my-coupons-page') }}" class="small-box-footer">{{ trans('frontend.user_account_more_info_label') }} <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>    

  @if(is_frontend_user_logged_in() && Session::get('shopist_frontend_user_role') == 'Vendor')
  <div class="col-lg-3 col-xs-12">
    <div class="small-box bg-gray">
      <div class="inner">
        <h3>{!! $login_user_details['bv_points'] !!}</h3>
        <p>Total BV Points</p>
      </div>
      <div class="icon">
        <i class="fa fa-gift"></i>
      </div>
      <a href="{{ route('my-points') }}" class="small-box-footer">{{ trans('frontend.user_account_more_info_label') }} <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
@endif
@if(is_frontend_user_logged_in() && Session::get('shopist_frontend_user_role') == 'Vendor')
<div class="col-lg-3 col-xs-12">
  <div class="small-box bg-gray">
    <div class="inner">
      <h3>{!! $login_user_details['affiliation_points'] !!}</h3>
      <p>Total Affiliation Points</p>
    </div>
    <div class="icon">
      <i class="fa fa-gift"></i>
    </div>
    <a href="{{ route('aff_pro_points') }}" class="small-box-footer">{{ trans('frontend.user_account_more_info_label') }} <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
@endif



@if(is_frontend_user_logged_in() && Session::get('shopist_frontend_user_role') == 'Vendor')
   <div class="col-12">
                        <h5 style="margin-top: 20px;"><b>Active Offers</b>

                            @if(count($offers_list) > 3) 
                                  <center><a href="{{ route('my-offers') }}" style="float:right;margin-top: -20px;"><span class="badge badge-success">View More</span></a></center>
                               @endif

                        </h5><hr>

          <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <th>Offer Title</th>
                            <th>Purchase amount</th>
                            <th>Product to get as offer</th>
                            <th>Discounted Price</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @if(count($offers_list) > 0) 
                            @foreach($offers_list as $key => $row)
                              @if($key <= 2 )
                               <tr>
                                  <td>{!! $row->offer_title !!}</td>
                                  <td><i class="fa fa-inr"></i> {!! $row->from_price !!} To <i class="fa fa-inr"></i> {!! $row->to_price !!}</td>
                                  <td>{!! $row->ptitle !!}</td>
                                  <td><i class="fa fa-inr"></i> {!! $row->discounted_price !!}</td>
                                  <td>{!! $row->expiry_date !!}</td>
                                  <td>
                                    @if($row->ostatus == 1)
                                      <span class="badge badge-success">Active</span>
                                    @elseif ($row->ostatus == 0 )
                                      <span class="badge badge-danger">Expired</span>
                                    @endif

                                  </td>
                                </tr>
                                @endif
                            @endforeach
                             
                            @endif
                        </tbody>
                        </table>
                    </div>

@endif


</div>
