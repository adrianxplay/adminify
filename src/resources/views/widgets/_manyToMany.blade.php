<adminify-manyToMany
  inline-template
  :inputs="{{$reference}}.collection"
  :name="{{$reference}}.name"
  :class_name="{{$reference}}.class"
  :subscribed="{{$reference}}.subscribed"
  :to-subscribe="{{$reference}}.to_subscribe"
  :to-unsubscribe="{{$reference}}.to_unsubscribe"
  index="{{$index}}"
  relation-type="{{$type}}">
  <div class="card card-widget adminify-manytomany">
    <div class="header">
      <h4 class="title">@{{name}}</h4>
    </div>
    <div class="content">
      <div class="col-md-12">
        <div class="col-sm-9">
          <input v-model="query" type="text" class="form-control" placeholder="filter">
        </div>
        <div class="col-sm-3">
          <button class="btn btn-primary btn-fill" @click="clearFilter">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </button>
        </div>
      </div>

      <div class="col-sm-12" v-if="!anyData">
        {{-- TODO: translate this --}}
        <label for="" class="adminify-error">
          No hay resultados que mostrar :(
        </label>
      </div>

      <div class="col-sm-12">
        <ul>
          <li v-for="input in dataset">
            <div v-show="input.visible">
              <label>
                <input type="checkbox" :checked="input.checked" @change="toggle(input)">
                @{{input.description}}
              </label>
            </div>
          </li>
        </ul>
      </div>

      <div class="clearfix"></div>

    </div>
  </div>
</adminify-manyToMany>
