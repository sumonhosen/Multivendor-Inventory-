@extends('layouts.admin.master')
@section('title', 'Update Banner' .' < '. get_site_title())

@section('content')
@include('pages-message.form-submit')
@include('pages-message.notify-msg-error')
@include('pages-message.notify-msg-success')

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  @include('includes.csrf-token')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Update Banner &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="{{ route('admin.banner_list_content') }}">All Banners</a>&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="{{ route('admin.banner_add') }}">Add New Banner</a>&nbsp;&nbsp;

        <a class="btn btn-default btn-sm" target="_blank" href="#" style="display:none;">ff</a></h3>
      <div class="pull-right">
        <button class="btn btn-primary btn-sm" type="submit">{!! trans('admin.update') !!}</button>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-8">

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Banner Title</h3>
        </div>
        <div class="box-body">
          <input type="text" placeholder="Title" class="form-control" name="title" id="title" value="{!! $banner['title'] !!}">
        </div>
      </div>


      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Button Title</h3>
        </div>
        <div class="box-body">
          <input type="text" placeholder="Button Title" class="form-control" name="button_title" id="button_title" value="{!! $banner['button_title'] !!}">
        </div>
      </div>

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-link"></i>
          <h3 class="box-title">Button Link</h3>
        </div>
        <div class="box-body">
          <input type="text" placeholder="Button Link" class="form-control" name="button_link" id="button_link" value="{!! $banner['button_link'] !!}">
        </div>
      </div>

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-image"></i>
          <h3 class="box-title">Banner Image</h3>
        </div>
        <div class="box-body">
          <input type="file" placeholder="Button Link" class="form-control" name="image" id="file" value="" accept="image/*" >
        </div>

        @if(!empty($banner['image']))
          <img src="{{ asset('public/uploads/' . $banner['image']) }}" alt="{{ basename ($banner['image']) }}" style="max-height: 100px;" >
        @endif

      </div>


    </div>
    <div class="col-md-4">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-eye"></i>
          <h3 class="box-title">{!! trans('admin.visibility') !!}</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <div class="row">  
              <label class="col-sm-4 control-label" for="inputVisibility">Status</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="status" style="width: 100%;">
                  @if($banner['status'] == 1)
                    <option selected="selected" value="1">{!! trans('admin.enable') !!}</option>
                  @else
                    <option value="1">{!! trans('admin.enable') !!}</option>
                  @endif

                  @if($banner['status'] == 0)
                    <option selected="selected" value="0">{!! trans('admin.disable') !!}</option>          
                  @else
                    <option value="0">{!! trans('admin.disable') !!}</option>
                  @endif      
                </select>                                         
              </div>
            </div>
          </div>
        </div>
      </div>
        

    </div>  
  </div>
  <input type="hidden" name="hf_post_type" id="hf_post_type" value="update">
  <input type="hidden" name="image_url" id="image_url" value="{{ $banner['image'] }}">
</form>

@endsection