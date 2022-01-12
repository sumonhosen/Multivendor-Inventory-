@extends('layouts.admin.master')
@section('title', 'create offer' .' < '. get_site_title())

@section('content')
@include('pages-message.form-submit')
@include('pages-message.notify-msg-error')
@include('pages-message.notify-msg-success')

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
@include('includes.csrf-token')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">create offer &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="{{ route('admin.all_offers') }}">All Offers</a></h3>
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
          <h3 class="box-title">Offer Title</h3>
        </div>
        <div class="box-body">
          <input type="text" placeholder="Offer Title" class="form-control" name="offer_title" id="" value="{{ old('offer_title') }}" required="">
        </div>
      </div>


      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">From Price</h3>
        </div>
        <div class="box-body">
          <input type="text" placeholder="from price" class="form-control" name="from_price" id="" value="{{ old('from_price') }}" required="">
        </div>
      </div>

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">To Price</h3>
        </div>
        <div class="box-body">
          <input type="text" placeholder="To price" class="form-control" name="to_price" id="" value="{{ old('to_price') }}" required="">
        </div>
      </div>

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Select Product</h3>
        </div>
        <div class="box-body">
          <select class="form-control" name="product" required="">
            <option value="">Select</option>
            @foreach ($product_all_data as $prow)
              <option value="{{ $prow->id }}">{{ $prow->title }}</option>
            @endforeach
          </select>
        </div>
      </div>

       <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">Discounted Price</h3>
        </div>
        <div class="box-body">
          <input type="text" placeholder="Discounted Price" class="form-control" name="discounted_price" id="" value="{{ old('discounted_price') }}" required="">
        </div>
      </div>




    </div>
    <div class="col-md-4">

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-calendar"></i>
          <h3 class="box-title">Offer Expiry</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <div class="row">  
              <label class="col-sm-4 control-label" for="inputVisibility">Offer Expiry Date</label>
              <div class="col-sm-8">
                    <input type="date" placeholder="Expiry Date" class="form-control" name="expiry_date" id="" value="{{ old('expiry_date') }}" required="">                           
              </div>
            </div>
          </div>
        </div>
      </div>

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
                <select class="form-control select2" name="pages_visibility" style="width: 100%;">
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
</form>

@endsection