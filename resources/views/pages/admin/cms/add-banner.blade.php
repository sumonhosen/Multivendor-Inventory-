@extends('layouts.admin.master')
@section('title', 'add banner' .' < '. get_site_title())

@section('content')
@include('pages-message.form-submit')
@include('pages-message.notify-msg-error')
@include('pages-message.notify-msg-success')

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  @include('includes.csrf-token')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Add New Banner &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="{{ route('admin.banner_list_content') }}">All Banners</a></h3>
      <div class="pull-right">
        <button class="btn btn-primary btn-sm" type="submit">{!! trans('admin.save') !!}</button>
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
          <input type="text" placeholder="Title" class="form-control" name="title" id="title" value="{{ old('title') }}">
        </div>
      </div>

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Button Title</h3>
        </div>
        <div class="box-body">
          <input type="text" placeholder="Button Title" class="form-control" name="button_title" id="button_title" value="{{ old('button_title') }}">
        </div>
      </div>

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-link"></i>
          <h3 class="box-title">Button Link</h3>
        </div>
        <div class="box-body">
          <input type="text" placeholder="Button Link" class="form-control" name="button_link" id="button_link" value="{{ old('button_link') }}">
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
              <label class="col-sm-4 control-label" for="inputVisibility">{!! trans('admin.blog_post_status') !!}</label>
              <div class="col-sm-8">
                <select class="form-control select2" name="status" style="width: 100%;">
                  <option selected="selected" value="1">{!! trans('admin.enable') !!}</option>
                  <option value="0">{!! trans('admin.disable') !!}</option>                  
                </select>                                         
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>  
  </div>
  <input type="hidden" name="hf_post_type" id="hf_post_type" value="add">
  <input type="hidden" name="image_url" id="image_url">
</form>
@endsection