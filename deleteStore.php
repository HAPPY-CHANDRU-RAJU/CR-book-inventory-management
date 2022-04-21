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
	

    if (!isset($_GET['storeid']) ) {
		header("Location: dashboard.php");
		exit;
	}

	$sid = $_GET['storeid'];
	$usid = $_SESSION['User_id'];

	$sql7 = "SELECT * FROM `store` WHERE `StoreId`='$sid'";
	$res7 = $conn->prepare($sql7);
	$res7->execute();
	$rows = $res7->fetch();

	if($rows['StoreStatus'] == "INACTIVE"){
		$sql7 = "UPDATE `store` SET `StoreStatus`='ACTIVE' WHERE  `StoreId`='$sid'";
	}else{
		$sql7 = "UPDATE `store` SET `StoreStatus`='INACTIVE' WHERE  `StoreId`='$sid'";
	}
	$res7 = $conn->prepare($sql7);
	if(!$res7->execute()){
		$error = TRUE;
	}

	if(!$error){
		$stat = "success";
		$errMSG = "Successfully Updated...<br>";
		header("Location: dashboard.php?storeShow=TRUE");
		exit;
	} else {
		$stat = "danger";
		$errMSG = "Something Wents Wrong, Try again...<br>";
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

	<title>CR Book Inventory Management - Delete Store</title>
</head>
<body>
<?php
	include_once('nav.php');
?>
<br/><br/><br/>
        
<div class="container-fluid">
	<div class="row" style="background: url('https://s26162.pcdn.co/wp-content/uploads/2019/09/books-1163695_1920.jpg');background-size: inherit;height: 635px;">
		<br/>
		<div class="col-sm-3"></div>
		<div class="col-sm-5" style="background: rgb(0 0 0 / 55%);
    border-radius: 10px;
    color: #ffffff;
    box-shadow: 1px 2px 0px 1px #747070;
    margin: 50px;">
				<div id="login-form">
    	<div class="col-md-12">
        	<div class="form-group">
            	<h2 class="text-default" style="color: #ffffff"> <b>Delete Your Store </b></h2>
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
        </div>
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