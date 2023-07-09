
<?php require_once('../checkLogin.php'); ?>
<?php require_once('../utilities.php'); ?>

<?php 

$limit = 23;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if(!is_numeric($page))
{
    header("Location: Blog.php");
}
$start = ($page - 1) * $limit;
$blog = $db->prepare("SELECT * FROM blog  ORDER BY ID DESC LIMIT :start, :limit");

$getCount = $db->prepare("SELECT COUNT(ID) AS COUNT FROM blog");
$getCount->execute();
$customerCount = $getCount->fetchAll(PDO::FETCH_ASSOC);
$total = $customerCount[0]['COUNT'];
$pages = ceil( $total / $limit );

if($pages < 1)
{$pages = 1;}

$prev = $page - 1;
$next = $page + 1;

if(!(($page > 0) && ($page < $pages+1)))
{
    header("Location: Blog.php");
}


?>

<!DOCTYPE html> 
<html lang="tr">
<head>
    <script src="../JQuery.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
      integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <link rel="stylesheet" href="../Template.css">
    <link rel="stylesheet" href="Blog.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <script src="../js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

    <title>Blog</title>
</head>

<body>   
    <script src="Blog.js"></script>
	<div class="fullScreen">
	<?php require_once('../navbar.php'); ?>
    <div class="header">
        <div class="pagename"></div>
    </div>
        <div class="mainScreen" id="msc"> 
			<div class="content">


            <div class="h1b">
                        <div class="h1">Son Blog Yazıları</div>  
                        <div></div>
                        <a class="blogbutton" href="Yeni.php">Yeni Yazı Ekle</a>
                    </div>


                <div class="contentbox">
                        <?php if(isset($_GET["ekleme"]) && $_GET["ekleme"] == "basarili") {echo "<div class='upperblog'>  <div class='mesaj'>&nbsp;&nbsp;Ekleme işlemi başarılı! &#10003;</div></div>";} ?>
                   
                    <div class="boxesdesc">
                        <div class="desc" id="desc1">TARİH</div>
                        <div class="desc" id="desc2">YAZAR</div>
                        <div class="desc" id="desc3">BAŞLIK</div>
                        <div class="desc" id="desc4">DURUM</div>
                        <div class="desc" id="desc5">İŞLEMLER</div>
                    </div>
                    <div class="boxes">
                        <?php
                        $deneme = 0;
                        $blog->bindParam(":start", $start, PDO::PARAM_INT);
                        $blog->bindParam(":limit", $limit, PDO::PARAM_INT);
                        $blog->execute();
                        while($row = $blog->fetch(PDO::FETCH_ASSOC)) {
                            $deneme++;
                        ?>

                        <div class="box" <?php if($deneme % 2 == 1) echo 'id=gray'; ?>>
                            <div class="boxdate"><?php echo htmlspecialchars($row["TARIH"]); ?></div>
                            <div class="boxauthor"><?php echo htmlspecialchars($row["YAZAR"]);?></div>
                            <div class="boxheader"><?php echo htmlspecialchars($row["BASLIK"]);?></div>
                            <div class="boxbuttons">
                                <form action="" method="POST" class="boxbutton activeform"> 
                                    <input type="hidden" name="status" <?php echo "value='" . $row["AKTIF"] . "'"; ?> />
                                    <input type="hidden" name="blogid" <?php echo "value='" . $row["ID"] . "'"; ?> /> 
                                    <input type="submit" class="btn active" <?php  if($row["AKTIF"] == 0) {echo 'style=background:#646161;';} else {echo 'style=background:green;';} ?>
                                    <?php if($row["AKTIF"] == 0) {echo 'value="PASİF"';} else {echo 'value="AKTİF"';} ?> />
                                    
                                </form>
                                <div class="boxbutton"><a <?php echo "href='Duzenle.php?blogid=". $row["ID"] . "'";?>  class="edit">Düzenle</a></div>
                                <form action="" method="POST" class="boxbutton deleteform"> 
                                    <input type="hidden" name="delete" <?php echo "value='" . htmlspecialchars($row["ID"]) . "'"; ?> />  
                                    <input type="hidden" name="picway" <?php echo "value='" . $row["IMAGE"] . "'"; ?> />
                                    <input type="hidden" name="small_picway" <?php echo "value='" . $row["SMALL_IMAGE"] . "'"; ?> />
                                    <input type="submit" class="boxbutton btn delete" value="Sil" />
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="pageswidth">
                    <div class="pages">
                    <a class="p4" <?php if($page > 1) echo "href='Blog.php?page=" . ($page-1) . "'";
                                        else { echo "href='javascript:void(0)' id='disabled'" . "";}?> >&larr;&nbsp;&nbsp;Önceki</a>
                        <div class="inpages">
                        <?php if($page > 3) echo "<a class='page' href='Blog.php?page=1'>1</a>"; ?>
                        <?php if($page > 3) echo "<div class='page'>...</div>"; ?>
                        <?php if($page > 2) echo "<a class='page' href='Blog.php?page=" . ($page - 2) . "'>". ($page - 2) ."</a>"; ?>
                        <?php if($page > 1) echo "<a class='page' href='Blog.php?page=" . ($page - 1) . "'>" . ($page - 1) . "</a>"; ?>
                        <?php echo "<a class='page p15' href='Blog.php?page=" . $page . "'>" . $page ."</a>"; ?>
                        <?php if($page < $pages) echo "<a class='page' href='Blog.php?page=" . ($page + 1) . "'>" . ($page + 1) . "</a>"; ?>
                        <?php if($page < $pages-1) echo "<a class='page' href='Blog.php?page=" . ($page + 2) . "'>" . ($page + 2). "</a>"; ?>
                        <?php if($page < $pages-2) echo "<div class='page'>...</div>"; ?>
                        <?php if($page < $pages-2) echo "<a class='page noborder' href='Blog.php?page=" . ($pages) . "'>" . ($pages) . "</a>"; ?>
                        </div>
                        <a class="p4" <?php if($page < $pages) echo "href='Blog.php?page=" . ($page+1) . "'";
                                        else { echo "href='javascript:void(0)' id='disabled'" . "";}?> >Sonraki &nbsp;&nbsp;&rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
</body>