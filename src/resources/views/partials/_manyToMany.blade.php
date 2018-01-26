<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <h4 class="title">
          {{$class}}
        </h4>
      </div>
      <div class="content">
        <select id="manyToMany-{{$class}}" class="selectpicker" multiple data-live-search="true">
          @foreach ($elements as $element)
            <option value="{{$element['id']}}">
              {{join(' | ',$element)}}
            </option>
          @endforeach
        </select>
        <button id="update-manyToMany-{{$class}}" class="btn btn-info btn-fill">Update</button>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script type="text/javascript">
    $(function(){
      var model{{$class}} = [];

      $("#update-manyToMany-{{$class}}").click(function(evt){
        axios.post
      });

      $("#manyToMany-{{$class}}").multiSelect({
        selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search'>",
        selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search'>",
        afterInit: function(ms){
          var that = this,
              $selectableSearch = that.$selectableUl.prev(),
              $selectionSearch = that.$selectionUl.prev(),
              selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
              selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

          that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
          .on('keydown', function(e){
            if (e.which === 40){
              that.$selectableUl.focus();
              return false;
            }
          });

          that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
          .on('keydown', function(e){
            if (e.which == 40){
              that.$selectionUl.focus();
              return false;
            }
          });
        },
        afterSelect: function(values){
          this.qs1.cache();
          this.qs2.cache();

          model{{$class}} = model{{$class}}.concat(values);

        },
        afterDeselect: function(values){
          this.qs1.cache();
          this.qs2.cache();
          values.forEach(function(value){
            var index = model{{$class}}.indexOf(value);
            model{{$class}}.splice(index, 1);
          });
        }
      });
    });

    function addElement(element, collection){
      collection.forEach(function(value, index){
        console.log(index, value);
      });
    }
  </script>
@endpush
