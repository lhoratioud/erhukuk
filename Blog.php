<?php require_once('Utilities/conn.php');?>

<?php

if(isset($_GET['a2']))
{
    //$url = "/Blog.php?action=arama&ara=" . $_GET["a1"];
    $url = "/arama/" . $_GET["a1"];
    if($_GET["a1"] == '')
    {
        header("Location: /Blog");
    }
    else {
        header("Location:" . " " . $url);
    }
}



$limit = 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if(!is_numeric($page))
{
    header("Location: /Blog");
}   
$start = ($page - 1) * $limit;
$total = null;



$tags = $db->prepare("SELECT TAG_NAME, TAG_ID FROM tags ORDER BY ID DESC LIMIT 20");
$tags->execute();

$ptags = $db->prepare("SELECT ID, TAG_NAME, TAG_BLOG_COUNT FROM taglist ORDER BY TAG_BLOG_COUNT DESC LIMIT 20");
$ptags->execute();

$blog = null;
$getblogs = null;
$blogcount = null;
$is_page_normal = 3;


if(isset($_GET["action"]))
{
    if($_GET["action"] == "arama")
    {
        if(isset($_GET["ara"]))
        {
            $is_page_normal = 3;
            if(isset($_GET['page']))
            {
                header("Location: /Blog");
            }
            $blog = $db->prepare("SELECT * FROM blog WHERE baslik LIKE CONCAT('%', :arama, '%')");
            $blog->bindParam(":arama", $_GET["ara"], PDO::PARAM_STR);
            $blog->execute();
            $total = $blog->rowCount();
        }
        else 
        {
            header("Location: /Blog");
        }
    }
    else if($_GET["action"] == "etiket")
    {
        if(isset($_GET["etk"]) && is_numeric($_GET["etk"]))
        {
            $blog = $db->prepare("SELECT * FROM blog WHERE TAG_IDS LIKE CONCAT('%#', :tagid, '#%') AND AKTIF = '1' ORDER BY ID DESC LIMIT :start, :limit");
            $blogcount = $db->prepare("SELECT ID FROM blog WHERE AKTIF = '1' AND TAG_IDS LIKE CONCAT('%#', :tagid, '#%')");
            $blogcount->bindParam(":tagid", $_GET["etk"], PDO::PARAM_INT);  
            $blogcount->execute();
            $total = $blogcount->rowCount();
            $blog->bindParam(":tagid", $_GET["etk"], PDO::PARAM_INT);   
            $blog->bindParam(":start", $start, PDO::PARAM_INT);   
            $blog->bindParam(":limit", $limit, PDO::PARAM_INT);   
            $blog->execute();
            $is_page_normal = 2;
        }
        else 
        {
            header("Location: /Blog");
        }
    }
    else {
        header("Location: /Blog");
    }
}
else {
    $blog = $db->prepare("SELECT * FROM blog WHERE AKTIF = '1' ORDER BY ID DESC LIMIT :start, :limit");
    $blogcount = $db->prepare("SELECT ID FROM blog WHERE AKTIF = '1'");
    $blogcount->execute();
    $total = $blogcount->rowCount();
    $blog->bindParam(":start", $start, PDO::PARAM_INT);   
    $blog->bindParam(":limit", $limit, PDO::PARAM_INT);  
    $blog->execute();
    $is_page_normal = 1;
}


$pages = ceil( $total / $limit );

if($pages < 1)
{$pages = 1;}


$prev = $page - 1;
$next = $page + 1;


if(!(($page > 0) && ($page < $pages+1)))
{
    header("Location: /Blog");
}


?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <base href="/">
    <script src="Utilities/JQuery.js"></script>
    <script src="Utilities/PageTemplate.js"></script>
    <link rel="stylesheet" href="Blogish.css">
    <link rel="stylesheet" href="Utilities/PageTemplate.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <link rel="canonical" href="https://www.erhukuk.com.tr/" />
    <!-- FAV ICON START -->
    <link rel="shortcut icon" href="https://www.erhukuk.com.tr/Icon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="57x57" href="https://www.erhukuk.com.tr/Icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://www.erhukuk.com.tr/Icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://www.erhukuk.com.tr/Icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://www.erhukuk.com.tr/Icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://www.erhukuk.com.tr/Icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://www.erhukuk.com.tr/Icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="https://www.erhukuk.com.tr/Icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://www.erhukuk.com.tr/Icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://www.erhukuk.com.tr/Icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="https://www.erhukuk.com.tr/Icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.erhukuk.com.tr/Icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.erhukuk.com.tr/Icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.erhukuk.com.tr/Icon/favicon-16x16.png">
    <link rel="manifest" href="https://www.erhukuk.com.tr/Icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="https://www.erhukuk.com.tr/Icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- FAV ICON END -->
    <title>Blog</title>
    <meta name="description" content="Son blog yazılarımıza göz atın!" />
	
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
               <div class="h1">Blog Yazıları</div>
				</div>
          </div>

        <div class="content_1">
            <div class="content_1_in">







            <div class="contentSearch">
                    <form class="search" method="GET" >
                        <div class="searchh1">Başlıkta Arama Yap</div>
                        <label for="1" class="searchbox">
                            <input type="text" name="a1" id="1" class="searchinput" placeholder="Arama Yap">
                            <input type="submit" class="hidden" id="s" name="a2" value="">
                            <label for="s" class="searchbutton"  value=""><img class="searchimg" src="images/Template/search1.png" alt=""></label>
                        </label>
                    </form>
                    <div class="tags disappear">
                        <div class="searchh1">Son Eklenen Etiketler</div>
                        <div class="tagboxes">


                        <?php
                        while(($row = $tags->fetch(PDO::FETCH_ASSOC))) {?>

                            <a <?php echo "href='etiket/" . $row["TAG_ID"] . "'"; ?> class="tagbox"><?php echo $row["TAG_NAME"];?></a>        
                        
                        <?php  } ?>
                        </div>
                    </div>
                    <div class="tags disappear">
                        <div class="searchh1">Popüler Etiketler</div>
                        <div class="tagboxes">
                        <?php
                        while(($row = $ptags->fetch(PDO::FETCH_ASSOC))) {?>

                            <a <?php echo "href='etiket/" . $row["ID"] . "'"; ?> class="tagbox"><?php echo $row["TAG_NAME"] . " " . "(" . $row["TAG_BLOG_COUNT"] . ")";?></a>        
                        
                        <?php  } ?>
                        </div>
                    </div>
                </div>



























                <div class="contentBlog">
                    <div class="blogboxes">
                    <?php


                    if($total < 1)
                        {echo "<div class='nocontentfound'>Aramanıza uygun içerik bulunamadı, lütfen tekrar deneyin.</div>";}


                        while(($row = $blog->fetch(PDO::FETCH_ASSOC))) {
                            if($row["AKTIF"] == 0) {continue;}
                                ?>

                            <a <?php $baslik = str_replace(" ","-", $row["BASLIK"]); echo "class='Box'" . " href='/icerik/" . $row["ID"] . "/" . $baslik . "'"; ?>>
                                <div class="boxImage"> <div class="boxImage_II"><img class="boxImage_I" <?php echo "src='Panel/Empty/" . $row["IMAGE"] . "'"; ?> alt=""> </div> <div class="graylayer"></div></div>

                                <div class="boxText">
                                    <div class="boxInfo"><?php echo $row["YAZAR"] . " " . "|" . " " . $row["TARIH"]; ?></div>
                                    <div class="boxHeader"><?php echo $row["BASLIK"]; ?></div>
                                    <div class="boxContent"><?php echo substr($row["ICERIK"], 0, 650); ?> </div>
                                        <div class="boxButton"></div>
                                </div>
                            </a>
                        
                        <?php  } ?>
                    </div>


                    <div class="pageswidth">
                        <div class="pages">
                            <?php 
                            if($is_page_normal != 3)
                            {
                            echo "<a class='p4'";
                            if($page > 1)
                            {
                                if($is_page_normal == 1)
                                {echo "href='Blog/" . ($page-1) . "'>&larr;&nbsp;&nbsp;Önceki</a>";}
                                else if($is_page_normal == 2)
                                {echo "href='etiket/" . $_GET["etk"] . "/" . ($page-1) . "'>&larr;&nbsp;&nbsp;Önceki</a>";}
                            } 
                            else { echo "href='javascript:void(0)' id='disabled'" . ">&larr;&nbsp;&nbsp;Önceki</a>";}
                            }
                            ?>
                            <div class="inpages">
                                <?php 
                                if($is_page_normal == 1)
                                {
                                    if($page > 3) echo "<a class='page' href='../Blog'>1</a>"; 
                                    if($page > 3) echo "<div class='page'>...</div>";
                                    if($page > 2) echo "<a class='page' href='Blog/" . ($page - 2) . "'>". ($page - 2) ."</a>"; 
                                    if($page > 1) echo "<a class='page' href='Blog/" . ($page - 1) . "'>" . ($page - 1) . "</a>"; 
                                    echo "<div class='page p15'>" . $page ."</div>"; 
                                    if($page < $pages) echo "<a class='page' href='Blog/" . ($page + 1) . "'>" . ($page + 1) . "</a>"; 
                                    if($page < $pages-1) echo "<a class='page' href='Blog/" . ($page + 2) . "'>" . ($page + 2). "</a>"; 
                                    if($page < $pages-2) echo "<div class='page'>...</div>"; 
                                    if($page < $pages-2) echo "<a class='page noborder' href='Blog/" . ($pages) . "'>" . ($pages) . "</a>"; 
                                }
                                else if($is_page_normal == 2) 
                                {
                                    if($page > 3) echo "<a class='page' href='../etiket/" . $_GET["etk"] . "'>1</a>"; 
                                    if($page > 3) echo "<div class='page'>...</div>";
                                    if($page > 2) echo "<a class='page' href='etiket/" . $_GET["etk"] . "/" . ($page - 2) . "'>". ($page - 2) ."</a>"; 
                                    if($page > 1) echo "<a class='page' href='etiket/" . $_GET["etk"] . "/" . ($page - 1) . "'>". ($page - 1) ."</a>"; 
                                    echo "<div class='page p15'>" . $page . "</div>"; 
                                    if($page < $pages) echo "<a class='page' href='etiket/" . $_GET["etk"] . "/" . ($page + 1) . "'>". ($page + 1) ."</a>"; 
                                    if($page < $pages-1) echo "<a class='page' href='etiket/" . $_GET["etk"] . "/" . ($page + 2) . "'>". ($page + 2) ."</a>"; 
                                    if($page < $pages-2) echo "<div class='page'>...</div>"; 
                                    if($page < $pages-2) echo "<a class='page noborder' href='etiket/" . $_GET["etk"] . "/" . ($pages) . "'>". ($pages) ."</a>"; 
                                } 
                                ?>
                            </div>
                            <?php 
                            if($is_page_normal != 3)
                            {
                            echo "<a class='p4'"; 
                            if($page < $pages)
                            {
                                if($is_page_normal == 1)
                                { echo "href='Blog/" . ($page+1) . "'>Sonraki &nbsp;&nbsp;&rarr;</a>";}
                                else if($is_page_normal == 2)
                                {echo "href='etiket/" . $_GET["etk"] . "/" . ($page+1) . "'>Sonraki &nbsp;&nbsp;&rarr;</a>";}
                            }
                            else { echo "href='javascript:void(0)' id='disabled'" . ">Sonraki &nbsp;&nbsp;&rarr;</a>";} 
                            }?>
                        </div>
                    </div>



                    
                </div>
            </div>
        </div>


        
        <?php require_once('Utilities/pagefooter.php');?>

        </div>
    </div>
</body>
