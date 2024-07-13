<?php

require_once('Utilities/conn.php');

require_once('Panel/geoplug.php');
require_once('record_log.php');


$hizmetler = $db->prepare("SELECT * FROM hizmetler WHERE AKTIF = '1'");
$hizmetler->execute();


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
    <link rel="stylesheet" href="calismaalanlari.css">
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
    <!-- FAV ICON END -->
    <title>Çalışma Alanları</title>
    <meta name="description" content="Er Hukuk Bürosu olarak, 10'u aşkın faaliyet alanıyla müvekkilerimize her türlü hukuki konuda yardımcı oluyoruz." />
</head>
<body>


    <div class="fullScreen">
        <div class="mainScreen">

        <?php require_once('Utilities/pageheader.php');?>

        <div  class="upperImageCon">
                  <div class="Imagex">
                     <div id="image" style="background: url('images/Template/bg8-1.webp');" class="upperBG"> </div>
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
                                <div class="h1ekin" id="h2ekin">Çalışma Alanlarımız</div>
                            </div>
                        </div>

                        <div class="infoContent">
                            <div class="historyHeaders">
                                <div class="historyHead">Hukukun Her Dalında Etkin Hizmet</div>
                                <div class="historyContext">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis laudantium, suscipit natus unde qui ad culpa possimus 
                                    voluptatem voluptatum quos similique explicabo est animi, incidunt libero deleniti iure rem ab maiores cum! 
                                </div>
                            </div>
                           
                            <div class="infoText">

                                <?php

                                while(($hizmet = $hizmetler->fetch(PDO::FETCH_ASSOC))) 
                                {
                                ?>

                                    <a <?php echo "href='/calismaalani/" . $hizmet["HIZMET_LINKI"] . "' class='BCTabs'"; ?> > 
                                        <h3> <?php echo $hizmet["HIZMET_ADI"]; ?></h3> 
                                        <div class="BCTabContent disappear boxContent"> <?php echo substr($hizmet["HIZMET_ACIKLAMA_KISA"], 0, 100);  ?> </div>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>

                        </div>

                        <div class="fastContact">

    
                            <div class="fcImageBox">
                                <img id="fcImage" src="images/Template/bg2-1.webp" style="background: #590000;"></img>
                            </div>

                            <div class="fcContext">
                                <div class="fcText">Hukuki Süreçleriniz İçin...</div>
                                <a href="/iletisim" class="fcLink">İletişime Geçin</a>
                            </div>

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



