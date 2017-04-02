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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) or ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2"))) {
  $insertSQL = sprintf("INSERT INTO orders (id, `company name`, email, phone, `Postal Address`, `Physical Address`, `Job Type`, `Final Size`, `Number of Pages`, `Colour Mixture`, `Paper Type Cover`, `Paper Type Text`, Design, `Binding Style`, `Number of Leaves (Calender)`, Detail) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['company_name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['Postal_Address'], "text"),
                       GetSQLValueString($_POST['Physical_Address'], "text"),
                       GetSQLValueString($_POST['Job_Type'], "text"),
                       GetSQLValueString($_POST['Final_Size'], "text"),
                       GetSQLValueString($_POST['Number_of_Pages'], "int"),
                       GetSQLValueString($_POST['Colour_Mixture'], "text"),
                       GetSQLValueString($_POST['Paper_Type_Cover'], "text"),
                       GetSQLValueString($_POST['Paper_Type_Text'], "text"),
                       GetSQLValueString($_POST['Design'], "text"),
                       GetSQLValueString($_POST['Binding_Style'], "text"),
                       GetSQLValueString($_POST['Number_of_Leaves_Calender'], "int"),
                       GetSQLValueString($_POST['Detail'], "text"));

  mysql_select_db($database_local, $local);
  $Result1 = mysql_query($insertSQL, $local) or die(mysql_error());

   $insertGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
 	$msg = "success";
  }else{
	  $msg = "failure";
	  }
}


mysql_select_db($database_local, $local);
$query_Recordset2 = "SELECT product_name FROM product_list";
$Recordset2 = mysql_query($query_Recordset2, $local) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_local, $local);
$query_all_prods = "SELECT product_name FROM product_list";
$all_prods = mysql_query($query_all_prods, $local) or die(mysql_error());
$row_all_prods = mysql_fetch_assoc($all_prods);
$totalRows_all_prods = mysql_num_rows($all_prods);

$maxRows_all_prods2 = 10;
$pageNum_all_prods2 = 0;
if (isset($_GET['pageNum_all_prods2'])) {
  $pageNum_all_prods2 = $_GET['pageNum_all_prods2'];
}
$startRow_all_prods2 = $pageNum_all_prods2 * $maxRows_all_prods2;

mysql_select_db($database_local, $local);
$query_all_prods2 = "SELECT product_name FROM product_list";
$query_limit_all_prods2 = sprintf("%s LIMIT %d, %d", $query_all_prods2, $startRow_all_prods2, $maxRows_all_prods2);
$all_prods2 = mysql_query($query_limit_all_prods2, $local) or die(mysql_error());
$row_all_prods2 = mysql_fetch_assoc($all_prods2);

if (isset($_GET['totalRows_all_prods2'])) {
  $totalRows_all_prods2 = $_GET['totalRows_all_prods2'];
} else {
  $all_all_prods2 = mysql_query($query_all_prods2);
  $totalRows_all_prods2 = mysql_num_rows($all_all_prods2);
}
$totalPages_all_prods2 = ceil($totalRows_all_prods2/$maxRows_all_prods2)-1;

mysql_select_db($database_local, $local);
$query_makeOrder = "SELECT product_name FROM product_list";
$makeOrder = mysql_query($query_makeOrder, $local) or die(mysql_error());
$row_makeOrder = mysql_fetch_assoc($makeOrder);
$totalRows_makeOrder = mysql_num_rows($makeOrder);

mysql_select_db($database_local, $local);
$query_mob_job_type = "SELECT product_name FROM product_list";
$mob_job_type = mysql_query($query_mob_job_type, $local) or die(mysql_error());
$row_mob_job_type = mysql_fetch_assoc($mob_job_type);
$totalRows_mob_job_type = mysql_num_rows($mob_job_type);

mysql_select_db($database_local, $local);
$query_paper_type = "SELECT paper_name FROM printing_paper";
$paper_type = mysql_query($query_paper_type, $local) or die(mysql_error());
$row_paper_type = mysql_fetch_assoc($paper_type);
$totalRows_paper_type = mysql_num_rows($paper_type);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Make Print Order(Quote)</title>
	<meta name="description" content="Printing template">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
	<meta name="author" content="Netbase">
	<!--Add css lib-->
<?php include "header.php";?>
	<!--Main category : Begin-->
	<main id="main category">
		<section class="header-page">
			<style type="text/css">
			</style>
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
					<div class="breadcrumb-w col-sm-9"> 
						<span>You are here:</span>
						<ul class="breadcrumb">
							<li>
								<a href="index.php">Home</a>
							</li>
							<li>
								<span class="capitalize">make order</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
	<div class="fab_form">
	  <div class="web_form">
	    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table align="center" class="tablez" border="0px" >
          <tr valign="baseline">
            <td colspan="2" align="right" valign="top" nowrap><div class="quote"><?php 
            if($msg == "success"){ echo'<div class ="success">Your order was sent successfully, We will get back to you within 48 hours </div>';}
			elseif($msg=="failure"){
				echo'<div class=""failure">Your order was not sent, Please try again later</div>';} ?><br/>Quotation Request Form</div></td>
          </tr>
          <tr valign="baseline">
            <td width="53%" align="left" valign="top" nowrap  class="column_words">Company name
              <p>
  <input placeholder="Company Name*" name="company_name" type="text" class="textfields" required>
            </p></td>
            <td width="47%" align="left" valign="top"  class="column_fields">Email
              <p>
                <input placeholder="Enter Your Email*" name="email2" type="email" class="textfields" value="" required />
            </p></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap class="column_words">Phone
              <p>
  <input placeholder="Enter Your Phone Number*" name="phone" type="number" class="textfields" value="" size="32" required>
            </p></td>
            <td align="left" valign="top" class="column_fields">Postal Address 
              <p>
                <input placeholder="Enter Postal Code" name="Postal_Address2" type="text" class="textfields" value="" />
            </p></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap class="column_words">Physical Address
              <p>
  <textarea placeholder="Enter Your Physical Address*" name="Physical_Address" class="textareas" required></textarea>
            </p></td>
            <td align="left" valign="top" class="column_fields">Job Type
              <p>
                <select name="Job_Type2" class="textfields">
                  <?php 
do {  
?>
                  <option value="<?php echo $row_Recordset2['product_name']?>" ><?php echo $row_Recordset2['product_name']?></option>
                  <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
?>
                </select>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap class="column_words">Final Size
              <p>
  <input placeholder="Enter Final Size of Work*" name="Final_Size" type="text" class="textfields" value="" required>
            </p></td>
            <td align="left" valign="top" class="column_fields">Number of Pages 
              <p>
                <input placeholder="Enter Number of Pages*" name="Number_of_Pages2" type="number" class="textfields" value="" size="32" required />
            </p></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap class="column_words">Colour Mixture
              <p>
  <select name="Colour_Mixture" class="textfields">
    <option value="BW" <?php if (!(strcmp("BW", ""))) {echo "SELECTED";} ?>>Black and White</option>
    <option value="FC" <?php if (!(strcmp("FC", ""))) {echo "SELECTED";} ?>>Full Color</option>
  </select>
            </p></td>
            <td align="left" valign="top" class="column_fields">Paper Type Cover
              <p>
                <select name="Paper_Type_Cover2" class="textfields">
                  <?php
do {  
?>
                  <option value="<?php echo $row_paper_type['paper_name']?>"><?php echo $row_paper_type['paper_name']?></option>
                  <?php
} while ($row_paper_type = mysql_fetch_assoc($paper_type));
  $rows = mysql_num_rows($paper_type);
  if($rows > 0) {
      mysql_data_seek($paper_type, 0);
	  $row_paper_type = mysql_fetch_assoc($paper_type);
  }
?>
                </select>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap class="column_words">Paper Type Text
              <p>
  <select name="Paper_Type_Text" class="textfields">
    <?php
do {  
?>
    <option value="<?php echo $row_paper_type['paper_name']?>"><?php echo $row_paper_type['paper_name']?></option>
    <?php
} while ($row_paper_type = mysql_fetch_assoc($paper_type));
  $rows = mysql_num_rows($paper_type);
  if($rows > 0) {
      mysql_data_seek($paper_type, 0);
	  $row_paper_type = mysql_fetch_assoc($paper_type);
  }
?>
  </select>
            </p></td>
            <td align="left" valign="top" class="column_fields">Design:
              <table>
                <tr>
                  <td><input  type="radio" name="Design" value="yes" />
                    Yes</td>
                </tr>
                <tr>
                  <td><input type="radio" name="Design" value="no" checked="checked" />
                    No</td>
                </tr>
            </table></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap class="column_words">Binding Style
              <p>
  <select name="Binding_Style" class="textfields">
    <option value="stitching" <?php if (!(strcmp("stitching", ""))) {echo "SELECTED";} ?>>Stitching</option>
    <option value="saddle" <?php if (!(strcmp("saddle", ""))) {echo "SELECTED";} ?>>Saddle</option>
    <option value="perfect" <?php if (!(strcmp("perfect", ""))) {echo "SELECTED";} ?>>Perfect</option>
    <option value="spiral" <?php if (!(strcmp("spiral", ""))) {echo "SELECTED";} ?>>Spiral</option>
    <option value="perforation" <?php if (!(strcmp("perforation", ""))) {echo "SELECTED";} ?>>Perforation</option>
    <option value="metal strip" <?php if (!(strcmp("metal strip", ""))) {echo "SELECTED";} ?>>Metal Strip</option>
    <option value="lamination" <?php if (!(strcmp("lamination", ""))) {echo "SELECTED";} ?>>Lamination</option>
  </select>
            </p></td>
            <td align="left" valign="top" class="column_fields">Number of Leaves (Calender) 
              <p>
                <input placeholder="Enter Number of Leaves" name="Number_of_Leaves_Calender2" type="text" class="textfields" value="" />
            </p></td>
          </tr>
          <tr valign="baseline">
            <td colspan="2" align="left" valign="top" nowrap class="column_words">Details
              <p>
                <textarea placeholder="Give More Information*" name="Detail" class="textareas" required></textarea>
           </p></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap><input type="submit" class="sub_button" value="Request Quotation"></td>
            <td valign="top" class="column_fields">&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1">
      </form>
      </div>
      <div class="mob_form">
            <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
        <table align="center" class="tablez" >
          <tr valign="baseline">
            <td align="right" nowrap><div class="quote"><?php
            if($msg == "success"){ echo'<div class ="success">Your order was successful,<br/> We will get back to you within 48hrs </div>';}
			elseif($msg == "failure"){
				echo'<div class=""failure">Your order was not sent,<br/> Please try again later</div>';} ?><br/>Quotation Request Form</div></td>
          </tr>
          <tr valign="baseline">
            <td  class="column_fields"><p><span class="column_words">Company name</span>
              </p>
              <p>
                <input name="company_name" type="text" class="textfields" value="" required>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Email</span></p>
              <p>
                <input name="email" type="email" class="textfields" value="" size="32" required>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Phone</span></p>
              <p>
                <input name="phone" type="text" class="textfields" value="" size="32" required>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Postal Address</span></p>
              <p>
                <input name="Postal_Address" type="text" class="textfields" value="" size="32">
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Physical Address</span></p>
              <p>
                <textarea name="Physical_Address" cols="50" rows="5" class="textareas" required></textarea>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Job Type:</span></p>
              <p>
                <select name="Job_Type" class="textfields">
                  <?php
do {  
?>
                  <option value="<?php echo $row_mob_job_type['product_name']?>"><?php echo $row_mob_job_type['product_name']?></option>
                  <?php
} while ($row_mob_job_type = mysql_fetch_assoc($mob_job_type));
  $rows = mysql_num_rows($mob_job_type);
  if($rows > 0) {
      mysql_data_seek($mob_job_type, 0);
	  $row_mob_job_type = mysql_fetch_assoc($mob_job_type);
  }
?>
                </select>
            </p></td>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Final Size</span>
              </p>
              <p>
                <input name="Final_Size" type="text" class="textfields" value="" size="32" required>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Number of Pages</span>
              </p>
              <p>
                <input name="Number_of_Pages" type="text" class="textfields" value="" size="32" required>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Colour Mixture</span>
              </p>
              <p>
                <select name="Colour_Mixture" class="textfields">
                  <option value="BW" <?php if (!(strcmp("BW", ""))) {echo "SELECTED";} ?>>Black and White</option>
                  <option value="FC" <?php if (!(strcmp("FC", ""))) {echo "SELECTED";} ?>>Full Color</option>
                </select>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Paper Type Cover</span>
              </p>
              <p>
                <select name="Paper_Type_Cover" class="textfields">
                  <option value="Paper 1" <?php if (!(strcmp("Paper 1", ""))) {echo "SELECTED";} ?>>Paper 1</option>
                  <option value="Paper 2" <?php if (!(strcmp("Paper 2", ""))) {echo "SELECTED";} ?>>Paper 2</option>
                  <option value="Paper 3" <?php if (!(strcmp("Paper 3", ""))) {echo "SELECTED";} ?>>Paper 3</option>
                </select>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Paper Type Text:</span>
              </p>
              <p>
                <select name="Paper_Type_Text" class="textfields">
                  <option value="Paper 1" <?php if (!(strcmp("Paper 1", ""))) {echo "SELECTED";} ?>>Paper 1</option>
                  <option value="Paper 2" <?php if (!(strcmp("Paper 2", ""))) {echo "SELECTED";} ?>>Paper 2</option>
                  <option value="Paper 3" <?php if (!(strcmp("Paper 3", ""))) {echo "SELECTED";} ?>>Paper 3</option>
                </select>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td valign="baseline" class="column_fields"><p><span class="column_words">Design</span></p>
              <table>
              <tr>
                <td><input type="radio" name="Design" value="yes" >
                  Yes</td>
              </tr>
              <tr>
                <td><input type="radio" name="Design" value="no" checked>
                  No</td>
              </tr>
            </table></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Binding Style:</span>
              </p>
              <p>
                <select name="Binding_Style" class="textfields">
                  <option value="stitching" <?php if (!(strcmp("stitching", ""))) {echo "SELECTED";} ?>>Stitching</option>
                  <option value="saddle" <?php if (!(strcmp("saddle", ""))) {echo "SELECTED";} ?>>Saddle</option>
                  <option value="perfect" <?php if (!(strcmp("perfect", ""))) {echo "SELECTED";} ?>>Perfect</option>
                  <option value="spiral" <?php if (!(strcmp("spiral", ""))) {echo "SELECTED";} ?>>Spiral</option>
                  <option value="perforation" <?php if (!(strcmp("perforation", ""))) {echo "SELECTED";} ?>>Perforation</option>
                  <option value="metal strip" <?php if (!(strcmp("metal strip", ""))) {echo "SELECTED";} ?>>Metal Strip</option>
                  <option value="lamination" <?php if (!(strcmp("lamination", ""))) {echo "SELECTED";} ?>>Lamination</option>
                </select>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Number of Leaves (Calender)</span>
              </p>
              <p>
                <input name="Number_of_Leaves_Calender" type="text" class="textfields" value="" size="32">
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><p><span class="column_words">Job Details:</span>
              </p>
              <p>
                <textarea name="Detail" cols="50" rows="5" class="textareas"></textarea required>
            </p></td>
          </tr>
          <tr valign="baseline">
            <td class="column_fields"><input type="submit" class="sub_button" value="Request Quotation"></td>
          </tr>
        </table>
        
<input type="hidden" name="MM_insert" value="form2">
      </form>
      </div>
     
	</div>
</main>
	<p><!-- Main Category: End -->
	  <?php include "footer.php";?>
</p>
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
