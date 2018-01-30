@extends('adminify::layouts.layout')

@section('content')

  {{-- {{dd($properties, $model)}} --}}

  <div class="row" id="app">
    <div class="col-md-12 col-lg-12 col-sm-12" :synctest="test">
        <div class="card">
          <div class="header">
            <h4 class="title">CREATE {{strtoupper($slug)}}</h4>
          </div>
          <div class="content">
            <form action="{{route('adminify.create-model', [
              'slug' => $slug
              ])}}" method="POST" @submit.prevent="pushdata">

              @foreach ($properties as $key => $value)
                @php
                  $name = $value['field_type'];
                  $view_name = "adminify::widgets._input-field";
                @endphp
                @if($name !== "primary")
                  @include($view_name, ['field' => $key])
                @endif
              @endforeach

              <button :disabled="requesting" type="submit" class="btn btn-primary btn-fill pull-right">Create</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
    </div>

    <div class="col-sm-12">
      @foreach ($model->meta['relationships'] as $type => $collections)
        @foreach ($collections as $index => $collection)
          @php
            $vueReference = "model.meta.relationships.$type"."[$index]";
          @endphp

          <div class="col-md-4 col-lg-4">

            @include("adminify::widgets._$type", [
              'reference' => $vueReference,
              'index' => $index,
              'type' => $type
            ])
          </div>

        @endforeach
      @endforeach

    </div>

  </div>

@endsection

@push('css')
  <link rel="stylesheet" href="{{mix('vendor/adminify/css/components.css')}}">
@endpush

@push('js')
  @if ($errors->any())
    @include('adminify::js._error')
  @endif

  <script>
    window.adminify = {
      model: <?php echo $model; ?>,
      form: {
        route: "{{route('adminify.create-model', ['slug' => $slug])}}"
      }
    }
  </script>

  <script src="{{asset('js/vue.js')}}"></script>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{mix('vendor/adminify/js/components.js')}}"></script>
@endpush
