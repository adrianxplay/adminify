<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label for="{{$key}}">{{ucfirst($key)}}</label>
        @if(! empty($data))
          <input name="{{$key}}" type="text" class="form-control" value="{{$data[$key]}}">
        @else
          <input name="{{$key}}" type="text" class="form-control">
        @endif
    </div>
  </div>
</div>
