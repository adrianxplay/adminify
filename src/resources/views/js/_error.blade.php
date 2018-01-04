<script type="text/javascript">
  $(document).ready(function(){
    @foreach ($errors->all() as $error)
      $.notify({
          icon: 'pe-7s-close-circle',
          message: "{{$error}}"

        },{
            type: 'danger',
            timer: 4000
        });
    @endforeach
  });
</script>
