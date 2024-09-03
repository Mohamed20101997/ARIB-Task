<script>
    $(document).ready(function(){
      $(document).on('click','.delete',function(e){
        e.preventDefault();
        var that = $(this);
        var n = new Noty({
          text : 'تأكيد حذف السجل',
          killer : true,
          themes: 'relax',
          buttons:[
            Noty.button('نعم', 'btn btn-success mr-2', function(){
              that.closest('form').submit();
            }),

            Noty.button('لا', 'btn btn-danger', function(){
              n.close();
            }),
          ]
        });
        n.show();

      });

    });
  </script>
