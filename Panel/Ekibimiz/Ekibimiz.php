
<?php require_once('../checkLogin.php'); ?>
<?php require_once('../utilities.php'); ?>

<?php 

$ekip = $db->prepare("SELECT * FROM ekip  ORDER BY ID");

$getCount = $db->prepare("SELECT COUNT(ID) AS COUNT FROM ekip");
$getCount->execute();
$ekipCount = $getCount->fetchAll(PDO::FETCH_ASSOC);

$total = $ekipCount[0]['COUNT'];

if($total > 8 || $total < 0)
{
    header("Location: ../Anasayfa/Anasayfa.php");
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
    <link rel="stylesheet" href="Ekibimiz.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <script src="../js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

    <title>Ekibimiz</title>
</head>

<body>   
    <script src="Ekibimiz.js"></script>
	<div class="fullScreen">
	<?php require_once('../navbar.php'); ?>
    <div class="header">
        <div class="pagename"></div>
    </div>
        <div class="mainScreen" id="msc"> 
			<div class="content">


            <div class="h1b">
                        <div class="h1">Ekip Üyeleri</div>  
                        <div></div>
                        <a class="blogbutton" href="Yeni.php">Yeni Üye Ekle</a>
                    </div>


                <div class="contentbox">
                        <?php if(isset($_GET["ekleme"]) && $_GET["ekleme"] == "basarili") {echo "<div class='upperblog'>  <div class='mesaj'>&nbsp;&nbsp;Ekleme işlemi başarılı! &#10003;</div></div>";} ?>
                   
                    <div class="boxesdesc">
                        <div class="desc" id="desc1">İSİM</div>
                        <div class="desc" id="desc2">UNVAN</div>
                        <div class="desc" id="desc3">DURUM</div>
                        <div class="desc" id="desc4">İŞLEMLER</div>
                    </div>
                    <div class="boxes">
                        <?php
                        $deneme = 0;
                        $ekip->execute();
                        while($row = $ekip->fetch(PDO::FETCH_ASSOC)) {
                            $deneme++;
                        ?>

                        <div class="box" <?php if($deneme % 2 == 1) echo 'id=gray'; ?>>
                            <div class="boxdate"><?php echo htmlspecialchars($row["ISIM"]); ?></div>
                            <div class="boxauthor"><?php echo htmlspecialchars($row["UNVAN"]);?></div>
                            <div class="boxbuttons">
                                <form action="" method="POST" class="boxbutton activeform"> 
                                    <input type="hidden" name="status" <?php echo "value='" . $row["AKTIF"] . "'"; ?> />
                                    <input type="hidden" name="uyeid" <?php echo "value='" . $row["ID"] . "'"; ?> /> 
                                    <input type="submit" class="btn active" <?php  if($row["AKTIF"] == 0) {echo 'style=background:#646161;';} else {echo 'style=background:green;';} ?>
                                    <?php if($row["AKTIF"] == 0) {echo 'value="PASİF"';} else {echo 'value="AKTİF"';} ?> />
                                    
                                </form>
                                <div class="boxbutton"><a <?php echo "href='EkipDuzenle.php?uyeid=". $row["ID"] . "'";?>  class="edit">Düzenle</a></div>
                                <form action="" method="POST" class="boxbutton deleteform"> 
                                    <input type="hidden" name="delete" <?php echo "value='" . htmlspecialchars($row["ID"]) . "'"; ?> />  
                                    <input type="hidden" name="picway" <?php echo "value='" . $row["IMAGE"] . "'"; ?> />
                                    <input type="submit" class="boxbutton btn delete" value="Sil" />
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
</body>