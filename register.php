<?php
session_start();
include "db.php";

$dblist = $baglan->prepare("SELECT * from user where users_id=?");
$dblist->execute(array($_GET["user"]));
$x = $dblist->fetchAll(PDO::FETCH_ASSOC);
$data = $dblist->rowCount();

$db = $baglan->prepare("UPDATE user set user_nickname=?, user_name=?, user_surname=?, user_email=?, user_password=? where users_id=?");
    if(@$_POST["user_nickname"] || @$_POST["users_name"] || @$_POST["users_surname"] || @$_POST["users_email"] || @$_POST["users_password"]){
       
        $db->execute(array($_POST["user_nickname"],$_POST["user_name"],$_POST["user_surname"],$_POST["user_email"],$_POST["user_password"],$_GET["user"]));
        $user =$_SESSION["id"];
        $user_id=$_GET["user"];
        
       header("refresh: 1;url=admin.php?id=$user&list");
    }

?>
<!DOCTYPE html>
<html>
<title>Tam Kahve</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<style>
body, html {height: 100%}
body,h1,h2,h3,h4,h5,h6 {font-family: "Amatic SC", sans-serif}
.menu {display: none}
.bgimg {
  background-repeat: no-repeat;
  background-size: cover;
  background-image: url("menuarka.jpg");
  min-height: 90%;
}
#transparent{
  background-color: transparent;
}
</style>
<body>


<div class="w3-container w3-padding-64 w3-blue-grey w3-grayscale-min w3-xlarge" id="myMap">
  <div class="w3-content">
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">Düzenle</h1>
    <?php foreach($x as $m){?>
    <form method="POST" >
      <p><input value="<?php echo $m["user_nickname"];?>" class="w3-input w3-padding-16 w3-border" type="text" placeholder="Takma Adı" required name="user_nickname" ></p>
      <p><input value="<?php echo $m["user_name"];?>" class="w3-input w3-padding-16 w3-border" type="text" placeholder="Adı" required name="user_name"></p>
      <p><input value="<?php echo $m["user_surname"];?>" class="w3-input w3-padding-16 w3-border" type="text" placeholder="Soyadı" required name="user_surname"></p>
      <p><input value="<?php echo $m["user_email"];?>" class="w3-input w3-padding-16 w3-border" type="email" placeholder="E-Posta" required name="user_email"></p>
      <p><input value="<?php echo $m["user_password"];?>" class="w3-input w3-padding-16 w3-border" type="text" placeholder="Şifresi" required name="user_password"></p>
      <p><button class="w3-button w3-light-grey w3-block" type="submit">Düzenle</button></p>
    </form>
    <?php }?>
  </div>
</div>

</body>
</html>