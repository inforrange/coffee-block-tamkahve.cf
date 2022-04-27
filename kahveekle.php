
<?php

include "db.php";

$db = $baglan->prepare("INSERT into coffee set 
							coffee_name=?,
							coffee_text=?,
              coffee_img=?,
              coffee_categorie_id=?,
              coffee_hardness=?,
              coffee_acidity=?,
              coffee_consistency=?,
              coffee_aroma=?
");

if($_POST){
	
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
					
					
					$Kahve_adi = $_POST["coffee_name"];
					$Kahve_text = $_POST["coffee_text"];
					$Kahve_kategori = $_POST["coffee_categorie_id"];
					$Kahve_sertlik= $_POST["coffee_hardness"];
					$Kahve_asitlik = $_POST["coffee_acidity"];
					$Kahve_konsantre = $_POST["coffee_consistency"];
          $Kahve_aroma = $_POST["coffee_aroma"];
          $Kahve_img = $dosyayolu;

					$kontrol = $db->execute(array($Kahve_adi,$Kahve_text,$Kahve_img,$Kahve_kategori,$Kahve_sertlik,$Kahve_asitlik,$Kahve_konsantre,$Kahve_aroma));

				
				}
			}else{
				echo "Yüklenirken hata oluştu";
			}
	
		}
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
							<h1>TAM Kahve</h1>
						 </div>
					</div>
                   <form  method="post" enctype="multipart/form-data" >
                           <div class="form-group">
                              <label for="exampleInputEmail1">Kahve İsmi</label>
                              <input type="text" name="coffee_name"  class="form-control" id="kahveisim" placeholder="Kahve İsmi Giriniz...">
                           </div>
                           <div class="form-group">
                              <label for="exampleInputEmail1">Kahve Açıklaması</label>
                              <textarea type="text" name="coffee_text" id="aciklama"  class="form-control" placeholder="Kahve Açıklaması..."></textarea>
                           </div>
                           <div class="form-group">
                              <label for="exampleInputEmail1">Sertlik Türü: </label>
                            <select id="category" class="fadeIn second" name="coffee_hardness" required>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                  
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="exampleInputEmail1">Asidite: </label>
                            <select id="category" class="fadeIn second" name="coffee_acidity" required>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                  
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="exampleInputEmail1">Kıvam: </label>
                            <select id="category" class="fadeIn second" name="coffee_consistency" required>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                  
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="exampleInputEmail1">Aroma: </label>
                            <select id="category" class="fadeIn second" name="coffee_aroma" required>
                                  <option value="*">*</option>
                                  <option value="**">**</option>
                                  <option value="***">***</option>
                                  <option value="****">****</option>
                                  <option value="*****">*****</option>
                                  
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="exampleInputEmail1">Kategori: </label>
                            <select id="category" class="fadeIn second" name="coffee_categorie_id" required>
                                  <option  value="1">Sütlü Kahve</option>
                                  <option value="2">Sütsüz Kahve</option>
                                  <option value="3">Soğuk Kahve</option>
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="exampleInputEmail1">Kahve Resmi </label>
                              <input name="coffee_img" class="fadeIn second" style=" background-color: #f6f6f6; border: none; width: 100%; color:  #606060; padding: 1px 10px;  text-align: center; font-size: 16px; " type="file" placeholder="Film Afişi Seçiniz" required>
                            </div>
                           <div class="col-md-12 text-center ">
                             <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Kahve Ekle</button>
                             
                           </div>
                          
                           </div>
                           
                          
                        </form>
                      
				</div>
			</div>
			  
			</div>
		</div>
      </div>   
         
</body>