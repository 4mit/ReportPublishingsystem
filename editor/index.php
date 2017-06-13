<?php
session_start();
if(!$_SESSION['editor_name'])
	header('location:home.html');
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Editor Dashboard</title>
	<?php include('../plugin.php');?>

</head>
<body>
<div class="loading">Loading&#8230;</div>
<?php include('../header.php');?>
<dir class="row">
	<div class="container">
		<h4 align="center">Welcome <em><?php echo $_SESSION['editor_name'];?></em>  !  choose the action to perform!</h4>		
		
		<div class="col col-sm-12">
			<div class="col col-sm-6">
					<div class="panel panel-info"><div class="panel-body">						  
				  				<div class="pan-btn"><a href="newUploads.php" class="text-center" id="verify_pop">New Uploaded Reports </a>
				  				 <br/>
				  					<div class="upload_file_info text-center"><strong> List of the new reports uploaded by the student </strong></div>
				  				</div>					
						  </div>
					</div>			
			</div>

			<div class="col col-sm-6">
			<div class="panel panel-info"><div class="panel-body">				  
		  				<div class="pan-btn"><a href="published.php" class="text-center" >Published Reports</a>
		  					<br/>
		  					<div class="upload_file_info text-center"><strong>List of reports that are published to the server</strong> </div>
		  				</div>		
				  </div>
			</div>				
		</div>
			
		</div>	

	<div class="col-sm-12">
		<div class="col col-sm-6">
				<div class="panel panel-info"><div class="panel-body">					  		
			  				<div class="pan-btn"><a href="editor4.php" class="text-center" >Approved Reports by Reviewer</a>
			  					<br/>
			  					<div class="upload_file_info text-center"><strong>List of the reports verified by the supervisor</strong></div>
			  				</div>				
					  </div>
				</div>					
		</div>
		<div class="col col-sm-6">
				<div class="panel panel-info">
					  
					  <div class="panel-body">
					  		
			  				<div class="pan-btn">
					    		<a href="editor3.php" class="text-center" id="reject_pop">Rejected Requests   (By Supervisor)</a>
			  					<br/>
			  					<div class="upload_file_info text-center"><strong>List of the reports rejected by the supervisor</strong></div>
			  				</div>
				
					  </div>
				</div>		
			
		</div>
	</div>

	
	<div class="col-sm-12">
		<div class="col col-sm-6">
			<div class="panel panel-info">
				 
				  <div class="panel-body">
				  		
		  				<div class="pan-btn">
				    		<a href="Assign.php" class="text-center" >Verified Requests/ Assign to reviewer</a>
		  					<br/>
		  					<div class="upload_file_info text-center"><strong>List of files approved by the Reviewer</strong> </div>
		  				</div>
			
				  </div>
			</div>		
			
		</div>

		<div class="col col-sm-6">
					<div class="panel panel-info">
						 
						  <div class="panel-body">
						  		
				  				<div class="pan-btn">
						    		<a href="RejectedByreviewer.php" class="text-center" >Rejected Reports   (By reviewer)</a>
				  					<br/>
				  					<div class="upload_file_info text-center"><strong>List of reports that are rejected by the reviewer</strong></div>
				  				</div>
					
						  </div>
					</div>		
				
			</div>
	</div>			  
	</div>
</dir>
	
<script type="text/javascript" src="style.js"></script>
<script type="text/javascript">
	  $('div.loading').hide();
  $(document).ajaxStart(function(){
        $('div.loading').show();
   });

  $( document ).ajaxComplete(function( event, xhr, settings ) {
    $('div.loading').hide();
  });
</script>
</body>
</html>
