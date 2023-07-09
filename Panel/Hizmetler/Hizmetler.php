
<?php require_once('../checkLogin.php'); ?>
<?php require_once('../utilities.php'); ?>

<?php 

$hizmetler = $db->prepare("SELECT * FROM hizmetler  ORDER BY ID DESC");

$getCount = $db->prepare("SELECT COUNT(ID) AS COUNT FROM hizmetler");
$getCount->execute();
$hizmetCount = $getCount->fetchAll(PDO::FETCH_ASSOC);

$total = $hizmetCount[0]['COUNT'];

if($total > 20 || $total < 0)
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
    <link rel="stylesheet" href="Hizmetler.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <script src="../js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

    <title>Faaliyet Alanlarımız</title>
</head>

<body>   
    <script src="Hizmetler.js"></script>
	<div class="fullScreen">
	<?php require_once('../navbar.php'); ?>
    <div class="header">
        <div class="pagename"></div>
    </div>
        <div class="mainScreen" id="msc"> 
			<div class="content">


            <div class="h1b">
                        <div class="h1">Tüm Faaliyet Alanları</div>  
                        <div></div>
                        <a class="blogbutton" href="Yeni.php">Yeni Alan Ekle</a>
                    </div>


                <div class="contentbox">
                        <?php if(isset($_GET["ekleme"]) && $_GET["ekleme"] == "basarili") {echo "<div class='upperblog'>  <div class='mesaj'>&nbsp;&nbsp;Ekleme işlemi başarılı! &#10003;</div></div>";}
                              if(isset($_GET["duzenleme"]) && $_GET["duzenleme"] == "basarili") {echo "<div class='upperblog'>  <div class='mesaj'>&nbsp;&nbsp;Düzenleme işlemi başarılı! &#10003;</div></div>";}  
                        ?>
                   
                    <div class="boxesdesc">
                        <div class="desc" id="desc1">ALAN ADI</div>
                        <div class="desc" id="desc2">DURUM</div>
                        <div class="desc" id="desc3">İŞLEMLER</div>
                    </div>
                    <div class="boxes">
                        <?php
                        $deneme = 0;
                        $hizmetler->execute();
                        while($row = $hizmetler->fetch(PDO::FETCH_ASSOC)) {
                            $deneme++;
                        ?>

                        <div class="box" <?php if($deneme % 2 == 1) echo 'id=gray'; ?>>
                            <div class="boxname"><?php echo htmlspecialchars($row["HIZMET_ADI"]); ?></div>
                            <div class="boxbuttons">
                                <form action="" method="POST" class="boxbutton activeform"> 
                                    <input type="hidden" name="status" <?php echo "value='" . $row["AKTIF"] . "'"; ?> />
                                    <input type="hidden" name="hizmetid" <?php echo "value='" . $row["ID"] . "'"; ?> /> 
                                    <input type="submit" class="btn active" <?php  if($row["AKTIF"] == 0) {echo 'style=background:#646161;';} else {echo 'style=background:green;';} ?>
                                    <?php if($row["AKTIF"] == 0) {echo 'value="PASİF"';} else {echo 'value="AKTİF"';} ?> />
                                    
                                </form>
                                <div class="boxbutton"><a <?php echo "href='HizmetDuzenle.php?hizmetid=". $row["ID"] . "'";?>  class="edit">Düzenle</a></div>
                                <form action="" method="POST" class="boxbutton deleteform"> 
                                    <input type="hidden" name="delete" <?php echo "value='" . htmlspecialchars($row["ID"]) . "'"; ?> />  
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