
<?php 
require_once('../checkLogin.php'); 
require_once('../utilities.php');



$check_if_active = $db->prepare("SELECT * FROM hizmetler WHERE ID = :id");

if(isset($_GET['hizmetid']) && is_numeric($_GET['hizmetid']))
{
    header("Location Hizmetler.php");
}

$check_if_active->bindParam(":id", $_GET["hizmetid"], PDO::PARAM_INT);
$check_if_active->execute();

if(!($check_if_active->rowCount() > 0))
{
  header("Location: Hizmetler.php");
}

$hizmet = $check_if_active->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['submit']))
{
    $additional = array ("İ"    => "ⅰ");
    $tmp = mb_strtolower($_POST['hizmetadi']);
    $tmp2 = preg_replace('/i̇+/', 'i', $tmp);
    $LINK = preg_replace('/\s+/', '-', $tmp2);
    $YAZI = htmlspecialchars($_POST['hizmet_yazisi'], ENT_QUOTES, 'UTF-8');
    $AD = htmlspecialchars($_POST['hizmetadi'], ENT_QUOTES, 'UTF-8');
    $KISA = substr($YAZI, 0, 200);


    $UPDATE =  $db->prepare("UPDATE hizmetler SET HIZMET_LINKI = :yeni_link, HIZMET_ACIKLAMA = :yeni_yazi, HIZMET_ADI = :yeni_isim, HIZMET_ACIKLAMA_KISA = :yeni_kisa WHERE ID = :id");

    $UPDATE->bindParam(':yeni_link', $LINK, PDO::PARAM_STR);
    $UPDATE->bindParam(':yeni_yazi', $YAZI, PDO::PARAM_STR);
    $UPDATE->bindParam(':yeni_isim', $AD, PDO::PARAM_STR);
    $UPDATE->bindParam(':yeni_kisa', $KISA, PDO::PARAM_STR);
    $UPDATE->bindParam(":id", $_GET["hizmetid"]);

    if($UPDATE->execute())
    {
        header("Location: Hizmetler.php?duzenleme=basarili");
    }
    else
    {
        header("Location: Hizmetler.php?duzenleme=hata");
    }
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
    <script src="Hizmetler.js"></script>
    <link rel="stylesheet" href="../Template.css">
    <link rel="stylesheet" href="HizmetDuzenle.css">
    <script src="../Utilities.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <script src="../js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        font_size_formats:
            "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 18pt 24pt 30pt 36pt 48pt 60pt 72pt 96pt",
        selector: '#mytextarea',
        content_css: 'white',
        plugins: "link image code lists",
        toolbar: 'undo redo | styleselect | forecolor | bold italic | numlist bullist | alignleft aligncenter alignright alignjustify | outdent indent | fontsize | backcolor'
      });
    </script>
    <title><?php echo $hizmet["HIZMET_ADI"]; ?></title>
</head>

<body>

<?php

    if(isset($_POST['submit']))
    {

    }

?>

	<div class="fullScreen">
	<?php require_once('../navbar.php'); ?>
	<div class="header">
        <div class="pagename"><?php echo $hizmet["HIZMET_ADI"]; ?></div>
    </div>
        <div class="mainScreen">
            
            <form method="POST" id="myForm" class="hizmetlerForm" enctype="multipart/form-data">
                
                    <div class="hizmetBox">

                        <div class="hizmetBilgi">

                            <div class="inputBox">
                                <div class="inputHead">Hizmet Adı</div>
                                <input type="text" class="inputArea" <?php echo "value='" . $hizmet["HIZMET_ADI"] . "'"; ?> name="hizmetadi" id="" required></input>
                            </div>


                            <div class="inputBox">
                                <div class="inputHead">Hizmet Açıklaması</div>
                                <textarea name="hizmet_yazisi" id="mytextarea" class="uyeIcerik inputArea" spellcheck="false" required> <?php if(isset($hizmet['HIZMET_ACIKLAMA'])) echo $hizmet['HIZMET_ACIKLAMA']; ?> </textarea>
                            </div>
                            <!--     <div class="line"></div> -->
                            <!-- <div class="msg" <?php if(isset($_SESSION["HIZMET_MESAJ"]) && (strpos($_SESSION['HIZMET_MESAJ'], "-")) == 0) {echo 'style=color:green;';}
                            else {echo 'style=color:red;';} ?>> -->
                        </div>

                    </div>
                    <div class="buttons">
                        <input type="submit" name="submit" id="submitButton" value="KAYDET" class="button">
                    </div>

            </form>
</body>