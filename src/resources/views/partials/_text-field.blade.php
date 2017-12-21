<div class="form-group">
  <label for="{{$key}}" class="col-md-12">{{ucfirst($key)}}</label>
  <div class="col-md-12">
    <textarea class="form-control" name="{{$key}}" rows="8" cols="80">
      @if(!empty($data))
        {{$data[$key]}}
      @endif
    </textarea>
  </div>
</div>
