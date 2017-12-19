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
              <h3 class="box-title">Users</h3>
              <div class="table-responsive">
                  <table class="table">
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
                  <div class="dataTables_info pull-right" role="status" aria-live="polite">
                    Showing {{$data->currentPage() * 10}} of {{$data->total()}} entries
                  </div>
                  <div class="dataTables_paginate paging_simple_numbers">
                    {{$data->links()}}
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection
