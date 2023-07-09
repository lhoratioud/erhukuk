<?php 




header("Content-Type: text/html; charset=utf-8");
//error_reporting(0);
setlocale(LC_ALL, 'tr_TR.UTF-8', 'tr-TR', 'tr', 'turkish');

define("_HOST", "localhost:3307");
define("_DBNAME", "login");
define("_DBUSER", "root");
define('_DBPASS', '');



try {
    $db = new PDO("mysql:host="._HOST.";dbname="._DBNAME."", _DBUSER, _DBPASS);
}  catch (PDOException $ex) { 
    echo $ex->getMessage();
}

$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");

define("_URL", "http://erhukuk/Panel/");

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
     $url = "https://";   
else  
     $url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    
  
if($url == "http://erhukuk/Panel/Blog/YeniBlog.php")
    {

    }
    else {
        $_SESSION["BLOG_MESAJ"] = "";
        $_SESSION["blog_aciklama"] = "";
        $_SESSION["blog_baslik"] = "";
    }



?>