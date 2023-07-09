
<?php require_once('../checkLogin.php'); ?>
<?php require_once('../utilities.php'); 
      require_once('resize-class.php');



?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <script src="../JQuery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="../Template.css">
    <link rel="stylesheet" href="Yeni.css">
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
        plugins: "link image code",
        toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | fontfamily fontsize | backcolor'
      });
    </script>
    <title>Yeni Blog</title>
</head>

<body>
    <script src="Blog.js"> </script>

    <?php
    error_reporting(0);

    if(isset($_POST['submit']))
    {
      global $target_dir, $target_file, $uploadOk, $imageFileType, $target_name, $target;
      $target_dir = "../Uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $target_name =  uniqid("IMG-", true).'.'.$imageFileType;
      $target = $target_dir . $target_name;
      $target_small =  $target_dir . "SMALL-" . $target_name;
      // Check if image file is a actual image or fake image
      error_reporting(0);

        if(!file_exists($_FILES['fileToUpload']['tmp_name']) || !is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) 
        {
          $_SESSION["BLOG_MESAJ"] = "Hata! - Kapak Görseli Seçilmedi.";
          $uploadOk = 0;
        }  


        //else if(isset($_FILES["fileToUpload"]["tmp_name"]) && $_FILES["fileToUpload"]["tmp_name"] != '')
        //{
        //  header("Location: Blog.php?". 22 ."");
        //    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        //    $file_path = $_FILES["fileToUpload"]["tmp_name"];
        //  $size = filesize($file_path);
        //    if($check != false) {
        //      $_SESSION["BLOG_MESAJ"] = "File is an image - " . $check["mime"] . ".";
        //      $uploadOk = 1;
        //    } else {
        //      $_SESSION["BLOG_MESAJ"] = "Hata! - Dosya boyutu 2MB'den büyük olamaz.";
        //      $uploadOk = 0;
        //    }
        //}


        // Check if file already exists
        else if (file_exists($target_file)) 
        {
          $_SESSION["BLOG_MESAJ"] = "Hata! - Dosya zaten mevcut.";
          $uploadOk = 0;
        }


        else if(isset($_FILES["fileToUpload"]["tmp_name"]))
        {
          $file_path = $_FILES["fileToUpload"]["tmp_name"];
          $size = filesize($file_path);
          if($size > 2000000)
          {
            $_SESSION["BLOG_MESAJ"] = "Hata! - Dosya boyutu 2MB'den büyük olamaz.";
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
          $_SESSION["BLOG_MESAJ"] = "Hata! - Kapak Görseli Seçilmedi.";
          $uploadOk = 0;
        }
      }
      else 
      {
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          $_SESSION["blog_baslik"] = htmlspecialchars($_POST['baslik'], ENT_QUOTES, 'UTF-8');
          $_SESSION["blog_aciklama"] = htmlspecialchars($_POST['aciklama'], ENT_QUOTES, 'UTF-8');
      // if everything is ok, try to upload file
      } else {
          $_SESSION["blog_aciklama"] = "";
          $_SESSION["blog_baslik"] = "";
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target)) {
          $_SESSION["BLOG_MESAJ"] = "". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " adlı resim başarıyla yüklendi.";

          $resizeObj = new resize($target);

          $resizeObj -> resizeImage(300, 200, 'crop');

          $resizeObj -> saveImage($target_small, 1000);
          
        } 
        else {
          $_SESSION["BLOG_MESAJ"] ="Hata! - Yükleme yapılırken sorun oluştu.";
        }




      if($uploadOk == 1)
      {

      $insert =  $db->prepare("INSERT INTO blog (YAZAR, BASLIK, ICERIK, TARIH, AKTIF, IMAGE, IMAGE_NAME, SMALL_IMAGE, TAG_IDS) VALUES (:name, :baslik, :icerik, :tarih, :aktif, :imageurl, :image_name, :smallimg, '0')");
      $save_tag = $db->prepare("INSERT INTO tags (TAG_NAME, BLOG_ID, TAG_ID) VALUES (:tagname, :blogid, :tagid)");
      $check_if_registered = $db->prepare("SELECT * FROM taglist WHERE TAG_NAME = :tag_name");
      $register_tag = $db->prepare("INSERT INTO taglist (TAG_NAME, TAG_BLOG_COUNT) VALUES (:tag_name, '1')");
      $incremenet_tag_count = $db->prepare("UPDATE taglist SET TAG_BLOG_COUNT = TAG_BLOG_COUNT + 1 WHERE TAG_NAME = :tag_name");
      $get_tag_id = $db->prepare("SELECT ID FROM taglist WHERE TAG_NAME = :tag_name");
      $update_tag_ids = $db->prepare("UPDATE blog SET TAG_IDS = :tagids WHERE ID = :blogid");

      $tagid_all = '';
      $BASLIK = htmlspecialchars($_POST['baslik'], ENT_QUOTES, 'UTF-8');
      $ACIKLAMA = htmlspecialchars($_POST['aciklama'], ENT_QUOTES, 'UTF-8');
      $AKTIF = htmlspecialchars($_POST['durum'], ENT_QUOTES, 'UTF-8');
      $YAZAR = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');
      $TARIH = echodate();
      $RESIM_ADI = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]), ENT_QUOTES, 'UTF-8');
      $insert->bindParam(':name', $YAZAR, PDO::PARAM_STR);
      $insert->bindParam(':baslik', $BASLIK, PDO::PARAM_STR);
      $insert->bindParam(':icerik', $ACIKLAMA, PDO::PARAM_STR);
      $insert->bindParam(':tarih', $TARIH, PDO::PARAM_STR);
      $insert->bindParam(':aktif', $AKTIF, PDO::PARAM_INT);
      $insert->bindParam(':imageurl', $target);
      $insert->bindParam(':smallimg', $target_small);
      $insert->bindParam(':image_name', $RESIM_ADI, PDO::PARAM_STR);
      if($insert->execute())
      {
        $GET_ID = $db->prepare("SELECT ID FROM blog ORDER BY ID DESC LIMIT 1");
        $GET_ID->execute();
        $row = $GET_ID->fetch(PDO::FETCH_ASSOC);
        $tags = $_POST['tags'];
        foreach ($tags as $tag) {
          $check_if_registered->bindParam(":tag_name", $tag);
          $check_if_registered->execute();
          if(!($check_if_registered->rowCount() > 0))
          {
            $register_tag->bindParam(":tag_name", $tag, PDO::PARAM_STR);
            $register_tag->execute();
          }
          else 
          {
            $incremenet_tag_count->bindParam(":tag_name", $tag, PDO::PARAM_STR);
            $incremenet_tag_count->execute();
            
          }
          $get_tag_id->bindParam(":tag_name", $tag, PDO::PARAM_STR);
          $get_tag_id->execute();
          $tagid = $get_tag_id->fetch(PDO::FETCH_ASSOC);
          $tagid_all .= "#" . $tagid["ID"] . "#";
          $save_tag->bindParam(":tagname", $tag, PDO::PARAM_STR);
          $save_tag->bindParam(":blogid", $row["ID"], PDO::PARAM_INT);
          $save_tag->bindParam(":tagid", $tagid["ID"], PDO::PARAM_INT);
          $save_tag->execute();
        }
        $update_tag_ids->bindParam(":tagids", $tagid_all, PDO::PARAM_STR);
        $update_tag_ids->bindParam(":blogid", $row["ID"], PDO::PARAM_INT);
        $update_tag_ids->execute();
        $db = null;
        header("Location: Blog.php?ekleme=basarili");
      }
    }
    $db = null;
  }
  $db = null;
    
?>


	<div class="fullScreen">
	  <?php require_once('../navbar.php'); ?>
    <div class="header">
        <div class="pagename"></div>
    </div>

    <div class="mainScreen">
      <form method="POST" class="newBlog" enctype="multipart/form-data">
        <div class="imageinput">
           <div class="inputbox upper">

          <div class="msg" <?php if(isset($_SESSION["BLOG_MESAJ"]) && (strpos($_SESSION['BLOG_MESAJ'], "-")) == 0) {echo 'style=color:green;';}
            else {echo 'style=color:red;';} ?>>
            <?php if(isset($_SESSION["BLOG_MESAJ"])) echo $_SESSION["BLOG_MESAJ"]; ?>
          </div>
          <div class="frontcontext">Başlık</div>
          <div class="headerinput">
            <input type="text" name="baslik" class="baslik" id="" placeholder="Başlık Giriniz" required value="<?php if(isset($_SESSION['blog_baslik'])) echo $_SESSION['blog_baslik'];?>">
             
          </div>

          <div class="tags">
                  <div id="fr">Etiketler</div>
                <select class="form-control" name="tags[]" multiple="multiple">
                  <option>Miras Hukuku</option>
                  <option>Aile Hukuku</option>
                  <option>Ticaret Hukuku</option>
                  <option>Kira Hukuku</option>
                  <option>Sigorta Hukuku</option>
                  <option>Gayrimenkul Hukuku</option>
                  <option>Şirketler Hukuku</option>
                  <option>Vergi Hukuku</option>
                  <option>Tüketici Hukuku</option>
                  <option>İcra ve İflas Hukuku</option>
                  <option>Rekabet Hukuku</option>
                  <option>Bankacılık ve Finans</option>
                </select>
          </div>


        </div>
        <div class="picture">
        <input type="file" class="hidden" onchange="changelabel(); readURL(this);" name="fileToUpload" id="fileToUpload">
            <label class="button btnbig color2"  id="filelabel" for="fileToUpload">Kapak Görseli Seçiniz</label>   
            <img id="resimalani" src="#" alt="Yüklenen Resim" />
        </div>
          

                </div>
                <div class="inputbox">
                    <div class="frontcontext" >Açıklama</div>
                    <textarea id="mytextarea" name="aciklama" placeholder="İçeriği buraya yazabilirsiniz."><?php if(isset($_SESSION['blog_aciklama'])) echo $_SESSION['blog_aciklama'];?></textarea>
                </div>
                <div class="bottom2">

                <div class="inputbox">
                    <div class="frontcontext" >Durum</div>  
                    <div class="status">                    
                      <label class="label" for="lb1">Aktif<input type="radio" name="durum" id="lb1" value="1" checked></label>
                      <label class="label" for="lb2">Pasif<input type="radio" name="durum" id="lb2" value="0"></label>
                  </div>
                </div>

                



                <div class="status">
                    <input type="submit" name="submit"  value="Kaydet" class="button color3">
                    <button type="reset" class="button color1">Temizle</button>
                </div>

                </div>

            </form>
        </div>
    </div>
            
</body>
</html>