<?php

session_start();
include "../db.php";

$dbcf = $baglan->prepare("SELECT * from coffee where coffee_id=?");

$dbcf->execute(array($_GET["cf_id"]));

$listele = $dbcf->fetchAll(PDO::FETCH_ASSOC);
$data = $dbcf->rowCount();


?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https: //fonts.googleapis.com/css2? family= Amatic+SC:wght@700 & display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<style type="text/css">body
{
	font-family: 'Amatic SC', cursive;
	background: black;
	color: white;
}

</style>
<style type="text/css">
.gonder{
	display:block;
}
#icerik{
	margin-top: 43px;
}
#ozellik{
	margin-top: 43px;
}
#yorum{
margin-top: 43px;
}
#isim h1{
	font-size: 60px;
}
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-light ">
    <a class="navbar-brand" href="#" style="color:white;"><h1>Tam Kahve</h1></a>
    <a href="#"  style="color:white; " class="nav navbar-brand navbar-right">ANASAYFA</a>
    <a href="#menu" style="color:white;" class="nav navbar-brand navbar-right">MENU</a>
    <a href="#about" style="color:white;" class="nav navbar-brand navbar-right">TARİHÇE</a>
    <a href="#myMap" style="color:white;" class="nav navbar-brand navbar-right">KAYIT OL</a>
</nav>
<?php foreach($listele as $r){?>
<div class="container">
<div class="row">
  <div class="col-sm-6">
  <div class="image">
<img src="../<?php echo $r["coffee_img"];?>" style="width:300px; height: 300px; margin-top:80px; margin-left:150px;">
</div>
  </div>
  <div class="col-sm-6 ">
  <div id="isim"><h1><?php echo $r["coffee_name"];?></h1></div>
	<div id="icerik"><?php echo $r["coffee_text"];?></div>
	<div id="ozellik">
		
		<div id="sertlik">
			<div>Sertlik : <?php echo $r["coffee_hardness"];?></div>
		</div>
		<div id="asidite">
			<div>Asidite : <?php echo $r["coffee_acidity"];?> </div>
		</div>
		<div id="kıvam">
			<div>Kıvam : <?php echo $r["coffee_consistency"];?></div>	
		</div>
		<div id="aroma">
			<div>Aroma : <?php echo $r["coffee_aroma"];?> </div>
		</div>
	</div>
	
</div>
</div>
</div>
<?php }?>
<div class="row">
  <div class="col-sm-12" align="center"><?php

?> <br>

 
</div>
  
</div>
</body>
</html>