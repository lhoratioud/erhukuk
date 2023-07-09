
<?php 
require_once('../checkLogin.php'); 
require_once('../utilities.php');



$check_if_active = $db->prepare("SELECT * FROM ekip WHERE ID = :id");

if(isset($_GET['uyeid']) && is_numeric($_GET['uyeid']))
{
    header("Location Ekibimiz.php");
}

$check_if_active->bindParam(":id", $_GET["uyeid"], PDO::PARAM_INT);
$check_if_active->execute();

if(!($check_if_active->rowCount() > 0))
{
  header("Location: Ekibimiz.php");
}

$uye = $check_if_active->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['submit']))
{
    global $target_dir, $target_file, $uploadOk, $imageFileType, $target_name, $target;
    error_reporting(1);
    $YAZI = htmlspecialchars($_POST['uye_yazisi'], ENT_QUOTES, 'UTF-8');
    $AD = htmlspecialchars($_POST['uyeadi'], ENT_QUOTES, 'UTF-8');
    $UNVAN = htmlspecialchars($_POST['uyeunvan'], ENT_QUOTES, 'UTF-8');

    if(isset($_POST["resim"]) && ($_POST["resim"] == $uye["IMAGE_NAME"]))
    {

        $INSERT =  $db->prepare("UPDATE ekip SET YAZI = :yeni_yazi, ISIM = :yeniad, UNVAN = :yeniunvan WHERE ID = :id");

        $INSERT->bindParam(':yeni_yazi', $YAZI, PDO::PARAM_STR);
        $INSERT->bindParam(':yeniad', $AD, PDO::PARAM_STR);
        $INSERT->bindParam(':yeniunvan', $UNVAN, PDO::PARAM_STR);
        $INSERT->bindParam(":id", $_GET["uyeid"]);


        if($INSERT->execute())
        {
            header("Location: Ekibimiz.php?duzenleme=basarili");
        } 
    }

    else 
    {
        $target_dir = "../../images/Ekip/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $target_name =  uniqid("IMG-", true).'.'.$imageFileType;
        $target = $target_dir . $target_name;

        // Check if image file is a actual image or fake image
        error_reporting(0);
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $_SESSION["EKIP_MESAJ"] = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } 
        else {
            $_SESSION["EKIP_MESAJ"] = "Hata! - Dosya boyutu 2MB'den büyük olamaz.";
            $uploadOk = 0;
        }
      
      
        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION["EKIP_MESAJ"] = "Hata! - Dosya zaten mevcut.";
            $uploadOk = 0;
        }
  
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 2000000) {
            $_SESSION["EKIP_MESAJ"] = "Hata! - Dosya boyutu 2MB'dan büyük olamaz.";
            $uploadOk = 0;
        }
  
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $_SESSION["EKIP_MESAJ"] = "Hata! - Ekip Görseli Seçilmedi.";
            $uploadOk = 0;
        }
  

        // if everything is ok, try to upload file
        if($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target)) {
                $_SESSION["EKIP_MESAJ"] = "". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " adlı resim başarıyla yüklendi.";
            } 
            else {
                $_SESSION["EKIP_MESAJ"] ="Hata! - Yükleme yapılırken sorun oluştu.";
                $uploadOk = 0;
            }
        }


        if($uploadOk == 1)
        {
            $RESIM_ADI = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]), ENT_QUOTES, 'UTF-8');
        
            $INSERT =  $db->prepare("UPDATE ekip SET YAZI = :yeni_yazi,
                                                   ISIM = :yeni_ad,
                                                   UNVAN = :yeni_unvan, 
                                                   IMAGE = :imageurl,
                                                   IMAGE_NAME = :image_name
                                                   WHERE ID = :id");

            $INSERT->bindParam(':yeni_yazi', $YAZI, PDO::PARAM_STR);
            $INSERT->bindParam(':yeni_ad', $AD, PDO::PARAM_STR);
            $INSERT->bindParam(':yeni_unvan', $UNVAN, PDO::PARAM_STR);
            $INSERT->bindParam(':imageurl', $target);
            $INSERT->bindParam(':image_name', $RESIM_ADI, PDO::PARAM_STR);
            $INSERT->bindParam(":id", $_GET["uyeid"], PDO::PARAM_INT);
            if($uye["IMAGE"] != "../../images/Ekip/ORNEK_RESIM.jpg")
            {
                unlink($uye["IMAGE"]);
            }
            if(unlink($uye["IMAGE"]) &&  $INSERT->execute())
            {
                header("Location: Ekibimiz.php?duzenleme=basarili");
            } 
        }
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
                                <div class="inputHead">İsim</div>
                                <input type="text" class="inputArea" <?php echo "value='" . $uye["ISIM"] . "'"; ?> name="uyeadi" id="" required></input>
                            </div>

                            <div class="inputBox">
                                <div class="inputHead">Unvan</div>
                                <input type="text" class="inputArea" <?php echo "value='" . $uye["UNVAN"] . "'"; ?> name="uyeunvan" id="" required></input>
                            </div>

                            <div class="inputBox">
                                <div class="inputHead">Üye Yazısı</div>
                                <textarea name="uye_yazisi" id="" class="uyeIcerik inputArea" spellcheck="false" required> <?php if(isset($uye['YAZI'])) echo $uye['YAZI']; ?> </textarea>
                            </div>
                            <!--     <div class="line"></div> -->
                            <!-- <div class="msg" <?php if(isset($_SESSION["EKIP_MESAJ"]) && (strpos($_SESSION['EKIP_MESAJ'], "-")) == 0) {echo 'style=color:green;';}
                            else {echo 'style=color:red;';} ?>> -->
                        </div>

                        <div class="ekibUyesiResimBox">
                            <input type="file" class="hidden" onload="changelabeledit();" onchange="changelabeledit(); readURL(this);" name="fileToUpload" id="fileToUpload">
                            <label class="button btnbig color2"  id="filelabel" for="fileToUpload">Görseli Değiştir</label>  
                            <input type="hidden" id="hiddenfilename" name="resim" <?php if(isset($uye['IMAGE_NAME'])) echo "value='" . $uye['IMAGE_NAME'] . "'"; ?>>   
                            <img id="resimalani"<?php if(isset($uye['IMAGE'])) echo "src='" . $uye['IMAGE'] . "'"; ?> alt="Yüklenen Resim" />
                        </div>


                    </div>
                    <div class="buttons">
                        <input type="submit" name="submit" id="submitButton" value="KAYDET" class="button">
                    </div>

            </form>
</body>