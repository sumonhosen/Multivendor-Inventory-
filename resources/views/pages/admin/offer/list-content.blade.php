@extends('layouts.admin.master')
@section('title', 'Offer Lists' .' < '. get_site_title())

@section('content')
<div class="row">
  <div class="col-6">
    <h5>Offer Lists</h5>
  </div>
  <div class="col-6">
    <div class="pull-right">
      <a href="{{ route('admin.add_offer') }}" class="btn btn-primary pull-right btn-sm">Add Offer</a>
    </div>  
  </div>
</div>
<br>
<div class="row">
  <div class="col-12">
    <div class="box">
      <div class="box-body">

        <table class="example table table-bordered admin-data-table admin-data-list">
          <thead class="thead-dark">
            <tr>
              <th>Offer Title</th>
              <th>From Price</th>
              <th>To Price</th>
              <th>Product to get as offer</th>
              <th>Discounted Price</th>
              <th>Expiry Date</th>
              <th>Status</th>
              <th>{!! trans('admin.action') !!}</th>
            </tr>
          </thead>
          <tbody>
            @if(count($pages_list)>0)
              @foreach($pages_list as $row)
                <tr>
                  <td>{!! $row->offer_title !!}</td>
                  <td>{!! $row->from_price !!}</td>
                  <td>{!! $row->to_price !!}</td>
                  <td>{!! $row->ptitle !!}</td>
                  <td>{!! $row->discounted_price !!}</td>
                  <td>{!! $row->expiry_date !!}</td>
                  <td>
                    @if($row->ostatus == 1)
                      <span class="badge badge-success">Active</span>
                    @elseif ($row->ostatus == 0 )
                      <span class="badge badge-danger">Expired</span>
                    @endif

                  </td>


                  <td>
                    <div class="btn-group">
                      <button class="btn btn-success btn-flat" type="button">{!! trans('admin.action') !!}</button>
                      <button data-toggle="dropdown" class="btn btn-success btn-flat dropdown-toggle" type="button">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul role="menu" class="dropdown-menu">

                          <li><a class="remove-selected-data-from-list" data-track_name="offer_list" data-id="{{ $row->oid }}" href="#"><i class="fa fa-remove"></i>{!! trans('admin.delete') !!}</a></li>
                  
                      </ul>
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
            <tr><td colspan="3"><i class="fa fa-exclamation-triangle"></i> {!! trans('admin.no_data_found_label') !!}</td></tr>
            @endif
          </tbody>
      
        </table>
        <br>

      </div>
    </div>
  </div>
</div>
@endsection