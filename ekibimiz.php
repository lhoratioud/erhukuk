<?php

require_once('Utilities/conn.php');

require_once('Panel/geoplug.php');
require_once('record_log.php');


$ekip = $db->prepare("SELECT * FROM ekip WHERE AKTIF = '1' ORDER BY ID ASC LIMIT 8");
$ekip->execute();


?>


<!DOCTYPE html>
<html lang="tr">
<head>
     <!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-5XPW7W6BFX"></script>
	<script>
  		window.dataLayer = window.dataLayer || [];
  		function gtag(){dataLayer.push(arguments);}
  		gtag('js', new Date());
  		gtag('config', 'G-5XPW7W6BFX');
	</script>
    <base href="/">
    <script src="Utilities/JQuery.js"></script>
    <script src="Utilities/PageTemplate.js"></script>
    <link rel="stylesheet" href="Utilities/PageTemplate.css">
    <link rel="stylesheet" href="ekibimizCSS.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <link rel="canonical" href="https://www.erhukuk.com.tr/" />
    <!-- FAV ICON START -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=4">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=4">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=4">
    <link rel="manifest" href="/site.webmanifest?v=4">
    <link rel="mask-icon" href="/safari-pinned-tab.svg?v=4" color="#5bbad5">
    <link rel="shortcut icon" href="/favicon.ico?v=4">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="preload" as="font" type="font/woff" href="fonts/OpenSans-Light.woff2" crossorigin>
    <link rel="preload" as="font" type="font/woff" href="fonts/NexaBold.woff2" crossorigin>
    <!-- FAV ICON END -->
    <title>Ekibimiz</title>
  <meta name="description" content="Takımımız : Av. Rahmi ÖZKUL, Av. EROL KÖRÜKLÜ, Av. Ramazan ÇİVİCİ, Danışman Mehmet GÖKTÜRK" />

	
</head>
<body>


    <div class="fullScreen">
        <div class="mainScreen">

        <?php require_once('Utilities/pageheader.php');?>

        <div  class="upperImageCon">
                  <div class="Imagex">
                     <div id="image" style="background: url('images/Template/bg7.jpg');" class="upperBG"> </div>
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
                            <div class="erhukukheader">
                                <div class="h1ek">
                                    <div class="line"></div>
                                    <div class="h1ekin">1990'dan beri</div>
                                    <div class="line"></div>  
                                </div>
                                <div id="pageOne" class="h1">Er Hukuk Bürosu</div> 
                            </div>
                            <div class="h1ek" id="h2ek">
                                <div class="h1ekin" id="h2ekin">Ekibimiz</div>
                            </div>
                        </div>

                        <div class="infoContent"> 

                        <div class="ekipleTanis">
                            <div class="TumEkipAciklamaBox">
                                <div class="TumEkipAciklamaHead">Hukuk Ekibimizle Tanışın</div>
                                <div class="TumEkipAciklamaContent">Lorem ipsum dolor sit amet consectetur 
                                    adipisicing elit. Magni ex quisquam hic. Voluptas quibusdam numquam vero! Tenetur, quo!
                                     Quae maiores tenetur hic sunt aspernatur
                                     recusandae quaerat id quia! Sint voluptate fugit est corrupti consectetur ut quasi quibusdam at alias minima!
                                    </div>
                            <div class="scrollDownButton  ekibBaslangic"> <img onclick="scrollDown();" class="scrollDownImage" src="images/Index/scrollDown3.png" alt=""></div>
                            </div>

                            

                            <div class="imgTumEkipContainerAll animatedFadeInUpslow animatedslow fadeInUpslow">
                                <div class="imgTumEkipContainer">
                                    <img class="imgTumEkip" src="images/Template/lawyers1.jpg" alt="">
                                </div>
                                <div class="imgTumEkipShadow"></div>
                            </div>
                        </div>





                            <div class="tumEkibKutusu">






                            <?php
                                $count = 0;
                                while(($uye = $ekip->fetch(PDO::FETCH_ASSOC))) 
                                {
                                    $count++;
                            ?>
                                <div class="ekibUyesi" <?php if($count % 2 == 0) echo "id='ters'";?>>
                                    <div class="ekibUyeResimBox" <?php if($count % 2 == 0) echo "id='ters'";?>>
                                            <img class="ekibUyeResmi" <?php echo "src='images/Ekip/" . $uye["IMAGE"] . "'"; ?> alt="">
                                    </div>
                                    <div class="ekibUyeContext" <?php if($count % 2 == 0) echo "id='ters3'";?>>
                                        <div class="ekibUyeBaslik">
                                            <div class="uyeisim"><?php echo $uye["ISIM"] ?></div>
                                            <div class="uyeunvan"><?php echo $uye["UNVAN"] ?></div>
                                        </div>
                                        <div class="ekibUyeIcerik disappear2"><?php echo $uye["YAZI"]; ?></div>
                                    </div>
                                    <div class="straightline" <?php if($count % 2 == 0) echo "id='ters2'";?>></div>
                                </div>


                            <?php 
                                } ?>
                            </div>

                        </div>
            
                    </div>   
				</div>
        </div>

            <?php require_once('Utilities/pagefooter.php');?>

        </div>
    </div>
</body>



