@extends('layouts.admin.master')
@section('title', 'Distributor Report' .' < '. get_site_title())

@section('content')
@include('pages-message.notify-msg-error')
@include('pages-message.form-submit')

<form class="form-horizontal" method="post" action="{{ route('export-distributor-report') }}" enctype="multipart/form-data">
  @include('includes.csrf-token')
  
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Create Distributor Report</h3>
      <div class="pull-right">
        <button class="btn btn-block btn-primary btn-sm" type="submit">Create Report</button>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-8">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">From Date</h3>
        </div>
        <div class="box-body">
          <input type="date" placeholder="From Date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}">
        </div>
      </div>

      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-text-width"></i>
          <h3 class="box-title">To Date</h3>
        </div>
        <div class="box-body">
          <input type="date" placeholder="To Date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}">
        </div>
      </div>


    </div>
  </div>

 

  <input type="hidden" name="hf_post_type" id="hf_post_type" value="add_post">

</form>


@endsection