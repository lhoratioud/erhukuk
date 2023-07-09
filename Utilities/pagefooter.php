<?php

$footerblog = $db->prepare("SELECT * FROM blog WHERE AKTIF = '1' ORDER BY ID DESC LIMIT 3");
$footerblog->execute();

$footerareas = $db->prepare("SELECT * FROM hizmetler WHERE AKTIF = '1' ORDER BY ID ASC LIMIT 11");
$footerareas->execute();

$iletisim_cek = $db->prepare("SELECT * FROM iletisim LIMIT 1");
$iletisim_cek->execute();
$iletisim = $iletisim_cek->fetch(PDO::FETCH_ASSOC);



if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header("Location: /");
}

?>

<div class="bottomContent">
                <div class="footerContent">
                    <div class="footerBlog">
                        <div class="bContact">
                            <div class="bFooterBox">
                                <img src="../images/Template/loc1.png" class="bContactIcon" alt="">
                                <a href="https://maps.google.com/maps/dir//ER+Hukuk+B%C3%BCrosu+Mansuro%C4%9Flu+Mahallesi+Mustafa+Kemal+Caddesi+Som+sitesi,+No:+145,+B+Blok,+Daire:5+35030+Bayrakl%C4%B1%2F%C4%B0zmir/@38.4602368,27.19856,16z/data=!4m5!4m4!1m0!1m2!1m1!1s0x14b97de33f50145f:0xbe0c9133618af5af" class="bContactContext">Yol Tarifi</a>
                            </div>
                            <div class="bFooterBox">
                                <img src="../images/Template/tel1.png" class="bContactIcon" alt="">
                                <a href="tel:05553965151" class="bContactContext">Bizi Arayın</a>
                            </div>
                        </div>
                        <div class="bContent">
                            <div class="bHeader">BLOG <div class="bLine"></div></div>

                                <?php
                                $counter = 0;
                                 while(($row = $footerblog->fetch(PDO::FETCH_ASSOC)) && $counter < 3) {
                                    if($row["AKTIF"] == 0) {continue;}
                                    $counter++;
                                ?>

                                <a <?php $baslik = str_replace(" ","-", $row["BASLIK"]); echo "class='bEntry'" . " href='/icerik/" . $row["ID"] . "/" . $baslik . "'"; ?>>
                                
                                <div class="entryHead"> <?php echo $row["BASLIK"]; ?> </div>
                                <div class="entryContent"><?php echo substr($row["ICERIK"], 0, 140); ?></div>

                                </a>
                        
                                <?php  } ?>

                        </div>
                        <div class="footerAdress">
                            <div class="bHeader">İLETİŞİM <div class="bLine"></div></div>
                            <div class="aEntry">
                                <div class="aentryHead">Adres&nbsp;&nbsp;:&nbsp;&nbsp;</div>
                                <div class="aentryContent"><?php echo htmlspecialchars_decode($iletisim["ADRESS"]); ?></div>
                            </div>
                            <div class="aEntry">
                                <div class="aentryHead">Telefon&nbsp;&nbsp;:&nbsp;&nbsp;</div>
                                <a href="tel:0555-396-5151" class="aentryContent"><?php echo htmlspecialchars_decode($iletisim["PHONE"]); ?></a>
                            </div>
                            <div class="aEntry">
                                <div class="aentryHead">WhatsApp&nbsp;&nbsp;:&nbsp;&nbsp;</div>
                                <a href="https://wa.me/5553965151" class="aentryContent"><?php echo htmlspecialchars_decode($iletisim["PHONE"]); ?></a>
                            </div>
                            <div class="aEntry">
                                <div class="aentryHead">Mail&nbsp;&nbsp;:&nbsp;&nbsp;</div>
                                <div class="aentryContent"><?php echo htmlspecialchars_decode($iletisim["MAIL"]); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="footerContact">
                    </div>
                    <div class="footerServices">
                        <?php 
                            while($foooter_area = $footerareas->fetch(PDO::FETCH_ASSOC))
                            {
                        ?>

                        
                        <div class="btab"><a class="btabl" <?php echo "href='calismaalani/" . $foooter_area["HIZMET_LINKI"] . "'"; ?>><?php echo $foooter_area["HIZMET_ADI"]; ?></a></div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <script>sanitize();</script>
                <div class="footerCopyright"><a href="Panel/Login/Login.php" class="copyTxt">&copy; 2022  Er Hukuk Bürosu | Tüm Hakları Saklıdır.</a></div>
            </div>