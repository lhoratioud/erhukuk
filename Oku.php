<?php require_once('Utilities/conn.php');?>

<?php


error_reporting(0);

$tags = $db->prepare("SELECT TAG_NAME, TAG_ID FROM tags ORDER BY ID DESC LIMIT 20");
$tags->execute();

$ptags = $db->prepare("SELECT ID, TAG_NAME, TAG_BLOG_COUNT FROM taglist ORDER BY TAG_BLOG_COUNT DESC LIMIT 20");
$ptags->execute();

$check_if_active = $db->prepare("SELECT * FROM blog WHERE ID = :blogid");

if(!isset($_GET['blogid']) || !is_numeric($_GET['blogid']))
{
    header("Location: /Blog?deneme1");
}

$check_if_active->bindParam(":blogid", $_GET["blogid"], PDO::PARAM_INT);
$check_if_active->execute();

if(!($check_if_active->rowCount() > 0))
{
  header("Location: /Blog?deneme2");
}

$blog = $check_if_active->fetch(PDO::FETCH_ASSOC);


if(!(isset($blog["AKTIF"])) && $blog["AKTIF"] == 0)
{
    header("Location: /Blog?deneme3");
}



$blog_tags = $db->prepare("SELECT TAG_NAME FROM tags WHERE BLOG_ID = :blog_id ORDER BY ID ASC");



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
    <link rel="stylesheet" href="/Utilities/PageTemplate.css">
    <link rel="stylesheet" href="Okush.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <link rel="canonical" href="https://www.erhukuk.com.tr/Blog/" />
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
    <title> <?php echo $blog["BASLIK"];?></title>
	
</head>
<body>


    <div class="fullScreen">
        <div class="mainScreen">

            <?php require_once('Utilities/pageheader.php');?>

            <div  class="upperImageCon">
                <div class="Imagex">
                    <div id="image" style="background: url('Panel/Empty/<?php echo $blog["IMAGE"]; ?>');"class="upperBG"> </div>
                </div>
            </div>
				
				
		    <div class="enterance">

            <div class="emptySpace"></div>

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
                    <div class="h1ekin" id="h2ekin"><?php echo $blog["BASLIK"] ?></div>
                </div>
            </div>

            <div class="content_1">
                <div class="content_1_in">


                <div class="contentSearch">
                        <div class="tags">
                            <div class="searchh1">Son Eklenen Etiketler</div>
                            <div class="tagboxes">


                            <?php
                            while(($row = $tags->fetch(PDO::FETCH_ASSOC))) {?>

                                <a <?php echo "href='etiket/" . $row["TAG_ID"] . "'"; ?> class="tagbox"><?php echo $row["TAG_NAME"];?></a>        
                            
                            <?php  } ?>
                            </div>
                        </div>
                        <div class="tags">
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
                        <div class="blogh1"><?php echo $blog["BASLIK"];?></div> 
                        <div class="bloginfos">
                            <div class="author"> <?php echo "Yazar: &nbsp" .  $blog["YAZAR"] . "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;" . "Tarih: &nbsp" . $blog["TARIH"];?></div>
                            
                            <div class="blogtags"> Etiketler:
                            <?php
                              $blog_tags->bindParam(":blog_id", $_GET["blogid"], PDO::PARAM_INT);
                              $blog_tags->execute();
                              $tagcontent = $blog_tags->fetchAll(PDO::FETCH_ASSOC);
                              $full_tag_list = '';
                              if($blog_tags->rowCount() > 0 )
                              {
                                foreach($tagcontent as $tag => $name)
                                {
                                    $full_tag_list  .= " " . $name["TAG_NAME"] . " , ";
                                } 
                                echo substr_replace($full_tag_list ,"", -2);
                                $full_tag_list = null;
                              }
                              else {
                                echo "Bu yazıya ait bir etiket bulunamadı.";
                              }
                            ?>
                            </div>

                         </div>
                        <div class="imagecon"><div class="blogimgcontainer"><img class="blogimg" src="Panel/Empty/<?php echo $blog["IMAGE"];?>" alt=""></div> <div class="graylayer"></div> </div> 
                        
                         <div class="blogcontent"><?php echo htmlspecialchars_decode($blog["ICERIK"]) ;?></div>
                    </div>
                    








                </div>
            </div>

                            </div>
                            
                            </div>


            <?php require_once('Utilities/pagefooter.php');?>



        </div>
    </div>
</body>
