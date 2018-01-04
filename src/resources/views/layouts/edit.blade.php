@extends('adminify::layouts.layout')

@section('content')

  <div class="row">
      <div class="col-md-8 col-lg-8 col-sm-8">
          <div class="card">
            <div class="header">
              <h4 class="title">EDIT {{strtoupper($slug)}}</h4>
            </div>
            <div class="content">
              <form action="{{route('adminify.create-model', [
                'slug' => $slug
                ])}}" method="POST">

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

                <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
      </div>
  </div>

@endsection

@section('js')
  @if ($errors->any())
    @include('adminify::js._error')
  @endif
@endsection
