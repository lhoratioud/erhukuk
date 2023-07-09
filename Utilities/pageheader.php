<?php 

require_once("conn.php");

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
   header("Location: /");
}

?>



      

            <div class="upperContent">
               <div class="hiddentop">
                <div  id="tabmenu">
                     <div class="tab"><a class="tabl"  href="/">Anasayfa</a></div>
                     <div class="tab"><a class="tabl"  href="/hakkimizda">Hakkımızda</a></div>
                     <div class="tab"><a class="tabl"  href="/calismaalanlari">Çalışma Alanlarımız</a></div>
                     <div class="tab"><a class="tabl"  href="/ekibimiz">Ekibimiz</a></div>
                     <div class="tab"><a class="tabl"  href="/blog">Blog</a></div>
                     <div class="tab"><a class="tabl"  href="">Mesleki Sertifikalar</a></div>
                     <div class="tab"><a class="tabl"  href="/iletisim">İletişim</a></div>
                  </div>    
                </div>
               <div class="UC_upperMenu nav-transparent" id="mynav1">       
                  <div class="logoandmenus">
                     <a href="https://www.erhukuk.com.tr/" id="logo" class="UC_logo nav-transparent">
                     <div class="nav-transparent erhukbig" id="erHukuk">ER HUKUK</div>
                        <div class="nav-transparent erhuksmall" id="erHukuk">ER</div>
                        <div class="nav-transparent arabulbig" id="arabulucukDanismanlik">ARABULUCULUK & DANIŞMANLIK</div>
                        <div class="nav-transparent arabulsmall" id="arabulucukDanismanlik">HUKUK BÜROSU</div>
                     </a>
                     <div class="UC_menu  nav-transparent" id="ucmen">
                        <ul>
                            <div class="UC_menuContainers nav-transparent"><li><a class="uppertab nav-transparent"  href="/">Anasayfa</a></li></div>
                            <div class="UC_menuContainers nav-transparent"><li><a class="uppertab nav-transparent"  href="/hakkimizda">Hakkımızda</a></li></div>
                            <div class="UC_menuContainers nav-transparent"><li><a class="uppertab nav-transparent"  href="/calismaalanlari">Faaliyet Alanlarımız</a></li></div>
                            <div class="UC_menuContainers nav-transparent"><li><a class="uppertab nav-transparent"  href="/ekibimiz">Ekibimiz</a></li></div>
                            <div class="UC_menuContainers nav-transparent"><li><a class="uppertab nav-transparent"  href="/blog">Blog</a></li></div>
                            <div class="UC_menuContainers nav-transparent"><li><a class="uppertab nav-transparent"  href="#">Mesleki Sertifikalar</a></li></div>
                            <div class="UC_menuContainers nav-transparent"><li><a class="uppertab nav-transparent"  href="/iletisim">İletişim</a></li></div>
                        </ul>
                        <button type="button" onclick="tabtoggle();" class="hiddenButton">
                           <img class="menuIcon menuI1" id="menuI" src="#" alt="">
                        </button>
                     </div>
                  </div>
               </div>


               <div class="UC_upperMenu nav-colored vanish" id="mynav2">       
                  <div class="logoandmenus">
                     <a href="https://www.erhukuk.com.tr/" id="logo" class="UC_logo nav-colored">
                        <div class="nav-colored erhukbig" id="erHukuk">ER HUKUK</div>
                        <div class="nav-colored erhuksmall" id="erHukuk">ER</div>
                        <div class="nav-colored arabulbig" id="arabulucukDanismanlik">ARABULUCULUK & DANIŞMANLIK</div>
                        <div class="nav-colored arabulsmall" id="arabulucukDanismanlik">HUKUK BÜROSU</div>
                     </a>
                     <div class="UC_menu nav-colored">
                        <ul>
                            <div class="UC_menuContainers nav-colored"><li><a class="nav-colored"  href="/">Anasayfa</a></li></div>
                            <div class="UC_menuContainers nav-colored"><li><a class="nav-colored"  href="/hakkimizda">Hakkımızda</a></li></div>
                            <div class="UC_menuContainers nav-colored"><li><a class="nav-colored"  href="/calismaalanlari">Faaliyet Alanlarımız</a></li></div>
                            <div class="UC_menuContainers nav-colored"><li><a class="nav-colored"  href="/ekibimiz">Ekibimiz</a></li></div>
                            <div class="UC_menuContainers nav-colored"><li><a class="nav-colored"  href="/blog">Blog</a></li></div>
                            <div class="UC_menuContainers nav-colored"><li><a class="nav-colored"  href="#">Mesleki Sertifikalar</a></li></div>
                            <div class="UC_menuContainers nav-colored"><li><a class="nav-colored"  href="/iletisim">İletişim</a></li></div>
                        </ul>
                        <button type="button" onclick="tabtoggle();" class="hiddenButton">
                           <img class="menuIcon menuI2" id="menuI" src="#" alt="">
                        </button>
                     </div>
                  </div>

                  <div  id="tabmenu">
                     <div class="tab"><a class="tabl"  href="/">Anasayfa</a></div>
                     <div class="tab"><a class="tabl"  href="/hakkimizda">Hakkımızda</a></div>
                     <div class="tab"><a class="tabl"  href="/calismaalanlari">Çalışma Alanlarımız</a></div>
                     <div class="tab"><a class="tabl"  href="/ekibimiz">Ekibimiz</a></div>
                     <div class="tab"><a class="tabl"  href="/blog">Blog</a></div>
                     <div class="tab"><a class="tabl"  href="">Mesleki Sertifikalar</a></div>
                     <div class="tab"><a class="tabl"  href="">İletişim</a></div>
                  </div>
               </div>
				
