@extends('adminify::layouts.layout')

@section('content')

  <div class="row">
      <div class="col-md-8 col-lg-8 col-sm-8">
          <div class="card">
            <div class="table-responsive">
              <table class="table table-hover table-stripped">
                <thead>
                    <tr>
                      @foreach ($properties as $property)
                        <th>{{$property}}</th>
                      @endforeach
                    </tr>
                </thead>
                <tbody>
                  @foreach ($data as $result)
                    <tr>
                      @php
                        $k = 0;
                      @endphp
                      @foreach ($properties as $property)
                        @if($k == 1)
                          <td>
                            <a href="{{route('adminify.edit-model', [
                              'slug' => $slug,
                              'id' => $result->id
                              ])}}">{{$result[$property]}}</a>
                          </td>
                        @else
                          <td>{{$result[$property]}}</td>
                        @endif
                        @php
                          $k++;
                        @endphp
                      @endforeach
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          {{$data->links()}}
      </div>
      <div class="col-md-4 col-lg-4">
        <div class="card">
          <div class="header">
            <h4 class="title">Filters</h4>
          </div>
        </div>
      </div>
  </div>

@endsection
