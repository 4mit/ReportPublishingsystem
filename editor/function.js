$('#tbl').find('button').click(function()
   {
        var id=$(this).attr('id');    
        var currentElement = $('this');
        var fa = $(this).parent().parent().find('#faculty').html();
        var request="optype=approve&app_id="+id+'&faculty='+fa;  
        console.log(request);
        $.ajax({
          url:"toSuperVisor.php",
          method:'POST',
          data:request,
          beforeSend: function( xhr ) {
            alert('hello');
          },
          success:function(responseText){
            console.log(responseText);
            var d = $.trim(responseText);
            currentElement.closest('tr').slideDown("slow").remove();
            location.reload();
          },
          error:function(responseText){
            alert(responseText);
          }
        });
   }) ;