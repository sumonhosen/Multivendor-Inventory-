@extends('layouts.admin.master')

@section('title', trans('admin.add_page_title') .' < '. get_site_title())



@section('content')

@include('pages-message.form-submit')

@include('pages-message.notify-msg-error')

@include('pages-message.notify-msg-success')



<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">

@include('includes.csrf-token')

  <div class="box">

    <div class="box-header">

      <h3 class="box-title">{!! trans('admin.add_new_page_top_title') !!} &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-sm" href="{{ route('admin.all_pages') }}">{!! trans('admin.all_pages_list') !!}</a></h3>

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

          <h3 class="box-title">{!! trans('admin.page_title') !!}</h3>

        </div>

        <div class="box-body">

          <input type="text" placeholder="{{ trans('admin.example_pages_placeholder') }}" class="form-control" name="page_title" id="seo_url_format" value="{{ old('page_title') }}">

        </div>

      </div>

        

      <div class="box box-solid">

        <div class="box-header with-border">

          <i class="fa fa-text-width"></i>

          <h3 class="box-title">{!! trans('admin.description') !!}</h3>

        </div>

        <div class="box-body">

          <textarea id="page_description_editor" name="page_description_editor" class="dynamic-editor" placeholder="{{ trans('admin.post_description_placeholder') }}"></textarea>

        </div>

      </div>





       <div class="box box-solid">

        <div class="box-header with-border">

          <i class="fa fa-text-width"></i>

          <h3 class="box-title">Meta Tags</h3>

        </div>

        <div class="box-body">

          <div class="seo-preview-content">

            <!-- <p><i class="fa fa-eye"></i> {!! trans('admin.google_search_preview_label') !!}</p><hr> -->

           <!--  <h3>{!! trans('admin.product_title_label') !!}</h3>

            <p class="link">{!! url('/') !!}/<span>{!! string_slug_format( trans('admin.product_title_label') ) !!}</span></p>

            <p class="description">{!! trans('admin.seo_description_label') !!}</p>
 -->
          </div><hr>

          <div class="seo-content">

            <!-- <div class="form-group">  

              <div class="row">    

                <div class="col-md-12">

                  <input type="text" class="form-control" name="seo_title" id="seo_title" placeholder="" value="">

                </div> 

              </div>    

            </div>

 -->

            <div class="form-group">

              <div class="row">   

                <div class="col-md-12">  

                  <textarea id="seo_description" class="form-control" name="seo_description" placeholder="{{ trans('admin.seo_description_label') }}"></textarea>

                </div>

              </div>    

            </div>  

            <div class="form-group">   

              <div class="row">   

                <div class="col-md-12">  

                  <textarea id="seo_keywords" class="form-control" name="seo_keywords" placeholder="{{ trans('admin.seo_keywords_label') }}"></textarea>

                </div>

              </div>    

            </div>

          </div>  

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