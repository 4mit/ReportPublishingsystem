<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Supervisor Dashboard</title>
  <meta charset="utf-8">
  <?php include('../plugin.php');?>

  

  <style type="text/css">
    .pan-btn ul{margin-left: -20px;}
    .pan-btn ul li{
      cursor: pointer;
      height: 40px;
      margin-top: 8px;
      border: 2px solid brown;
      list-style-type:none;
      word-wrap: break-word;
      box-shadow: inset 0px 5px 10px rgba(111,105,123,1);
    }
    .pan-btn ul li a {
      line-height: 40px;
      text-decoration: none;
    }

    .pan-btn ul li:hover{
      transition: 0.6s all linear;
      margin-left: 13px;
     
    }
    th{background-color: black;}
    .nav li:hover{transition: 0.6s all linear;box-shadow: inset 280px 0px 0px black;}

  </style>
</head>
<body>

<?php include('../header.php');?>
<div  class="row">
    <div class="col col-sm-12">
     <h2 align="center">Welcome - <?php  echo $_SESSION['supervisor'];?></h2>
      <div class="col col-sm-3">
          <div class="panel panel-info">
              
              <div class="panel-body">
                  
                  <div class="pan-btn">
                    <h3 align="center">Navigatioin</h3>
                    <ul>
                      <li class="text-center"><a href="./index.php">Reports to Be Verified</a></li>
                      <li class="text-center"><a id="Showallverified">Already Verified Reports</a></li>
                    </ul>                 
                  </div>
      
              </div>
          </div>      
      </div>

      <div class="col col-sm-9">
            <div id="allrecord">
            <div id="operation_result"></div>
            <table class="table table-responsive table-bordered" >
                          <tr>
                              <th>App ID</th>
                              <th>Editor Name</th>
                              <th>File</th>
                              <th>status</th>
                              <th>Download</th>
                              <th>Accept</th>
                              <th>reject</th>
                              
                          </tr>
              <?php include('function_super.php'); ?>
             </table>

            </div>
      </div>
    </div>  
</div>
<script type="text/javascript" src="super_js.js"></script>
</body>
</html>