<?php 

<?php 


header("Content-Type: text/html; charset=utf-8");
//error_reporting(0);
setlocale(LC_ALL, 'tr_TR.UTF-8', 'tr-TR', 'tr', 'turkish');

//define("_HOST", "localhost:3307");
//define("_DBNAME", "login");
//define("_DBUSER", "root");
//define('_DBPASS', '');


define("_HOST", "localhost:3306");
define("_DBNAME", "erhukukburosu");
define("_DBUSER", "hayrullahozkul");
define('_DBPASS', '.H@yrullahOZKUL_1392.');

try {
    $db = new PDO("mysql:host="._HOST.";dbname="._DBNAME.";charset=utf8mb4", _DBUSER, _DBPASS);
}  catch (PDOException $ex) { 
    echo $ex->getMessage();
}


?>
