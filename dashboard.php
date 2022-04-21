<?php
	ob_start();
	session_start();
	include_once 'utilities_ini.php';
	require_once 'connector.php';
	if (!isset($_SESSION['User_id']) ) {
		header("Location: index.php");
		exit;
	}
    $sflag = FALSE;
    $bflag = FALSE;
    if(isset($_GET['bookShow'])){
        $bflag = TRUE;
    }
    
    if(isset($_GET['storeShow'])){
        $sflag = TRUE;
    }
    
    if(($bflag == TRUE) && ($sflag == TRUE)){
        $sflag == TRUE;
    }

    if($sflag){
        $sQL = "style='display: block'";
        $bQL = "style='display: none'";
    }

    if($bflag){
        $sQL = "style='display: none'";
        $bQL = "style='display: block'";
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

	<title>CR Book Inventory Management - dashboard</title>
</head>
<body>
<?php
	include_once('nav.php');
?>
<br/><br/><br/>
<div class="container-fluid">
	<div class="row" >
                
        <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Stores')" id="defaultOpen"><img src="assets\img\store.png" style="height: 40px;" /> Stores</button>
        <button class="tablinks" onclick="openTab(event, 'Books')" id="books"><img src="assets\img\books.png" style="height: 40px;" /> Books</button>
        </div>

        <div id="Stores" class="tabcontent" <?php if(isset($sQL)) echo $sQL;?> >
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="tabtitle"> Stores</h3>
                </div>
                <div class="col-sm-4" style="padding: 27px 12px;">
                    <button class="btn btn-sm btn-success create-btn" onclick='window.location.href="addStore.php"'>CREATE A STORE</button>
                </div>
            </div>
            <hr style="border: 2px solid black;" />
            <?php
                include "storetable.php";
            ?>
        </div>

        <div id="Books" class="tabcontent" <?php if(isset($bQL)) echo $bQL;?> >
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="tabtitle"> Books</h3>
                </div>
                <div class="col-sm-4" style="padding: 25px 12px;">
                    <button class="btn btn-sm btn-success create-btn" onclick='window.location.href="addbook.php"' >ADD BOOK</button>
                </div>
            </div>
            <hr style="border: 2px solid black;" />
            <?php
                include "booktable.php";
            ?>
        </div>
	</div>
	<div class="row">
		<?php include_once "copyrights.php"; ?>
	</div>
</div>

<script>
function openTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();

var url = new URL(location.href);
var b = "FALSE";
b = url.searchParams.get("bookShow");
if(b == "TRUE"){
    document.getElementById("books").click();
}
</script>
</body> 
</html>
<?php ob_flush(); ?>