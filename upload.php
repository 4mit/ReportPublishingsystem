<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student File Upload</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/alertify.min.js"></script>
  <link rel="stylesheet" href="css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/themes/default.min.css"/>
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.10.0/css/themes/semantic.min.css"/>
  <style type="text/css">

     textarea {
       width: 45%;
       height: 130px;
       padding: 12px 20px;
       box-sizing: border-box;
       border: 1px solid #ccc;
       border-radius: 4px;
       background-color: #f8f8f8;
       font-size: 16px;
       resize: none;
       color:black;
     }
     #error_p{color:green;}
    .change{
      background-color: #DCDCDC;
      padding: 2px;
      width:80%;
      margin-left: 10%;

    }
    input[type=text], input[type=number],input[type=date] {

      padding: 5px 10px;
      width: 45%;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;color: #2DA50A;

    }
    input[type=file]{
      outline:none;
    }      
    select {

      padding: 5px 10px;
      width: 45%;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      color: #2DA50A;

    }                      
    lable{
      padding-right: 50px;
    }
    input[type=submit]{
     margin: 4px 120px;

   }
   form{
    border: 1px solid #ccc;

  }   



</style>
</head>
<body>
  <div class="loading">Loading&#8230;</div>
  <?php include('header.php');?>


  <div class="container">
    <div class="header" id="headera">
      <center><h2 style="margin-left: 10%" ><b>Hello Student!</b></h3></center>
      <center><h3 style="margin-left: 10%" ><b>Please upload your file</b></h3></center>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <form method="post" enctype="multipart/form-data" name="uploadForm" id="myform" class="form">       
          <div class="panel panel-default">
            <div class="panel-body form-horizontal payment-form">

              <div class="form-group">
                <label for="status" class="col-sm-3 control-label">DEPARTMENT</label>
                <div class="col-sm-6">
                  <select name="selectdepartment" class="form-control" id="status">
                    <option value="Computer Science and Engineering Depatment">Computer Science and Engineering Depatment</option>
                    <option value="Mechanical Engineering Depatment">Mechanical Engineering Depatment</option>
                    <option value="Civil Engineering Depatment">Civil Engineering Depatment</option>
                    <option value="Electronics and Commun Engineering Depatment">Electronics and Commun Engineering Depatment</option>
                    <option value="Electrical Engineering Depatment">Electrical Engineering Depatment</option>
                  </select>
                </div>
              </div>


              <div class="form-group">
                <label for="status" class="col-sm-3 control-label"><b>Superviser Name:</b></label>
                <div class="col-sm-6">
                  <select name="selectfaculty" class="form-control" id="status">

                    <option value="Dr. Vineeth Paleri">Dr. Vineeth Paleri</option>
                    <option value="Dr. S.D Madhu Kumar">Dr. S.D Madhu Kumar</option>
                    <option value="Dr. Priya Chandran">Dr. Priya Chandran</option>
                    <option value="Dr. Abdul Naseer">Dr. Abdul Naseer</option>
                    <option value="Dr. Sudeep K.S ">Dr. Sudeep K.S</option>
                    <option value="Dr. Saidalvi Kalady">Dr. Saidalvi Kalady</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="concept" class="col-sm-3 control-label">NAME </label>
                <div class="col-sm-6">
                  <input id="Name" name="Name" type="text" class="form-control"  required="required" placeholder="Your name">
                </div>
              </div>

              <div class="form-group">
                <label for="concept" class="col-sm-3 control-label">Roll Number:</label>
                <div class="col-sm-6">
                  <input type="text" id="rollnumber" name="rollnumber" class="form-control" required="required" ">
                </div>
              </div>


              <div class="form-group">
                <label for="amount" class="col-sm-3 control-label">Email ID:</label>
                <div class="col-sm-6">
                  <input type="email" id="emailid" name="emailid" class="form-control" required="required">
                </div>
              </div> 

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
     </form>           
   </div> <!-- / panel preview -->
 </div>
</div>
</div>


<script type="text/javascript">
  $('div.loading').hide();
  $(document).ajaxStart(function(){
    $('div.loading').show();
  });

  $( document ).ajaxComplete(function( event, xhr, settings ) {
    $('div.loading').hide();
  });

  $("form#myform").submit(function(e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
      url: 'action.php',
      type: 'POST',
      data: formData,
      async: true,
      cache: false,
      contentType: false,
      processData: false,
      success: function (returndata) 
      {        
        if($.trim(returndata)=="OK_"){alertify.alert('Success', 'All right you done !', function(){ alertify.success('Click me ssmiss'); });
      }else if($.trim(returndata)=="FILE_EXISTS_ALREADY"){
        alertify.warning('oops something went wrong with  file please choose correct file .');

        location.reload();
      }
      else{var r = JSON.parse(returndata);for(var i=0;i<r.length;i++){var obj = r[i];for(var key in obj){alertify.error(obj[key]);}}
    }
  },
  error:function(){console.log('error');}
});
  });
</script>
</body>
</html>
