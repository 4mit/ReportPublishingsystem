  $('div.loading').hide();
  $(document).ajaxStart(function(){     $('div.loading').show().delay(300);  });

  $( document ).ajaxComplete(function( event, xhr, settings ) {    $('div.loading').hide(); });

  var ver =  document.getElementById('verified');
  var rej =  document.getElementById('reject');
  var appr =  document.getElementById('appr');


  function fetch_data(rt){
    var final_url  = "request_type="+rt;
    $.ajax({
          url :'handle_r_request.php',
          method:'POST',
          cache:false,
          data:final_url,
          success:function(responce){
              
              $('#result').html(responce);
          },
          error:function(responce){}
      });
  }

  window.onload = function(){  var verify ="verified";   fetch_data(verify);  };
  $('#reject').click(function(){  var reject ="reject";   fetch_data(reject);  });
  $('#verified').click(function(){  var verify ="verified";   fetch_data(verify); });


  function perform_data(rt,a,current){
    var final_url  = "operation_type="+rt+'&app_id='+a;
    console.log(final_url);
    $.ajax({
          url :'handle_r_request.php',
          method:'POST',
          cache:false,
          data:final_url,
          success:function(responce){
              $('#nf').html(responce);
              alertify.alert('Action', 'Action is being taken.......', function(){ alertify.success('please chhose new File '); })
              $(current).closest('tr').remove();           
          },
          error:function(responce){}
      });
  }


  function jsFunction(data,current){
     var a = $(current).closest('tr').find('td:first-child').html();
     console.log('reviewer.ja'+a);
      if(data!=='Choose'){  alertify.confirm('Are You sure you want to '+data+'for application'+a).set('onok', function(closeEvent){ perform_data(data,a,current)} );    }         
    }
  
  appr.addEventListener("click",function(){     var verify = $(this).attr('id');    console.log(verify);    fetch_data(verify);  });
