<?php	

// Parameters to connect to database using sqli
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'programmationweb3');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM tp_user WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Parameters are set
            $param_id = $id;
            
            // Executing the prepared statement, if successful the if block is executed
            if(mysqli_stmt_execute($stmt)){
    
            $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* If the result has only one row */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Getting individual field values and assigning it to seperate variables
                    $id = $row["id"];
                    $firstName = $row["firstName"];
                    $lastName = $row["lastName"];
                    $email = $row["email"];
                    $userName = $row["userName"];
                    $userPassword = $row["userPassword"];
                } else{
                    // Displaying error page if more than 1 row exists
                    header("location: error.php");
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        mysqli_stmt_close($stmt);
        
        mysqli_close($link);
    }  
		
	//Update query using pdo
	
	$db = new PDO('mysql:host=localhost;dbname=programmationweb3;charset=utf8mb4', 'root', '');
	$msg = ""; 
	$msg1= "";
	if(isset($_POST['submitBtnSignUp'])) {
		$id = trim($_POST['id']);
		$fname = trim($_POST['firstName']);
		$lname = trim($_POST['lastName']);
		$email = trim($_POST['email']);
		$uname = trim($_POST['userName']);
		$password = trim($_POST['userPassword']);
		
		$password = password_hash(trim($_POST['userPassword']), PASSWORD_DEFAULT);
		
		$sql ="UPDATE tp_user SET firstName='".$fname."', lastName='".$lname."', email='".$email."', userName='".$uname."', userPassword='".$password."' WHERE id='".$id."'";
				echo $sql;
			
		if ($db->query($sql)) {
			echo "<script type= 'text/javascript'>alert('Row Successfully Updated');</script>";
			header("location: index.php");
		}
		else{
			echo "<script type= 'text/javascript'>alert('Updating row not Successful.');</script>";
			header("location: index.php");
		}		
	} 
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
	    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Update User Details</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id" class="form-control" value="<?php echo $id; ?>" required>
                        </div>
					    <div class="form-group">
                            <label>FirstName</label>
                            <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>" required>
                        </div>
					    <div class="form-group">
                            <label>LastName</label>
                            <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>" required>
                        </div>	
					    <div class="form-group">
                            <label>email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" required>
                        </div>	
					    <div class="form-group">
                            <label>UserName</label>
                            <input type="text" name="userName" class="form-control" value="<?php echo $userName; ?>" required>
                        </div>							
                        <div class="form-group">
                            <label>UserPassword</label>
                            <input type="text" name="userPassword" class="form-control" value="<?php echo $userPassword; ?>" required>
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