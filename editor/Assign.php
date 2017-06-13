<?php
error_reporting(0);
 session_start();
 if($_SESSION['editor_name']!=null){}
 else{
    echo  '<script type="text/javascript">alert("Please Login First")</script>';
    header("Refresh:0,url=../home.html");
 } 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Approved reportse seisi report me koi prblmnhi h..or </title>
  <?php include('../plugin.php');?>
  <style>
  table{width: 500px; overflow-x: scroll !important;}
        th, td {
            text-align: left;
            padding: 8px;
        }


        th {
            background-color: #4CAF50;
            color: white;
        }
  </style>
</head>
<body>

<?php include('../header.php');?>

<center> <h3> <i> List of requests approved by the reviewer </i> </h3> 
<br/><a href="./index.php"><-Home</a>
</center>


<table class="table  table-hover">
  <tr>
    <th>app_id</th>
    <th>Department</th>
    <th>Supervisor</th>
    <th>Roll No.</th>
    <th>Name</th>
    <th>Topic</th>
    <th>action Taken</th>
    <th>reviewer</th>
    <th>assign</th>

  </tr>
  <?php

        $conn = new MongoClient();
        $db= $conn->SPOTLITE;
        $collection = $db->editor;
        $cursor = $collection->find(array('eid' =>'editor')); 

        function getReviewer()
        {
            $conn = new MongoClient();
            $db= $conn->SPOTLITE;
            $collection = $db->reviewer;
            
            $cursor = $collection->find(array());

            $r_detail =array();
            foreach($cursor as $dr){
              array_push($r_detail, array($dr['reviewerId'], $dr['rName']));             
            }    
            return $r_detail;          
        }

        function getfaculty($id)
        {
            $conn = new MongoClient();
            $db= $conn->SPOTLITE;
            $collection = $db->student;
            
            $cursor = $collection->find(
              array("app_id"=>$id),
              array("Faculty"=>1,"Department"=>1,"Roll Number"=>1,"Name"=>1)
            );

            $f_detail =array();
            foreach($cursor as $dr){

                array_push($f_detail,$dr['Faculty']);
                array_push($f_detail,$dr['Department']);
                array_push($f_detail,$dr['Roll Number']);
                array_push($f_detail,$dr['Name']);
                return $f_detail;  
            }            
        }

        foreach ($cursor as $doc)
        {           
            for($i=0;$i<count($doc['student_data']);$i++)
            {            
             
             //echo $doc['student_data'][$i]['ReviewerAssinged']." ";
                if( $doc['student_data'][$i]['supervisor_action']=='Accepted' && $doc['student_data'][$i]['ReviewerAssinged']=='no')
                {
                    $a =getfaculty($doc['student_data'][$i]['app_id']);              
                    echo '<tr><td>'.$doc['student_data'][$i]['app_id'].'</td>';
                    echo '<td>'.$a[1].'</td>';
                    echo '<td>'.$a[0].'</td>';
                    echo '<td>'.$a[2].'</td>';
                    echo '<td>'.$a[3].'</td>';  
                    echo '<td>--</td>';                    
                    echo '<td>'.$doc['student_data'][$i]['supervisor_action'].'</td>';

                    $r_list = getReviewer();
                
                    echo "<td><select class=\"form-control\" id=\"reviewer_name\">";

                    for($j =0; $j < sizeof($r_list); $j++){
                      echo "<option >".$r_list[$j][1]."</option>";
                    }

                    echo "</select></td>";
                    echo "<td><button class=\"assinf_to_supervisor btn btn-danger\" type='button' value = 'assign'>Assign</button></td>";
                   
                    echo '</tr>';  
                }
            }
        }      
   ?>
</table>

<script type="text/javascript">
        function addEventListenerByClass(className, event, fn) {
            var list = document.getElementsByClassName(className);
            for (var i = 0, len = list.length; i < len; i++) {
                list[i].addEventListener(event, fn, false);
            }
        }

        addEventListenerByClass('assinf_to_supervisor', 'click',function(){
              var app_id = $(this).closest('tr').find('td:first-child').html();
              var $toberemoved = $(this).closest('tr');
              
              var reviewer_name = $(this).closest('tr').find('#reviewer_name').val(); 
                alertify.confirm('Hey ! Please look at your action',
                                 "Are You sure you want to assign application to "+$(this).closest('tr').find('#reviewer_name').val(),
                                  function(){
                                        
                                        $toberemoved.hide();
                                        var url ="action=assign&revieweNmae="+reviewer_name+"&appid="+app_id;

                                        $.ajax({
                                          url :'function.php',
                                          method:'POST',
                                          cache:false,
                                          data:url,
                                          success:function(responce){
                                              
                                              if($.trim(responce)=="assign_ok"){

                                                alertify.alert('Success', 'Application has assigned to editor !', function(){ alertify.success('All right !'); });
                                              }else if($.trim(responce)=='assign_err'){
                                              

                                                alertify.alert('ERROR', 'SOMETHING WENT WRONG !', function(){ alertify.success('Whoops  !'); });
                                              
                                              }

                                              else{alertify.error('OOPS SOMETHING WENT WRONG ...');}
                                              
                                          },
                                          error:function(responce){}
                                      });
                                  }, function(){});  
          });                          
                   
</script>
</body>
</html>
