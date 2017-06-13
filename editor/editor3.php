<?php
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
  <title>Rejected Requests</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/themes/semantic.min.css"/>
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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="home.html">Spotlite-R</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        
        <li><a href="#">General Structure</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <!--  <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
       <li><a href="../terminate.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        
      </ul>
    </div>
  </div>
</nav>

<center> <h3> <i> List of requests rejected by the supervisor </i> </h3> 
<br/><a href="./index.php">Back to editor's page </a>
</center>


<table class="table table-responsive table-hover">
  <tr>
    <th>app_id</th>
    <th>Department</th>
    <th>Supervisor</th>
    <th>Roll No.</th>
    <th>Name</th>
    <th>Topic</th>
    <th>action Taken</th>
  </tr>
  <?php

        $conn = new MongoClient();
        $db= $conn->SPOTLITE;
        $collection = $db->editor;
        $cursor = $collection->find(array('eid' =>'editor'));                  
        
        function getfaculty($id){
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
                if($doc['student_data'][$i]['supervisor_action']=='Rejected')
                {
                    $a =getfaculty($doc['student_data'][$i]['app_id']);              
                    echo '<tr><td>'.$doc['student_data'][$i]['app_id'].'</td>';
                    echo '<td>'.$a[1].'</td>';
                    echo '<td>'.$a[0].'</td>';
                    echo '<td>'.$a[2].'</td>';
                    echo '<td>'.$a[3].'</td>';  
                    echo '<td>--</td>';                    
                    echo '<td>'.$doc['student_data'][$i]['supervisor_action'].'</td>';
                    echo '</tr>';  
                }
            }
        }      
   ?>
</table>
</body>
</html>
