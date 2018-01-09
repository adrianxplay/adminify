@extends('adminify::layouts.layout')

@push('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script> --}}

  @if ($errors->any())
    @include('adminify::js._error')
  @endif
@endpush

@push('css')
  <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" />
@endpush

@section('content')
  <div class="row">
      <div class="col-md-8 col-lg-8 col-sm-8">
          <div class="card">
            <div class="header">
              <h4 class="title">EDIT {{strtoupper($slug)}}</h4>
            </div>
            <div class="content">
              <form action="{{route('adminify.update-model', [
                'slug' => $slug,
                'id' => $id
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

                @if(! sizeof($relationships))
                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                @endif
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
      </div>
      <div class="col-md-4 col-lg-4 col-sm-4">
        <div class="card">
          <div class="header">
            <h4 class="title">{{strtoupper($slug)}} PREVIEW</h4>
          </div>
          <div class="content"></div>
        </div>
      </div>
  </div>
  @if (sizeof($relationships))
    @foreach ($relationships as $type => $classes)
      @foreach ($classes as $class => $elements)
        @if($type === "oneToOne")
        @elseif($type === "oneToMany")
        @elseif($type === "manyToMany")
          @include('adminify::partials._manyToMany', [
            'class' => $class,
            'elements' => $elements
          ])
        @endif
      @endforeach
    @endforeach
  @endif
  <div class="row">
    <div class="col-md-8 col-lg-8">
      <div class="card">
        <div class="content">
          <button type="submit" id="update-model" class="btn btn-info btn-fill">Update</button>
        </div>
      </div>
    </div>
  </div>

@endsection
