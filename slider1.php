<?php require_once('Connections/local.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_gen_cat = "-1";
if (isset($_GET['id'])) {
  $colname_gen_cat = $_GET['id'];
}
mysql_select_db($database_local, $local);
$query_gen_cat = sprintf("SELECT * FROM general_cat WHERE cat_name = %s", GetSQLValueString($colname_gen_cat, "text"));
$gen_cat = mysql_query($query_gen_cat, $local) or die(mysql_error());
$row_gen_cat = mysql_fetch_assoc($gen_cat);
$totalRows_gen_cat = mysql_num_rows($gen_cat);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css" type="text/css">
<title></title>
<link href="css/style-main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="w3-content w3-display-container">
<div class="w3-display-container mySlides">

  <img src="images/manual slider/books novels and brochures.png" style="width:100%">
   <div class="w3-display-bottom w3-container w3-padding-16 w3-black">
  Vision printing offers print
management solutions
that will make your life a
little easier. Relax and know
your printing needs are in
the right hands.
  </div>
  </div>
  <div class="w3-display-container mySlides">

  <img src="images/manual slider/certs wobblers tags and cards.png" style="width:100%">
   <div class="w3-display-bottom w3-container w3-padding-16 w3-black">
  At Vision
printing, Print Management
can be best described as
streamlining, controlling,
maintaining and monitoring
printed material.
  </div>
  </div>
  <div class="w3-display-container mySlides">

  <img src="images/manual slider/registers exams and answer sheets.png" style="width:100%">
   <div class="w3-display-bottom w3-container w3-padding-16 w3-black">
   The team at Vision printing
understands the challenges
that training organisations
face and the limitations
often imposed by the print
industry for ordering, so we
have adapted and offered a
unique print management
system that truly offers a
solution.
  </div>
  </div>
    <div class="w3-display-container mySlides">

  <img src="images/manual slider/food and shopping packaging.png" style="width:100%">
   <div class="w3-display-bottom w3-container w3-padding-16 w3-black">
  At vision printing, we know that tremendous
effort goes into creating, developing, and nurturing
your brand and product, so you need labels that
communicate your brand message and describe
your product contents.
  </div>
  </div>
    <div class="w3-display-container mySlides">

  <img src="images/manual slider/medicine packaging.png" style="width:100%">
   <div class="w3-display-bottom w3-container w3-padding-16 w3-black">
   We never skimp on quality – it's as important to
us to deliver the highest quality as it is for you to
receive it.
  </div>
  </div>
    <div class="w3-display-container mySlides">

  <img src="images/manual slider/news paper inserts.png" style="width:100%">
   <div class="w3-display-bottom w3-container w3-padding-16 w3-black">
    20% discount on
your insertion
costs if you print
with us. For those
clients that need
to run newspaper
inserts, it pays to
print with us. Over
and above all the
benefits you enjoy,
you also enjoy a
20% discount on
your insertion
cost.
  </div>
  </div>
      <div class="w3-display-container mySlides">

  <img src="images/manual slider/news papers.png" width="1239" height="383" style="width:100%">
   <div class="w3-display-bottom w3-container w3-padding-16 w3-black">
   Vision printing prints all the Vision Group news papers
  </div>
  </div>
     <div class="w3-display-container mySlides">

  <img src="images/manual slider/posters tickets and fliers.png" width="1234" height="412" style="width:100%">
   <div class="w3-display-bottom w3-container w3-padding-16 w3-black">
    Vision printing will make it
happen. We take the time to
discuss your printing needs
then identify and tailor the
best solution for you.
  </div>
  </div>
    <div class="w3-display-container mySlides">

  <img src="images/manual slider/promotional materilas.png" style="width:100%">
   <div class="w3-display-bottom w3-container w3-padding-16 w3-black">
  Put your stamp on the world and promote your business
in a unique way! Vision printing offers more than
just paper-based printing and can offer a variety
of promotional products to help your business.
  </div>
  </div>
   <div class="w3-display-container mySlides">

  <img src="images/manual slider/calenders.png" style="width:100%">
   <div class="w3-display-bottom w3-container w3-padding-16 w3-black">
    Put your stamp on the world and promote your business
in a unique way! Vision printing offers more than
just paper-based printing and can offer a variety
of promotional products to help your business.
  </div>
  </div>
</div>

  <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>
</body>
</html>
<?php
mysql_free_result($gen_cat);
?>
