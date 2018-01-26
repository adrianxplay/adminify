<adminify-text inline-template
 :field="{{$field}}" field_name="{{$key}}">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="{{$key}}">{{ucfirst($key)}}</label>
        <textarea
          :value="property"
          @input="updateField($event.target.value)"
          name="{{$key}}" type="text" class="form-control"
          rows="8" cols="80"></textarea>
      </div>
    </div>
  </div>
</adminify-text>
