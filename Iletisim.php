<?php

require_once('Utilities/conn.php');
require_once('record_log.php');

$iletisim_cek = $db->prepare("SELECT * FROM iletisim LIMIT 1");
$iletisim_cek->execute();
$iletisim = $iletisim_cek->fetch(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="Iletisim.css">
    <link rel="stylesheet" href="Utilities/PageTemplate.css">
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
    <title>İletişim</title>
    <meta name="description" content="Bizimle aşağıdaki bilgileri kullanarak iletişime geçebilirsiniz;
    Adres : Mansuroğlu Mahallesi, 1934. Sokak, No:6, Som Sitesi B Blok, Kat:2, Daire:5 Bayraklı / İzmir, Telefon : (555) 396 5151, Mail : erhukuk@erhukuk.com.tr" />

	
</head>
<body>


    <div class="fullScreen">
        <div class="mainScreen">

        <?php require_once('Utilities/pageheader.php');?>

        <div  class="upperImageCon">
                  <div class="Imagex">
                     <div id="image" style="background: url('images/Template/law1b.jpg');" class="upperBG"> </div>
                  </div>
               </div>
				
				
				<div class="enterance">
                    <div class="h1">Bize Ulaşın</div>
				</div>
        </div>

        <div class="content_1">
            <div class="content_1_in">

                <div class="leftcontent animatedFadeInUpslow animatedslow fadeInUpslow">
                    <div class="head"></div>
                    <div class="subhead">Bize Aşağıdaki Kanallardan Ulaşabilirsiniz</div>
                    <div class="leftboxes">
                        <div class="box mail">
                            <div class="boxp1">Telefon / WhatsApp</div> 
                            <div class="boxp2"><?php echo htmlspecialchars_decode($iletisim["PHONE"]); ?></div> 
                            <div class="boxp3">Pazartesi - Cuma | 08.00 - 18.00</div>
                        </div>
                        <div class="box adres">
                            <div class="boxp1">Adres</div> 
                            <div class="boxp2">Bayraklı / İzmir</div>
                            <div class="boxp3"><?php echo htmlspecialchars_decode($iletisim["ADRESS"]); ?></div>
                        </div>
                        <div class="box tel">
                            <div class="boxp1">Mail</div> 
                            <div class="boxp2"><?php echo htmlspecialchars_decode($iletisim["MAIL"]); ?></div>
                            <div class="boxp3">En Yakın Zamanda Dönüş Yapılacaktır</div>
                        </div>
                    </div>
                </div>
                <div class="rightcontent">
                <iframe class= "map animatedFadeInUpslow animatedslow fadeInUpslow" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3124.1871275413505!2d27.196371315599205!3d38.460240980197646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14b97de33f50145f%3A0xbe0c9133618af5af!2sER%20Hukuk%20B%C3%BCrosu!5e0!3m2!1sen!2str!4v1661891975121!5m2!1sen!2str" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>


            <?php require_once('Utilities/pagefooter.php');?>

        </div>
    </div>
</body>