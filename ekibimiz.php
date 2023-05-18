<?php

require_once('Utilities/conn.php');

$ekip = $db->prepare("SELECT * FROM ekip WHERE AKTIF = '1' ORDER BY ID ASC LIMIT 8");
$ekip->execute();


?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <base href="/">
    <script src="Utilities/JQuery.js"></script>
    <script src="Utilities/PageTemplate.js"></script>
    <link rel="stylesheet" href="Utilities/PageTemplate.css">
    <link rel="stylesheet" href="ekibimiz.css">
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
    <title>Ekibimiz</title>

	
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
                                <div class="h1ekin" id="h2ekin">EKİBİMİZ</div>
                                <div class="line" id="line2"></div>
                            </div>
                        </div>

                        <div class="infoContent"> 

                            <div class="imgTumEkipContainerAll animatedFadeInUpslow animatedslow fadeInUpslow">
                                <div class="imgTumEkipContainer">
                                    <img class="imgTumEkip" src="images/Template/lawyers1.jpg" alt="">
                                </div>
                                <div class="imgTumEkipShadow"></div>
                            </div>

                            <div class="scrollDownButton  ekibBaslangic"> <img onclick="scrollDown();" class="scrollDownImage" src="images/Index/scrollDown3.png" alt=""></div>


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
                                    <div class="ekibUyeContext">
                                        <div class="ekibUyeBaslik"><?php echo $uye["UNVAN"] . " " . $uye["ISIM"]; ?></div>
                                        <div class="ekibUyeIcerik"><?php echo $uye["YAZI"]; ?></div>
                                    </div>
                                    <div class="straightline" <?php if($count % 2 == 0) echo "id='ters2'";?>></div>
                                </div>


                            <?php 
                                } ?>




                                <?php /*

                                <div class="ekibUyesi">
                                    <div class="ekibUyeResimBox">
                                            <img class="ekibUyeResmi" <?php echo "src='images/Ekip/" . $uyeler[0]["IMAGE"] . "'"; ?> alt="">
                                    </div>
                                    <div class="ekibUyeContext">
                                        <div class="ekibUyeBaslik">Av. Rahmi ÖZKUL</div>
                                        <div class="ekibUyeIcerik">Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                                            Nulla eaque aspernatur iste, provident earum voluptatum. Temporibus architecto quae molestiae 
                                            necessitatibus repellat est illum natus iste consequatur placeat, vero soluta. Vel dolores quibusdam itaque 
                                            aliquid error. Quia eum ex laudantium inventore quos sapiente delectus, repellat eligendi nobis repudiandae 
                                            voluptates ducimus laboriosam minima eius porro numquam vitae doloribus incidunt aspernatur reprehenderit quasi. 
                                            Maiores praesentium fugit delectus modi obcaecati nostrum commodi quam incidunt porro aperiam dolor minus ipsam 
                                            voluptatibus voluptatum ullam 
                                            architecto reprehenderit iure non libero quos voluptate, dignissimos, repudiandae quisquam? Culpa, 
                                            quisquam praesentium nesciunt laborum aspernatur ea modi sunt officia beatae eos.</div>
                                    </div>
                                    <div class="straightline"></div>
                                </div>


                                <div class="ekibUyesi" id="ters">
                                    <div class="ekibUyeResimBox"  id="ters">
                                    <img class="ekibUyeResmi" <?php echo "src='images/Ekip/" . $uyeler[1]["IMAGE"] . "'"; ?> alt="">
                                    </div>
                                    <div class="ekibUyeContext">
                                        <div class="ekibUyeBaslik">Av. Erol KÖRÜKLÜ</div>
                                        <div class="ekibUyeIcerik">Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                                            Nulla eaque aspernatur iste, provident earum voluptatum. Temporibus architecto quae molestiae 
                                            necessitatibus repellat est illum natus iste consequatur placeat, vero soluta. Vel dolores quibusdam itaque 
                                            aliquid error. </div>
                                    </div>
                                    <div class="straightline" id="ters2"></div>
                                </div>


                                <div class="ekibUyesi">
                                    <div class="ekibUyeResimBox">
                                    <img class="ekibUyeResmi" <?php echo "src='images/Ekip/" . $uyeler[2]["IMAGE"] . "'"; ?> alt="">
                                    </div>
                                    <div class="ekibUyeContext">
                                        <div class="ekibUyeBaslik">Av. Ramazan ÇİVİCİ</div>
                                        <div class="ekibUyeIcerik">Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                                            Nulla eaque aspernatur iste, provident earum voluptatum. Temporibus architecto quae molestiae 
                                            necessitatibus repellat est illum natus iste consequatur placeat, vero soluta. Vel dolores quibusdam itaque 
                                            aliquid error. Quia eum ex laudantium inventore quos sapiente delectus, repellat eligendi nobis repudiandae 
                                            voluptates ducimus laboriosam minima eius porro numquam vitae doloribus incidunt aspernatur reprehenderit quasi. 
                                            Maiores praesentium fugit delectus modi obcaecati nostrum commodi quam incidunt porro aperiam dolor minus ipsam 
                                            voluptatibus voluptatum ullam 
                                            architecto reprehenderit iure non libero quos voluptate, dignissimos, repudiandae quisquam? Culpa, 
                                            quisquam praesentium nesciunt laborum aspernatur ea modi sunt officia beatae eos. </div>
                                    </div>
                                    <div class="straightline"></div>
                                </div>


                                <div class="ekibUyesi" id="ters">
                                    <div class="ekibUyeResimBox" id="ters">
                                    <img class="ekibUyeResmi" <?php echo "src='images/Ekip/" . $uyeler[3]["IMAGE"] . "'"; ?> alt="">
                                    </div>
                                    <div class="ekibUyeContext">
                                        <div class="ekibUyeBaslik">Danışman Mehmet GÖKTÜRK</div>
                                        <div class="ekibUyeIcerik">Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                                            Nulla eaque aspernatur iste, provident earum voluptatum. Temporibus architecto quae molestiae 
                                            necessitatibus repellat est illum natus iste consequatur placeat, vero soluta. Vel dolores quibusdam itaque 
                                            aliquid error. Quia eum ex laudantium inventore quos sapiente delectus, repellat eligendi nobis repudiandae 
                                            voluptates ducimus laboriosam minima eius porro numquam vitae doloribus incidunt aspernatur reprehenderit quasi. 
                                            Maiores praesentium fugit delectus modi obcaecati nostrum commodi quam incidunt porro aperiam dolor minus ipsam 
                                            voluptatibus voluptatum ullam 
                                            architecto reprehenderit iure non libero quos voluptate, dignissimos, repudiandae quisquam? Culpa, 
                                            quisquam praesentium nesciunt laborum aspernatur ea modi sunt officia beatae eos.</div>
                                    </div>
                                    <div class="straightline" id="ters2"></div>
                                </div>


                             
                                */ ?>
                            </div>

                        </div>
            
                    </div>   
				</div>
        </div>

            <?php require_once('Utilities/pagefooter.php');?>

        </div>
    </div>
</body>



