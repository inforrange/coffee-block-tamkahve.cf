<?php
 
include "db.php";

$url= $_GET['id'];
$db = $baglan->prepare("SELECT * from user ORDER BY users_id DESC");
$ban = $baglan->prepare("UPDATE user set user_ban=? where users_id=?");
$admnban = $baglan->prepare("UPDATE user set user_authority=? where users_id=?");
$onay = $baglan->prepare("UPDATE user set user_new_old=? where users_id=?");
$del = $baglan->prepare("DELETE from user where users_id=? ");
$db->execute(array());
$list = $db->fetchAll(PDO::FETCH_ASSOC);

 
if(@$_GET["users"]=="del"){
   $del->execute(array($_GET["user_id"]));
}else if(@$_GET["users"]=="ban"){  
  $ban->execute(array(1,$_GET["user_id"]));
}else if(@$_GET["users"]=="deban"){
  $ban->execute(array(0,$_GET["user_id"]));
}else if(@$_GET["users"]=="onay"){
	$onay->execute(array(1,$_GET["user_id"]));
}elseif(@$_GET["users"]=="admn"){
	$admnban->execute(array(1,@$_GET["user_id"]));
}elseif(@$_GET["users"]=="banadmn"){
	$admnban->execute(array(0,@$_GET["user_id"]));
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Tak Kahve</title>
    
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
      
      </div>
      <?php
	  foreach($list as $m){?>
       <div class="col-md-4">
		<div class="card" style="width: 18rem;">
		  <div class="card-body">
			  <?php if($m["user_new_old"]==0){?>
		  <p class="card-text" style="color:red">Onaylanacak Üye</p>
		  <?php }?>
		   <h6 class="card-title">Nickname: <?php echo $m["user_nickname"]; ?></h6>
		    <h6 class="card-title">Adı: <?php echo $m["user_name"]; ?></h6>
			<h6 class="card-title">Soyadı: <?php  echo $m["user_surname"];?></h6>
			<h6 class="card-title">E-Posta: <?php  echo $m["user_email"];?></h6>
			<?php if($m["user_new_old"]==0){?>
		    <a title="Onayla" href="admin.php?id=<?php echo $_SESSION["id"];?>&user=list&users=onay&user_id=<?php echo $m["users_id"];?>" class="btn mr-2"><i class="fas fa-check"></i></a>
			<?php }else{ if($m["user_ban"]==0){?>
			<a title="Engelle" href="admin.php?id=<?php echo $_SESSION["id"];?>&user=list&users=ban&user_id=<?php echo $m["users_id"];?>" class="btn mr-2"><i class="fas fa-check"></i></a>
			<?php }else{?>
		    <a title="Engeli Kaldır" href="admin.php?id=<?php echo $_SESSION["id"];?>&user=list&users=deban&user_id=<?php echo $m["users_id"];?>" class="btn mr-2"><i class="fas fa-ban"></i></a>

			<?php }}?>
		    <a title="Düzenle" target="_blank" href="register.php?id=<?php echo $_SESSION["id"];?>&user=<?php echo $m["users_id"];?>" class="btn mr-2"><i class="fas fa-magic"></i></a>
		    <a title="Sil" href="admin.php?id=<?php echo $_SESSION["id"];?>&user=list&users=del&user_id=<?php echo $m["users_id"];?>" class="btn"><i class="fa fa-trash"></i></a>

			<?php if($m["user_authority"]==0){?>
			<a title="Adminlik Ver" href="admin.php?id=<?php echo $_SESSION["id"];?>&user=list&users=admn&user_id=<?php echo $m["users_id"];?>" class="btn"><i class="fa fa-gem"></i></a>
			<?php }else{?>
			<a title="Admin Engelle" href="admin.php?id=<?php echo $_SESSION["id"];?>&user=list&users=banadmn&user_id=<?php echo $m["users_id"];?>" class="btn"><i class="fa fa-user"></i></a>
			<?php }?>
		  </div>
		  </div>
   		</div>    
      <?php }?>   
        
	</div>
  </div>

</body>
</html>