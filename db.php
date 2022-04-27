<?php

try{
    $baglan = new PDO("mysql:host=localhost;dbname=tamkahve;port=3308;charset=utf8;","root","");

}catch(PDOException $mesaj){
    echo $mesaj->getMessage();
}



?>