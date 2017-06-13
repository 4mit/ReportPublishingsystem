<?php
error_reporting(E_ALL);

$select_department = $_POST['selectdepartment'];
$select_faculty = trim($_POST['selectfaculty']);
$name = $_POST['Name'];
$rollnumber = $_POST['rollnumber'];
$email_id = $_POST['emailid'];
$report_subject = $_POST['reportsubject'];
$file_name = $_FILES['fileupload']['name'];
$file = $_FILES['fileupload']['tmp_name'];
$filesize = filesize($file);


function generate_app_id(){
		$tet = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','q','x','y','z','0'
			,'1','2','3','4','5','6','7','8','9');
		$cypher ='_app_';
		for($i=0;$i<10;$i++)
			$cypher .= $tet[rand(0,35)];

		$cypher .='_id';
		return $cypher;
}

function insertData($filename,$select_department,$select_faculty,$name,$rollnumber,$email_id,$report_subject,$file)
{
	
	//connect to mongo
	$conn = new MongoClient();
	$db= $conn->SPOTLITE;
	$collection = $db->student;	
	//terminate
	$id = generate_app_id();
	$document =  array(
		"app_id" => $id,	
		"Department" => $select_department,
		"Faculty" => $select_faculty,
		"Name" => $name,
		"Roll Number" => $rollnumber,
		"Email-id" => $email_id,
		"Report Subject" => $report_subject,
		"File" => $rollnumber.'_'.$filename,
		"Verify" =>"0"	
 	);

 	$filename = $rollnumber.'_'.$_FILES['fileupload']['name'];
	$path = 'pdfs/'.$filename;
	
	
	if (file_exists($path)) {
		echo 'FILE_EXISTS_ALREADY';
		
	} else {
		move_uploaded_file($file, $path);	
		if ($collection->insert($document))
		{

			$document =  array(
				"app_id" => $id,
				"File" => $filename,
				"sentToSupervisor" =>"pending",
				"supervisor_action" =>"pending",
				"reviewer_action" =>"pending",
				"editor_passes" =>"pending",
				"ReviewerAssinged"=>"no"	
		 	);
			$collection = $db->editor;
		 	if($collection->update(array("eid"=>'editor'),array('$push'=>array("student_data"=>$document)))){
		 		echo 'OK_';	
		 	}else{
		 		echo 'error';
		 	}				
		}
		else
			array_push($error,"OOps something went wrong ...");
	}	
}

function validate($filename,$select_department,$select_faculty,$name,$rollnumber,$email_id,$report_subject,$filesize,$file)
{	
	$error = array();
	if(preg_match("/[\w]{4,26}/",$_POST['Name']))
	{
		if(preg_match("/[mM|bB|pP|P][\d]{6}[a-zA-Z]/", $_POST['rollnumber']))
			if(!filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL) === false)
				if(preg_match("/[\w]+/", $_POST['reportsubject']))
					if($filesize<=5e+6)
					{
						insertData(
								$filename,
								$select_department,
								$select_faculty,
								$name,
								$rollnumber,
								$email_id,
								$report_subject,
								$file
							    
						);	
					}else
						array_push($error,array('size_error' => 'File Size is too large'));
				else
				array_push($error,array('subject_error' => 'Subject too short'));	
			else
			array_push($error,array('email_error' => 'Invalid Email id ..'));	
		else
		array_push($error,array('rno_error' => 'Invalid Roll Number'));	
	}else
		array_push($error,array('name_error' => 'Invalid Name Format'));
		
	if(!empty($error)){

		$return_json =json_encode($error); 
		echo  $return_json;
		die();
	}

}

if($_POST){
	//echo 'submitted';
	validate(	$_FILES['fileupload']['name'],
				$_POST['selectdepartment'],
				$_POST['selectfaculty'],
				$_POST['Name'],
				$_POST['rollnumber'],
				$_POST['emailid'],
				$_POST['reportsubject'],
				$filesize,$file
			);
}

?>