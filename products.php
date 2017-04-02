<html>
<head></head>
<body>
<div class="dall">
 <div class="tab">
  <button class="tablinks" onclick="openCity(event, 'cp')">Commercial Printing</button>
  <button class="tablinks" onclick="openCity(event, 'bm')">Books &amp; Magazines</button>
  <button class="tablinks" onclick="openCity(event, 'lp')">Labels &amp; Packaging</button>
  <button class="tablinks" onclick="openCity(event, 'pc')">Promo &amp; Conference </button>
  <button class="tablinks" onclick="openCity(event, 'pd')">Print On Demand</button>
</div>
<div id="" class="tabcontent">
<?php include_once"all tabd.php"; ?>
</div>

<div id="cp" class="tabcontent1">
<?php include_once"comercial printing tabd.php"; ?>
</div>

<div id="bm" class="tabcontent1">
<?php include_once"books and magazines.php"; ?>
</div>

<div id="lp" class="tabcontent1">

  <?php include_once"labels and packaging.php"; ?>
</div>
<div id="pc" class="tabcontent1">
  
<?php include_once"promotional and conference materials.php"; ?>
</div>

<div id="pd" class="tabcontent1">

  <?php include_once"print on demand.php"; ?>
</div>
</div>
</body>
</html>