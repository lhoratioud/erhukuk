
<?php 
require_once('../checkLogin.php'); 
require_once('../utilities.php');


error_reporting(0);


if(isset($_POST['submit']))
{
    global $target_dir, $target_file, $uploadOk, $imageFileType, $target_name, $target;
    $target_dir = "../../images/Ekip/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $target_name =  uniqid("IMG-", true).'.'.$imageFileType;
    $target = $target_dir . $target_name;

    // Check if image file is a actual image or fake image
    error_reporting(1);

    if(!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) 
    {
        $_SESSION["EKIP_MESAJ"] = "Hata! - Kapak Görseli Seçilmedi.";
        $uploadOk = 0;
    }  


    // Check if file already exists
    else if (file_exists($target_file)) 
    {
        $_SESSION["EKIP_MESAJ"] = "Hata! - Dosya zaten mevcut.";
        $uploadOk = 0;
    }


    else if(isset($_FILES["fileToUpload"]["tmp_name"]))
    {
        $file_path = $_FILES["fileToUpload"]["tmp_name"];
        $size = filesize($file_path);
        if($size > 2000000)
        {
            $_SESSION["EKIP_MESAJ"] = "Hata! - Dosya boyutu 2MB'den büyük olamaz.";
            $uploadOk = 0;
        }
    }

    // Check file size
    else if ($_FILES["fileToUpload"]["size"] > 2000000) 
    {
        $_SESSION["BLOG_MESAJ"] = "Hata! - Dosya boyutu 2MB'dan büyük olamaz.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
    {
        $_SESSION["EKIP_MESAJ"] = "Hata! - Kapak Görseli Seçilmedi.";
        $uploadOk = 0;
    }
}

else 
{
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) 
{
    $_SESSION["session_uye_ad"] = htmlspecialchars($_POST['uyeadi'], ENT_QUOTES, 'UTF-8');
    $_SESSION["session_uye_unvan"] = htmlspecialchars($_POST['uyeunvan'], ENT_QUOTES, 'UTF-8');
    $_SESSION["session_uye_yazi"] = htmlspecialchars($_POST['uyeyazi'], ENT_QUOTES, 'UTF-8');
}
// if everything is ok, try to upload file
else 
{
    
    $_SESSION["session_uye_ad"] = "";
    $_SESSION["session_uye_unvan"] = "";
    $_SESSION["session_uye_yazi"] = "";


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target)) 
    {
        $_SESSION["EKIP_MESAJ"] = "". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " adlı resim başarıyla yüklendi.";
    } 
    else 
    {
        $_SESSION["EKIP_MESAJ"] ="Hata! - Yükleme yapılırken sorun oluştu.";
    }
    if($uploadOk == 1)
    {
        $insert =  $db->prepare("INSERT INTO ekip (ISIM, UNVAN, YAZI, IMAGE, IMAGE_NAME) VALUES (:isim, :unvan, :yazi, :imageurl, :image_name)");

        $AD = htmlspecialchars($_POST['uyeadi'], ENT_QUOTES, 'UTF-8');
        $UNVAN = htmlspecialchars($_POST['uyeunvan'], ENT_QUOTES, 'UTF-8');
        $YAZI = htmlspecialchars($_POST['uyeyazi'], ENT_QUOTES, 'UTF-8');
        $RESIM_ADI = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]), ENT_QUOTES, 'UTF-8');


        $insert->bindParam(':isim', $AD, PDO::PARAM_STR);
        $insert->bindParam(':unvan', $UNVAN, PDO::PARAM_STR);
        $insert->bindParam(':yazi', $YAZI, PDO::PARAM_STR);
        $insert->bindParam(':imageurl', $target);
        $insert->bindParam(':image_name', $RESIM_ADI, PDO::PARAM_STR);

        if($insert->execute())
        {
            header("Location: Ekibimiz.php?ekleme=basarili");
        }
    }
}

$db = null;

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
    <script src="../Blog/Blog.js"></script>
    <link rel="stylesheet" href="../Template.css">
    <link rel="stylesheet" href="EkipDuzenle.css">
    <script src="../Utilities.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <title><?php echo $uye["ISIM"]; ?></title>
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
        <div class="pagename">Ekibimiz</div>
    </div>
        <div class="mainScreen">

            <form method="POST" id="myForm" class="ekibimizForm" enctype="multipart/form-data">
                
                <div class="ekibUyesiBox">

                    <div class="ekipUyesiBilgi">

                        <div class="inputBox">
                            <div class="inputHead">ISIM</div>
                            <input type="text" class="inputArea" <?php if(isset($_SESSION["session_uye_ad"])) echo "value='" . $_SESSION["session_uye_ad"] . "'"; ?> name="uyeadi" id="" required></input>
                        </div>

                        <div class="inputBox">
                            <div class="inputHead">UNVAN</div>
                            <input type="text" class="inputArea"  <?php if(isset($_SESSION["session_uye_unvan"])) echo "value='" . $_SESSION["session_uye_unvan"] . "'"; ?> name="uyeunvan" id="" required></input>
                        </div>

                        <div class="inputBox">
                            <div class="inputHead">YAZI</div>
                            <textarea name="uyeyazi" id="" class="uyeIcerik inputArea" spellcheck="false" required> <?php if(isset($uye['session_uye_yazi'])) echo $uye['session_uye_yazi']; ?> </textarea>
                        </div>
                        <!--     <div class="line"></div> -->
                        <!-- <div class="msg" <?php if(isset($_SESSION["EKIP_MESAJ"]) && (strpos($_SESSION['EKIP_MESAJ'], "-")) == 0) {echo 'style=color:green;';}
                        else {echo 'style=color:red;';} ?>> -->
                    </div>

                    <div class="ekibUyesiResimBox">
                        <input type="file" class="hidden" onload="changelabeledit();" onchange="changelabeledit(); readURL(this);" name="fileToUpload" id="fileToUpload">
                        <label class="button btnbig color2"  id="filelabel" for="fileToUpload">Örnek Resim | Değiştir</label>  
                        <input type="hidden" id="hiddenfilename" name="resim" value="ORNEK_RESIM.jpg">   
                        <img id="resimalani" src="../../images/Ekip/ORNEK_RESIM.jpg" alt="Yüklenen Resim" />
                    </div>


                </div>
                <div class="buttons">
                    <input type="submit" name="submit" id="submitButton" value="KAYDET" class="button">
                </div>

        </form>

</body>