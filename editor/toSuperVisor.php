<?php
session_start();
$conn = new MongoClient();
$db= $conn->SPOTLITE;
if(isset($_POST['app_id']) && $_POST['optype']=='approve' && $_POST['faculty'])
{	
   // $_SESSION['editor_name'];
     $r = $_POST['app_id'];  
     $collection = $db->student;

     $cursor = $collection->find(array('app_id' => $r));
     $collection->update(
        array('app_id' => $r),
        array('$set'=>array('Verify'=>'YES'))
     );   

     foreach ($cursor as $student_deails){
         $file = $student_deails['File'];             
     }

     $document =  array(
                "editor_id"=>'editor',
                "app_id" => $r,
                "file" => $file,
                "status" =>"pending"
            );
    $collection = $db->supervisor;
    
    if($collection->update(array("sid"=>$_POST['faculty']),array('$push'=>array("editor_data"=>$document))))
    {
        $newfile = 'forwarded_by_editor_'.$file;
        $to = '../pdfs/'.$file;
        $from = '../supervisor/files/'.$newfile;
        copy($to, $from);
        echo 'forwarded_done';
    }
         
} 

/*
$collection = $db->supervisor_logins;
$document =  array(
	"username" => "supervisor",
	"password" => "supervisor",
	"Email-id" => "supervisor2@spoiler.com"
	);
$collection->insert($document);
*/
?>