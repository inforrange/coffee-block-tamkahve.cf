<?php

include "db.php";

  $dbcom = $baglan->prepare("SELECT * from comment where comment_coffe_id=?");
  $dbcom->execute(array(@$_GET["cf_id"]));
  $listcom = $dbcom->fetchAll(PDO::FETCH_ASSOC);
  $data = $dbcom->rowCount();



    $dbusr = $baglan->prepare("SELECT * from user ORDER BY users_id DESC");
    $dbusr->execute(array());
    $listusr = $dbusr->fetchAll(PDO::FETCH_ASSOC);

  

  






?>
<!DOCTYPE html>
<html>
<title>Tam Kahve</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<style type="text/css">
  body {
    font-family: 'Amatic SC', cursive;
  }
</style>
<body>

<div class="container">
    
  <div class="row"  style="margin-bottom:20px;border:solid 1px white; background:white;color:black;    box-shadow: 0 8px 16px 0 gray, 0 6px 20px 0 gray;">
<?php foreach($listcom as $dc){
  if($dc["comment_new_old"]==1){
  ?>
    <div class="col-sm-2">
     <b><?php
     
   
      foreach($listusr as $f){
        if($dc["comment_user_id"] == $f["users_id"]){
          echo $f["user_name"];
        }
        
      } 

      ?></b>
    </div>
    <div class="col-sm-10" >
      <?php echo $dc["comment_text"];?>

      <?php if($dc["comment_user_id"]==$_GET["id"]){?>
      <a class=" w3-right" href="coffee.php?id=<?php echo $_GET["id"];?>&cf_id=<?php echo $_GET["cf_id"];?>&cmnt_id=<?php echo $dc["comment_id"];?>&cmt=dell">
    <span title="Sil" class="w3-bar-item  btn btn-danger  fa fa-trash w3-right" style="float:right; margin-top:5px;"><i class=""></i></span></a>
    <a class=" w3-right" href="coffee.php?id=<?php echo $_GET["id"];?>&cf_id=<?php echo $_GET["cf_id"];?>&cmnt_id=<?php echo $dc["comment_id"];?>&cmt=edt">
    <span title="Düzenle" class="w3-bar-item  btn btn-success fa fa-edit w3-right" style="background-color: #1C6DD0; float:right; margin-top:5px;"></span></a>
    <?php }?>  
    <hr>
    </div> 
    </div> 
    <div class="row"  style="margin-bottom:20px;border:solid 1px white; background:white;color:black;    box-shadow: 0 8px 16px 0 gray, 0 6px 20px 0 gray;">
<?php }}?>



</body>
</html>
