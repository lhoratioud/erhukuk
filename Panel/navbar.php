<?php 
require_once('checkLogin.php'); 
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header("Location: Anasayfa/Anasayfa.php");
}

?>

<div class="navbar">
    <div class="navbarup">
    <div class="logo">
        <div class="p1">ER HUKUK</div>
        <div class="p2">ADMİN PANELİ</div>
    </div>
    <div class="navs">
        <a href="/Panel/Anasayfa/Anasayfa.php" class="nav">Anasayfa</a>
        <a href="/Panel/Hizmetler/Hizmetler.php" class="nav">Faaliyet Alanlarımız</a>
        <a href="/Panel/Ekibimiz/Ekibimiz.php" class="nav">Ekibimiz</a>
        <a href="/Panel/Blog/Blog.php" class="nav">Blog</a>
        <a href="/Panel/Hakkimizda/Hakkimizda.php" class="nav">Hakkımızda</a>
        <a href="" class="nav">Mesleki Sertifikalar</a>
        <a href="../Iletisim/Iletisim.php" class="nav">İletişim</a>
    </div>
    </div>
    <div class="navbarbot">
        <div class="welcome"><?php echo $_SESSION['name']?></div>
        <div class="navicons">
        <a class="navimg" href="/Panel/Anasayfa/Anasayfa.php">
            <img class="navimg2" src="../images/Template/home1.png"  alt="">
        </a>
        <a class="navimg" href="/Panel/Login/Logout.php">
            <img class="navimg" src="../images/Template/logout1.png" alt="">
        </a>
    </div>
    </div>
</div>
