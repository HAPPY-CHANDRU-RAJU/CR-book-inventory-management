<?php
	ob_start();
	session_start();
	include_once 'utilities_ini.php';
	include_once 'connector.php';
	if (isset($_SESSION['User_id']) ) {
		header("Location: home.php");
		exit;
	}
	
	$error = FALSE;
	
	
	if( isset($_POST['btn-signup'],$_POST['token']) ) {	
		if ( validate_token($_POST['token']) ) {
				
			
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		$name = strtoupper($name);
			
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
			
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		
		if(empty($pass) || (strlen($pass)< 8) ){
			$error = TRUE;
			$passError = "Please Enter Password <sub> ( Min 8 Characters ) </sub>";
		}
		
		if(empty($name) || (strlen($name)< 3) ){
			$error = TRUE;
			$nameError = "Please Enter Name <sub> ( Min 3 Characters ) </sub>";
		}
		
		
		if(emailVerify($email)){
			$error = TRUE;
			$emailError = "Please Check E-mail Id";
		}else{
			$sql2 = 'SELECT * FROM `user` WHERE `userEmail`="'.$email.'"';
			$res2 = $conn->prepare($sql2);
			$res2->execute();

			$count = $res2->rowcount();

			if($count!=0){
				$error = TRUE;
				$emailError = "Provided Email is already in use.";
			}
		}
		
		if (!$error) {
			
			$password = hash('sha256', $pass); 
			$pvtKeyID = md5(sha1(md5($password).time()).time()); 
			$encode_id = base64_encode("encodeMYUserid{$pvtKeyID}");
			$sql1 = "INSERT INTO `user`(`userId`, `userName`, `userEmail`, `userPassword`, `userDoc`) VALUES ('$pvtKeyID','$name', '$email', '$password', current_timestamp())";
			$res1 = $conn->prepare($sql1);
			$res1->execute();
			
			if($res1){
					unset($pkid);
					unset($password);
					_token();
					$stat = "success";
					$errMSG = "Registered Successfully";	
				}else {
					$stat = "danger";
					$errMSG = "Something went wrong, try again later...";	
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
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
  	<link rel="stylesheet" href="assets/style.css"/>
	<link rel="icon" href="https://thumbs.dreamstime.com/z/hands-around-world-globe-education-book-save-care-diversity-logo-icon-clip-art-hands-around-world-globe-education-book-157596431.jpg" >
	<title>CR Book Inventory Management - Registration</title>
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
        <li><a href="index.php"><span class="glyphicon glyphicon-log-in "></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  <br/><br/><br/>
<div class="container-fluid">
	<div class="row" style="background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Ym9vayUyMHN0b3JlfGVufDB8fDB8fA%3D%3D&w=1000&q=80');background-size: cover;">
		<br/><br/><br/><br/>
		<div class="col-sm-3"></div>
		<div class="col-sm-5" style="background: rgb(0 0 0 / 55%);border-radius: 10px;color: #ffffff;box-shadow: inset 6px 4px 16px 1px #747070;margin: 50px;">
				<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        	<div class="form-group">
            	<h2 class="text-default" style="color: #ffffff"> <b>Create my account</b></h2>
            </div>
            
             <div class="form-group" style="color: #ffffff">
Already have an account&nbsp;?&nbsp;&nbsp;<a href="index.php" class="" id="nolink"><b>Log In Here...</b></a>
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
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Your Name" value="<?php if(isset($name)) echo $name; ?>" maxlength="25" required />
                </div>
                <span class="text-danger"><?php if(isset($nameError)) echo $nameError; ?></span>
            </div>
            
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
            	<input type="password" name="pass" id="pass" class="form-control" placeholder="Your Password" maxlength="15" required />
                </div><br/>
                <div class="progress" id="progressfield" >
    <div class="progress-bar progress-bar-danger progress-bar-striped active" id="progress" rCR Book Inventory Management="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width:0%">
    </div>
  				</div>
                
                <span class="text-danger"><?php if(isset($passError)) echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
           
        <input type="hidden" name="token" value="<?php echo _token(); ?>">
            <div class="form-group" >
            	<button type="submit"  class="btn btn-block btn-success" name="btn-signup" id="submit"><b>SIGN UP</b>&nbsp;&nbsp;<i class="glyphicon glyphicon-triangle-right"></i></button><br/>
        <p align="center">By clicking "&nbsp;<b>SIGN UP</b>&nbsp;" you agree our Terms of Use and Privacy Policy.</p>
            </div>
            
   
        </div>
   
    </form>
    </div>
		</div>
		<div class="col-sm-3"></div>
		<br/><br/><br/><br/>
	</div>
	<div class="row" >
		<?php include_once "copyrights.php"; ?>
	</div>
</div>
<script type="text/javascript">

var password = document.getElementById('pass');
var meterfield = document.getElementById('progressfield');
var meter = document.getElementById('progress');
var btnsubmit = document.getElementById('submit');
	
meterfield.style.display='none';
btnsubmit.className = " btn btn-block btn-success disabled";
password.addEventListener('input', function() {
  var val = password.value;
  var result = zxcvbn(val);
	meterfield.style.display='block';
  meter.value = result.score;
  

if(meter.value == 1){
	meter.className = "progress-bar progress-bar-danger progress-bar-striped active";
	meter.style.width = '25%';
}

if(meter.value == 2){
	meter.className = "progress-bar progress-bar-warning progress-bar-striped active";
	meter.style.width = '50%';
}

if(meter.value == 3){
	meter.className = "progress-bar progress-bar-warning progress-bar-striped active";
	meter.style.width = '75%';
}

if(meter.value==4){
	meter.className = "progress-bar progress-bar-success progress-bar-striped active";
	btnsubmit.className = "btn btn-block btn-success active";
	meter.style.width = '100%';
}

if(meter.value<4)
	btnsubmit.className = "btn btn-block btn-success disabled";
});
	</script>
</body> 
</html>
<?php ob_flush(); ?>