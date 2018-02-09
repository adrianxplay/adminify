<adminify-manytomany
  inline-template
  :collection="{{$reference}}.collection"
  :name="{{$reference}}.name"
  :class_name="{{$reference}}.class"
  :subscribed="{{$reference}}.subscribed"
  :to-subscribe="{{$reference}}.to_subscribe"
  :to-unsubscribe="{{$reference}}.to_unsubscribe"
  index="{{$index}}"
  :submit-flag="submited"
  relation-type="{{$type}}">

  <div class="col-sm-12 adminify-multiselect">

    <div class="col-sm-5 list">
      <div class="col-sm-12">
        <div
          v-for="element in dataset"
          class="list-element"
          v-if="element.visible"
          @click="subscribe(element)">
          @{{element.description}}
        </div>
      </div>
    </div>

    <div class="col-sm-2">
      <button
        class="btn btn-primary btn-fill">
        >>
      </button>

      <button
        class="btn btn-primary btn-fill"
        @click="unsubscribeAll"
      >
        <<
      </button>
    </div>

    <div class="col-sm-5 list">
      <div class="col-sm-12">
        <div
          v-for="(element, index) in toSubscribe"
          class="list-element"
          @click="unsubscribe(element, index)">
          @{{element.description}}
        </div>
      </div>
    </div>

  </div>

</adminify-manytomany>
