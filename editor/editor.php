<?php
session_start();
if(!$_SESSION['editor'])
	header('location:home.html');
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Student File Upload</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="//cdn.jsdelivr.net/alertifyjs/1.10.0/alertify.min.js"></script>
	  <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/alertify.min.css"/>
	  <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/themes/default.min.css"/>
	  <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/themes/semantic.min.css"/>
	<link  type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  rel="stylesheet">
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
        <li class="active"><a href="home.html">Home</a></li>
        <li><a href="#">General Structure</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>

        
      </ul>
      <ul class="nav navbar-nav navbar-right">
       <li><a href="terminate.php"><i class="fa fa-window-close" aria-hidden="true"></i> Logout</a></li>
        
      </ul>
    </div>
  </div>
</nav>

<dir class="row">
	<div class="container">
		<h2 align="center">Hello Editor!Please choose the action to perform!</h2>		
		
		<div class="col col-sm-12">
			<div class="col col-sm-6">
					<div class="panel panel-info">
						  
						  <div class="panel-body">
						  		
				  				<div class="pan-btn">
				  					<a href="editor1.php" class="text-center" id="verify_pop">Show All Request </a>
				  					<br/>
				  					<div class="upload_file_info text-center"><strong>Notice -</strong>File Size Must me less then 5mb and valid PDF type </div>
				  				</div>
					
						  </div>
					</div>			
			</div>

			<div class="col col-sm-6">
					<div class="panel panel-info">
						 
						  <div class="panel-body">
						  		
				  				<div class="pan-btn">
						    		<a href="editor2.php" class="text-center" >Verified Reports</a>
				  					<br/>
				  					<div class="upload_file_info text-center"><strong>Notice -</strong>File Size Must me less then 5mb and valid PDF type </div>
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
					    		<a href="editor3.php" class="text-center" id="reject_pop">Rejected Reports</a>
			  					<br/>
			  					<div class="upload_file_info text-center"><strong>Notice -</strong>File Size Must me less then 5mb and valid PDF type </div>
			  				</div>
				
					  </div>
				</div>		
			
		</div>

		<div class="col col-sm-6">
				<div class="panel panel-info">
					 
					  <div class="panel-body">
					  		
			  				<div class="pan-btn">
					    		<a href="editor4.php" class="text-center" >Approved Uploads</a>
			  					<br/>
			  					<div class="upload_file_info text-center"><strong>Notice -</strong>File Size Must me less then 5mb and valid PDF type </div>
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
				    		<a href="editor4.php" class="text-center" >Approved Uploads</a>
		  					<br/>
		  					<div class="upload_file_info text-center"><strong>Notice -</strong>File Size Must me less then 5mb and valid PDF type </div>
		  				</div>
			
				  </div>
			</div>		
			
		</div>

		<div class="col col-sm-6">
			<div class="panel panel-info">
				 
				  <div class="panel-body">
				  		
		  				<div class="pan-btn">
							<a href="editor5.php" class="text-center" >Published Uploads</a>
		  					<br/>
		  					<div class="upload_file_info text-center"><strong>Notice -</strong>File Size Must me less then 5mb and valid PDF type </div>
		  				</div>
			
				  </div>
			</div>		
			
		</div>
	</div>	
			  
	</div>
</dir>
	
<script type="text/javascript">
	$(document).ready(function(){

		alertify.set('notifier','position', 'top-right');
 		alertify.success('Login Success : ' + alertify.get('Welcome','Editor'));

		$('body').css({"background-color":"black"});

		$('.upload_file_info').hide();
		$('.pan-btn a').css({
			"display":"block",
			"text-decoration":"none",
			"font-size":"24px",
			"transition":".51s all linear"

		});

		$('.panel').css({
			"box-shadow":"0px 6px 15px rgba(119,200,237,0.4)",
		});

		$('.pan-btn > a').hover(function() 
		{
			$(this).next().next().slideDown();
			
	      	$(this).css({
	      		"margin-bottom":"2px",     
	      	
	      		"margin-top":"-1px",
	      		"border-bottom":"2px solid red",
	      		
	      		"box-shadow":"inset 500px 0px 0px rgba(179,220,237,0.4)",
	      		"background-color": "rgba(139, 139, 147, 0.6)"

	      	});
			},function(){
				$('.upload_file_info').slideUp();
				$(this).css({
					"box-shadow":"none",
					"margin-top":"1px",
					"background-color": "transparent",
					"border-bottom":"none"
			});
		});
		

		$('#verify_pop').tooltip({
				"animation":true,
				"content":"Hello Popover im here to see you",
				"delay":"1s",
				"placement":"top",
				"title":"Upload your file here be sure file constraint "
		});

		$('#reject_pop').tooltip({
				"animation":true,
				"content":"Hello Popover im here to see you",
				"delay":"1s",
				"placement":"top",
				"title":"click to see List of all rejected records here "
		});

		

	});
</script>
</body>
</html>
