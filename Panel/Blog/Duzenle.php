
<?php require_once('../checkLogin.php'); ?>
<?php require_once('../utilities.php'); 
      require_once('resize-class.php');
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <script src="../JQuery.js"></script>
    <script src="Blog.js"> </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="../Template.css">
    <link rel="stylesheet" href="Duzenle.css">
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
    <title>Blog Düzenleme</title>
</head>

<body>
    <?php 

    $tags = $db->prepare("SELECT TAG_NAME FROM tags WHERE BLOG_ID = :blog_id ORDER BY ID ASC");


      if(isset($_GET["blogid"]) && is_numeric($_GET["blogid"]))
      {
        $blogcheck = $db->prepare("SELECT * FROM blog WHERE ID = :id");
        $blogcheck->bindParam(":id", $_GET["blogid"], PDO::PARAM_INT);
        $blogcheck->execute();

        if(!($blogcheck->rowCount() > 0))
        {
          header("Location: Blog.php");
        }
        else
        {
          $row = $blogcheck->fetch(PDO::FETCH_ASSOC);
        }
      }
      else {
        header("Location: Blog.php");
      }



    if(isset($_POST['submit']))
    {

      $BASLIK = htmlspecialchars($_POST['baslik'], ENT_QUOTES, 'UTF-8');
      $ACIKLAMA = htmlspecialchars($_POST['aciklama'], ENT_QUOTES, 'UTF-8');
      $AKTIF = htmlspecialchars($_POST['durum'], ENT_QUOTES, 'UTF-8');

      if(isset($_POST["resim"]) && ($_POST["resim"] == $row["IMAGE_NAME"]))
      {
        $INSERT =  $db->prepare("UPDATE blog SET BASLIK = :baslik, ICERIK = :icerik, AKTIF = :aktif WHERE ID = :blogid");

        $INSERT->bindParam(':baslik', $BASLIK, PDO::PARAM_STR);
        $INSERT->bindParam(':icerik', $ACIKLAMA, PDO::PARAM_STR);
        $INSERT->bindParam(':aktif', $AKTIF, PDO::PARAM_INT);
        $INSERT->bindParam(":blogid", $_GET["blogid"]);
        if($INSERT->execute())
        {
            header("Location: Blog.php?duzenleme=basarili");
        } 
      }




      else 
      {
        $target_dir = "../Uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $target_name =  uniqid("IMG-", true).'.'.$imageFileType;
        $target = $target_dir . $target_name;
        $target_small =  $target_dir . "SMALL-" . $target_name;

        // Check if image file is a actual image or fake image
            error_reporting(0);
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
              $_SESSION["BLOG_MESAJ"] = "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
            } else {
              $_SESSION["BLOG_MESAJ"] = "Hata! - Dosya boyutu 2MB'den büyük olamaz.";
              $uploadOk = 0;
            }
          
          
        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION["BLOG_MESAJ"] = "Hata! - Dosya zaten mevcut.";
          $uploadOk = 0;
        }
      
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 2000000) {
            $_SESSION["BLOG_MESAJ"] = "Hata! - Dosya boyutu 2MB'dan büyük olamaz.";
          $uploadOk = 0;
        }
      
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          $_SESSION["BLOG_MESAJ"] = "Hata! - Kapak Görseli Seçilmedi.";
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

            $resizeObj = new resize($target);

            $resizeObj -> resizeImage(400, 200, 'crop');
  
            $resizeObj -> saveImage($target_small, 1000);

            $_SESSION["BLOG_MESAJ"] = "". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " adlı resim başarıyla yüklendi.";
          } else {
            $_SESSION["BLOG_MESAJ"] ="Hata! - Yükleme yapılırken sorun oluştu.";
          }
        }
        if($uploadOk == 1)
        {
              $RESIM_ADI = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]), ENT_QUOTES, 'UTF-8');
            
              $INSERT =  $db->prepare("UPDATE blog SET BASLIK = :baslik,
                                                       ICERIK = :icerik, 
                                                       AKTIF = :aktif, 
                                                       IMAGE = :imageurl,
                                                       IMAGE_NAME = :image_name,
                                                       SMALL_IMAGE = :smallimg
                                                       WHERE ID = :blogid");

              $INSERT->bindParam(':baslik', $BASLIK, PDO::PARAM_STR);
              $INSERT->bindParam(':icerik', $ACIKLAMA, PDO::PARAM_STR);
              $INSERT->bindParam(':aktif', $AKTIF, PDO::PARAM_INT);
              $INSERT->bindParam(':imageurl', $target);
              $INSERT->bindParam(':image_name', $RESIM_ADI, PDO::PARAM_STR);
              $INSERT->bindParam(':smallimg', $target_small);
              $INSERT->bindParam(":blogid", $_GET["blogid"], PDO::PARAM_INT);
              if((unlink($row["IMAGE"]) && unlink($row["SMALL_IMAGE"])) &&  $INSERT->execute())
              {
                  header("Location: Blog.php?duzenleme=basarili");
              } 
            }
        }
      }
    ?>
	<div class="fullScreen">
      	<?php require_once('../navbar.php'); ?>
    <div class="header">
        <div class="pagename">YAZIYI DÜZENLE</div>
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
                        <input type="text" name="baslik" class="baslik" id="" placeholder="Başlık Giriniz" 
                        required value="<?php if(isset($row['BASLIK'])) echo $row['BASLIK'];?>">

                        <div class="tags">
                          <div id="fr">Etiketler</div>
                          <select class="form-control2" multiple="multiple">
                            <?php 

                           
                              $tags->bindParam(":blog_id", $_GET["blogid"], PDO::PARAM_STR);
                              $tags->execute();
                              $rows = $tags->fetchAll(PDO::FETCH_ASSOC);
                              if($tags->rowCount() > 0 )
                              {
                                foreach($rows as $tag => $name)
                                {
                                  echo "<option selected>" . $name["TAG_NAME"] . "</option>";
                                } 
                              }
                              else {
                                echo "<option selected> Bu yazıya ait bir etiket bulunamadı. </option>;";
                              }
                            

                            ?>


                          </select>
                        </div>
                       </div>
                      </div>
                      <div class="picture">
                                                    
                      <input type="file" class="hidden" onload="changelabeledit();" onchange="changelabeledit(); readURL(this);" name="fileToUpload" id="fileToUpload">
                    <label class="button btnbig color2"  id="filelabel" for="fileToUpload">Görseli Değiştir</label>  
                    <input type="hidden" id="hiddenfilename" name="resim" <?php if(isset($row['IMAGE_NAME'])) echo "value='" . $row['IMAGE_NAME'] . "'"; ?>>   
                    <img id="resimalani"<?php if(isset($row['IMAGE'])) echo "src='" . $row['IMAGE'] . "'"; ?> alt="Yüklenen Resim" />
                    </div> 
                </div>
                <div class="inputbox">
                    <div class="frontcontext" >Açıklama</div>
                    <textarea id="mytextarea" name="aciklama" placeholder="İçeriği buraya yazabilirsiniz."><?php if(isset($row['ICERIK'])) echo $row['ICERIK'];?></textarea>
                </div>
                <div class="bottom2">

                <div class="inputbox">
                    <div class="frontcontext" >Durum</div>  
                    <div class="status">                    
                      <label class="label" for="lb1">Aktif<input type="radio" name="durum" id="lb1" value="1" <?php if(isset($row['AKTIF']) && $row["AKTIF"] == 1) 
                      echo "checked"; ?>></label>
                      <label class="label" for="lb2">Pasif<input type="radio" name="durum" id="lb2" value="0" <?php if(isset($row['AKTIF']) && $row["AKTIF"] == 0) 
                      echo "checked"; ?>></label>
                  </div>
                </div>
                <div class="status">
                <div class="boxbutton">  
                  <!-- 
                      <input type="hidden" name="delete" <?php echo "value='" . $row["ID"] . "'"; ?> />  
                      <input type="hidden" name="picway" <?php echo "value='" . $row["IMAGE"] . "'"; ?> />
                      <input type="submit" class="button delete" value="Sil" /> -->
                </div>
                    <input type="submit" name="submit"  value="Kaydet" class="button">
                    <button type="reset" class="button">Temizle</button>
                </div>

                </div>

            </form>
        </div>
    </div>
            
</body>
