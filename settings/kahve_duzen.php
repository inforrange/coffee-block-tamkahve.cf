
<?php

include "db.php";

$cflist = $baglan->prepare("SELECT * from coffee where coffee_id=?");
$cflist->execute(array($_GET["cf_id"]));
$list = $cflist->fetchAll(PDO::FETCH_ASSOC);
$data = $cflist->rowCount();





if($_POST){
    if(@$_GET["img"]=="edt"){
        $cfupdtimg = $baglan->prepare("UPDATE coffee set 
        coffee_name=?,
        coffee_text=?,
        coffee_img=?,
        coffee_categorie_id=?,
        coffee_hardness=?,
        coffee_acidity=?,
        coffee_consistency=?,
        coffee_aroma=? where coffee_id=?");
        foreach($list as $r){
            $img= unlink($r["coffee_img"]);
        }



        $maxboyut = 5000000;
	$dosyauzantisi = substr($_FILES["coffee_img"]["name"],-4,4);
	$dosyaadi = rand(0,99999).$dosyauzantisi;
	$dosyayolu = "coffee_img/".$dosyaadi;
	
	if($_FILES["coffee_img"]["size"]>$maxboyut){
		echo "Dosya boyutu 500kb den büyük olamaz";
	}else{
		$d=$_FILES["coffee_img"]["type"];
		if($d=="image/jpeg" || $d=="image/png" || $d=="image/gif"){
			if(is_uploaded_file($_FILES["coffee_img"]["tmp_name"])){
				$x = move_uploaded_file($_FILES["coffee_img"]["tmp_name"],$dosyayolu);
				if($x){
					
				//	echo "Yükleme başarılı..<br>";
					
                   $cfupdtimg->execute(array($_POST["coffee_name"],$_POST["coffee_text"],$dosyayolu,$_POST["coffee_categorie_id"],$_POST["coffee_hardness"],$_POST["coffee_acidity"],$_POST["coffee_consistency"],$_POST["coffee_aroma"],$_GET["cf_id"]));
                   $url = $_SESSION["id"];
                   echo "<script>alert('Düzenleme Başarılı');</script>";
				
				}
			}else{
				echo "Yüklenirken hata oluştu";
			}
	
		}
	}


    }else{
        $cfupdt = $baglan->prepare("UPDATE coffee set 
         coffee_name=?,
        coffee_text=?,
        coffee_img=?,
        coffee_categorie_id=?,
        coffee_hardness=?,
        coffee_acidity=?,
        coffee_consistency=?,
        coffee_aroma=? where coffee_id=?");
        foreach($list as $m){
            $img= $m["coffee_img"];
        }
        $cfupdt->execute(array($_POST["coffee_name"],$_POST["coffee_text"],$img,$_POST["coffee_categorie_id"],$_POST["coffee_hardness"],$_POST["coffee_acidity"],$_POST["coffee_consistency"],$_POST["coffee_aroma"],$_GET["cf_id"]));
        echo "<script>alert('Düzenleme Başarılı');</script>";
    }
}




?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<style type="text/css">
           body{
        padding-top:4.2rem;
      padding-bottom:4.2rem;
      margin-top: 20px;
        }
        a{
         text-decoration:none !important;
         }
         h1,h2,h3{
         font-family: 'Kaushan Script', cursive;
         }
          .myform{
      position: relative;
      display: -ms-flexbox;
      display: flex;
      padding: 1rem;
      -ms-flex-direction: column;
      flex-direction: column;
      width: 100%;
      pointer-events: auto;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid rgba(0,0,0,.2);
      border-radius: 1.1rem;
      outline: 0;
      max-width: 500px;
       }
         .tx-tfm{
         text-transform:uppercase;
         }
         .mybtn{
         border-radius:50px;
         }
        
         .login-or {
         position: relative;
         color: #aaa;
         margin-top: 10px;
         margin-bottom: 10px;
         padding-top: 10px;
         padding-bottom: 10px;
         }
         .span-or {
         display: block;
         position: absolute;
         left: 50%;
         top: -2px;
         margin-left: -25px;
         background-color: #fff;
         width: 50px;
         text-align: center;
         }
         .hr-or {
         height: 1px;
         margin-top: 0px !important;
         margin-bottom: 0px !important;
         }
         .google {
         color:#666;
         width:100%;
         height:40px;
         text-align:center;
         outline:none;
         border: 1px solid lightgrey;
         }
          form .error {
         color: #ff0000;
         }
         #second{display:none;}

</style>

<body>
    <div class="container">
        <div class="row">
			<div class="col-md-5 mx-auto">
			<div id="first">
				<div class="myform form ">
					 <div class="logo mb-3">
						 <div class="col-md-12 text-center">
							<h1>Kahve Düzenle</h1>
						 </div>
					</div>
                    <?php foreach($list as $m){?>
                   <form  method="post" enctype="multipart/form-data" >
                           <div class="form-group">
                              <label for="exampleInputEmail1">Kahve İsmi</label>
                              <input value="<?php echo $m["coffee_name"]?>" type="text" name="coffee_name"  class="form-control" id="kahveisim" placeholder="Kahve İsmi Giriniz...">
                           </div>
                           <div class="form-group">
                              <label for="exampleInputEmail1">Kahve Açıklaması</label>
                              <textarea  type="text" name="coffee_text" id="aciklama"  class="form-control" placeholder="Kahve Açıklaması..."><?php echo $m["coffee_text"]?></textarea>
                           </div>
                           <div class="form-group">
                              <label  for="exampleInputEmail1">Sertlik Türü: </label>
                            <select id="category" class="fadeIn second" name="coffee_hardness" required>
                                <?php if($m["coffee_hardness"]=="*"){?>
                                  <option selected value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_hardness"]=="**"){?>
                                  <option value="*">*</option>
                                  <option selected value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_hardness"]=="***"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option selected value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_hardness"]=="****"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option selected value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_hardness"]=="*****"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option selected value="*****">*****</option>
                                 <?php }?>
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="exampleInputEmail1">Asidite: </label>
                            <select id="category" class="fadeIn second" name="coffee_acidity" required>
                                  <?php if($m["coffee_acidity"]=="*"){?>
                                  <option selected value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_acidity"]=="**"){?>
                                  <option value="*">*</option>
                                  <option selected value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_acidity"]=="***"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option selected value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_acidity"]=="****"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option selected value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_acidity"]=="*****"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option selected value="*****">*****</option>
                                 <?php }?>
                                  
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="exampleInputEmail1">Kıvam: </label>
                            <select id="category" class="fadeIn second" name="coffee_consistency" required>
                                <?php if($m["coffee_consistency"]=="*"){?>
                                  <option selected value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_consistency"]=="**"){?>
                                  <option value="*">*</option>
                                  <option selected value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_consistency"]=="***"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option selected value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_consistency"]=="****"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option selected value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_consistency"]=="*****"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option selected value="*****">*****</option>
                                 <?php }?>
                                  
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="exampleInputEmail1">Aroma: </label>
                            <select id="category" class="fadeIn second" name="coffee_aroma" required>
                            <?php if($m["coffee_aroma"]=="*"){?>
                                  <option selected value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_aroma"]=="**"){?>
                                  <option value="*">*</option>
                                  <option selected value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_aroma"]=="***"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option selected value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_aroma"]=="****"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option selected value="****">****</option>
                                  <option value="*****">*****</option>
                                 <?php } elseif($m["coffee_aroma"]=="*****"){?>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option selected value="*****">*****</option>
                                 <?php }?>
                                  
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="exampleInputEmail1">Kategori: </label>
                            <select value="" id="category" class="fadeIn second" name="coffee_categorie_id" required>
                                  
                                  <?php if($m["coffee_categorie_id"] == 1){?>
                                      <option selected value="1">Sütlü Kahve</option>
                                      <option value="2">Sütsüz Kahve</option>
                                      <option value="3">Soğuk Kahve</option>
                                      <?php } elseif($m["coffee_categorie_id"] == 2){?>
                                      <option value="1">Sütlü Kahve</option>
                                      <option selected value="2">Sütsüz Kahve</option>
                                      <option value="3">Soğuk Kahve</option>
                                      <?php } elseif($m["coffee_categorie_id"] == 3){?>
                                      <option value="1">Sütlü Kahve</option>
                                      <option value="2">Sütsüz Kahve</option>
                                      <option selected value="3">Soğuk Kahve</option>
                                      <?php }?>
                                 
                              </select>
                             </div>
                             <div class="form-group">
                             <?php if(@$_GET["img"]=="edt"){?>
                                <a href="admin.php?id=<?php echo $_SESSION["id"];?>&coffe=edt&cf_id=<?php echo $m["coffee_id"];?>"><div>İptal Et</div></a>

                            <?php }else{?>
                                <a href="admin.php?id=<?php echo $_SESSION["id"];?>&coffe=edt&cf_id=<?php echo $m["coffee_id"];?>&img=edt"><div>Resim Düzenle</div></a>
                             <?php }?>
                                 <?php if(@$_GET["img"]=="edt"){?>
                              <label for="exampleInputEmail1">Kahve Resmi </label>
                              <input name="coffee_img" class="fadeIn second" style=" background-color: #f6f6f6; border: none; width: 100%; color:  #606060; padding: 1px 10px;  text-align: center; font-size: 16px; " type="file" placeholder="Film Afişi Seçiniz" required>
                              <?php }?>
                            </div>
                           <div class="col-md-12 text-center ">
                             <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Kahve Düzenle</button>
                             
                           </div>
                          
                           </div>
                           
                          
                        </form>
                        <?php }?>
                      
				</div>
			</div>
			  
			</div>
		</div>
      </div>   
         
</body>