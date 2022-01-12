@extends('layouts.admin.master')
@section('title', 'Product Log History' .' < '. get_site_title())


@section('content')
<div class="row">
  <div class="col-6">
    <h5>Inventory Log</h5>
  </div>
  <div class="col-6">

  </div>
</div>


<div class="row">
  <div class="col-12">

        <div class="products-export-import-options">
        <ul style="padding: 0px;">
                    {{-- <a href="{{ route('export-low-stock-products') }}"><li><div class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> {!! trans('admin.export_label') !!}</div></li></a> --}}

                </ul>
            </div>

    <div class="box">
      <div class="box-body">
        <div id="table_search_option">
          <form action="" method="GET">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="input-group">
                  <input type="text" name="term_product" class="search-query form-control" placeholder="Search by Product name or Product Price or Stock Quantity"  />
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

        <table class="table table-bordered admin-data-table admin-data-list" id="table_id">
          <thead class="thead-dark">
            <tr>
              <th>Product Title</th>
              <th>Order</th>
              <th>Previous Stock</th>
              <th>Stock In/Out</th>
              <th>Current Stock</th>
              <th>Created By</th>
            </tr>
          </thead>
          <tbody>
            @if($inventory_logs->count() > 0)
              @foreach($inventory_logs as $row)

              <tr>
                <td class="text-center">{{$row->inventory_log->title}}</td>

                <td class="text-center">
                    @if($row->order_id)
                    <a href="{{ route('admin.view_order_details',$row->order_id??'') }}">Order # {{$row->order_id}}
                    </a>
                    @else
                    Empty
                    @endif
                </td>
                <td class="text-center">{{$row->previous_stock}}</td>
                <td class="text-center">
                    @if($row->order_id)
                        <span style="color:red">
                            {{$row->stock_in_or_out}}
                        </span>
                    @else
                        <span style="color:green">
                            {{$row->stock_in_or_out}}
                        </span>
                    @endif
                </td>
                <td class="text-center">{{$row->current_stock}}</td>
                <td class="text-center">{{ $row->create_order->name ??''}}</td>
              </tr>
              @endforeach
            @else
              <tr><td colspan="8"><i class="fa fa-exclamation-triangle"></i> {!! trans('admin.no_data_found_label') !!}</td></tr>
            @endif
          </tbody>
          <tfoot class="thead-dark">
            <tr>
                <th>Product Title</th>
                <th>Order</th>
                <th>Previous Stock</th>
                <th>Current Stock</th>
                <th>Stock In Or Out</th>
                <th>Created By</th>
            </tr>
          </tfoot>
        </table>
          <br>
        {{-- <div class="products-pagination">{!! $product_all_data->appends(Request::capture()->except('page'))->render() !!}</div> --}}
      </div>
    </div>
  </div>
</div>
@endsection
