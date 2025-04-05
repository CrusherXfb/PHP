<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Site</title>
	<!-- Bootstrap --> 
	<link href="css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>
	<div class="container">
		<!-- строка меню -->
		<div class="row">
			<nav class="col-md-12 col-sm-12 col-lg-12">
				<?php 
					require_once('pages/functions.php');
					require_once('pages/menu.php');
				?>
			</nav>
		</div>
		<!-- основная часть страницы -->
		<div class="row">
			<section class="col-md-12 col-sm-12 col-lg-12">
				<?php
					if(isset($_GET['page'])) {
						$page = htmlentities($_GET['page']);
						if ($page == '1') {require_once('pages/home.php');}
						if ($page == '2') {require_once('pages/upload.php');}
						if ($page == '3') {require_once('pages/gallery.php');}
						if ($page == '4') {require_once('pages/login.php');}
						if ($page == '5') {require_once('pages/registration.php');}
					}
					else
					{
						$_GET['page'] = '1';
						require_once('pages/home.php');
					}
				?>
			</section>
		</div>
	</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>