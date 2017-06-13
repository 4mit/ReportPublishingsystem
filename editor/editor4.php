<?php
  error_reporting(~E_NOTICE);
  session_start();
  if(!$_SESSION['editor_name'])
    header('location:home.html');
  ?> 
<!DOCTYPE html>
<html>
<head>
    <title>Approved Reports</title>
    <meta charset="utf-8">
    <?php include('../plugin.php');?>

    <style>
        a{
          font-size:17px;
          word-wrap: break-word;
          word-break: break-all;
        }


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

<center> <h3> <i> List of reports approved by the reviewer  </i> </h3> </center>

<a href="./index.php" class="text-centered">Back to editor's page </a>
<table class="table">
  <tr><th>App ID</th><th>Department</th><th>Faculty</th><th>Roll Number</th><th>Student Name</th><th>Operation</th><th>other</th></tr>
   <?php

      $conn = new MongoClient();
      $db= $conn->SPOTLITE;
      $collection = $db->reviewer;
      $cursor = $collection->find(); 

      echo ''; 
      foreach ($cursor as $doc)
      {           
          for($i=0;$i<count($doc['student_data']);$i++)
          {            
             
              if($doc['student_data'][$i]['finalStatus']=='FinalApproved')
              {
                 
                  echo '<tr><td>'.$doc['student_data'][$i]['app_id'].'</td>';
                  echo '<tr><td></td>';

                               
                  echo '<td><a href="../reviewer/pdfs/'.$doc['student_data'][$i]['new_uploaded_File'].'">New File Download</a></td>';
                  
                  echo '<td><select class="form-control" id="action_" onchange="jsFunction(this.value,this);"><option>Choose</option><option>Accept</option><option>Reject</option></select>';  echo '</td></tr>';
              }
          }
      }   
      echo '</table>';   

/*
 $conn = new MongoClient();
        $db= $conn->SPOTLITE;
        $collection = $db->editor;
        $cursor = $collection->find(); 


         function fetch_student_roll($student_id)
          {
                $conn = new MongoClient();
                $db= $conn->SPOTLITE;
                $collection = $db->student;                
                $condition = array("app_id" => $student_id);
                $cursor = $collection->find($condition);
                foreach ($cursor as $student_deails){                
                    echo $student_deails['Roll Number'];                           
                }
          }


        foreach ($cursor as $doc)
        {           
            for($i=0;$i<count($doc['student_data']);$i++)
            {                        
                if($doc['student_data'][$i]['reviewer_action']=='Accepted')
                {
                    echo '<tr><td>'.$i.'</td>';
                    echo '<td>Editor</td>';

                    
                    echo '<td>';fetch_student_roll($doc['student_data'][$i]['app_id']); echo '</td>'; 

                    echo '<td>'.$doc['student_data'][$i]['app_id'].'</td>'; 

                    echo '<td>'.$doc['student_data'][$i]['reviewer_action'].'</td>';

                    echo '<td><button type="button" class="btn btn-success" id="">'.$doc['student_data'][$i]['reviewer_action'].'</td>'; 
                    echo '</tr>';
                }
            }
        }  */    
   ?>
</table>

</body>
</html>
