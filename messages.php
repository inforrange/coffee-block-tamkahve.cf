<?php

include "db.php";

$comment = $baglan->prepare("SELECT * from comment ORDER BY comment_id DESC");
$comment->execute(array());
$cmntlist = $comment->fetchAll(PDO::FETCH_ASSOC);

$delcmnt = $baglan->prepare("DELETE from comment where comment_id=? ");
$bancmnt = $baglan->prepare("UPDATE comment set comment_new_old=? where comment_id=?");


$dbcfname = $baglan->prepare("SELECT * from coffee ORDER BY coffee_id DESC");
$dbcfname->execute(array());
$listname = $dbcfname->fetchAll(PDO::FETCH_ASSOC);



if(@$_GET["yrmedt"]=="dell"){
  $delcmnt->execute(array(@$_GET["yrm_id"]));
  
}else if(@$_GET["yrmedt"]=="ban"){
  $bancmnt->execute(array(0,@$_GET["yrm_id"]));
}elseif(@$_GET["yrmedt"]=="deban"){
  $bancmnt->execute(array(1,@$_GET["yrm_id"]));
}

?>


<!DOCTYPE html>
<html>
<title>Tam Kahve</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

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

<div class="container">
    
  <div class="row">

<div class="col-sm-2">

</div>
<div class="col-sm-10" style="margin-top:20px;">
</div>

<?php foreach($cmntlist as $cmnt){ ?>
  <hr>
    <div class="col-sm-2" >
      <h4>Kullanıcı Adı</h4>
      <?php foreach($listname as $name){?>
        <?php if($cmnt["comment_coffe_id"]==$name["coffee_id"]){?>
      <sub><b>Kahve Adı:</b> 
        <?php echo $name["coffee_name"];?>
        </sub><br>
        <sub><b>Kahve Türü:</b> <?php if($name["coffee_categorie_id"]==1){echo "Sütlü Kahve";}elseif($name["coffee_categorie_id"]==2){echo "Sütsüz Kahve";}elseif($name["coffee_categorie_id"]==3){echo "Soğuk Kahve";}?></sub><br>
        <?php }?>
      <?php }?>

     
    </div>
    <div class="col-sm-10">
      <?php echo $cmnt["comment_text"];?>
      <div style="float:right;">
      <?php if($cmnt["comment_new_old"]==0){?>
      <a href="admin.php?id=<?php echo $_SESSION["id"];?>&yrm=list&yrmedt=deban&yrm_id=<?php echo $cmnt["comment_id"];?>"  class="btn mr-2"><i class="fas fa-check"></i></a>
      <?php }else{?>
      <a href="admin.php?id=<?php echo $_SESSION["id"];?>&yrm=list&yrmedt=ban&yrm_id=<?php echo $cmnt["comment_id"];?>"  class="btn mr-2"><i class="fas fa-ban"></i></a>
      <?php }?>
      <a href="admin.php?id=<?php echo $_SESSION["id"];?>&yrm=list&yrmedt=dell&yrm_id=<?php echo $cmnt["comment_id"];?>" class="btn"><i class="fa fa-trash"></i></a>
      </div>
      
      
    </div>
    <hr> 
    <br>
<?php }?>
    
      
  </div>
</div>
 
</body>
</html>
