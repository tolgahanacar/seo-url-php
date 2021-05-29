<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=seourl;charset=UTF8","tolga","123456");
}catch(PDOException $ErrorMessage){
    echo $ErrorMessage->getMessage();
    die();
}

