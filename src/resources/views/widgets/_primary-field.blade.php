<adminify-primary inline-template>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="{{$key}}">{{ucfirst($key)}}</label>
        <input name="{{$key}}" type="text" class="form-control" value="{{$data[$key]}}" disabled>
      </div>
    </div>
  </div>
</adminify-primary>
