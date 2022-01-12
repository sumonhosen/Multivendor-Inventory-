@extends('layouts.admin.master')
@section('title', trans('admin.orders_list') .' < '. get_site_title())

@section('content')
<div class="row">
  <div class="col-12">
    <h5>
      
      @if($status_type == 'all_order')
        All Orders
      @elseif($status_type == 'completed')
        Completed Orders
      @elseif($status_type == 'on-hold')
        On Hold Orders
      @elseif($status_type == 'cancelled')
        Cancelled
      @else
       {{ $status_type }} Orders
      @endif

    </h5>
  </div>
</div>
<br>
<div class="row">
  <div class="col-12">
    <div class="box">
      <div class="box-body">


    <div class="row" style="padding-bottom: 30px;">
      
            <div class="col-md-6">
              <form action="{{route('admin.order_by_date')}}" method="post" class="order_by_date">
                 @csrf
                  <div class="row">
                    <div class="col-md-4">
                      <label>From Date</label>
                      <input type="date" name="start_date" class="form-control" required="">
                    </div>

                    <div class="col-md-4">
                      <label>To Date</label>
                      <input type="date" name="end_date" class="form-control" required="">
                    </div>

                     <div class="col-md-4">
                      <label style="visibility: hidden;">jj</label>
                      <input type="submit" name="submit" class="btn btn-primary form-control">
                    </div>
                  </div>
              </form>
            </div>
      

    <div class="col-md-6">
      <form action="{{route('admin.order_search')}}" method="post" class="order_by_date">
          @csrf
            <div class="row">
              <div class="col-md-4">
                <label>Search by</label>
                <select class="form-control" name="type" required="">
                  <option value="">Select</option>
                  <option value="_billing_first_name">By Billing Name</option>
                  <option value="_final_order_total">By Price</option>
                  <option value="product">By Product Name</option>
                  <option value="distributor">By Distributor ID</option>
                </select>
              </div>

              <div class="col-md-4">
                <label>Input</label>
                <input type="text" name="query" class="form-control" required="">
              </div>
              <div class="col-md-4">
                <label style="visibility: hidden;">jj</label>
                <input type="submit" name="submit" class="btn btn-success form-control">
              </div>
            </div>
      </form>
    </div>

  </div>
          

          
          
          
      
        <table class="table table-bordered admin-data-table admin-data-list">
          <thead class="thead-dark">
            <tr>
              <th>{{ trans('admin.orders') }}</th>
              <th>{{ trans('admin.order_totals') }}</th>
              <th>{{ trans('admin.vendor_name_label') }}</th>
              <th>{{ trans('admin.action') }}</th>
            </tr>
          </thead>
          <tbody>
            @if(count($orders_list_data)>0)
              @foreach($orders_list_data as $row)


              <tr>
                <td>
                  <a href="{{ route('admin.view_order_details', $row['_post_id']??'') }}">{{ trans('admin.order') }} #{!! $row['_post_id']??'' !!}</a>
                  @if($row['_order_status'] == 'on-hold')<span class="on-hold-label">{{ trans('admin.on_hold') }}</span>@elseif($row['_order_status'] == 'refunded') 
                   
                   <span class="refunded-label">{{ trans('admin.refunded') }}</span>
                  
                  @elseif($row['_order_status'] == 'cancelled') 
                   
                   <span class="cancelled-label">{{ trans('admin.cancelled') }}</span>
                  
                  @elseif($row['_order_status'] == 'pending') 
                   
                   <span class="pending-label">{{ trans('admin.pending') }}</span> 
                  
                  @elseif($row['_order_status'] == 'processing') <span class="processing-label">{{ trans('admin.processing') }}</span> 
                  @elseif($row['_order_status'] == 'completed') 
                   
                   <span class="completed-label">{{ trans('admin.completed') }}</span> 
                  
                  @elseif($row['_order_status'] == 'shipping') 
                   
                   <span class="shipping-label">{{ trans('admin.shipping') }}</span> 
                  
                  @endif 
                   
                   <br><span class="order-date-format">{!! $row['_order_date'] !!}</span>
                </td>

                <td>{!! price_html( $row['_final_order_total'], $row['_order_currency'] ) !!}</td>
                <td>{!! vendor_name_by_oid( $row['_post_id']??'' ) !!}</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-success btn-flat" type="button">{{ trans('admin.action') }}</button>
                    <button data-toggle="dropdown" class="btn btn-success btn-flat dropdown-toggle" type="button">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul role="menu" class="dropdown-menu">
                      <li><a href="{{ route('admin.view_order_details', $row['_post_id']??'') }}"><i class="fa  fa-search"></i>{{ trans('admin.view_order') }}</a></li>
                      <li><a class="remove-selected-data-from-list" data-track_name="order_list" data-id="{{ $row['_post_id']??'' }}" href="#"><i class="fa fa-remove"></i>{{ trans('admin.delete') }}</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            @else
              <tr><td colspan="3"><i class="fa fa-exclamation-triangle"></i> {!! trans('admin.no_data_found_label') !!}</td></tr>  
            @endif
          </tbody>
          <tfoot class="thead-dark">
            <tr>
              <th>{{ trans('admin.orders') }}</th>
              <th>{{ trans('admin.order_totals') }}</th>
              <th>{{ trans('admin.vendor_name_label') }}</th>
              <th>{{ trans('admin.action') }}</th>
            </tr>
          </tfoot>
        </table>
        <br>
        <div class="products-pagination">{!! $orders_list_data->appends(Request::capture()->except('page'))->render() !!}</div>   
      </div>
    </div>
  </div>
</div>
@include('includes.csrf-token')
@endsection