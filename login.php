
<?php

session_start();

include "db.php";

$db = $baglan->prepare("SELECT * from user where user_email=? and user_password=?");



if($_POST){

	$email = $_POST["email"];
	$password = $_POST["password"];
	$db->execute(array($email,$password));
	$x = $db->fetch(PDO::FETCH_ASSOC);
	$kontrol = $db->rowCount();


	if($kontrol){
		$_SESSION["name"] = $x["user_name"];
		$_SESSION["id"] = $x["users_id"];
		$_SESSION["ban"] = $x["user_ban"];
    $_SESSION["user_new_old"] = $x["user_new_old"];
	}else{
		echo "Bilgileri Doğru Giriniz";
	}

			
		
	
	
}
if($_SESSION){
  if($_SESSION["ban"]==0 && $_SESSION["user_new_old"]==1){
     header("refresh: 1;url=index.php?id=".$_SESSION["id"]."");
  }else{
    if($_SESSION["user_new_old"]==0){
    echo "<script>alert('Hesabınız Onaylama Aşamasında');</script>";
    header("refresh: 1;url=dt/exit.php");
    session_destroy();
    }else if($_SESSION["ban"]==1){
      echo "<script>alert('Admin Tarafından Banlandınız');</script>";
      header("refresh: 1;url=dt/exit.php");
    session_destroy();
    }
    header("refresh: 1;url=dt/exit.php");
    session_destroy();
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
      background:rgba(0, 0, 0, 0.76);
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
<script type="text/javascript">
   $("#signup").click(function() {
$("#first").fadeOut("fast", function() {
$("#second").fadeIn("fast");
});
});

$("#signin").click(function() {
$("#second").fadeOut("fast", function() {
$("#first").fadeIn("fast");
});
});


  
         $(function() {
           $("form[name='login']").validate({
             rules: {
               
               email: {
                 required: true,
                 email: true
               },
               password: {
                 required: true,
                 
               }
             },
              messages: {
               email: "Lütfen geçerli bir e-mail adresi giriniz...",
              
               password: {
                 required: "Lütfen şifrenizi giriniz.",
                
               }
               
             },
             submitHandler: function(form) {
               form.submit();
             }
           });
         });
         


$(function() {
  
  $("form[name='registration']").validate({
    rules: {
      firstname: "required",
      lastname: "required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    
    messages: {
      firstname: "Please enter your firstname",
      lastname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
  
    submitHandler: function(form) {
      form.submit();
    }
  });
});

</script>
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
         
                   <form  method="post" name="login">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Email adresi</label>
                              <input type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="E-mail Adresinizi Giriniz...">
                           </div>
                           <div class="form-group">
                              <label for="exampleInputEmail1">Şifre</label>
                              <input type="password" name="password" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="Şifrenizi Giriniz...">
                           </div>
                           <div class="col-md-12 text-center ">
                             <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                           </div>
                          
                           </div>
                           
                          
                        </form>
       
                 
				</div>
			</div>
			  
			</div>
		</div>
      </div>   
         
</body>