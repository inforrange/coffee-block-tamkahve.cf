<?php

session_start();
include "db.php";

$dbcf = $baglan->prepare("SELECT * from coffee where coffee_id=?");
$dbcf->execute(array(@$_GET["cf_id"]));
$listele = $dbcf->fetchAll(PDO::FETCH_ASSOC);
$data = $dbcf->rowCount();


$cmnt = $baglan->prepare("SELECT * from comment where comment_id=?");
$cmnt->execute(array(@$_GET["cmnt_id"]));
$cmntlist = $cmnt->fetchAll(PDO::FETCH_ASSOC);


$delcmnt = $baglan->prepare("DELETE from comment where comment_id=? ");
if(@$_GET["cmt"]=="dell"){
  $delcmnt->execute(array(@$_GET["cmnt_id"]));
  $url = $_GET['id'];
  $cf_url=$_GET['cf_id'];
  header("refresh: 0;url=coffee.php?id=$url&cf_id=$cf_url");
}



$yrm = $baglan->prepare("INSERT into comment set 
							comment_text=?,
              comment_user_id=?,
              comment_coffe_id=?
");

if($_POST){
  if(@$_SESSION["id"]==false){
    echo "<script>alert('Lütfen Önce Kayıt Olun');</script>";
    header("refresh: 0;url=index.php");
  }else{
    $text= @$_POST["comment_text"];
    $id=$_SESSION["id"];
    $cfid=$_GET["cf_id"];
    $yrm->execute(array($text,$id,$cfid));
  }

  if(@$_POST["edt_comment_text"]){
    $cmtedt = $baglan->prepare("UPDATE comment set comment_text=? where comment_id=?");
    $cmtedt->execute(array($_POST["edt_comment_text"],$_GET["cmnt_id"]));
    $url = $_GET['id'];
    $cf_url=$_GET['cf_id'];
    header("refresh: 0;url=coffee.php?id=$url&cf_id=$cf_url");

  }


}


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
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<style type="text/css">


      
  body
{
	font-family: 'Amatic SC', cursive;
	background: black;
	color: white;
}
#image{
  margin-top: 60px;
}
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
    <a class="navbar-brand" href="index.php" style="color:white;"><h1>Tam Kahve</h1></a>
    <a href="index.php"  style="color:white; " class="nav navbar-brand navbar-right">ANASAYFA</a>
  
</nav>
<?php foreach($listele as $r){?>
<div class="container">
<div class="row">
  <div class="col-sm-6">
  		<div class="image">
      <img src="<?php echo $r["coffee_img"];?>" style="width:300px; height: 300px; margin-top:80px; margin-left:150px;" style="width: 500px; height: 500px;">
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
      <div>Asidite : <?php echo $r["coffee_acidity"];?></div>
    </div>
    <div id="kıvam">
      <div>Kıvam : <?php echo $r["coffee_consistency"];?></div> 
    </div>
    <div id="aroma">
      <div>Aroma :  <?php echo $r["coffee_aroma"];?> </div>
    </div>
  </div>
  <div id="yorum">
    <?php if(@$_GET["cmt"]=="edt"){
      foreach($cmntlist as $cmt){
      ?>
      <form method="POST">
    <textarea name="edt_comment_text" rows="4" cols="50" placeholder="Yorumunuzu buraya yazınız.." > <?php echo $cmt["comment_text"];?>
      </textarea>
    <input type="submit" class="gonder" value="Yorumu Düzenle" /></div>
    </form>

    <?php }}else{?>

  <form method="POST">
    <textarea name="comment_text" rows="4" cols="50" placeholder="Yorumunuzu buraya yazınız.." >
      </textarea>
    <input type="submit" class="gonder" value="Yorumu ekle" /></div>
    </form>
    <?php }?>
  </div>
</div>
</div>
<?php }?>
</div>
<div class="row">
  <div class="col-sm-12" align="center"><br><?php
include 'yorumlar.php';
?> <br>

 
</div>
  
</div>
</body>
</html>