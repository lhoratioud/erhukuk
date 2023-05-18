<?php

require_once('Utilities/conn.php');

$hakkimizda = $db->prepare("SELECT CONTENT FROM hakkimizda WHERE ID = 1 LIMIT 1");
$hakkimizda->execute();

$hakkimizda_yazi = $hakkimizda->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <base href="/">
    <script src="Utilities/JQuery.js"></script>
    <script src="Utilities/PageTemplate.js"></script>
    <link rel="stylesheet" href="Utilities/PageTemplate.css">
    <link rel="stylesheet" href="hakkimizda.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <link rel="canonical" href="https://www.erhukuk.com.tr/" />
    <!-- FAV ICON START -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
    <!-- FAV ICON END -->
    <title>Hakkımızda</title>
    <meta name="description" content=" Kuruluştan bugüne müvekkilerimizin çıkarını devam ettirdiğimiz bu süreçe, Av. Rahmi ÖZKUL ve Av. Erol KÖRÜKLÜ olarak başladık." />

	
</head>
<body>


    <div class="fullScreen">
        <div class="mainScreen">

        <?php require_once('Utilities/pageheader.php');?>

        <div  class="upperImageCon">
                  <div class="Imagex">
                     <div id="image" style="background: url('images/Template/law13.jpg');" class="upperBG"> </div>
                  </div>
               </div>
				
				
				<div class="enterance">

                    <div class="emptySpace"></div>
                    <div class="contentbox">
                        <div  class="upperImageCon2">
                            <div class="Imagex2">
                                <div id="image" style="background: #590000;" class="upperBG"> </div>
                            </div>
                        </div>

                        <div class="infoHeader">
                            <div class="h1ek">
                                <div class="line"></div>
                                <div class="h1ekin">1990'dan beri</div>
                                <div class="line"></div>
                            </div>
                            <div id="pageOne" class="h1">Er Hukuk Bürosu</div> 
                            <div class="h1ek" id="h2ek">
                                <div class="line" id="line2"></div>
                                <div class="h1ekin" id="h2ekin">HAKKIMIZDA</div>
                                <div class="line" id="line2"></div>
                            </div>
                        </div>

                        <div class="infoContent"> <?php echo htmlspecialchars_decode($hakkimizda_yazi["CONTENT"]); ?>
                        </div>
                    </div>   
				</div>
        </div>

        <!-- <div class="content_1">
            <div class="content_1_in">

            <div class="content2">


            

               <div class="enterance2"></div>


            </div>


            </div>
        </div>

        -->

            <?php require_once('Utilities/pagefooter.php');?>

        </div>
    </div>
</body>



