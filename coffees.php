<?php

include "db.php";


$url= $_GET['id'];
$db = $baglan->prepare("SELECT * from coffee ORDER BY coffee_id DESC");
$ban = $baglan->prepare("UPDATE coffee set coffee_ban=? where coffee_id=?");
$onay = $baglan->prepare("UPDATE coffee set coffee_new_old=? where coffee_id=?");
$del = $baglan->prepare("DELETE from coffee where coffee_id=? ");
$db->execute(array());
$list = $db->fetchAll(PDO::FETCH_ASSOC);

 
if(@$_GET["cof"]=="del"){
   $del->execute(array($_GET["coffee_id"]));
   $img_del = unlink($_GET["coffe_img"]);
}else if(@$_GET["cof"]=="ban"){  
  $ban->execute(array(1,$_GET["coffee_id"]));
}else if(@$_GET["cof"]=="deban"){
  $ban->execute(array(0,$_GET["coffee_id"]));
}else if(@$_GET["cof"]=="onay"){
	$onay->execute(array(1,$_GET["coffee_id"]));
}

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
    
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

</head>
<style type="text/css">
	:root {
  --gradient: linear-gradient(to left top, #DD2476 10%, #FF512F 90%) !important;
}


.card {
  border: 1px solid #dd2476;
  margin-bottom: 2rem;
  margin-top:50px;
}

.btn {
  background: var(--gradient) !important;
  -webkit-background-clip: text !important;
  -webkit-text-fill-color: transparent !important;
  text-decoration: none;
  transition: all .4s ease;
}

.btn:hover, .btn:focus {
      background: var(--gradient) !important;
  -webkit-background-clip: none !important;
  -webkit-text-fill-color: #fff !important;
  box-shadow: #222 1px 0 10px;
  text-decoration: underline;
}
</style>
<body>
	
<div class="container mx-auto mt-4">
  <div class="row">
    <div style="float:right; margin-top:10px; margin-left: 1000px; ">
      <a href="admin.php?id=<?php echo $_SESSION["id"];?>&coffe=add" class="btn mr-2"> <i class="fas fa-plus"> Kahve Ekle</i></a>
      
      </div>
      <?php foreach($list as $m){?>
       <div class="col-md-4">
		<div class="card" style="width: 18rem;">
		  <div class="card-body">
		    <h5 class="card-title">Kahve Adı: <?php echo $m["coffee_name"];?></h5>
			<h6 class="card-title">Kategorisi: <?php if($m["coffee_categorie_id"]=="1"){?> Sütlü Kahve <?php } else if($m["coffee_categorie_id"]=="2"){?> Sütsüz Kahve <?php } elseif($m["coffee_categorie_id"]=="3"){?> Soğuk Kahve <?php }?></h6>
			<h5 class="card-title" style="text-align: center;">Hakkında</h5>
			<h6 class="card-title"><?php echo substr($m["coffee_text"],0,55);?></h6>

		    <a href="admin.php?id=<?php echo $_SESSION["id"];?>&coffe=edt&cf_id=<?php echo $m["coffee_id"];?>" class="btn mr-2"><i class="fas fa-magic"></i></a>

		    <a target="_blank" href="settings/coffee_eye.php?id=<?php echo $_SESSION["id"];?>&cf_id=<?php echo $m["coffee_id"];?>" class="btn mr-2"><i class="fas fa-eye"></i></a>

		    <a title="Sil" href="admin.php?id=<?php echo $_SESSION["id"];?>&coffe=list&cof=del&coffee_id=<?php echo $m["coffee_id"];?>&coffe_img=<?php echo $m["coffee_img"];?>" class="btn"><i class="fa fa-trash"></i></a>
		  </div>
		  </div>
   		</div>    
    <?php }?>
        
        
	</div>
  </div>

</body>
</html>