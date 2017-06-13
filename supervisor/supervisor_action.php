<?php

session_start();
      $conn = new MongoClient();
      $db= $conn->SPOTLITE;
      $collection = $db->supervisor;

     if(isset($_POST['listallverified']))
     {
            
            $cursor = $collection->find(array('isVerified' => 'YES' ));
            foreach ($cursor as $doc)
            {
                echo '<tr id="tbl">     
                        <td> '.$doc['Name'].       '</td>
                        <td >'.$doc['Roll Number'].'</td>
                        <td> '.$doc['Email-id'].   '</td>
                        <td> '.$doc['Department']. '</td>
                        <td> '.$doc['Faculty'].    '</td>
                        <td> '.$doc['Report Subject'].'</td>
                        <td><button name="accept" type="button" class="btn btn-primary" id="'.$doc['app_id'].'">=></button></td>
                      </tr>';
            }      
     } 

     if(isset($_POST['app_id']) && isset($_POST['action_type']))
     {         
          if($_POST['action_type']=="accept")
          {
              $r = $_POST['app_id'];
              
        
              $result = $_SESSION['supervisor'];
              if($collection->update(array('sid'=>$result,'editor_data.app_id'=>$r),array('$set'=>array('editor_data.$.status'=>'Accepted'))))
              {
                $collection = $db->editor;//
                $collection->update(array('eid'=>'editor','student_data.app_id'=>$r),array('$set'=>array('student_data.$.supervisor_action'=>'Accepted')));
                echo 'Accepted';

              }
          }
          if($_POST['action_type']=="reject")
          {
              $r = $_POST['app_id'];
              
              $collection = $db->supervisor;   
              $result = $_SESSION['supervisor'];
              if($collection->update(array('sid'=>$result,'editor_data.app_id'=>$r),array('$set'=>array('editor_data.$.status'=>'Rejected'))))
              {

                $collection = $db->editor;//
                $collection->update(array('eid'=>'editor','student_data.app_id'=>$r),array('$set'=>array('student_data.$.supervisor_action'=>'Rejected')));
                
                //supervisor_action
                echo 'Rejected';

              }
          } 
      }     
 ?>
