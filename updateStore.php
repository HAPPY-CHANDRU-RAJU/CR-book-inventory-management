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

    $desp = explode( ',', $rows["StoreName"] );

	print_r($rows["StoreName"]);

	if( isset($_POST['btn-login'],$_POST['token'],$_GET['storeid']) ) {	
		if ( validate_token($_POST['token']) ) {

		
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
        
        $loca = trim($_POST['location']);
        $loca = strip_tags($loca);
        $loca = htmlspecialchars($loca);
/** update */

		if((($name != $desp[0]) && (!empty($name))) && (($loca != $desp[1]) && (!empty($loca)))){
			$res = " ".$name.",".$loca;
		}else{
			if(($name != $desp[0])  && (!empty($name)) ){
				if(!empty($desp[1])){
					$res = " ".$name.",".$desp[1];
				}else{
					$res = " ".$name.", Location";
				}
			}

			if (($loca != $desp[1]) && (!empty($loca))) {

				if(!empty($desp[0])){
					$res = " ".$desp[0].",".$loca;
				}else{
					$res = " Name ,".$loca;

				}
			}
		}


        $sql7 = "UPDATE `store` SET `StoreName`='$res' WHERE  `StoreId`='$sid'";
				$res7 = $conn->prepare($sql7);
				if(!$res7->execute()){
					$error = TRUE;
				}

		if(!$error){
			$stat = "success";
			$errMSG = "Successfully Updated...<br>";
		} else {
			$stat = "danger";
			$errMSG = "Something Wents Wrong, Try again...<br>";
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

	<title>CR Book Inventory Management - Update Store</title>
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?storeid=<?php echo $sid; ?>" autocomplete="off">
    
    	<div class="col-md-12">
        	<div class="form-group">
            	<h2 class="text-default" style="color: #ffffff"> <b>Update Your Store </b></h2>
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
            	<input type="text" name="name" class="form-control" placeholder="Enter Your Store Name" value="<?php if(isset($name)) echo $name; ?>" minlength="8" maxlength="40"  />
                </div>
                <span class="text-danger"><?php if(isset($nameError)) echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
            	<input type="text" name="location" class="form-control" placeholder="Enter Your Store Location" value="<?php if(isset($loca)) echo $loca; ?>"  minlength="3" maxlength="15"  />
                </div>
                <span class="text-danger"><?php if(isset($locaError)) echo $locaError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
           
        <input type="hidden" name="token" value="<?php echo _token(); ?>">
            <div class="form-group" >
            	<button type="submit"  class="btn btn-block btn-success" name="btn-login"><b>UPDATE NOW</b>&nbsp;&nbsp;<i class="glyphicon glyphicon-triangle-right"></i></button><br/>
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