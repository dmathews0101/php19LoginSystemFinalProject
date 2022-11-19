
<?php 
	session_start(); 
	$db = new PDO('mysql:host=localhost;dbname=programmationweb3;charset=utf8mb4', 'root', '');
	$msg = ""; 
	$msg1= "";
	if(isset($_POST['submitBtnLogin'])) {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		
		if($username != "" && $password != "") {
			try {
				$query = "select * from `tp_user` where `userName`=:username";
				$stmt = $db->prepare($query);
				$stmt->bindParam('username', $username, PDO::PARAM_STR);
				$stmt->execute();
				$count = $stmt->rowCount();
				$row   = $stmt->fetch(PDO::FETCH_ASSOC);
			if($count == 1 && !empty($row) && password_verify($password, $row['userPassword'])) {
				$_SESSION['sess_user_id']   = $row['id'];
				$_SESSION['sess_username'] = $row['firstName'];
				$_SESSION['sess_name'] = $row['userName'];
				header('location:index.php');
			} else {
				$msg = "Invalid username and password!";
			}
		} catch (PDOException $e) {
			echo "Error : ".$e->getMessage();
		}
	} else {
		$msg = "Both fields are required!";
	}
}

	if(isset($_POST['submitBtnSignup'])) {
		header("Location: form.php"); 
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Page</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>

body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}

</style>
</head>

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submitBtnLogin" class="btn btn-info btn-md" value="Login">
                                <input type="submit" name="submitBtnSignup" class="btn btn-info btn-md" value="SignUp">
								<span class="loginMsg"><?php echo @$msg;?>
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="#" class="text-info" name="submitBtnSignup">Forgot Password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
