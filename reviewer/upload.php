<?php
session_start();

error_reporting(E_ALL);

	if(isset($_POST['snd'])){

		$conn = new MongoClient();
		$db= $conn->SPOTLITE;
		$collection = $db->reviewer;


		$report_subject = $_POST['reportsubject'];
		$app_id = $_REQUEST['appid'];

		$file_name = $_FILES['fileupload']['name'];
		$file = $_FILES['fileupload']['tmp_name'];
		$filesize = filesize($file);

			
		
		$cursor = $collection->find(array('rName' => $_SESSION['reviewer']));

	      foreach ($cursor as $doc)
	      {	                    
	          for($i=0;$i<count($doc['student_data']);$i++)
	          {                          
	          		if($app_id == $doc['student_data'][$i]['app_id'])
	          		{
						$conn = new MongoClient();
						$db= $conn->SPOTLITE;
						$collection = $db->reviewer;

						$filename = '_'.$_FILES['fileupload']['name'];
						$path = 'pdfs/'.$filename;
						
						
						if (file_exists($path)) {
							echo 'FILE_EXISTS_ALREADY'; die();
							
						}else {
							move_uploaded_file($file, $path);
							$document = array("app_id"=>$app_id,"new_uploaded_File"=>$file_name,"finalStatus"=>"FinalApproved");	
							$collection->update(array('rName'=>$_SESSION['reviewer']),array('$push'=>array("student_data"=>$document)));

							$doc['student_data'][$i]['file'] = $file_name;
							echo '<script>alert("File Uploaded SuccessFully");</script>';
							echo '<script>location.href="./index.php"</script>';	
							
						}							          					    				      		
	          		}
	          }                                        
	      }    	
	}	

?>