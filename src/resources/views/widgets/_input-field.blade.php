@php
  $data = "model.$field";
  $errors = "model.errors.$field";
@endphp
<adminify-input inline-template
 :field="{{$data}}"
 :errors="{{$errors}}"
 field_name="{{$key}}"
 >
  <div class="row">
    <div class="col-md-12">
      <div :class="errors.length > 0 ? 'form-group form-group-danger' : 'form-group' ">
        <label for="{{$key}}">{{ucfirst($key)}}</label>
        <input
          :value="property"
          @input="updateField($event.target.value)"
          name="{{$key}}" type="text" class="form-control">
        <label v-show="errors.length > 0">
          <ul>
            <li v-for="error in errors">
              @{{error}}
            </li>
          </ul>
        </label>
      </div>
    </div>
  </div>
</adminify-input>
