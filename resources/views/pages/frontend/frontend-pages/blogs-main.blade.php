@extends('layouts.frontend.master')
@section('title',  trans('frontend.blogs_page_title') .' < '. get_site_title() )

@section('content')
<br>
<div class="container new-container">
  @include( 'frontend-templates.blog.' .$appearance_settings['blogs']. '.' .$appearance_settings['blogs'] )
</div>
@endsection  