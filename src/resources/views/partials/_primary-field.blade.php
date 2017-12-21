<div class="form-group">
  <label for="{{$key}}" class="col-md-12">{{ucfirst($key)}}</label>
  <div class="col-md-12">
      <input name="{{$key}}" type="text" class="form-control" value="{{$data[$key]}}" disabled>
  </div>
</div>
