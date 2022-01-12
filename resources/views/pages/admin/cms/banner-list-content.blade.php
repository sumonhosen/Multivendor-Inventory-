@extends('layouts.admin.master')
@section('title', 'All Banners' .' < '. get_site_title())

@section('content')
@include('pages-message.notify-msg-error')
@include('pages-message.notify-msg-success')
<div class="row">
  <div class="col-6">
    <h5>All Banner</h5>
  </div>
  <div class="col-6">
    <div class="pull-right">
      <a href="{{ route('admin.banner_add') }}" class="btn btn-primary btn-sm">Add New Banner</a>
    </div>  
  </div>
</div>
<br>
<div class="row">
  <div class="col-12">
    <div class="box">
      <div class="box-body">

        <table id="table_for_manufacturers_list" class="table table-bordered admin-data-table admin-data-list">
          <thead class="thead-dark">
            <tr>
              <th>Image</th>
              <th>Heading</th>
              <th>Button title</th>
              <th>Button Link</th>
              <th>{!! trans('admin.status') !!}</th>
              <th>{!! trans('admin.action') !!}</th>
            </tr>
          </thead>
          <tbody>
            @if(count($banner)>0)
              @foreach($banner as $row)
                <tr>
                  @if(!empty($row->image))
                    <td><img src="{{ asset('public/uploads/' . $row->image) }}" alt="{{ basename ($row->image) }}"></td>
                  @else
                    <td><img src="{{ default_placeholder_img_src() }}" alt=""></td>
                  @endif

                  <td>{!! $row->title !!}</td>
                  <td>{!! $row->button_title !!}</td>
                  <td>{!! $row->button_link !!}</td>

                  @if($row->status == 1)
                    <td>{!! trans('admin.enable') !!}</td>
                  @else
                    <td>{!! trans('admin.disable') !!}</td>
                  @endif

                  <td>
                    <div class="btn-group">
                      <button class="btn btn-success btn-flat" type="button">{!! trans('admin.action') !!}</button>
                      <button data-toggle="dropdown" class="btn btn-success btn-flat dropdown-toggle" type="button">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul role="menu" class="dropdown-menu">

                          <li><a href="{{ route('admin.update_banner_content', $row->id) }}"><i class="fa fa-edit"></i>{!! trans('admin.edit') !!}</a></li>
                          <li><a class="remove-selected-data-from-list" data-track_name="banner_list" data-id="{{ $row->id }}" href="#"><i class="fa fa-remove"></i>{!! trans('admin.delete') !!}</a></li>
                        
                      </ul>
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
            <tr><td colspan="4"><i class="fa fa-exclamation-triangle"></i> {!! trans('admin.no_data_found_label') !!}</td></tr>
            @endif
          </tbody>

        </table>

      </div>
    </div>
  </div>
</div>
@endsection