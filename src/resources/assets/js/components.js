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


let checkbox = {
  template: `
    <label v-show="input.visible">
      <input type="checkbox" :value="input.id" >
      {{input.description}}
    </label>
  `,
  props: ['input']
};


Vue.component('adminify-multiple', {
  props: ['inputs'],
  components: {
    'adminify-multiple-checkbox': checkbox
  },
  computed: {
    chunks: function(){
      return _.chunk(this.dataset, 3)
    },
  },
  data: function(){
    return {
      query: "",
      filter: null,
      dataset: _.map(this.inputs, function(input){ input.visible = false; return input; })
    }
  },
  watch: {
    query: function(value){
      let data = this.filter.search(value);
    }
  },
  created: function(){
    this.filter = new Fuse(this.dataset, {
      keys: ['description', 'permission'],
      index: 'id'
    });
  }
});


let app = new Vue({
  el: '#app',
  data: {
    model: window.adminify.model,
    requesting: false
  },
  methods: {
    pushdata(){
      console.log(this.model);
      this.requesting = true;
      var url = window.adminify.form.route;
      console.log(url);
      NProgress.start();

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
    if(key !== "meta") data[key] = "";
  }
}

app.$on('update-field', function(data){
  this.$data.model[data.property] = data.value
});
