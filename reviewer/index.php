<?php session_start();
?> 
<!DOCTYPE html>
<html>
<head>
  <title>Reviewer Dashboard</title>
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
<div class="loading">Loading&#8230;</div>

<?php include('../header.php');?>
<div class="container">
  <center> <h2>Hello Reviewer!Please choose the action to perform!</h2><br>
  <div class="container">
    <h4 align="center">Welcome <em><?php echo $_SESSION['reviewer'];?></em>  !  choose the action to perform!</h4>   
    <div id="nf"></div>
    <div class="col col-sm-12" id="top_">
      <div class="col col-sm-4">
          <div class="panel panel-info">
              
              <div class="panel-body">
                  
                  <div class="pan-btn">
                    <a href="#" class="btn btn-primary btn-lg btn-block" id="verified">Reports to Be Reviewed</a>
                    <br/>
                    <div class="upload_file_info text-center"><strong> List of the new reports to be reviewed </strong></div>
                  </div>
          
              </div>
          </div>      
      </div>

      <div class="col col-sm-4">
        <div class="panel panel-info">
           
            <div class="panel-body">
                
                <div class="pan-btn">
                    <a href="#" class="btn btn-primary btn-lg btn-block" id="reject">Rejected Reports</a>
                  <br/>
                  <div class="upload_file_info text-center"><strong>List of reports that are are rejected by the reviewer</strong> </div>
                </div>
        
            </div>
        </div>    
      
      </div>

      <div class="col col-sm-4">
            <div class="panel panel-info">
               
                <div class="panel-body">
                    
                    <div class="pan-btn">
                      <a href="#" class="btn btn-primary btn-lg btn-block" id="appr">Approved Reports</a>
                      <br/>
                      <div class="upload_file_info text-center"><strong>List of the reports that are approved after review</strong></div>
                    </div>
            
                </div>
            </div>    
          
        </div>  
      
    </div>  
        
  </div>
</div>

<div class="row">
      <div class="container">
          <div class="col col-sm-12">
            <div id="result"></div>
          </div>
      </div>
</div>  
<script type="text/javascript" src="reviewer.js"></script>
</body>
</html>
