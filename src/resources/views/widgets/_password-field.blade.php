<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="{{$key}}">{{ucfirst($key)}}</label>
        <input name="{{$key}}" type="password" class="form-control" placeholder="password">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="{{$key}}">{{ucfirst($key)}} confirm</label>
      <input name="{{$key}}_confirmation" type="password" class="form-control" placeholder="password confirmation">
    </div>
  </div>
</div>
