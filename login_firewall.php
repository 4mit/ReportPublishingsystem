<?php
error_reporting(E_ALL);
  $conn = new MongoClient();
  $db= $conn->SPOTLITE;
  
  $usertype= $_POST['usertype'];
  $username = $_POST['username'];
  $pass = $_POST['pass'];

  if($usertype=='Editor')
  {
      $collection = $db->editor;  	
      $rows = $collection->find(array("eid"=>$username,"password"=>$pass))->count();
      echo $rows;
      if($rows==1)
      {   
           session_start();
           $_SESSION['editor_name'] = $username;
           header("Refresh:0,url=editor/index.php");
    	}
    	else
    	{
    		  echo '<script type="text/javascript"> alert("Username and Password incorrect")</script>';
    	    header("Refresh:0,url=home.html?loginfailue");
    	}	

  }
else if ($usertype=="Supervisor") {
	   echo $usertype;
      $collection = $db->supervisor;

      $rows = $collection->find(array("sid"=>$username,"pass"=>$pass))->count();
      
      if($rows==1)
      {   
           
           if(session_start()){session_destroy();}
           session_start();
           $_SESSION['supervisor'] = $username;
           header("Refresh:0,url=supervisor/index.php");
      }
      else
      {
          echo '<script type="text/javascript"> alert("incorrect supervisor")</script>';
          header("Refresh:0,url=home.html?loginfailue");
      }
}

else if ($usertype=="Reviewer") {
    $collection = $db->reviewer;; 
	  
    $ans = $collection->find(array("rName"=>$username,"rPass"=>$pass)); 
    if($ans)
    {
       session_start();
       $_SESSION['reviewer'] = $username;
       header("Refresh:0,url=reviewer/index.php");

    }
    else
    {
    	echo '<script type="text/javascript"> alert("Username and Password incorrect")</script>';
	    header("Refresh:0,url=home.html?loginfailue");
    }
}

?>