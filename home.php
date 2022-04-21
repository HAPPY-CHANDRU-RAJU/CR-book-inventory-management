<?php
	ob_start();
	session_start();
	include_once 'utilities_ini.php';
	require_once 'connector.php';
	if (!isset($_SESSION['User_id']) ) {
		header("Location: index.php");
		exit;
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

	<title>CR Book Inventory Management - Home</title>
</head>
<body>
<?php
	include_once('nav.php');
?>
<br/><br/><br/>
<?php
	include_once('slider.php');
?>
<br/><br/>
<div class="container-fluid">
	<div class="row" style="background: url('../asset/book.png');background-size: cover;">
	<footer class="section footer " style="background-color: black;height: 450px;padding: 12rem 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="widget clearfix">
                            <h3 class="widget-title">Subscribe Our Website</h3>
                            <div class="newsletter-widget">
                                <p>You can opt out of our website at any time.<br> See our <a href="#">privacy policy</a>.</p>
                                <form class="form-inline" role="search">
                                    <div class="form-1">
                                        <input type="text" class="form-control" placeholder="Enter email here..">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i></button>
                                    </div>
                                </form>
                                <img src="images/payments.png" alt="" class="img-responsive">
                            </div><!-- end newsletter -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-3">
                        <div class="widget clearfix">
                            <h3 class="widget-title">Join us today</h3>
                            <p>Would you like to add your store and expand your business? Join us without losing time.</p>
                            <a href="http://localhost/cr_book_inventory_mgmt/addStore.php" class="readmore">Became a Merchant</a>
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-3">
                        <div class="widget clearfix">
                            <h3 class="widget-title">Popular Tags</h3>
                            <div class="tags-widget">   
                                <ul class="list-inline">
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">Horror</a></li>
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">Fiction</a></li>
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">BookWorm</a></li>
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">History</a></li>
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">Thriller</a></li>
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">Mystery</a></li>
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">Spirituality</a></li>
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">Science</a></li>
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">UPSC</a></li>
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">CET Books</a></li>
                                    <li><a href="http://localhost/cr_book_inventory_mgmt/dashboard.php">Children's Literature</a></li>
                                </ul>
                            </div><!-- end list-widget -->
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-lg-2 col-md-2">
                        <div class="widget clearfix">
                            <h3 class="widget-title">Support</h3>
                            <div class="list-widget">   
                                <ul>
                                    <li><a href="#">Terms of Use</a></li>
                                    <li><a href="#">Copyrights</a></li>
                                    <li><a href="#">Create a Ticket</a></li>
                                    <li><a href="#">Pricing & Plans</a></li>
                                    <li><a href="#">Trademark</a></li>
                                </ul>
                            </div><!-- end list-widget -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </footer><!-- end footer -->
	</div>

	<div class="row">
		<?php include_once "copyrights.php"; ?>
	</div>
</div>
	
</body> 
</html>
<?php ob_flush(); ?>