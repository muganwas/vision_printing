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
  $insertSQL = sprintf("INSERT INTO orders (id, `company name`, email, phone, `Postal Address`, `Job Type`, `Final Size`, `Number of Pages`, `Colour Mixture`, `Paper Type Cover`, `Paper Type Text`, `Binding Style`, `Number of Leaves (Calender)`, Detail) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['company_name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['Postal_Address'], "text"),
                       GetSQLValueString($_POST['Job_Type'], "text"),
                       GetSQLValueString($_POST['Final_Size'], "text"),
                       GetSQLValueString($_POST['Number_of_Pages'], "int"),
                       GetSQLValueString($_POST['Colour_Mixture'], "text"),
                       GetSQLValueString($_POST['Paper_Type_Cover'], "text"),
                       GetSQLValueString($_POST['Paper_Type_Text'], "text"),
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
	$reciever = "print@newvision.co.ug, badpunter256@gmail.com";
	$to = $reciever; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $subject = "PRINTING ORDER";
    $message =        "Compay Name: " . $_POST['company_name'] . "\n".
					  "Email Address: " . $_POST['email'] . "\n".
                      "Phone Number: " . $_POST['phone'] . "\n".
					  "Number of Pages: " . $_POST['Number_of_Pages'] . "\n". 
                      "Paper Type For Pages: " . $_POST['Paper_Type_Text'] . "\n".
                      "Detail: " . $_POST['Detail'];			   
    $headers = "From:" . $from;
    $headers2 = "To:" . $to;
    mail($to,$subject,$message,$headers);
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

if(isset($_POST['MM_insert1']))
{
$msg1 = "success";
$to = "GMukiibi@newvision.co.ug, SKaali@newvision.co.ug, dsemukasa@newvision.co.ug"; // this is your Email address
$from = $_POST['email']; // this is the sender's Email address
$subject = "Inquiry";
$message = "Phone Number:". $_POST['phone'] ." \n" . "Message: " . $_POST['contact_message'] . "\n From: " .$_POST['name'] ;

    $headers = "From:" . $from;
    $headers2 = "To:" . $to;
    mail($to,$subject,$message,$headers);
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

</head>

<body>
<div role="tabpanel">
  <ul id="contact_d_p" class="nav nav-tabs" role="tablist">
    <li id="contact_d_p" class="active"><a href="#home1" data-toggle="tab" role="tab">Get A Quote</a></li>
    <li id="contact_d_p"><a href="#paneTwo1" data-toggle="tab" role="tab">Inquiry</a></li>
  </ul>
  <div id="tabContent1" class="tab-content">
    <div class="tab-pane fade in active" id="home1">
      <div class="fab_form">
	  <div class="web_form">
	    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table border="0px" align="center" class="tablez" >
          <tr valign="baseline">
            <td colspan="3" align="right" valign="top" nowrap><div class="quote"><?php 
            if($msg == "success"){ echo'<div class ="success">Your order was sent successfully, We will get back to you within 48 hours </div>';}
			elseif($msg=="failure"){
				echo'<div class=""failure">Your order was not sent, Please try again later</div>';} ?><br/>
            </div></td>
          </tr>
          <tr valign="baseline">
            <td colspan="3" align="left" valign="top" nowrap  class="column_words">
              <div class="text_d"><input placeholder="Company Name*" name="company_name" type="text" class="textfields" required></div><div class="text_d"><input placeholder="Enter Your Email*" name="email" type="email" class="textfields" value="" required /></div> 
              <div class="text_d"><input placeholder="Enter Your Phone Number*" name="phone" type="number" class="textfields" value=""  required></div>       
              </td>
            </tr>
          <tr>
            <td width="33%" align="left" valign="top" nowrap class="column_words">
  <select name="Paper_Type_Cover" required class="textfields" selected>
                <option  label="-Select Paper Type For Cover-" value=" ">-Select Paper Type For Cover-</option>
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
            </td>
            <td width="32%" align="left" valign="top" nowrap class="column_words"><input name="Postal_Address" type="text" required="required" class="textfields" placeholder="Enter Address" value="" /></td>
            <td width="33%" align="left" valign="top" class="column_fields">
              <select name="Job_Type" class="textfields" required>
                <option  label="-Select Job Type-" value=" " selected>-Select Job Type-</option>
                  <?php 
do {  
?>
                  <option value="<?php echo $row_Recordset2['product_name']?>"  ><?php echo $row_Recordset2['product_name']?></option>
                <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
?>
              </select>
            </td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap class="column_words">
              <select name="Paper_Type_Text" class="textfields">
                <option  label="-Select Paper Type For Pages-" value=" ">-Select Paper Type For Pages-</option>
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
            </td>
            <td align="left" valign="top" nowrap class="column_words"><select name="Colour_Mixture" class="textfields">
              <option  label="-Select Colour Mixture-" value=" " selected>Select Colour Mixture-</option>
                <option value="BW" <?php if (!(strcmp("BW", ""))) {echo "SELECTED";} ?>>Black and White</option>
              <option value="FC" <?php if (!(strcmp("FC", ""))) {echo "SELECTED";} ?>>Full Color</option>
            </select></td>
            <td align="left" valign="top" class="column_fields">
              <input placeholder="Enter Final Size of Work*" name="Final_Size" type="text" class="textfields" value="" required>
            </td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap class="column_words">
              <select name="Binding_Style" class="textfields">
                <option  label="-Select Binding Style-" value=" " selected>-Select Binding Style</option>
                  <option value="stitching" <?php if (!(strcmp("stitching", ""))) {echo "SELECTED";} ?>>Stitching</option>
                <option value="saddle" <?php if (!(strcmp("saddle", ""))) {echo "SELECTED";} ?>>Saddle</option>
                <option value="perfect" <?php if (!(strcmp("perfect", ""))) {echo "SELECTED";} ?>>Perfect</option>
                <option value="spiral" <?php if (!(strcmp("spiral", ""))) {echo "SELECTED";} ?>>Spiral</option>
                <option value="perforation" <?php if (!(strcmp("perforation", ""))) {echo "SELECTED";} ?>>Perforation</option>
                <option value="metal strip" <?php if (!(strcmp("metal strip", ""))) {echo "SELECTED";} ?>>Metal Strip</option>
                <option value="lamination" <?php if (!(strcmp("lamination", ""))) {echo "SELECTED";} ?>>Lamination</option>
              </select>
            </td>
            <td align="left" valign="top" nowrap class="column_words"><input placeholder="Enter Number of Leaves(Calender)" name="Number_of_Leaves_Calender" type="number" class="textfields" value="" /></td>
            <td align="left" valign="top" class="column_fields">
                <input placeholder="Enter Number of Pages*" name="Number_of_Pages" type="number" class="textfields" value="" size="32" required />
            </td>
          </tr>
          <tr valign="baseline">
            <td colspan="2" align="left" valign="top" nowrap class="column_words"><textarea class="textareas" placeholder="Enter More Detail*" name="Detail" id="" required></textarea>
              
            </td>
            <td align="left" valign="top" nowrap class="column_words">&nbsp;</td>
            </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap><input type="submit" class="sub_button" value="Request Quotation"></td>
            <td align="left" valign="top" nowrap></td>
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
				echo'<div class=""failure">Your order was not sent,<br/> Please try again later</div>';} ?><br/>
            </div></td>
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
            <td class="column_fields"><p><span class="column_words">Job Type:</span></p>
              <p>
                <select name="Job_Type" class="textfields">
                  <option  label="-Select Job Type-" value=" " selected>-Select Job Type-</option>
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
                <option  label="-Select Colour Mixture-" value=" " selected>-Select Colour Mixture-</option>
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
                 <option  label="-Select Paper Type For Pages-" value=" ">-Select Paper Type-</option>
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
            <td class="column_fields"><p><span class="column_words">Paper Type Pages:</span>
              </p>
              <p>
                <select name="Paper_Type_Text" class="textfields">
               <option  label="-Select Paper Type For Pages-" value=" ">-Select Paper Type-</option>
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
            <td class="column_fields"><p><span class="column_words">Binding Style:</span>
              </p>
              <p>
                <select name="Binding_Style" class="textfields"> <option label="-Select Binding Style-">-Select Binding Style-</option>
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
            <td class="column_fields"><p>Job Details</p>
              <p>
                <textarea class="textareas" placeholder="Enter More Information*" name="textarea" id="textarea" required></textarea>
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
    </div>
    <div class="tab-pane fade in" id="paneTwo1">
   <section id="pr-contact" class="pr-main fab_form">
        
		  
			<div class="container">
            <div class="quote">
             <?php 
            if($msg1 == "success"){ echo'<div class ="success">Your Inquiry was sent successfully, We will get back to you within 48 hours </div>';} 
			else{ echo '<div class ="success">Something went wrong, try sending the message again </div>'; ?>
            </div>
           
			  <form name="form3" id="contact-form" class="form-validate form-horizontal" method="post" action="<?php echo $editFormAction; ?>">
				
				
				<div class="col-md-3 col-sm-3 col-xs-12">
				  <input name="name" class="textfields" type="text" placeholder="Enter Your Name*" required>
				  
				  <input name="email" class="textfields" type="text" placeholder="Enter Your Email*" required>
				  
				  <input name="phone" class="textfields" type="text" placeholder="Enter Phone Number*" required>
				  
				  
				</div>
                <div class="col-md-6 col-sm-6 col-xs-12">
			    <textarea aria-required="true" required class="required invalid" rows="10" cols="50" id="jform_contact_message" name="contact_message" aria-invalid="true" value="Message"  placeholder="Message*" ></textarea>
			    <div class="button"></div>
				  <button type="submit" class="sub_button">Submit</button>
				</div>
                <input type="hidden" name="MM_insert1" value="form1">
			  </form>
		  </div>
		</section>   
    </div>
  </div>
</div>
<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</body>
</html>