<?php
	ob_start();
	session_start();
	require_once 'utilities_ini.php';
	require_once 'connector.php';

	if ( isset($_SESSION['User_id']) ) {
		header("Location: home.php");
		exit;
	}
	
	$error = FALSE;
	
	if( isset($_POST['btn-login'],$_POST['token']) ) {	
		if ( validate_token($_POST['token']) ) {
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		if(empty($pass) || (strlen($pass)< 6) ){
			$error = TRUE;
			$passError = "Please Enter Password <sub> ( Min 6 Characters ) </sub>";
		}
		
		if(emailVerify($email)){
			$error = TRUE;
			$emailError = "Please Check E-mail Id";
		}
		
		if (!$error) {
			
			$password = hash('sha256', $pass); 
			
			$sql5 = "SELECT * FROM `user` WHERE `userEmail`='$email';";
			$res5 = $conn->prepare($sql5);
			$res5->execute();
			$row = $res5->fetch();
			
			if(($res5->rowCount()==1)&&($row['userPassword']==$password)) {
			  	$_SESSION['User_id'] = $row['userId'];
				header("Location: home.php");
			} else {
				$stat = "danger";
				$errMSG = "Incorrect Credentials, Try again...<br>";
			}
				
		}
		
	   }
	}
?>
<!DOCTYPE >
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
  	<link rel="stylesheet" href="assets/style.css"/>
	<link rel="icon" href="https://thumbs.dreamstime.com/z/hands-around-world-globe-education-book-save-care-diversity-logo-icon-clip-art-hands-around-world-globe-education-book-157596431.jpg" >
	<title>CR Book Inventory Management - Login</title>
</head>
<body>


<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">&nbsp;&nbsp;CR Book Inventory Management</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="AboutUs.php"><span class="fa fa-info"></span>&nbsp;&nbsp;About Us</a></li>
        <li><a href="registrationForm.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      </ul>
    </div>
  </div>
</nav>
  <br/><br/><br/>
<div class="container-fluid">
	<div class="row" style="background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Ym9vayUyMHN0b3JlfGVufDB8fDB8fA%3D%3D&w=1000&q=80');background-size: cover;">
		<br/><br/><br/><br/>
		<div class="col-sm-3"></div>
		<div class="col-sm-5" style="background: rgb(0 0 0 / 55%);
    border-radius: 10px;
    color: #ffffff;
    box-shadow: 1px 2px 0px 1px #747070;
    margin: 50px;">
				<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        	<div class="form-group">
            	<h2 class="text-default" style="color: #ffffff"> <b>Log in to your account</b></h2>
            </div>
            
             <div class="form-group" style="color: #ffffff">
Don't have an account&nbsp;?&nbsp;&nbsp;<a href="registrationForm.php" style="color: #1db6d9;" id="nolink"><b>Sign Up Here...</b></a>
            </div>
         
            <div class="form-group">
            	<hr />
            </div>
           
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo $stat ;?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php if(isset($email)) echo $email; ?>" maxlength="40" required />
                </div>
                <span class="text-danger"><?php if(isset($emailError)) echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" required />
                </div>
                <span class="text-danger"><?php if(isset($passError)) echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
           
        <input type="hidden" name="token" value="<?php echo _token(); ?>">
            <div class="form-group" >
            	<button type="submit"  class="btn btn-block btn-primary" name="btn-login"><b>LOG IN</b>&nbsp;&nbsp;<i class="glyphicon glyphicon-triangle-right"></i></button><br/>
            </div>
            
   
        </div>
   
    </form>
    </div>
		</div>
		<div class="col-sm-3"></div>
		<br/><br/><br/><br/>
	</div>

	
	<div class="row">
		<?php include_once "copyrights.php"; ?>
	</div>
</div>
</body> 
</html>
<?php ob_flush(); ?>