<?php     

	  session_start();	
      $conn = new MongoClient();
      $db= $conn->SPOTLITE;
      $collection = $db->editor;
      
      function fetch_student_data($student_id)
      {
            $conn = new MongoClient();
            $db= $conn->SPOTLITE;
            $collection = $db->student;
            
            $condition = array(
                '$and' => array(
                    array(
                        "app_id" => $student_id,
                        'Verify' => '0'
                    )
                )
            );

            $cursor = $collection->find($condition);
            foreach ($cursor as $student_deails)
            {
                 echo '<td>'.$student_deails['Name'].'</td>';
                 echo '<td>'.$student_deails['Roll Number'].'</td>';
                 echo '<td>'.$student_deails['Email-id'].'</td>';
                 echo '<td>'.$student_deails['Department'].'</td>';
                 echo '<td id="faculty">'.$student_deails['Faculty'].'</td>'; 
                 echo '<td id="file"><a class="btn btn-info" href="../pdfs/'.$student_deails['File'].'"><i class="fa fa-download" aria-hidden="true"></i></a></td>';
                 echo '<td>
                        <button name="accept" type="button" class="btn btn-danger" id="'.$student_deails['app_id'].'"><i class="fa fa-share" aria-hidden="true"></i></button>  
                      </td>
                </tr>';              
            }
      }
      
      $rev_id = $_SESSION['reviewer'];
      $cursor = $collection->find(array('eid' => 'editor'));
      foreach ($cursor as $doc)
      {
          echo '<tr >';     
          for($i=0;$i<count($doc['student_data']);$i++)
          {                          
              fetch_student_data($doc['student_data'][$i]['app_id']);             
          }                                        
      }      
    ?>