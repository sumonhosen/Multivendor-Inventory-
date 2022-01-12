@extends('layouts.admin.master')
@section('title', 'Products Less than 10 Stock Quantity' .' < '. get_site_title())

@section('content')
<div class="row">
  <div class="col-6">
    <h5>Products Less than 10 Stock Quantity</h5>
  </div>
  <div class="col-6">
    
  </div>
</div>

<div class="row">
  <div class="col-12">		
				
        <div class="products-export-import-options">
        <ul style="padding: 0px;">
                    <a href="{{ route('export-low-stock-products') }}"><li><div class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> {!! trans('admin.export_label') !!}</div></li></a>

                </ul>
            </div>

    <div class="box">
      <div class="box-body">
        <div id="table_search_option">
          <form action="{{ route('admin.product_stock_list', 'all') }}" method="GET"> 
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="input-group">
                  <input type="text" name="term_product" class="search-query form-control" placeholder="Search by Product name or Product Price or Stock Quantity" value="{{ $search_value }}" />
                  <div class="input-group-btn">
                    <button class="btn btn-primary" type="submit">
                      <span class="fa fa-search"></span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>  
        </div>      
        <table class="table table-bordered admin-data-table admin-data-list">
          <thead class="thead-dark">
            <tr>
              <th>{!! trans('admin.product_image') !!}</th>
              <th>{!! trans('admin.product_name') !!}</th>
              <th>{!! trans('admin.product_sku') !!}</th>
              <th>{!! trans('admin.product_type') !!}</th>
              <th>{!! trans('admin.product_price') !!}</th>
              <th>{!! trans('admin.product_status') !!}</th>
              <th>BV Points</th>
              <th>Stock Qty</th>
              <th>{!! trans('admin.vendor_name_label') !!}</th>
              <th>{!! trans('admin.action') !!}</th>
            </tr>
          </thead>
          <tbody>
            @if($product_all_data->count() > 0)  
              @foreach($product_all_data as $row)
              <tr>
                @if(!empty($row->image_url))
                  <td><img src="{{ get_image_url($row->image_url) }}" alt="{{ basename ($row->image_url) }}"></td>
                @else
                  <td><img src="{{ default_placeholder_img_src() }}" alt=""></td>
                @endif

                <td>{!! $row->title !!}</td>

                <td>{!! $row->sku !!}</td>

                @if($row->type == 'simple_product')
                  <td>{!! trans('admin.simple_product') !!}</td>
                @elseif($row->type == 'configurable_product')
                  <td>{!! trans('admin.configurable_product') !!}</td>
                @elseif($row->type == 'downloadable_product')  
                  <td>{!! trans('admin.downloadable_product') !!}</td>
                @else
                  <td>{!! trans('admin.customizable_product') !!}</td>
                @endif

                <td>{!! price_html_for_list( $row->price, $settings) !!}</td>

                @if($row->status == 1)
                <td>{!! trans('admin.enable') !!}</td>
                @else
                <td>{!! trans('admin.disable') !!}</td>
                @endif

                <td>{!! $row->bv_points !!}</td>
                 <td><span class="badge badge-danger"> {!! $row->stock_qty !!} </span></td>
                <td>{!! $row->display_name !!}</td>
                
                <td>
                  <div class="btn-group">
                    <button class="btn btn-success btn-flat" type="button">{!! trans('admin.action') !!}</button>
                    <button data-toggle="dropdown" class="btn btn-success btn-flat dropdown-toggle" type="button">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul role="menu" class="dropdown-menu">
                      <li><a target="_blank" href="{{ route( 'details-page', $row->slug ) }}"><i class="fa fa-edit"></i>{!! trans('admin.view') !!}</a></li>
                      @if(in_array('add_edit_delete_product', $user_permission_list)) 
                        <li><a href="{{ route('admin.update_product_content', $row->slug) }}"><i class="fa fa-edit"></i>{!! trans('admin.edit') !!}</a></li>
                      @endif
                      @if(in_array('add_edit_delete_product', $user_permission_list)) 
                        <li><a class="remove-selected-data-from-list" data-track_name="product_list" data-id="{{ $row->id }}" href="#"><i class="fa fa-remove"></i>{!! trans('admin.delete') !!}</a></li>
                      @endif
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            @else
              <tr><td colspan="8"><i class="fa fa-exclamation-triangle"></i> {!! trans('admin.no_data_found_label') !!}</td></tr>
            @endif
          </tbody>
          <tfoot class="thead-dark">
            <tr>
              <th>{!! trans('admin.product_image') !!}</th>
              <th>{!! trans('admin.product_name') !!}</th>
              <th>{!! trans('admin.product_sku') !!}</th>
              <th>{!! trans('admin.product_type') !!}</th>
              <th>{!! trans('admin.product_price') !!}</th>
              <th>{!! trans('admin.product_status') !!}</th>
              <th>BV Points</th>
              <th>Stock Qty</th>
              <th>{!! trans('admin.vendor_name_label') !!}</th>
              <th>{!! trans('admin.action') !!}</th>
            </tr>
          </tfoot>
        </table>
          <br>
        <div class="products-pagination">{!! $product_all_data->appends(Request::capture()->except('page'))->render() !!}</div>  
      </div>
    </div>
  </div>
</div>
@endsection