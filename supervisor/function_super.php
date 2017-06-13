<?php
                  $conn = new MongoClient();
                  $db= $conn->SPOTLITE;
                  $collection = $db->supervisor;
                  $cursor = $collection->find(array('sid' =>$_SESSION['supervisor'] ));                  
                  
                  foreach ($cursor as $doc)
                  {
                      for($i=0;$i<count($doc['editor_data']);$i++)
                      {                          
                          
                          echo '<tr><td>'.$doc['editor_data'][$i]['app_id'].'</td>'; 
                          echo '<td>'.$doc['editor_data'][$i]['editor_id'].'</td>';
                          echo '<td>'.$doc['editor_data'][$i]['file'].'</td>';
                          echo '<td>'.$doc['editor_data'][$i]['status'].'</td>';

                          echo '<td id="file"><a class="btn btn-info" href="../supervisor/files/'.$doc['editor_data'][$i]['file'].'"><i class="fa fa-download" aria-hidden="true"></i></a></td>';

                          if($doc['editor_data'][$i]['status']=='Accepted')
                          {
                              echo '<td id="file">Accepted</td>';
                          }
                          else if ($doc['editor_data'][$i]['status']=='Rejected')
                          {
                            echo '<td id="file">Rejected</td>';
                          }
                          else if($doc['editor_data'][$i]['status']=='pending'){

                              echo '<td id="file">
                                          <button class="btn btn-info" type="accept" id="'.$doc['editor_data'][$i]['app_id'].'" >Accept</i></button>
                                    </td>';
                              echo '<td>
                                  <button  class="btn btn-danger" type="reject" type="reject"  id="'.$doc['editor_data'][$i]['app_id'].'">Reject</button>  
                                </td>';
                          }
                                                 
                          echo '</tr>';           
                      }
                  }      
              ?>