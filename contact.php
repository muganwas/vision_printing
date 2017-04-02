<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Contact Us</title>
	<meta name="description" content="Printing template">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0, user-scalable=yes"/>
	<meta name="author" content="Netbase">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
	<!--Add header-->
<link rel="stylesheet" type="text/css" href='<?php echo "css/style-main1.css";?>'> 
<link href='<?php echo "http://fonts.googleapis.com/css?family=Roboto:500,300,700,400";?>' rel='stylesheet' type='text/css'>
<link href='<?php echo "https://fonts.googleapis.com/css?family=Arimo:500,300,700,400";?>' rel='stylesheet' type='text/css'>
<link href='<?php echo "http://fonts.googleapis.com/css?family=Roboto+Condensed:500,300,700,400";?>' 
rel='stylesheet' type='text/css'>

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
<link rel="shortcut icon" href="favicon.ico" />
</head>
<body>

<script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>

<script>
  googletag.cmd.push(function() {
    googletag.defineSlot('/16375024/VPrinting_930x180_Front_dtop', [930, 180], 'div-gpt-ad-1489405880098-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>


<script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>

<script>
  googletag.cmd.push(function() {
    googletag.defineSlot('/16375024/VPrinting_700x80_Header_dtop', [700, 80], 'div-gpt-ad-1489405132952-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>

<!--Header: Begin-->
<header>
<!--Top Header: Begin--><!--Top Header: End-->

<!--Top Header: Begin-->
<!--Main Header: Begin-->
<section class="main-header">
<div class="container1">
				<div class="row">
					<div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 w-logo">
						<div class="logo hd-pd ">
							<a href="index.php">
								<img  src="images/logo.png" alt="printshop logo" >
							</a>
						</div>	
					</div>
					<div class="col-lg-7 col-md-8 visible-md visible-lg">
				  <nav id="main-menu" class="main-menu clearfix">
							<ul>
                            <li class="level0 parent col1 hd-pd">
									<a href="index.php" title="Business Cards">
								<span>Home</span></a> </li>
                                
								<li class="level0 hd-pd">
									<a href="categories.php">Products and Services</a>
                                    </li>							
								<li class="level0 hd-pd">
									<a href="capacity.php">Facilities</a>
								</li>
								<li class="level0 hd-pd">
									<a href="contact.php">Contact Us</a>
							  </li>
								
						  </ul>
					  </nav>
		      </div>
					<div class="col-sm-1 col-sm-offset-5 col-xs-offset-2 col-xs-2 visible-sm visible-xs mbmenu-icon-w">
						<span class="mbmenu-icon hd-pd">
							<i class="fa fa-bars"></i>
						</span>
				  </div>
					<div class="col-lg-1 col-md-2 col-sm-2 col-xs-3 headerCS">
						
						
					</div>
				</div>
                </div>
			</div>
            
            </section><!--Main Header: End-->
</header>

	<!--Main index : End-->
<!--Main index : End-->
<div class="tabbz"><?php include_once"in_contact.php" ?></div>
	<!--Footer : Begin-->
	<?php include "footer.php";?>
	<div id="sitebodyoverlay"></div>
<?php include_once"mobile_menu.php"; ?>
	<!--Add js lib-->
	<script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script> 
<script type="text/javascript" src="js/owl.carousel.min.js"></script>  
<script type="text/javascript" src="js/theme.js"></script>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  	<![endif]-->

</body>
</html>
<?php
mysql_free_result($Recordset2);

mysql_free_result($all_prods);

mysql_free_result($all_prods2);

mysql_free_result($makeOrder);

mysql_free_result($mob_job_type);

mysql_free_result($paper_type);
?>
