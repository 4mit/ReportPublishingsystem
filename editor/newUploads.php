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
  <title>New Uploads</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/themes/default.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/themes/semantic.min.css"/>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  rel="stylesheet">
  <style>
          
          .btn:hover{
            margin-top: -2px;
            transition:0.3s all linear;
            box-shadow: 0px 2px 6px rgba(254, 167, 66, 0.4); ;
          }
          .nav a:hover{
            transition:0.3s all linear;
            box-shadow: 0px 2px 6px black;
            background-color: rgba(123,100,021,0.3);
            border-bottom: 2px solid red;
          }

          table {
              border-collapse: collapse;
              width: 80%;
              align-content: center;
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
<center> <h3> <i> List of New files uploaded by the student  </i> </h3> <br/><a href="./index.php">Back to editor's page </a></center>
<div class="container-fluid">
    <table class="table table-responsive table-bordered" id="tbl">
        <tr><th>Name</th><th>Roll No.</th><th>Email</th><th>Department</th><th>Faculty</th><th>File</th><th>Forward</th></tr>
        <?php  include('fetch_record.php');?>       
    </table>
 </div>
 <script src="function.js"></script>
</body>
</html>
