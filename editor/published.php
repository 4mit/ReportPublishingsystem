<!-- <?php
?> -->
<!DOCTYPE html>
<html>
<head>
  <title>Published reports</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>


  <style>
table {
    border-collapse: collapse;
    width: 80%;
    margin-right: 10%;
    margin-left: 10%;
    align-content: center;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>

<?php include('../header.php'); ?>

<center> <h3> <i> List of reports Published on the server </i> </h3> </center>


<table >
  <tr>
    <th>S. No</th>
    <th>Department</th>
    <th>Supervisor</th>
    <th>Roll No.</th>
    <th>Name</th>
    <th>Topic</th>
    <th>Unique Report ID</th>
  </tr>
  
</table>

</body>
</html>
