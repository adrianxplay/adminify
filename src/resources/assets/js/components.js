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

Vue.component('adminify-manytomany',{
  props: [
    'collection', 'name', 'class_name',
    'index', 'relation-type', 'submitFlag'
  ],
  data: function(){
    return {
      dataset: [],
      toSubscribe: [],
      toUsubscribe: [],
      subscribed: []
    }
  },
  watch: {
    submitFlag: function(next, previous){
      if(next){
        this.toSubscribe = [];
        this.toUsubscribe = [];
        this.subscribed = [];
        _.map(this.dataset, function(el){
          el.visible = true;
        });

        this.$parent.$emit("adminify-manytomany-reset");
      }
    }
  },
  methods: {
    subscribe: function(element){
      this.toSubscribe.push(element);
      element.visible = false;
      var tmp = Object.assign({}, element, {});
      delete tmp.visible;

      this.$parent.$emit('adminify-subscribe', {
        index: this.index,
        type: this.relationType,
        data: tmp
      });

    },
    unsubscribe: function(element, index){
      _.filter(this.dataset, function(o){
        if(o.id === element.id)
          o.visible = true;
      });
      this.toSubscribe.splice(index, 1);
      var tmp = Object.assign({}, element, {});
      delete tmp.visible;

      this.$parent.$emit('adminify-unsubscribe', {
        index: this.index,
        type: this.relationType,
        data: tmp
      });
    },
    unsubscribeAll: function(){
      this.toSubscribe = [];
      _.filter(this.dataset, function(element){
        element.visible = true;
      });
    }
  },
  mounted: function(){
    this.dataset = _.map(this.collection, function(element){
      return Object.assign({}, element, {visible: true});
    });
  }
});

let app = new Vue({
  el: '#app',
  data: {
    model: window.adminify.model,
    requesting: false,
    submited: false
  },
  methods: {
    pushdata(){
      this.requesting = true;
      this.submited = true;
      var url = window.adminify.form.route;
      NProgress.start();

      axios
        .post(url, {model: this.model})
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

  for(relation in data.meta.relationships){
    if(relation === "manyToMany"){

      app.$emit('cleanComponents');

      for(collection in data.meta.relationships.manyToMany){
        var tmp = data.meta.relationships.manyToMany[collection];
        tmp.subscribed = [];
        tmp.to_subscribe = [];
        tmp.to_unsubscribe = [];

      }
    }
  }
}

app.$on('update-field', function(data){
  this.$data.model[data.property] = data.value
});


app.$on('adminify-subscribe', function(model){
  this.$data.model.meta
    .relationships[model.type][model.index]
    .to_subscribe.push(model.data);
});

app.$on('adminify-unsubscribe', function(model){

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
        // console.log(reference, reference[i]);
        reference.splice(i, 1);
        break;
      }
    }
  }
});


app.$on('adminify-manytomany-reset', function(){
  this.submited = false;
});
