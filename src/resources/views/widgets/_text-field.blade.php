<div class="form-group">
  <label for="{{$key}}" class="col-md-12">{{ucfirst($key)}}</label>
  <div class="col-md-12">
    @if(!empty($data))
      <textarea class="form-control" name="{{$key}}" rows="8" cols="80">{{$data[$key]}}</textarea>
    @else
      <textarea class="form-control" name="{{$key}}" rows="8" cols="80"></textarea>
    @endif
  </div>
</div>
