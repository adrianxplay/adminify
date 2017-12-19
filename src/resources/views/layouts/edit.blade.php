@extends('adminify::layouts.layout')

@section('content')

  <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">Users</h4> </div>
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
              <h3 class="box-title">Edit User</h3>
                <form action="" class="form-horizontal">
                  @foreach ($properties as $prop)
                    <div class="form-group">
                      <label for="{{$prop}}" class="col-md-12">{{$prop}}</label>
                      <div class="col-md-12">
                        <input type="text" class="form-control" value="{{$data[$prop]}}">
                      </div>
                    </div>
                  @endforeach
                  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Update</button>
                </form>
          </div>
      </div>
  </div>

@endsection
