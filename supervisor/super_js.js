$('document').ready(function()
    {
          $('button').click(function()
          {
              var id=$(this).attr('id');
              var action=$(this).attr('name');
              var type=$(this).attr('type');
              console.log(action);
              console.log(type);
             
              var request="optype=verify&app_id="+id+"&action_type="+type;  
              console.log(request);
              $.ajax({
                    url:"supervisor_action.php",
                    method:'POST',
                    data:request,
                    success:function(responseText){
                         console.log(responseText);
                         
                         if(responseText=='Accepted'){
                            alertify.success('Accepted');
                            location.reload();
                         }else if(responseText=='Rejected'){
                            alertify.error('Rejected');
                            location.reload();
                         }else{
                            console.log('ERROR');
                         }
                  },
                    error:function(responseText){
                    alert(responseText);
                    }
            });
    });
        
        $('#Showallverified').click(function(){
            var request="listallverified=yes";  
            $.ajax({
              url:"supervisor_action.php",
              method:'POST',
              data:request,
              success:function(responseText){
                console.log(responseText);
                var d = $.trim(responseText);
                $('#allrecord').html(responseText);
                //location.reload();
              },
              error:function(responseText){
                alert(responseText);
              }
            });
      });
    });