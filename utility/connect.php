<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=seourl;charset=UTF8","tolga","123456");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $ErrorMessage){
    echo $ErrorMessage->getMessage();
    die();
}

