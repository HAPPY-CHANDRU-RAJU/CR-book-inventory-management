<?php
	ob_start();
	session_start();
	include_once 'utilities_ini.php';
	require_once 'connector.php';
	if (!isset($_SESSION['User_id']) ) {
		header("Location: index.php");
		exit;
	}

	$error = FALSE;
	
	if( isset($_POST['btn-login'],$_POST['token']) ) {	
		if ( validate_token($_POST['token']) ) {
		
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$loca = trim($_POST['location']);
		$loca = strip_tags($loca);
		$loca = htmlspecialchars($loca);
		
		if(empty($name) || (strlen($name)< 8) ){
			$error = TRUE;
			$nameError = "Please Enter Name <sub> ( Min 8 Characters ) </sub>";
		}
		
		if(empty($loca) || (strlen($loca)< 3) ){
			$error = TRUE;
			$locaError = "Please Enter Location <sub> ( Min 3 Characters ) </sub>";
		}
		
		if (!$error) {
			
			$pvtKeyID = hash('sha256', $name); 
			$hashname =  md5(sha1(md5($pvtKeyID).time()).time()); 
			
            $usid = $_SESSION['User_id'];
            $fullName = " ".$name.",".$loca;
			$sql5 = "INSERT INTO `store` (`StoreId`, `UserId`, `StoreName`, `StoreStatus`, `StoreDoc`) VALUES ('$hashname', '$usid', '$fullName', 'ACTIVE', current_timestamp());";
			$res5 = $conn->prepare($sql5);
			$res5->execute();
			
			if(($res5->rowCount()==1)) {
                unset($hashname);
                unset($pvtKeyID);
                unset($usid);
                $stat = "success";
				$errMSG = "Successfully Added...<br>";
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
	<meta http-equiv="refresh" content="60"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
  	<link rel="stylesheet" href="assets/style.css"/>
		<link rel="icon" href="https://thumbs.dreamstime.com/z/hands-around-world-globe-education-book-save-care-diversity-logo-icon-clip-art-hands-around-world-globe-education-book-157596431.jpg" >

	<title>CR Book Inventory Management - Add Store</title>
</head>
<body>
<?php
	include_once('nav.php');
?>
<br/><br/><br/>
        
<div class="container-fluid">
	<div class="row" style="background: url('https://cdn.slidemodel.com/wp-content/uploads/2074-01-worldmap-connections-16x9-1.jpg');background-size: inherit;height: 635px;">
		<br/><br/>
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
            	<h2 class="text-default" style="color: #ffffff"> <b>Add a store </b></h2>
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
            	<input type="text" name="name" class="form-control" placeholder="Enter Your Store Name" value="<?php if(isset($name)) echo $name; ?>" minlength="8" maxlength="40" required />
                </div>
                <span class="text-danger"><?php if(isset($nameError)) echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
            	<input type="text" name="location" class="form-control" placeholder="Enter Your Store Location" value="<?php if(isset($loca)) echo $loca; ?>"  minlength="3" maxlength="15" required />
                </div>
                <span class="text-danger"><?php if(isset($locaError)) echo $locaError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
           
        <input type="hidden" name="token" value="<?php echo _token(); ?>">
            <div class="form-group" >
            	<button type="submit"  class="btn btn-block btn-success" name="btn-login"><b>ADD NOW</b>&nbsp;&nbsp;<i class="glyphicon glyphicon-triangle-right"></i></button><br/>
            </div>
            
   
        </div>
   
    </form>
    </div>
		</div>
		<div class="col-sm-3"></div>
		<br/><br/>
	</div>
	</div>
	<div class="row">
		<?php include_once "copyrights.php"; ?>
	</div>
</div>
	
</body> 
</html>
<?php ob_flush(); ?>