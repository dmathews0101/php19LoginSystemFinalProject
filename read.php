<?php
// Condition to check if parameter id exists
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'programmationweb3');
 
/* Connecting to database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// If Unsuccessful connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
    
    // Select query to get the user with selected id
    $sql = "SELECT * FROM tp_user WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Variables are bind to the prepared statement as the respective parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["firstName"];
                $address = $row["lastName"];
                $salary = $row["email"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                        <h1>View Record</h1>
                    </div>
					<div class="form-group">
                        <label>ID</label>
                        <p class="form-control-static"><?php echo $row["id"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>FirstName</label>
                        <p class="form-control-static"><?php echo $row["firstName"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>LastName</label>
                        <p class="form-control-static"><?php echo $row["lastName"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>userName</label>
                        <p class="form-control-static"><?php echo $row["userName"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>UserPassword</label>
                        <p class="form-control-static"><?php echo $row["userPassword"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>CreationDate</label>
                        <p class="form-control-static"><?php echo $row["creationDate"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>ModificationDate</label>
                        <p class="form-control-static"><?php echo $row["modificationDate"]; ?></p>
                    </div>
					
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>