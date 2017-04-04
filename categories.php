<!DOCTYPE html>
<html lang="en">
            <head>
            <meta charset="utf-8">
            <title>Products and Services</title>
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
            
            <!--Add css lib-->
            <?php include "header.php";?>
            <!--Main category : Begin-->
 <main id="main category">
<section class="home-category">
            <script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>
 <script >
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent1, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent1 = document.getElementsByClassName("tabcontent1");
    for (i = 0; i < tabcontent1.length; i++) {
        tabcontent1[i].style.display = "none";
    }
	 tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
<script>
  googletag.cmd.push(function() {
    googletag.defineSlot('/16375024/VPrinting_930x180_Category_dtop', [930, 180], 'div-gpt-ad-1489406282690-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>
            
</section>
<section class="better-is">
<div class="products">
              
			  <?php include_once"products.php" ?></div>
 </section>

 </main>
            <!-- Main Category: End -->
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
       
</body></html>