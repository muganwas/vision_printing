<?php require_once('../Connections/local.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$maxRows_orders = 10;
$pageNum_orders = 0;
if (isset($_GET['pageNum_orders'])) {
  $pageNum_orders = $_GET['pageNum_orders'];
}
$startRow_orders = $pageNum_orders * $maxRows_orders;

mysql_select_db($database_local, $local);
$query_orders = "SELECT * FROM orders";
$query_limit_orders = sprintf("%s LIMIT %d, %d", $query_orders, $startRow_orders, $maxRows_orders);
$orders = mysql_query($query_limit_orders, $local) or die(mysql_error());
$row_orders = mysql_fetch_assoc($orders);

if (isset($_GET['totalRows_orders'])) {
  $totalRows_orders = $_GET['totalRows_orders'];
} else {
  $all_orders = mysql_query($query_orders);
  $totalRows_orders = mysql_num_rows($all_orders);
}
$totalPages_orders = ceil($totalRows_orders/$maxRows_orders)-1;

$queryString_orders = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_orders") == false && 
        stristr($param, "totalRows_orders") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_orders = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_orders = sprintf("&totalRows_orders=%d%s", $totalRows_orders, $queryString_orders);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Orders</title>
<link href="../css/style-main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="main_orders">
  <p>Hello Admin</p>
  <div class="logout"><a href="<?php echo $logoutAction ?>">Logout</a></div>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_orders > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_orders=%d%s", $currentPage, 0, $queryString_orders); ?>"><img src="First.gif" /></a>
      <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_orders > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_orders=%d%s", $currentPage, max(0, $pageNum_orders - 1), $queryString_orders); ?>"><img src="Previous.gif" /></a>
      <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_orders < $totalPages_orders) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_orders=%d%s", $currentPage, min($totalPages_orders, $pageNum_orders + 1), $queryString_orders); ?>"><img src="Next.gif" /></a>
      <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_orders < $totalPages_orders) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_orders=%d%s", $currentPage, $totalPages_orders, $queryString_orders); ?>"><img src="Last.gif" /></a>
      <?php } // Show if not last page ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table border="1" cellpadding="2" cellspacing="2">
    <tr class="capitalize">
      <td height="77" bgcolor="#F3E6E7"><strong>company name</strong></td>
      <td bgcolor="#F3E6E7"><strong>email</strong></td>
      <td bgcolor="#F3E6E7"><strong>phone</strong></td>
      <td bgcolor="#F3E6E7"><strong>Postal Address</strong></td>
      <td bgcolor="#F3E6E7"><strong>Job Type</strong></td>
      <td bgcolor="#F3E6E7"><strong>Final Size</strong></td>
      <td bgcolor="#F3E6E7"><strong>Number of Pages</strong></td>
      <td bgcolor="#F3E6E7"><strong>Colour Mixture</strong></td>
      <td bgcolor="#F3E6E7"><strong>Paper Type Cover</strong></td>
      <td bgcolor="#F3E6E7"><strong>Paper Type Text</strong></td>
      <td bgcolor="#F3E6E7"><strong>Binding Style</strong></td>
      <td bgcolor="#F3E6E7"><strong>Number of Leaves (Calender)</strong></td>
      <td bgcolor="#F3E6E7"><strong>Detail</strong></td>
    </tr>
    <?php do { ?>
    <tr>
      <td><?php echo $row_orders['company name']; ?></td>
      <td><?php echo $row_orders['email']; ?></td>
      <td><?php echo $row_orders['phone']; ?></td>
      <td><?php echo $row_orders['Postal Address']; ?></td>
      <td><?php echo $row_orders['Job Type']; ?></td>
      <td><?php echo $row_orders['Final Size']; ?></td>
      <td><?php echo $row_orders['Number of Pages']; ?></td>
      <td><?php echo $row_orders['Colour Mixture']; ?></td>
      <td><?php echo $row_orders['Paper Type Cover']; ?></td>
      <td><?php echo $row_orders['Paper Type Text']; ?></td>
      <td><?php echo $row_orders['Binding Style']; ?></td>
      <td><?php echo $row_orders['Number of Leaves (Calender)']; ?></td>
      <td><?php echo $row_orders['Detail']; ?></td>
    </tr>
    <?php } while ($row_orders = mysql_fetch_assoc($orders)); ?>
  </table>
  </p>
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($orders);
?>
