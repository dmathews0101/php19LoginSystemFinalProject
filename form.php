<?php	
	$db = new PDO('mysql:host=localhost;dbname=programmationweb3;charset=utf8mb4', 'root', '');
	$msg = ""; 
	$msg1= "";
	if(isset($_POST['submitBtnSignUp'])) {
		$id = trim($_POST['id']);
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$email = trim($_POST['email']);
		$uname = trim($_POST['uname']);
		
		$password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
			
		$sql = "INSERT INTO tp_user (id, firstName, lastName, email, userName, userPassword) VALUES ('".$id."','".$fname."', '".$lname."', '".$email."','".$uname."','".$password."')";
				
		if ($db->query($sql)) {
			echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
		}
		else{
			echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
		}		
	} 

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
		h2{
			text-align:center;
		}
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2><span class="glyphicon glyphicon-user"></span>  Add User</h2>
                    </div>
                    <p>Form to submit to add a new user to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					
						<div class="form-group ">
							<label>ID</label>
							<input type="text" name="id" class="form-control" >
						</div>
						
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control">
                        </div>
						
						<div class="form-group ">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control" >
                        </div>
						
						<div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
						
						
						<div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="uname" class="form-control" >
                        </div>
						
						<div class="form-group">
                            <label>User Password</label>
                            <input type="text" name="password" class="form-control" >
                        </div>
						                       
                        <input type="submit" name = "submitBtnSignUp" class="btn btn-primary" value="Submit">
                        <a href="login.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>