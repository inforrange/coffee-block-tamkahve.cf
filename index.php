<?php
session_start();
include "db.php";
$db = $baglan->prepare("INSERT into user set 
                                user_nickname=?,
                                user_name=?,
                                user_surname=?,
                                user_email=?,
                                user_password=?"
);
$data = $baglan->prepare("SELECT * from coffee ORDER BY 'coffee_id' DESC");

$data->execute(array());
$list = $data->fetchAll(PDO::FETCH_ASSOC);


  $dbusr = $baglan->prepare("SELECT * from user where users_id=?");
	$dbusr->execute(array(@$_GET["id"]));
	$listusr = $dbusr->fetchAll(PDO::FETCH_ASSOC);
	$data = $dbusr->rowCount();



if($_POST){

  $nickname = $_POST["user_nickname"];
  $name = $_POST["user_name"];
  $surname = $_POST["user_surname"];
  $email = $_POST["user_email"];
  $password = $_POST["user_password"];

  $kontrol = $db->execute(array($nickname,$name,$surname,$email,$password));
  if($kontrol){
    echo "<script>alert('Kayıt Başarılı. Giriş Yapabilirsiniz');</script>";
  }else{
    echo "<script>alert('Kayıt Başarısız. Tekrar Deneyin');</script>";
  }
  
}
?>



<!DOCTYPE html>
<html>
<title>Tam Kahve</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
body, html {height: 100%}
body,h1,h2,h3,h4,h5,h6 {font-family: "Amatic SC", sans-serif}
.menu {display: none}
.bgimg {
  background-repeat: no-repeat;
  background-size: cover;
  background-image: url("foto//menuarka.jpeg");
  min-height: 90%;
}
#transparent{
  background-color: transparent;
}


</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top w3-hide-small">
  <div class="w3-bar w3-xlarge w3-black w3-opacity w3-hover-opacity-off" id="myNavbar">
    
    <a href="index.php" class="w3-bar-item w3-button">ANASAYFA</a>
    <a href="#menu" class="w3-bar-item w3-button">MENU</a>
    <a href="#about" class="w3-bar-item w3-button">TARİHÇE</a>
    <a href="#myMap" class="w3-bar-item w3-button">KAYIT OL</a>
    <?php foreach($listusr as $m){
      
      if($m["user_authority"] != 0){?>
            <a target="_blank" href="admin.php?id=<?php echo $_SESSION["id"];?>" class="w3-bar-item w3-button w3-right"><i class="glyphicon glyphicon-user"></i></a>
            
    <?php } }?>

<?php if(@$_GET["id"]){?>
    <a href="dt/exit.php" class="w3-bar-item w3-button w3-right">ÇIKIŞ YAP</a>
  <?php }else{ ?>
    <a href="login.php" class="w3-bar-item w3-button w3-right">GİRİŞ YAP</a>

    <?php }?>
    
    
    


  </div>
</div>
  
<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-middle w3-center">
    <p><a href="#menu" class="w3-button w3-xxlarge w3-black" id="transparent">Menümüze göz at</a></p>
  </div>
</header>

<!-- Menu Container -->
<div class="w3-container w3-black w3-padding-64 w3-xxlarge" id="menu">
  <div class="w3-content">
  
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">KAHVE ÇEŞİTLERİMİZ</h1>
    <div class="w3-row w3-center w3-border w3-border-dark-grey">
      <a href="javascript:void(0)" onclick="openMenu(event, 'Pizza');" id="myLink">
        <div class="w3-col s4 tablink w3-padding-large w3-hover-red">SÜTLÜ KAHVELERİMİZ</div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'Pasta');">
        <div class="w3-col s4 tablink w3-padding-large w3-hover-red">SÜTSÜZ KAHVELERİMİZ</div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'Starter');">
        <div class="w3-col s4 tablink w3-padding-large w3-hover-red">SOĞUK KAHVELERİMİZ</div>
      </a>
    </div>

    <div id="Pizza" class="w3-container menu w3-padding-32 w3-white">
    <?php foreach($list as $m){if($m["coffee_categorie_id"]==1){?>
      <h1><b><a href="coffee.php?id=<?php echo @$_SESSION["id"];?>&cf_id=<?php echo $m["coffee_id"]?>" target="_blank"><?php echo $m["coffee_name"];?></a></b></h1>
      <p class="w3-text-grey"><?php echo substr($m["coffee_text"],0,55);?>...</p>
      <?php }}?>
      <hr>
   

     
    </div>

    <div id="Pasta" class="w3-container menu w3-padding-32 w3-white">
    <?php foreach($list as $m){if($m["coffee_categorie_id"]==2){?>
      <a href="coffee.php?id=<?php echo @$_SESSION["id"];?>&cf_id=<?php echo $m["coffee_id"]?>" target="_blank">
      <h1><b><?php echo $m["coffee_name"];?></b></h1></a>
      <p class="w3-text-grey"><?php echo substr($m["coffee_text"],0,55);?>...</p>
      <hr>
    <?php }}?>  
      

      
    </div>


    <div id="Starter" class="w3-container menu w3-padding-32 w3-white">
    <?php foreach($list as $m){if($m["coffee_categorie_id"]==3){?>
      <a href="coffee.php?id=<?php echo @$_SESSION["id"];?>&cf_id=<?php echo $m["coffee_id"]?>" target="_blank">
      <h1><b><?php echo $m["coffee_name"];?></b></h1></a>
      <p class="w3-text-grey"><?php echo substr($m["coffee_text"],0,55);?>...</p>
      <hr>
    <?php }}?>  
   
     
    </div><br>

  </div>
</div>

<!-- About Container -->
<div class="w3-container w3-padding-64 w3-red w3-grayscale w3-xlarge" id="about">
  <div class="w3-content">
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">TARİHÇE</h1>
    <p>Kahvenin ilk kullanımına dair çok çeşitli efsaneler bulunmaktadır. Bunlardan en meşhuru, Kaldi yahut Halid adındaki Etiyopyalı bir keçi çobanı hakkındadır. Bu efsane, batı edebiyatlarında fazlaca ilgi gördüğü için son derece popülerdir. Söz konusu hikaye miladi 800 yılına kadar uzanmaktadır. Rivayet edildiğine göre, Kaldi yahut Halid adındaki bu keçi çobanı, meçhul bir bitkinin meyvelerini tüketen keçilerinde bir takım uyarıcı tesirlerin meydana geldiğini ve keçilerin son derece enerjik olduğunu fark etmiştir. Kendisi de bu meyveleri denediğinde, aynı durumu yaşamıştır. Durumu bölgesindeki bir din adamına bildirmiş ve söz konusu meçhul meyveler hususundaki birkaç denemeden sonra bugünkü kahve içeceği keşfedilmiştir.

Etiyopyalı bir Arap olan Şeyh Şazili 14. yüzyıl sonlarında yaşamış olması muhtemel bir Sufi Şeyhi’dir. Kahveyi ilk içtiği rivayet edilen kişilerden biridir. Gece ibadetinde dinç ve uyanık kalabilmek için özellikle geceleri kahve içtiği, ve kahveyi ilk kullanan sufilerden biri olduğu belirtilmiştir.

16. yüzyılın Arap yazarı Ceziri’ye göre kahveyi ilk içen kişi ez-Zebhani olarak bilinen Yemenli Cemalleddin Ebu Abdullah Muhammed İbn Said’dir. Bir olay yüzünden Aden’i terk ederek Etiyopya’ya giden Zebhani orada kahve içen insanlarla karşılaşmış; Aden’e döndüğünde hastalanmış ve aklına kahve içmek gelmiş. Kahve onu iyileştirmiş. Kahve’nin yorgunluk ve uyuşukluk giderme, canlılık ve dinçlik kazandırma özelliklerini keşfetmiş.

Bazı rivayetler, ilk kahve tüketimini Süleyman'a nispet etmektedir. Bu rivayete göre, Süleyman bir yolcuğunda ahalisinin bilinmeyen bir hastalığa yakalandığı bir kente uğramıştır. Bu sorunu nasıl çözeceği kendisine Cebrail tarafından bildirilmiştir. Bunun üzerine Yemen'den gelen kahve çekirdeklerini kavurmuş ve yeni bir tür içecek keşfetmiştir. Bu içecekten içen hastalar tekrar sıhhatlerine kavuşmuştur.

Kahve uzun süre sadece Araplar tarafından kullanıldıktan bir yüzyıl sonra Suriye, Mısır, İran ve Hindistan'a yayılmıştır.</p>
   
    
    
  </div>
</div>

<!-- Image of location/map -->

<!-- Contact -->
<div class="w3-container w3-padding-64 w3-blue-grey w3-grayscale-min w3-xlarge" id="myMap">
  <div class="w3-content">
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">Aramıza Katıl</h1>
    <form method="POST" style="color:black;" >
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Takma Adınız" required name="user_nickname"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Adınız" required name="user_name"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Soyadınız" required name="user_surname"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="email" placeholder="E-Posta" required name="user_email"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="password" placeholder="Şifreniz" required name="user_password"></p>
      <p><button class="w3-button w3-light-grey w3-block" type="submit">KATIL</button></p>
    </form>
  </div>
</div>

<!-- Footer -->


<script>
// Tabbed Menu
function openMenu(evt, menuName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("menu");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-red";
}
document.getElementById("myLink").click();
</script>

</body>
</html>
