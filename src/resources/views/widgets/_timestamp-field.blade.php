<adminify-timestamp inline-template>
  <div class="form-group">
    <label for="{{$key}}" class="col-md-12">{{ucfirst($key)}}</label>
    <div class="col-md-12">
      @if(! empty($data))
        <input name="{{$key}}" type="text" class="form-control" value="{{$data[$key]}}">
      @else
        <input name="{{$key}}" type="text" class="form-control">
      @endif
    </div>
  </div>
</adminify-timestamp>
