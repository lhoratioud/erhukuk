

<?php require_once('Utilities/conn.php');?>

<?php

$blog = $db->prepare("SELECT * FROM blog WHERE AKTIF = '1' ORDER BY ID DESC LIMIT 8");
$blog->execute();


$blog_only_one = $db->prepare("SELECT * FROM blog WHERE AKTIF = '1' ORDER BY ID DESC LIMIT 1");
$blog_only_one->execute();

$blogish = $blog_only_one->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <script src="Utilities/JQuery.js"></script>
    <link rel="stylesheet" href="Index.css">
    <link rel="stylesheet" href="IndexMedia.css">
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
    <title>Er Hukuk</title>
	<meta name="description" content="20 yılı aşkın süredir hukuk ve danışmanlık hizmeti verdiğimiz bu alanda 
                                    müvekkillerimize en iyi hizmeti sunmak için sürekli olarak kendimizi geliştiriyoruz.  Hukukun sürekli değişen 
                                    düzenlemelerini yakından takip ediyor ve müvekkillerimize en doğru ve güncel bilgileri sunuyoruz." />

</head>
<body>

    
	<script src="Index.js"></script>

    <div class="fullScreen">
        <div class="mainScreen">


            

            <div class="mainPageUpperSection">

                <div class="hiddentop">
                    <div  id="tabmenu">
                        <div class="tab"><a class="tabl"  href="">Anasayfa</a></div>
                        <div class="tab"><a class="tabl"  href="/hakkimizda">Hakkımızda</a></div>
                        <div class="tab"><a class="tabl"  href="">Çalışma Alanlarımız</a></div>
                        <div class="tab"><a class="tabl"  href="/ekibimiz">Ekibimiz</a></div>
                        <div class="tab"><a class="tabl"  href="/Blog">Blog</a></div>
                        <div class="tab"><a class="tabl"  href="">Mesleki Sertifikalar</a></div>
                        <div class="tab"><a class="tabl"  href="/iletisim">İletişim</a></div>
                    </div>    
                </div>

                <div class="UC_upperMenu nav-transparent" id="mynav1">   
                    <div class="logoandmenus">

                        <div id="logo" class="UC_logo nav-transparent">
                            <div class="nav-transparent erhukbig" id="erHukuk">ER HUKUK</div>
                            <div class="nav-transparent erhuksmall" id="erHukuk">ER</div>
                            <div class="nav-transparent arabulbig" id="arabulucukDanismanlik">ARABULUCULUK & DANIŞMANLIK</div>
                            <div class="nav-transparent arabulsmall" id="arabulucukDanismanlik">HUKUK BÜROSU</div>
                        </div>

                        <div class="UC_menu  nav-transparent">
                            <ul>
                                <a class="UC_menuContainers nav-transparent" href="/"><li><div class="uppertab nav-transparent"  >Anasayfa</div></li></a>
                                <a class="UC_menuContainers nav-transparent" href="/hakkimizda"><li><div class="uppertab nav-transparent"  >Hakkımızda</div></li></a>
                                <a class="UC_menuContainers nav-transparent" href="#"><li><div class="uppertab nav-transparent"  >Faaliyet Alanlarımız</div></li></a>
                                <a class="UC_menuContainers nav-transparent" href="/ekibimiz"><li><div class="uppertab nav-transparent"  >Ekibimiz</div></li></a>
                                <a class="UC_menuContainers nav-transparent" href="/Blog"><li><div class="uppertab nav-transparent"  >Blog</div></li></a>
                                <a class="UC_menuContainers nav-transparent" href="#"><li><div class="uppertab nav-transparent"  >Mesleki Sertifikalar</div></li></a>
                                <a class="UC_menuContainers nav-transparent" href="/iletisim"><li><div class="uppertab nav-transparent"  >İletişim</div></li></a>
                            </ul>

                            <button type="button" onclick="tabtoggle();" class="hiddenButton">
                                <img class="menuIcon menuI1" id="menuI" src="#" alt="">
                            </button>
                        </div>
                    </div>
                </div>
               



               <div class="UC_upperMenu nav-colored"  id="mynav2">   
                    <div class="logoandmenus">
                        <div id="logo" class="UC_logo nav-colored">
                            <div class="nav-colored erhukbig" id="erHukuk">ER HUKUK</div>
                            <div class="nav-colored erhuksmall" id="erHukuk">ER</div>
                            <div class="nav-colored arabulbig" id="arabulucukDanismanlik">ARABULUCULUK & DANIŞMANLIK</div>
                            <div class="nav-colored arabulsmall" id="arabulucukDanismanlik">HUKUK BÜROSU</div>
                        </div>




                        <div class="UC_menu nav-colored" id="ucmen">
                            <ul>
                                <a class="UC_menuContainers nav-colored" href="/"><li><div class="uppertab nav-colored"  >Anasayfa</div></li></a>
                                <a class="UC_menuContainers nav-colored" href="/hakkimizda"><li><div class="uppertab nav-colored"  >Hakkımızda</div></li></a>
                                <a class="UC_menuContainers nav-colored" href="#"><li><div class="uppertab nav-colored"  >Faaliyet Alanlarımız</div></li></a>
                                <a class="UC_menuContainers nav-colored" href="/ekibimiz"><li><div class="uppertab nav-colored"  >Ekibimiz</div></li></a>
                                <a class="UC_menuContainers nav-colored" href="/Blog"><li><div class="uppertab nav-colored"  >Blog</div></li></a>
                                <a class="UC_menuContainers nav-colored" href="#"><li><div class="uppertab nav-colored"  >Mesleki Sertifikalar</div></li></a>
                                <a class="UC_menuContainers nav-colored" href="/iletisim"><li><div class="uppertab nav-colored"  >İletişim</div></li></a>
                            </ul>
                            <button type="button" onclick="tabtoggle();" class="hiddenButton">
                                <img class="menuIcon menuI2" id="menuI" src="#" alt="">
                            </button>
                        </div>
                    </div>
                </div>


               
				
                <div class="mainBackgroundImageContainer">
                    <div class="mainImageSubContainer">
                        <div id="imgSwap"></div>
                    </div>
                </div>
				
				
				<div class="mainPageUpperContent">
					<div id="mainPageSlider">		

				        <input type="radio" class="slideClass" name="slider" id="slide1">
                        <input type="radio"  class="slideClass"name="slider" id="slide2"  checked>
                        <input type="radio"  class="slideClass"name="slider" id="slide3">
                        <input type="radio"  class="slideClass"name="slider" id="slide4">	 
		
                        <div id="SlideContainer">
                            <div id="overflow">
                                <div class="inner">
                                    <div class="slide slide_1">
				        			    <div class="sh2">
                                            <div class="emptySpace"></div>
                                            <div class="header_for_slides">Son Blog Yazısı</div>
                                            <div class="emptySpace"></div>
                                            <div class="content_for_slides" id="blog_tek">
                                                <div id="blog_tek_yazar"><?php echo $blogish["YAZAR"] . " " . "|" . " " . $blogish["TARIH"]; ?></div>
                                                <div id="blog_tek_baslik"><?php echo $blogish["BASLIK"]; ?></div> 
                                                <div class="entryContent gounv" id="blog_tek_icerik"> <?php echo substr($blogish["ICERIK"], 0, 600) . "..."; ?>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide slide_2">
							            <div class="sh2">
                                            <div class="emptySpace"></div>
                                            <div class="header_for_slides">Er Hukuk Bürosu</div>
                                            <div class="emptySpace2"></div>
                                            <div class="content_for_slides">20 yılı aşkın süredir hukuk ve danışmanlık hizmeti verdiğimiz bu alanda 
                                            müvekkillerimize en iyi hizmeti sunmak için sürekli olarak kendimizi geliştiriyoruz.<span id="gounv">Hukukun sürekli değişen 
                                            düzenlemelerini yakından takip ediyor ve müvekkillerimize en doğru ve güncel bilgileri sunuyoruz. 
                                            Hukuken karşılaştığınız her sorunda sizlere en iyi hizmeti sunmak ve haklarınızı korumak
                                            için buradayız.</span> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide slide_3">
                                        <div class="sh2">
                                            <div class="emptySpace"></div>
                                            <div class="header_for_slides">Dünden Bugüne</div>
                                            <div class="emptySpace2"></div>
                                            <div class="content_for_slides">Av. Rahmi ÖZKUL ve Av. Erol Körüklü 
                                            tarafından 1996'da kurulan Er Hukuk Bürosu, geçmişten bugüne 100'ü aşkın dava ve çok daha fazla
                                            hukuki sürecin ilerlemesinde yardımcı olmuş ve olmaya devam etmektedir. <span id="gounv"> Bu süreç boyunca müvekillerinin sorunlarına 
                                                net ve etkili çözümler üretmiş ve bugünlere gelebilmiştir.
                                            Bu gaye uğrunda hukuki süreçlerde yardımcı olarak; avukatlık, danışmanlık ve arabuluculuk yapmaya devam etmektedir.</span>
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide slide_4">
                                    <div class="sh2">
                                        <div class="emptySpace"></div>
                                        <div class="header_for_slides">Bize Ulaşın</div>
                                        <div class="emptySpace2"></div>
                                        <div class="content_for_slides">
                                            <div class="bizeUlasinHeader" id="gounv">Hukuki danışmanlık, dava ve 
                                            arabuluculuk hizmetleri gibi birçok alanda size özel çözümler üretiyoruz.</div>
                                            <div class="bizeUlasinBox"> 
                                                <div class="bizeUlasinBoxBaslik" id="gounv">Adres</div> 
                                                <div class="bizeUlasinBoxIcerik">Mansuroğlu Mahallesi, 1934. Sokak, No:6, Som Sitesi B Blok, Kat:2, Daire:5, Bornova / İzmir</div>
                                            </div>
                                            <div class="bizeUlasinBox"> 
                                                <div class="bizeUlasinBoxBaslik">Telefon</div> 
                                                <a href="tel:0555-396-5151" class="bizeUlasinBoxIcerik">(+90) 555 396 5151</a>
                                            </div>
                                            <div class="bizeUlasinBox" id="gounv"> 
                                                <div class="bizeUlasinBoxBaslik">Mail</div> 
                                                <div class="bizeUlasinBoxIcerik">erhukuk@erhukuk.com.tr</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="empty"> </div>
                    <div class="empty"> </div>	


                    <div id="controls">
                        <label for="slide1"></label>
                        <label for="slide2"></label>
                        <label for="slide3"></label>
                        <label for="slide4"></label>
                    </div>
							
				    <div class="empty"> </div>
						
                    <div id="bullets">
                        <label for="slide1"><div class="load"></div></label>
                        <label for="slide2"><div class="load"></div></label>
                        <label for="slide3"><div class="load"></div></label>
                        <label for="slide4"><div class="load"></div></label>
                    </div>

				    <div class="empty2"> </div>		
                </div>
			</div>
        </div>




            <div class="middleContent_AW">

                <div class="MC_upperContainer_AW animatedFadeInUp animated">
                    <div class="h1ek">
                        <div class="line"></div>
                        <div class="h1ekin">1990'dan beri</div>
                        <div class="line"></div>
                    </div>
                    <div id="pageOne" class="h1">Er Hukuk Bürosu</div> 
                    <div class="p2desc">1996 yılından bu yana verdiğimiz köklü hizmetle 
                        Er Hukuk bürosu olarak, hukuki işlemler ve danışmanlık alanında yanınızdayız. Uzun yıllardır hizmet 
                        sunduğumuz bu alanda müvekkillerimizin ihtiyaçlarını anlamak ve uygun çözümler üretmek için çalışıyoruz.
                        Er Hukuk bürosu olarak; hukuki danışmanlık, dava ve arabuluculuk hizmetleri, sözleşme hazırlama ve 
                        inceleme, şirket kuruluşları, fikri mülkiyet hukuku, vergi hukuku, gayrimenkul hukuku, iş ve 
                        işçi hukuku, miras ve intikal hukuku gibi birçok alanda müvekkillerimize hizmet vermekteyiz.
                        Hukuki süreçleri müvekkillerimizle şeffaf bir şekilde yöneterek, müvekkillerimizin 
                        haklarını savunmayı amaçlıyoruz. Uzun yıllara dayanan tecrübesiyle Er Hukuk, müvekkillerine 
                        en doğru ve güvenilir hukuki çözümleri sunarken, aynı zamanda müvekkillerini 
                        bilgilendirir ve hukuk dilindeki terimleri anlaşılır bir şekilde aktarmaya özen gösterir.
                        Er Hukuk olarak, 1996 yılından bu yana hukuki sorunlarınızda size doğru ve etkili bir şekilde yardımcı olmak için hazırız.
                    </div>
                </div>

               <div class="plink l1 animatedFadeInUp animated"><a href="#">&nbsp;&nbsp;Hukuk Ekibimiz&nbsp;&nbsp;  </a></div>

                <div class="emptySpace"></div>

            </div>



            <div class="middleContent_A animatedFadeInUp animated">

                <div class="MC_upperContainer">
                    <div class="p2boxes">
                        <div class="p2box">
                            <img class="p2boximg" src="./images/Index/t2.png" alt="">
                            <div class="p2boxtext">Hukuki Danışmanlık</div>
                        </div>
                        <div class="p2box">
                            <img class="p2boximg" src="./images/Index/t1.png" alt="">
                            <div class="p2boxtext">Arabuluculuk Hizmetleri</div>
                        </div>
                        <div class="p2box">
                            <img class="p2boximg" src="./images/Index/t3.png" alt="">
                            <div class="p2boxtext">Hukuki Süreçlerin Yönetimi</div>
                        </div>
                        <div class="p2box">
                            <img class="p2boximg" src="./images/Index/t4.png" alt="">
                            <div class="p2boxtext">Hukuki Çözümler</div>
                        </div>
                    </div>

                </div>

                <div class="emptySpace"></div>

            </div>




            <div class="middleContent_B">

                <div class="Imagex2">
                    <img class="istImage" src="images/Index/ist_h_06.jpeg" alt="">
                </div>

                <div class="CT_B_All">

                    <div class="servicesDesc"></div>
    
                    <div class="p2Content  animatedFadeInUp animated">
                        <div id="pageTwo" class="h2">Hizmet Alanlarımız</div>
                        <div class="p2desc" id="p2desc1">Er Hukuk bürosu, 20 yılı aşkın tecrübemizle, hukukun birçok alanında faaliyet göstermeye devam ediyoruz.</div>
                    </div>
                    

                    <div class="BC_personsTab  animatedFadeInUp animated">
                        <button  class="BCTabs disappear"> <a href="#"> Gayrimenkul Hukuku</a></button>
                        <button class="BCTabs"> <a href="#">İdare Hukuku</a></button>
                        <button  class="BCTabs "> <a href="#">Aile Hukuku</a></button>
                        <button  class="BCTabs  disappear"> <a href="#">Kira Hukuku</a></button>
                        <button class="BCTabs"> <a href="#">Miras Hukuku</a></button>
                        <button  class="BCTabs"> <a href="#"> Ticaret Hukuku</a></button>
                      <!--  <button  class="BCTabs "> <a href="#"> Vergi Hukuku</a></button>
                        
                        <button  class="BCTabs  disappear"> <a href="#"> Arabuluculuk Hizmeti</a></button> -->  
                        <button  class="BCTabs "> <a href="#"> Vergi Hukuku</a></button>
                        <button  class="BCTabs"> <a href="#"> Tüketici Hukuku</a></button>
                        <button  class="BCTabs disappear"> <a href="#">Sigorta Hukuku</a></button>
                    </div>

                    <div class="plink l2"> <a href="/Blog">&nbsp;&nbsp;Tümüne Göz At&nbsp;&nbsp;  </a></div>


                    
    

                </div>
                
            </div>

            <div class="middleContent_C">

                <div class="h3 animatedFadeInUp animated"><div class="sline"></div> Son Blog Yazıları <div class="sline"></div></div>

                <div class="MC Boxes">

                <?php
                $count = 0;
                while(($row = $blog->fetch(PDO::FETCH_ASSOC))) {
                    if($row["AKTIF"] == 0) {continue;}
                    $count++;
                        ?>
                    <a <?php $baslik = str_replace(" ","-", $row["BASLIK"]); echo " href='/icerik/" . $row["ID"] . "/" . $baslik . "'"; if($count > 4) echo "class='Box animatedFadeInUp animated disappear'"; else {echo "class='MC Box animatedFadeInUp animated'";} ?>>
                        <div class="boxImage"> <img class="boxImage_I" <?php echo "src='Panel/Blog/" . $row["IMAGE"] . "'"; ?> alt=""> </div>
                        <div class="boxText">
                            <div class="boxInfo"><?php echo $row["YAZAR"] . " " . "|" . " " . $row["TARIH"]; ?></div>
                            <div class="boxHeader"><?php echo $row["BASLIK"]; ?></div>
                            <div class="boxContent"> <?php echo substr($row["ICERIK"], 0, 350) . "..."; ?> </div>
                                <div class="boxButton"></div>
                        </div>
                    </a>
                
                <?php  } ?>

                    <div class="plink l3"> <a href="/Blog">&nbsp;&nbsp;Tüm Yazıları Gör&nbsp;&nbsp;  </a></div>
                </div>



            </div>

            <div class="middleContent_D">

            </div>



            <?php require_once('Utilities/pagefooter.php');?>

        </div>
    </div>
    <script>load();</script>

    
</body>
</html>
