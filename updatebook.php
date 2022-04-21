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
	

    if (!isset($_GET['bookid']) ) {
		header("Location: dashboard.php");
		exit;
	}

	$bid = $_GET['bookid'];
	$usid = $_SESSION['User_id'];


	$sql7 = "SELECT * FROM `book` WHERE `BookId`='$bid'";
	$res7 = $conn->prepare($sql7);
	$res7->execute();
	$rows = $res7->fetch();

	if( isset($_POST['btn-login'],$_POST['token'],$_GET['bookid']) ) {	
		if ( validate_token($_POST['token']) ) {

        $id = trim($_POST['id']);
        $id = strip_tags($id);
        $id = htmlspecialchars($id);
		
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$desc = trim($_POST['desc']);
		$desc = strip_tags($desc);
		$desc = htmlspecialchars($desc);

        $price = trim($_POST['price']);
        $price = strip_tags($price);
        $price = htmlspecialchars($price);
        
        $available = trim($_POST['available']);
        $available = strip_tags($available);
        $available = htmlspecialchars($available);

        $storeid = trim($_POST['storeid']);
        $storeid = strip_tags($storeid);
        $storeid = htmlspecialchars($storeid);

        $catid = trim($_POST['catid']);
        $catid = strip_tags($catid);
        $catid = htmlspecialchars($catid);
		
		if(!empty($id)){
			if($id != $rows["BookId"]){
				$sql7 = "UPDATE `book` SET `BookId`='$ids' WHERE  `BookId`='$bid'";
				$res7 = $conn->prepare($sql7);
				if(!$res7->execute()){
					$error = TRUE;
				}
			}
		}

		if(!empty($name)){
			if($name != $rows["BookName"]){
				$sql7 = "UPDATE `book` SET `BookName`='$name' WHERE  `BookId`='$bid'";
				$res7 = $conn->prepare($sql7);
				if(!$res7->execute()){
					$error = TRUE;
				}
			}
		}

		if(!empty($desc)){
			if($desc != $rows["BookDesc"]){
				$sql7 = "UPDATE `book` SET `BookDesc`='$desc' WHERE  `BookId`='$bid'";
				$res7 = $conn->prepare($sql7);
				if(!$res7->execute()){
					$error = TRUE;
				}
			}
		}

		if(!empty($price)){
			if($price != $rows["BookPrice"]){
				$sql7 = "UPDATE `book` SET `BookPrice`='$price' WHERE  `BookId`='$bid'";
				$res7 = $conn->prepare($sql7);
				if(!$res7->execute()){
					$error = TRUE;
				}
			}
		}

		if(!empty($available) || $available == 0){
			if($available != $rows["BookAvailable"]){
				$sql7 = "UPDATE `book` SET `BookAvailable`='$available' WHERE  `BookId`='$bid'";
				$res7 = $conn->prepare($sql7);
				if(!$res7->execute()){
					$error = TRUE;
				}
			}
		}

		if(!empty($storeid)){
			if($storeid != $rows["storeId"]){
				$sql7 = "UPDATE `book` SET `storeId`='$storeid' WHERE  `BookId`='$bid'";
				$res7 = $conn->prepare($sql7);
				if(!$res7->execute()){
					$error = TRUE;
				}
			}
		}

		if(!empty($catid)){
			if($catid != $rows["CatId"]){
				$sql7 = "UPDATE `book` SET `CatId`='$catid' WHERE  `BookId`='$bid'";
				$res7 = $conn->prepare($sql7);
				if(!$res7->execute()){
					$error = TRUE;
				}
			}
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

	<title>CR Book Inventory Management - Update Book</title>
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?bookid=<?php echo $bid ; ?>" autocomplete="off">
    
    	<div class="col-md-12">
        	<div class="form-group">
            	<h2 class="text-default" style="color: #ffffff"> <b>Update Book To Your Store </b></h2>
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
                <span class="input-group-addon">id</span>
            	<input type="text" name="id" class="form-control" placeholder="Enter Book ID" value="<?php if(isset($rows["BookId"])) echo $rows["BookId"]; ?>" minlength="4" maxlength="40"  />
                </div>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Enter Book Name" value="<?php if(isset($rows["BookName"])) echo $rows["BookName"]; ?>" minlength="4" maxlength="50"  />
                </div>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-align-justify"></span></span>
            	<input type="text" name="desc" class="form-control" placeholder="Enter Book Description" value="<?php if(isset($rows["BookDesc"])) echo $rows["BookDesc"]; ?>"  minlength="15" maxlength="50"  />
                </div>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon">A</span>
            	<input type="number" name="available" class="form-control" placeholder="Enter Book Availability" value="<?php if(isset($rows["BookAvailable"])) echo $rows["BookAvailable"]; ?>"  />
                </div>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
            	<input type="text" name="price" class="form-control" placeholder="Enter Book Price" value="<?php if(isset($rows["BookPrice"])) echo $rows["BookPrice"]; ?>" minlength="1" maxlength="6"  />
                </div>
            </div>

            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon">S</span>
            	<select name="storeid" style="height: 35px;width: 100%;color: black;">
                    <option value="" selected disabled hidden  >SELECT STORE</option>>
                    <?php
                        $store = storeReturn();
                        foreach ($store as $key => $val){
                            echo '<option value="'.$key.'"  >'.$val.'</option>';
                        }
                    ?>
                </select>
                </div> 
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
            	<select name="catid" style="height: 35px;width: 100%;color: black;">
                    <option value="" selected disabled hidden  >SELECT CATEGORY</option>>
                    <?php
                        $cat = catReturn();
                        foreach ($cat as $key => $val){
                            echo '<option value="'.$key.'"  >'.$val.'</option>';
                        }
                    ?>
                </select>
                </div> 
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