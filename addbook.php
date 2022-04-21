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
		
		if(empty($id) || (strlen($id)< 4) ){
			$error = TRUE;
			$idError = "Please Enter Book ID <sub> ( Min 4 Characters ) </sub>";
		}
        
		if(empty($name) || (strlen($name)< 4) ){
			$error = TRUE;
			$nameError = "Please Enter Book Name <sub> ( Min 4 Characters ) </sub>";
		}
		
		if(empty($desc) || (strlen($desc)< 15) ){
			$error = TRUE;
			$descError = "Please Enter Book Description <sub> ( Min 15 Characters ) </sub>";
		}
		
		if(empty($price) ){
			$error = TRUE;
			$priceError = "Please Enter Book Price";
		}
		
		if(empty($available) ){
			$error = TRUE;
			$availableError = "Please Enter Book available";
		}
        
		if(empty($storeid) ){
			$error = TRUE;
			$storeidError = "Please Select Store ID";
		}
		
        
		if(empty($catid) ){
			$error = TRUE;
			$catidError = "Please Select Category ID";
		}
		
		
		if (!$error) {
		 
            $usid = $_SESSION['User_id'];
			$sql5 = "INSERT INTO `book` (`BookId`, `BookName`, `BookDesc`, `BookPrice`, `BookAvailable`, `BookStatus`, `BookDoc`, `UserId`, `storeId`, `CatId`) VALUES ('$id', '$name', '$desc', '$price', '$available', 'ACTIVE', current_timestamp(), '$usid', '$storeid', '$catid');";
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
				$errMSG = "Something Wents Wrong, Try again...<br>";
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

	<title>CR Book Inventory Management - Add Book</title>
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        	<div class="form-group">
            	<h2 class="text-default" style="color: #ffffff"> <b>Add Book To Your Store </b></h2>
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
            	<input type="text" name="id" class="form-control" placeholder="Enter Book ID" value="<?php if(isset($id)) echo $id; ?>" minlength="4" maxlength="40" required />
                </div>
                <span class="text-danger"><?php if(isset($idError)) echo $idError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Enter Book Name" value="<?php if(isset($name)) echo $name; ?>" minlength="4" maxlength="50" required />
                </div>
                <span class="text-danger"><?php if(isset($nameError)) echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-align-justify"></span></span>
            	<input type="text" name="desc" class="form-control" placeholder="Enter Book Description" value="<?php if(isset($desc)) echo $desc; ?>"  minlength="15" maxlength="500" required />
                </div>
                <span class="text-danger"><?php if(isset($descError)) echo $descError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon">A</span>
            	<input type="number" name="available" class="form-control" placeholder="Enter Book Availability" value="<?php if(isset($available)) echo $available; ?>" required />
                </div>
                <span class="text-danger"><?php if(isset($availableError)) echo $availableError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
            	<input type="text" name="price" class="form-control" placeholder="Enter Book Price" value="<?php if(isset($price)) echo $price; ?>" minlength="1" maxlength="6" required />
                </div>
                <span class="text-danger"><?php if(isset($priceError)) echo $priceError; ?></span>
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
                <span class="text-danger"><?php if(isset($storeidError)) echo $storeidError; ?></span>
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
                <span class="text-danger"><?php if(isset($catidError)) echo $catidError; ?></span>
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