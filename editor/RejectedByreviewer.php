<?php
  session_start();
  if(!$_SESSION['editor_name'])
    header('location:home.html');
  ?> 
<!DOCTYPE html>
<html>
<head>
	<title>Rejected Reports</title>
	<meta charset="utf-8">
  <?php include('../plugin.php');?>

  <style>

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

<center> <h3> <i> List of reports rejected by the reviewer  </i> </h3> </center>

<a href="./index.php">Back to editor's page </a>
<table class="table">
  <tr>
    <th>S. No</th>
    <th>Editor Name</th>
    <th>Roll Number</th>
    <th>Application ID.</th>
    
    
    <th>Status</th>
  </tr>
   <?php

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
                if($doc['student_data'][$i]['reviewer_action']=='Rejected')
                {
                    echo '<tr><td>'.$i.'</td>';
                    echo '<td>Editor</td>';

                    
                    echo '<td>';fetch_student_roll($doc['student_data'][$i]['app_id']); echo '</td>'; 

                    echo '<td>'.$doc['student_data'][$i]['app_id'].'</td>'; 

                    echo '<td>'.$doc['student_data'][$i]['reviewer_action'].'</td>'; 
                    echo '</tr>';
                }
            }
        }      
   ?>
</table>

</body>
</html>
