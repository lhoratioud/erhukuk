<?php 




header("Content-Type: text/html; charset=utf-8");
//error_reporting(0);
setlocale(LC_ALL, 'tr_TR.UTF-8', 'tr-TR', 'tr', 'turkish');


require_once("../../Utilities/conn.php");

try {
    $db = new PDO("mysql:host="._HOST.";dbname="._DBNAME."", _DBUSER, _DBPASS);
}  catch (PDOException $ex) { 
    echo $ex->getMessage();
}

$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");


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

function echodate () {
        $zaman = time();
        $YIL = date("Y", $zaman);
        $AY = date("m", $zaman);
        $GUN = date("d", $zaman);
        switch($AY)
        {
            case "01":
                return $GUN . " " . " Ocak " . " " .$YIL;
                break;
            case "02":
                return $GUN . " " . " Şubat " . " " .$YIL;
                break;
            case "03":
                return $GUN . " " . " Mart " . " " .$YIL;
                break;
            case "04":
                return $GUN . " " . " Nisan " . " " .$YIL;
                break;
            case "05":
                return $GUN . " " . " Mayıs " . " " .$YIL;
                break;
            case "06":
                return $GUN . " " . " Haziran " . " " .$YIL;
                break;
            case "07":
                return $GUN . " " . " Temmuz " . " " .$YIL;
                break;
            case "08":
                return $GUN . " " . " Ağustos " . " " .$YIL;
                break;
            case "09":
                return $GUN . " " . " Eylül " . " " .$YIL;
                break;
            case "10":
                return $GUN . " " . " Ekim " . " " .$YIL;
                break;
            case "11":
                return $GUN . " " . " Kasım " . " " .$YIL;
                break;
            case "12":
                return $GUN . " " . " Aralık " . " " .$YIL;
                break;
        }
        
    }



?>