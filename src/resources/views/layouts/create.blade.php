@extends('adminify::layouts.layout')

@section('content')

  <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">{{$slug}}</h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
              <li><a href="#">Dashboard</a></li>
          </ol>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- ============================================================== -->
  <!-- table -->
  <!-- ============================================================== -->
  <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12">
          <div class="white-box">
              @if ($errors->any())
                <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <p>
                      <strong>Error!</strong>
                      {{$error}}
                    </p>
                  @endforeach
                </div>
              @endif
              @if (session('success'))
                <div class="alert alert-success">
                  <p>{{session('success')}}</p>
                </div>
              @endif
              <h3 class="box-title">Edit {{$slug}}</h3>
                <form action="{{route('adminify.create-model', [
                  'slug' => $slug
                  ])}}" class="form-horizontal" method="POST">

                  {{ csrf_field() }}

                  @foreach ($properties as $key => $value)
                    @php
                      $name = $value['field_type'];
                      $view_name = "adminify::widgets._".$name."-field";
                    @endphp
                    @if($name !== "primary")
                      @include($view_name)
                    @endif
                  @endforeach

                  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Create</button>
                </form>
          </div>
      </div>
  </div>

@endsection
