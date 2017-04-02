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

$currentPage = $_SERVER["PHP_SELF"];

$currentPage = $_SERVER["PHP_SELF"];

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_search_matchines = 10;
$pageNum_search_matchines = 0;
if (isset($_GET['pageNum_search_matchines'])) {
  $pageNum_search_matchines = $_GET['pageNum_search_matchines'];
}
$startRow_search_matchines = $pageNum_search_matchines * $maxRows_search_matchines;

$colname_search_matchines = "-1";
if (isset($_POST['search'])) {
  $colname_search_matchines = $_POST['search'];
}
mysql_select_db($database_local, $local);
$query_search_matchines = sprintf("SELECT * FROM machines WHERE name LIKE %s", GetSQLValueString("%" . $colname_search_matchines . "%", "text"));
$query_limit_search_matchines = sprintf("%s LIMIT %d, %d", $query_search_matchines, $startRow_search_matchines, $maxRows_search_matchines);
$search_matchines = mysql_query($query_limit_search_matchines, $local) or die(mysql_error());
$row_search_matchines = mysql_fetch_assoc($search_matchines);

if (isset($_GET['totalRows_search_matchines'])) {
  $totalRows_search_matchines = $_GET['totalRows_search_matchines'];
} else {
  $all_search_matchines = mysql_query($query_search_matchines);
  $totalRows_search_matchines = mysql_num_rows($all_search_matchines);
}
$totalPages_search_matchines = ceil($totalRows_search_matchines/$maxRows_search_matchines)-1;

$maxRows_search_product_list = 10;
$pageNum_search_product_list = 0;
if (isset($_GET['pageNum_search_product_list'])) {
  $pageNum_search_product_list = $_GET['pageNum_search_product_list'];
}
$startRow_search_product_list = $pageNum_search_product_list * $maxRows_search_product_list;

$colname_search_product_list = "-1";
if (isset($_POST['search'])) {
  $colname_search_product_list = $_POST['search'];
}
mysql_select_db($database_local, $local);
$query_search_product_list = sprintf("SELECT * FROM product_list WHERE product_name LIKE %s", GetSQLValueString("%" . $colname_search_product_list . "%", "text"));
$query_limit_search_product_list = sprintf("%s LIMIT %d, %d", $query_search_product_list, $startRow_search_product_list, $maxRows_search_product_list);
$search_product_list = mysql_query($query_limit_search_product_list, $local) or die(mysql_error());
$row_search_product_list = mysql_fetch_assoc($search_product_list);

if (isset($_GET['totalRows_search_product_list'])) {
  $totalRows_search_product_list = $_GET['totalRows_search_product_list'];
} else {
  $all_search_product_list = mysql_query($query_search_product_list);
  $totalRows_search_product_list = mysql_num_rows($all_search_product_list);
}
$totalPages_search_product_list = ceil($totalRows_search_product_list/$maxRows_search_product_list)-1;

$maxRows_search_products = 10;
$pageNum_search_products = 0;
if (isset($_GET['pageNum_search_products'])) {
  $pageNum_search_products = $_GET['pageNum_search_products'];
}
$startRow_search_products = $pageNum_search_products * $maxRows_search_products;

$colname_search_products = "-1";
if (isset($_POST['search'])) {
  $colname_search_products = $_POST['search'];
}
mysql_select_db($database_local, $local);
$query_search_products = sprintf("SELECT * FROM products WHERE summary LIKE %s", GetSQLValueString("%" . $colname_search_products . "%", "text"));
$query_limit_search_products = sprintf("%s LIMIT %d, %d", $query_search_products, $startRow_search_products, $maxRows_search_products);
$search_products = mysql_query($query_limit_search_products, $local) or die(mysql_error());
$row_search_products = mysql_fetch_assoc($search_products);

if (isset($_GET['totalRows_search_products'])) {
  $totalRows_search_products = $_GET['totalRows_search_products'];
} else {
  $all_search_products = mysql_query($query_search_products);
  $totalRows_search_products = mysql_num_rows($all_search_products);
}
$totalPages_search_products = ceil($totalRows_search_products/$maxRows_search_products)-1;

$queryString_search_products = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_search_products") == false && 
        stristr($param, "totalRows_search_products") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_search_products = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_search_products = sprintf("&totalRows_search_products=%d%s", $totalRows_search_products, $queryString_search_products);

$queryString_search_matchines = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_search_matchines") == false && 
        stristr($param, "totalRows_search_matchines") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_search_matchines = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_search_matchines = sprintf("&totalRows_search_matchines=%d%s", $totalRows_search_matchines, $queryString_search_matchines);

$queryString_search_product_list = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_search_product_list") == false && 
        stristr($param, "totalRows_search_product_list") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_search_product_list = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_search_product_list = sprintf("&totalRows_search_product_list=%d%s", $totalRows_search_product_list, $queryString_search_product_list);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO orders (name, email, phone, product, details, quantity, quality, `physical location`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['product'], "text"),
                       GetSQLValueString($_POST['details'], "text"),
                       GetSQLValueString($_POST['quantity'], "text"),
                       GetSQLValueString($_POST['quality'], "text"),
                       GetSQLValueString($_POST['physical_location'], "text"));

  mysql_select_db($database_local, $local);
  $Result1 = mysql_query($insertSQL, $local) or die(mysql_error());

  $insertGoTo = "categories.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
	
	$msg = 'Your order was sent successfully, We will get back to you within 48 hours ';
  }else{
	  $msg = 'Your order was not sent, Please try again later';
	  }
  
}
?>
<!DOCTYPE html>
<html lang="en">
            <head>
            <meta charset="utf-8">
            <title>Search</title>
            <meta name="description" content="Printing template">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
            <meta name="author" content="Netbase">
            <!--Add css lib-->
            <?php include "header.php";?>
            <!--Main category : Begin-->
            <main id="main category">
            <section class="header-page">
            <style type="text/css"></style>
            <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
            <script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
            <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
            <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
            <link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
            <link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
            <link href="css/theme-default1.css" rel="stylesheet" type="text/css">
            <div class="container">
              <div class="row">
                <div class="col-sm-3 hidden-xs">
                  <h1 class="mh-title"><span class="capitalize"><?php echo $row_Recordset1['cat_name']; ?></span></h1>
                </div>
                <div class="breadcrumb-w col-sm-9"> <span>You are here:</span>
                  <ul class="breadcrumb">
                    <li> <a href="index.php">Home</a> </li>
                    <li> <span class="capitalize">Search Results</span> </li>
                  </ul>
                </div>
              </div>
            </div>
            </section>
            <section class="better-is">
              <div style="padding-top: 40px;">
            </div>
              <div class="products">
                <div class="katext">
              <div class ="katext1">
                <h2>Results found..</h2>
                <p>&nbsp;</p>
                <p>&nbsp;
                <table border="0">
                  <tr>
                    <td><?php if ($pageNum_search_product_list > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_search_product_list=%d%s", $currentPage, 0, $queryString_search_product_list); ?>">First</a>
                      <?php } // Show if not first page ?></td>
                    <td><?php if ($pageNum_search_product_list > 0) { // Show if not first page ?>
                      <a href="<?php printf("%s?pageNum_search_product_list=%d%s", $currentPage, max(0, $pageNum_search_product_list - 1), $queryString_search_product_list); ?>">Previous</a>
                      <?php } // Show if not first page ?></td>
                    <td><?php if ($pageNum_search_product_list < $totalPages_search_product_list) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_search_product_list=%d%s", $currentPage, min($totalPages_search_product_list, $pageNum_search_product_list + 1), $queryString_search_product_list); ?>">Next</a>
                      <?php } // Show if not last page ?></td>
                    <td><?php if ($pageNum_search_product_list < $totalPages_search_product_list) { // Show if not last page ?>
                      <a href="<?php printf("%s?pageNum_search_product_list=%d%s", $currentPage, $totalPages_search_product_list, $queryString_search_product_list); ?>">Last</a>
                      <?php } // Show if not last page ?></td>
                  </tr>
                </table>
                </p>
<?php if ($totalRows_search_product_list > 0) { // Show if recordset not empty ?>
<table border="0" cellpadding="2" cellspacing="2">
                  <tr>
                    <td colspan="3"><strong>Product List Results</strong></td>
                  </tr>
                  <?php do { ?>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align="left" valign="top"><?php echo $row_search_product_list['product_cat']; ?></td>
                    <td align="left" valign="top"><?php echo $row_search_product_list['product_name']; ?></td>
                  </tr>
                  <?php } while ($row_search_product_list = mysql_fetch_assoc($search_product_list)); ?>
                </table>
<p>
  <?php } // Show if recordset not empty ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;
<table border="0">
  <tr>
    <td><?php if ($pageNum_search_matchines > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_search_matchines=%d%s", $currentPage, 0, $queryString_search_matchines); ?>">First</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_search_matchines > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_search_matchines=%d%s", $currentPage, max(0, $pageNum_search_matchines - 1), $queryString_search_matchines); ?>">Previous</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_search_matchines < $totalPages_search_matchines) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_search_matchines=%d%s", $currentPage, min($totalPages_search_matchines, $pageNum_search_matchines + 1), $queryString_search_matchines); ?>">Next</a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_search_matchines < $totalPages_search_matchines) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_search_matchines=%d%s", $currentPage, $totalPages_search_matchines, $queryString_search_matchines); ?>">Last</a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
<?php if ($totalRows_search_matchines > 0) { // Show if recordset not empty ?>
<table border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="4"><strong>Machinery Results</strong></td>
    </tr>
  <?php do { ?>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><?php echo $row_search_matchines['name']; ?></td>
    <td align="left" valign="top"><?php echo $row_search_matchines['use']; ?></td>
    <td align="left" valign="top"><?php echo $row_search_matchines['capacity']; ?></td>
  </tr>
  <?php } while ($row_search_matchines = mysql_fetch_assoc($search_matchines)); ?>
</table>
<p>
  <?php } // Show if recordset not empty ?>
</p>
<p>&nbsp;</p>
<p>&nbsp;
<table border="0">
  <tr>
    <td><?php if ($pageNum_search_products > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_search_products=%d%s", $currentPage, 0, $queryString_search_products); ?>">First</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_search_products > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_search_products=%d%s", $currentPage, max(0, $pageNum_search_products - 1), $queryString_search_products); ?>">Previous</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_search_products < $totalPages_search_products) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_search_products=%d%s", $currentPage, min($totalPages_search_products, $pageNum_search_products + 1), $queryString_search_products); ?>">Next</a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_search_products < $totalPages_search_products) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_search_products=%d%s", $currentPage, $totalPages_search_products, $queryString_search_products); ?>">Last</a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
<?php if ($totalRows_search_products > 0) { // Show if recordset not empty ?>
<table border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="5"><strong>Products Results</strong></td>
    </tr>
  <?php do { ?>
  <tr>
    <td></td>
    <td><?php echo $row_search_products['cat_name']; ?></td>
    <td><?php echo $row_search_products['prod_name']; ?></td>
    <td><?php echo $row_search_products['summary']; ?></td>
    <td><?php echo $row_search_products['detail']; ?></td>
  </tr>
  <?php } while ($row_search_products = mysql_fetch_assoc($search_products)); ?>
</table>
<?php } // Show if recordset not empty ?>
              </div>
              </div>
              </div>
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
<?php
mysql_free_result($search_matchines);

mysql_free_result($search_product_list);

mysql_free_result($search_products);
?>
