<adminify-string inline-template
 :field="{{$field}}" field_name="{{$key}}">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="{{$key}}">{{ucfirst($key)}}</label>
        <input
          :value="property"
          @input="updateField($event.target.value)"
          name="{{$key}}" type="text" class="form-control">
      </div>
    </div>
  </div>
</adminify-string>
