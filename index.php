<!DOCTYPE html>

<html>

<head>
<meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<title>Title</title>
<style>
.highlight {
background-color: skyblue; }

h2{
	color:red;
}
</style>

</head>

<body>

<form name="form_update" method="post" action="exercise-school-teacher.php">

<?php

session_start(); 

if(!isset($_SESSION['sess_username'])) {
	echo "<script type= 'text/javascript'>alert('User not logged in.');</script>";
	header("Location: login.php"); 
}

// 1 - prepare the connection
$connectionDb = new PDO('mysql:host=localhost:3306;dbname=programmationweb3;charset=utf8','root','');
// 2 – prepare the query
$result = $connectionDb->prepare("select  id , firstName, lastName, email, userName, userPassword, creationDate, modificationDate from tp_user");
// 3 – add the parameters (inutil)

echo "<div class='container'>
  <h2>Current User : ".$_SESSION['sess_username']."</h2> 
  <p>List of all users</p>";

echo "<table border='1' class='table table-hover'>
<tr>
<th>id</th>
<th>firstName</th>
<th>lastName</th>
<th>email</th>
<th>userName</th>
<th>userPassword</th>
<th>creationDate</th>
<th>modificationDate</th>
<th>Action</th>
</tr>";
// 4 - run the query and retrieve thecursor
$result->execute();
// 5 fetch data line by line

//drop down
while($line=$result->fetch())
{
	if($line['id']==$_SESSION['sess_user_id']){
		echo "<tr class='highlight'>";
		echo "<td>" . $line['id'] . "</td>";
		echo "<td>" . $line['firstName'] . "</td>";
		echo "<td>" . $line['lastName'] . "</td>";
		echo "<td>" . $line['email'] . "</td>";
		echo "<td>" . $line['userName'] . "</td>";
		echo "<td>" . $line['userPassword'] . "</td>";
		echo "<td>" . $line['creationDate'] . "</td>";
		echo "<td>" . $line['modificationDate'] . "</td>";
		echo "<td>";
		echo "<a href='read.php?id=". $line['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
		echo "<a href='update.php?id=". $line['id'] .'&firstName='. $line['firstName'] .'&lastName='. $line['lastName'] .'&email='. $line['email'] .'&userName='. $line['userName'] .'&userPassword='. $line['userPassword'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
		echo "<a href='delete.php?id=". $line['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
		echo "</td>";
		echo "</tr>";
	}
	else
	{
		echo "<tr>";
		echo "<td>" . $line['id'] . "</td>";
		echo "<td>" . $line['firstName'] . "</td>";
		echo "<td>" . $line['lastName'] . "</td>";
		echo "<td>" . $line['email'] . "</td>";
		echo "<td>" . $line['userName'] . "</td>";
		echo "<td>" . $line['userPassword'] . "</td>";
		echo "<td>" . $line['creationDate'] . "</td>";
		echo "<td>" . $line['modificationDate'] . "</td>";
		echo "<td>";
		echo "<a href='read.php?id=". $line['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
		echo "<a href='update.php?id=". $line['id'] .'&firstName='. $line['firstName'] .'&lastName='. $line['lastName'] .'&email='. $line['email'] .'&userName='. $line['userName'] .'&userPassword='. $line['userPassword'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
		echo "<a href='delete.php?id=". $line['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
		echo "</td>";
		echo "</tr>";		
	}
}
echo "</table>";
echo "</div>";
?>




</form>

<div class='container'>
<br><a href="signout.php">Sign Out</a>
<br><a href="form.php" >Go to Sign Up Page</a>
</div>


</body>
</html>
