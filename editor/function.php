<?php

	$conn = new MongoClient();
    $db= $conn->SPOTLITE;
    $collection = $db->reviewer;

    function assignReviewer($rname,$appid)
	{
		
		$document =  array("app_id"=>$appid);
	    $GLOBALS["collection"] = $GLOBALS["db"]->reviewer;
	    
	    if($GLOBALS["collection"]->update(array("rName"=>$rname),array('$push'=>array("student_data"=>$document))))
	    {
	       
	      	$conn = new MongoClient();
		    $db= $conn->SPOTLITE;
		    $collection = $db->editor;
	       
	        $collection->update(array('eid'=>'editor','student_data.app_id'=>$appid),array('$set'=>array('student_data.$.ReviewerAssinged'=>$rname)));
	        echo 'assign_ok';
	    }else{
	    	echo 'assign_err';
	    }
	}

    if(isset($_POST['action']) && $_POST['action'] =="assign"){

    	if(isset($_POST['revieweNmae']) && isset($_POST['appid'])){

    			assignReviewer($_POST['revieweNmae'],$_POST['appid']);
    		
    	}

    }
	

?>
