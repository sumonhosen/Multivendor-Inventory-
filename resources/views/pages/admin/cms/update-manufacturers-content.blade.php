@extends('layouts.admin.master')
@section('title', trans('admin.update_manufacturers') .' < '. get_site_title())

@section('content')
@if($manufacturers_update_data)

@include('pages-message.notify-msg-success')
@include('pages-message.form-submit')

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  @include('includes.csrf-token')
  
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Update Downloads &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="{{ route('admin.manufacturers_list_content') }}">Download List</a>&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="{{ route('admin.add_manufacturers_content') }}">Add More Downloads</a></h3>
      <div class="pull-right">
        <button class="btn btn-primary pull-right btn-sm" type="submit">{{ trans('admin.update') }}</button>
      </div>
    </div>
  </div>
  
<div class="box box-solid">
  <div class="box-body">
    <div class="form-group">
      <div class="row">  
        <label class="col-sm-3 control-label" for="inputManufacturersName">Download Title</label>
        <div class="col-sm-9">
          <input type="text" placeholder="{{ trans('admin.manufacturers_name') }}" id="inputManufacturersName" name="inputManufacturersName" class="form-control" value="{{ $manufacturers_update_data['name'] }}">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="row">    
        <label class="col-sm-3 control-label" for="inputCountryName">{{ trans('admin.country_name') }}</label>
        <div class="col-sm-9">
          <input type="text" placeholder="{{ trans('admin.country_name') }}" id="inputCountryName" name="inputCountryName" class="form-control" value="{{ $manufacturers_update_data['brand_country_name'] }}">
        </div>
      </div>
    </div>
    <!--<div class="form-group">
      <div class="row">    
        <label class="col-sm-3 control-label" for="inputShortDescription">{{ trans('admin.short_description') }}</label>
        <div class="col-sm-9">
          <textarea id="inputShortDescription" name="inputShortDescription" class="dynamic-editor" placeholder="{{ trans('admin.short_description') }}">
           {!! string_decode( $manufacturers_update_data['brand_short_description'] ) !!}
          </textarea>
        </div>
      </div>
    </div>-->
    <!--<div class="form-group">
      <div class="row">    
        <label class="col-sm-3 control-label" for="inputShortDescription">PDF URL</label>
        <div class="col-sm-9">
          <input type="text" name="logo_img" class="form-control" id="logo_img" value="{{ $manufacturers_update_data['brand_logo_img_url'] }}">
        </div>
      </div>
    </div>-->
    <div class="form-group">
      <div class="row">    
        <label class="col-sm-3 control-label" for="inputStatus">{{ trans('admin.status') }}</label>
        <div class="col-sm-9">
          <select class="form-control select2" name="inputStatus" style="width: 100%;">

            @if($manufacturers_update_data['status'] == 1)
            <option selected="selected" value="1">{{ trans('admin.enable') }}</option>
            @else
            <option value="1">{{ trans('admin.enable') }}</option>
            @endif

            @if($manufacturers_update_data['status'] == 0)
            <option selected="selected" value="0">{{ trans('admin.disable') }}</option>
            @else
            <option value="0">{{ trans('admin.disable') }}</option>
            @endif

          </select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="row">    
        <label class="col-sm-3 control-label" for="inputUploadLogo">Upload PDF</label>
        <div class="col-sm-9">
          <div class="uploadform dropzone no-margin dz-clickable upload-manufacturers-logo" id="inputUploadLogo" name="inputUploadLogo">
            <div class="dz-default dz-message">
              <span>{{ trans('admin.drop_your_cover_picture_here') }}</span>
            </div>
          </div>
          <br>
          <div class="manufacturers-img-content">
        	@if($manufacturers_update_data['brand_logo_img_url'])
            <div class="manufacturers-sample-img"><a target="_blank" href="{{ url($manufacturers_update_data['brand_logo_img_url']) }}"><img class="img-responsive" src="{{ url('/public/images/pdf.png') }}" alt=""></a></div>
            @else
            <div class="manufacturers-sample-img"><img class="img-responsive" src="{{ url('/public/images/pdf.png') }}" alt=""></div>
            @endif
            <div class="manufacturers-img"><a href=""><img class="img-responsive" src="{{ url('/public/images/pdf.png') }}" alt=""></a></div>
            <br>
            <div class="manufacturers-img-remove-btn">
              <button type="button" class="btn btn-default attachtopost remove-manufacturers-img">Remove File</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<input type="hidden" name="logo_img" id="logo_img" value="{{ $manufacturers_update_data['brand_logo_img_url'] }}">
</form>

@endif
@endsection