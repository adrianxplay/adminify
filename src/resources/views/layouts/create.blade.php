@extends('adminify::layouts.layout')

@section('content')

  {{-- {{dd($properties, $model)}} --}}

  <div class="row" id="app">
    <div class="col-md-6 col-lg-6 col-sm-6">
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

              <button :disabled="requesting" type="submit" class="btn btn-info btn-fill pull-right">Create</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-sm-6">

      <adminify-multiple
        inline-template
        :inputs="model.meta.relationships.manyToMany">
        <div class="card">
          <div class="header">
            <h4 class="title">LAURA SAD</h4>
          </div>
          <div class="content">
            <div class="row">
              <div class="col-sm-12">
                <input v-model="query" type="text" class="form-control" placeholder="filter">
              </div>
            </div>

            <div class="row" v-for="inputs in chunks">
              <div class="col-sm-4" v-for="input in dataset">
                <adminify-multiple-checkbox :input="input" :query="query">
                </adminify-multiple-checkbox>
              </div>
            </div>

          </div>
        </div>
      </adminify-multiple>

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
