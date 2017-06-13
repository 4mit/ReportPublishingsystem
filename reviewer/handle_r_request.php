<?php
session_start();
//$rName = $_SESSION['supervisor'];
if(isset($_POST['operation_type']) && isset($_POST['app_id']))
{
	
	$conn = new MongoClient();
	$db= $conn->SPOTLITE;
	$collection = $db->reviewer;


	$app_id = $_POST['app_id'];
	$document =  array("editor_id"=>'editor',"app_id" => $app_id,"status" =>"Accepted");
	

	if($_POST['operation_type']=='Accept')
	{
		if($collection->update(array('rName'=>$_SESSION['reviewer']),array('$push'=>array("student_data"=>$document))))
		{

			$collection = $db->editor;
			$collection->update(array('eid'=>'editor','student_data.app_id'=>$app_id),array('$set'=>array('student_data.$.reviewer_action'=>'Accepted')));

	        echo 'update reviewer done';
	    }else{
	    	echo 'cant update reviewer';
	    }
	}






	if($_POST['operation_type']=='Reject')
	{
		$document =  array("editor_id"=>'editor',"app_id" => $app_id,"status" =>"Rejected");
		if($collection->update(array('rName'=>$_SESSION['reviewer']),array('$push'=>array("student_data"=>$document))))
		{

			$collection = $db->editor;
			$collection->update(array('eid'=>'editor','student_data.app_id'=>$app_id),array('$set'=>array('student_data.$.reviewer_action'=>'Rejected')));


	        echo '<form method="POST" enctype="multipart/form-data" name="uploadForm" id="myform" class="form" action="upload.php?appid='.$app_id.'">       
            <div class="panel panel-default">
                <div class="panel-body form-horizontal payment-form">

                    <div class="form-group">
                        <label for="date" class="col-sm-3 control-label">Report Subject:</label>
                        <div class="col-sm-6">
                           <textarea id="reportsubject" name="reportsubject" maxlength="50" class="form-control" required></textarea>
                        </div>
                    </div>   


                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Choose File</label>
                        <div class="col-sm-6">
                            <input type="file" name="fileupload" id="fileupload" required class="btn btn-info form-control">
                        </div>
                    </div> 

                    <div class="form-group" id="error_p"></div>
                    <div class="form-group">
                       
                        
                        <div class="col-sm-6">
                           <button type="submit" class="btn btn-success btn-md pull-right" name="snd" id="ds">Submit</button>
                        </div>
                    </div> 
                </div>
            </div>  
           </form> ';
	    }
	}
}




//request to verify 

if(isset($_POST['request_type']))
{

	function getReviewer(){
            $conn = new MongoClient();
            $db= $conn->SPOTLITE;
            $collection = $db->reviewer;
            
            $cursor = $collection->find(array());

            $r_detail =array();
            foreach($cursor as $dr){
              array_push($r_detail, array($dr['reviewerId'], $dr['rName']));             
            }    
            return $r_detail;          
    }

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

	

    if($_POST['request_type']=='verified')
	{
		
		$conn = new MongoClient();
	    $db= $conn->SPOTLITE;
	    $collection = $db->editor;
	    $cursor = $collection->find(array('eid' =>'editor')); 

	    echo '<table class="table"><tr><th>App ID</th><th>Department</th><th>Faculty</th><th>Roll Number</th><th>Student Name</th>
	    	   <th>Operation</th><th>other</th></tr>'; 
	    foreach ($cursor as $doc)
	    {           
	        for($i=0;$i<count($doc['student_data']);$i++)
	        {            
	            if($doc['student_data'][$i]['supervisor_action']=='Accepted' && $doc['student_data'][$i]['reviewer_action'] != 'Rejected')
	            {
	                $a =getfaculty($doc['student_data'][$i]['app_id']); 

	                echo '<tr><td>'.$doc['student_data'][$i]['app_id'].'</td>';
	                echo '<td>'.$a[1].'</td>';
	                echo '<td>'.$a[0].'</td>';
	                echo '<td>'.$a[2].'</td>';
	                echo '<td>'.$a[3].'</td>';  
	        
	                $r_list = getReviewer();
	                //print_r($r_list[0][1]);
	                
	                echo "<td><a class=\"btn btn-danger\" href=\"../pdfs/".$doc['student_data'][$i]['File']."\">open file</a></td>";
	                
	                echo '<td><select class="form-control" id="action_" onchange="jsFunction(this.value,this);"><option>Choose</option><option>Accept</option><option>Reject</option></select>';  echo '</td></tr>';
	            }
	        }
	    }   
	    echo '</table>';   

	}


	if($_POST['request_type']=='reject')
	{
		
		$conn = new MongoClient();
	    $db= $conn->SPOTLITE;
	    $collection = $db->editor;
	    $cursor = $collection->find(array('eid' =>'editor')); 

	    echo '<table class="table"><tr><th>App ID</th><th>Department</th><th>Faculty</th><th>Roll Number</th><th>Student Name</th>
	    	   <th>Operation</th><th>other</th></tr>'; 
	    foreach ($cursor as $doc)
	    {           
	        for($i=0;$i<count($doc['student_data']);$i++)
	        {            
	            if($doc['student_data'][$i]['reviewer_action']=='Rejected')
	            {
	                $a =getfaculty($doc['student_data'][$i]['app_id']); 

	                echo '<tr><td>'.$doc['student_data'][$i]['app_id'].'</td>';
	                echo '<td>'.$a[1].'</td>';
	                echo '<td>'.$a[0].'</td>';
	                echo '<td>'.$a[2].'</td>';
	                echo '<td>'.$a[3].'</td>';  
	        
	                $r_list = getReviewer();
	                //print_r($r_list[0][1]);
	                
	                echo "<td><a class=\"btn btn-danger\" href=\"../pdfs/".$doc['student_data'][$i]['File']."\">open file</a></td>";
	                
	                echo '<td></td></tr>';
	            }
	        }
	    }   
	    echo '</table>';   

	}


	if($_POST['request_type']=='Apprverify')
	{
		
		$conn = new MongoClient();
	    $db= $conn->SPOTLITE;
	    $collection = $db->editor;
	    $cursor = $collection->find(array('eid' =>'editor')); 

	    echo '<table class="table"><tr><th>App ID</th><th>Department</th><th>Faculty</th><th>Roll Number</th><th>Student Name</th>
	    	   <th>Operation</th><th>other</th></tr>'; 
	    foreach ($cursor as $doc)
	    {           
	        for($i=0;$i<count($doc['student_data']);$i++)
	        {            
	            if($doc['student_data'][$i]['reviewer_action']=='Rejected')
	            {
	                $a =getfaculty($doc['student_data'][$i]['app_id']); 

	                echo '<tr><td>'.$doc['student_data'][$i]['app_id'].'</td>';
	                echo '<td>'.$a[1].'</td>';
	                echo '<td>'.$a[0].'</td>';
	                echo '<td>'.$a[2].'</td>';
	                echo '<td>'.$a[3].'</td>';  
	        
	                $r_list = getReviewer();
	                //print_r($r_list[0][1]);
	                
	                echo "<td><a class=\"btn btn-danger\" href=\"../pdfs/".$doc['student_data'][$i]['File']."\">open file</a></td>";
	                
	                echo '<td></td></tr>';
	            }
	        }
	    }   
	    echo '</table>';   

	}
}
?>