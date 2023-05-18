
<?php require_once('../checkLogin.php'); ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <link rel="stylesheet" href="../Template.css">
    <link rel="stylesheet" href="Anasayfa.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <title>Admin Paneli</title>
</head>

<body>
	<div class="fullScreen">
	<?php require_once('../navbar.php'); ?>
	<div class="header">
        <div class="pagename">PANEL </div>
    </div>
        <div class="mainScreen">
			
			<?php require_once('../bottomdash.php'); ?>
            <div class="boxes">
                <!--
                <div class="box">
                    <img class="boximg" src="../images/Panel/home1.png" alt="">
                    Anasayfa
                </div>
                -->
                <div class="box">
                    <img class="boximg" src="../images/Panel/hizmet1.png" alt="">
                    Faaliyet Alanlarımız
                </div>
                <a href="../Ekibimiz/Ekibimiz.php" class="box">
                    <img class="boximg" src="../images/Panel/team1.png" alt="">
                    Ekibimiz
                </a>
                <a href="../Blog/Blog.php" class="box">
                    <img class="boximg" src="../images/Panel/blog1.png" alt="">
                    Blog
                </a>
                <a href="../Hakkimizda/Hakkimizda.php" class="box">
                    <img class="boximg" src="../images/Panel/hizmet1.png" alt="">
                    Hakkımızda
                </a>
                <div class="box">
                    <img class="boximg" src="../images/Panel/sertifika1.png" alt="">
                    Mesleki Sertifikalar
                </div>
                <div class="box">
                    <img class="boximg" src="../images/Panel/ilet1.png" alt="">
                    İletişim
                </div>
            </div>
</body>
