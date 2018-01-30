let _ = require("lodash");
let Fuse = require("fuse.js");

Vue.component('adminify-input', {
  methods: {
    updateField(value){
      // this.errors = [];
      this.property = value;
      app.$emit('update-field', {
        value: value,
        property: this.field_name
      });
    }
  },
  props: ['field', 'field_name', 'errors'],
  data() {
    return {
      property: this.field
    }
  },
  watch: {
    field: function(next, previous){
      this.property = next;
    }
  }
});


Vue.component('adminify-manytomany', {
  props: [
    'inputs', 'name', 'class_name',
    'subscribed', 'to-subscribe',
    'to-unsubscribe', 'index', 'relation-type'
  ],
  data: function(){
    return {
      query: "",
      filter: null,
      dataset: _.map(this.inputs, function(input){
        input.visible = true;
        input.checked = false;
        return input;
      }),
      anyData: true,
    }
  },
  watch: {
    query: function(value){

      this.anyData = true;

      if(value == ""){
        for( i in this.dataset ){
          this.dataset[i].visible = true;
        }
        return true;
      }

      for(i in this.dataset){
        this.dataset[i].visible = false;
      }

      let data = this.filter.search(value);

      if(data.length == 0){
        this.anyData = false;
        return true;
      }

      for( i in data ){
        data[i].visible = true;
      }
    }
  },
  methods: {
    clearFilter: function(){
      this.query = "";
      this.anyData = true;
    },
    toggle: function(input){
      input.checked = !input.checked;

      var data = {
        data: input,
        index: this.index,
        type: this.relationType
      }

      switch (input.checked) {
        case true:
          var input = _.find(this.subscribed, function(e){
            return e.id == input.id;
          });
          if(input === undefined){
            app.$emit("subscribe", data);
          }
          break;
        case false:

          var input = _.find(this.subscribed, function(e){
            return e.id == input.id;
          });

          data.subscribed = typeof input === "object" ? true : false;

          app.$emit("unsubscribe", data);

          break;
        default:
          console.error("shit");
      }
    }
  },
  created: function(){
    this.filter = new Fuse(this.dataset, {
      keys: ['description', 'permission'],
      index: 'id'
    });
  },
});


Vue.component('adminify-onetoone',{

});


let app = new Vue({
  el: '#app',
  data: {
    model: window.adminify.model,
    requesting: false
  },
  methods: {
    test: function(){
      console.log('hola k ase');
    },
    pushdata(){
      this.requesting = true;
      var url = window.adminify.form.route;
      NProgress.start();

      return true;

      axios
        .post(url, this.model)
        .then(response => {
          console.log(response);
          NProgress.done();

          $.notify({
            icon: 'pe-7s-close-circle',
            message: "Process completed!"
          },{
              type: 'info',
              timer: 2000
          });

          cleanForm(this.model);
          app.$data.requesting = false;

        })
        .catch(fail => {
          console.log(fail);
          app.$data.requesting = false;
          $.notify({
            icon: 'pe-7s-close-circle',
            message: "something failed!"
          },{
              type: 'danger',
              timer: 2000
          });
          NProgress.done();
        });
    }
  },
  created: function(){
    this.model.errors = {};
    for(var key in this.model){
      if(key !== "meta") this.model.errors[key] = [];
    }
  }
});

function cleanForm(data){
  for(var key in data){
    if(key !== "meta" && key !== "errors") data[key] = "";
  }
}

app.$on('update-field', function(data){
  this.$data.model[data.property] = data.value
});


app.$on('subscribe', function(model){
  this.$data.model.meta
    .relationships[model.type][model.index]
    .to_subscribe.push(model.data);
});

app.$on('unsubscribe', function(model){

  if(model.subscribed){
    this.$data.model.meta
      .relationships[model.type][model.index]
      .to_unsubscribe.push(model.data);
  }
  else {
    var reference = this.$data.model.meta
      .relationships[model.type][model.index]
      .to_subscribe;

    for(var i in reference){
      if(reference[i].id === model.data.id){
        console.log(reference, reference[i]);
        reference.splice(i, 1);
        break;
      }
    }
  }
});
