
<?php 
require_once('../checkLogin.php'); 
require_once('../utilities.php');
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <script src="../JQuery.js"></script>
    <link rel="stylesheet" href="../Template.css">
    <link rel="stylesheet" href="Iletisim.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../Utilities.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />

    <!--
    <script src="../js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        font_size_formats:
            "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 18pt 24pt 30pt 36pt 48pt 60pt 72pt 96pt",
        selector: '#mytextarea',
        height: '90%',
        width: '100%',
        content_css: 'white',
        plugins: "link image code",
        toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | fontfamily fontsize | backcolor'
      });
    </script>
    -->
    <title>Admin Paneli</title>
</head>

<body>

<?php

    if(isset($_POST['submit']))
    {

        $TELEFON_TEXT = htmlspecialchars($_POST['telefon'], ENT_QUOTES, 'UTF-8');
        $ADRES_TEXT = htmlspecialchars($_POST['adres'], ENT_QUOTES, 'UTF-8');
        $MAIL_TEXT = htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8');

        $INSERT =  $db->prepare("UPDATE iletisim SET PHONE = :p, ADRESS = :a, MAIL = :m WHERE ID = 1");

        $INSERT->bindParam(':p', $TELEFON_TEXT, PDO::PARAM_STR);
        $INSERT->bindParam(':a', $ADRES_TEXT, PDO::PARAM_STR);
        $INSERT->bindParam(':m', $MAIL_TEXT, PDO::PARAM_STR);

        if($INSERT->execute())
        {
            header("Location: Iletisim.php?duzenleme=basarili");
        }

    }

    $iletisim = $db->prepare("SELECT * FROM iletisim LIMIT 1");
    $iletisim->execute();
    $content = $iletisim->fetch(PDO::FETCH_ASSOC);

?>

	<div class="fullScreen">
	<?php require_once('../navbar.php'); ?>
	<div class="header">
        <div class="pagename">İletisim </div>
    </div>
        <div class="mainScreen">
			
                <form method="POST" id="myForm" class="hakkimizdaForm" enctype="multipart/form-data">

                    <?php 
                        if(isset($_GET["duzenleme"]) && $_GET["duzenleme"] == "basarili") {echo "<div class='upperblog'>  <div class='mesaj'>&nbsp;&nbsp;Düzenleme işlemi başarılı! &#10003;</div></div>";}
                    ?>

                    <div class="inputBox">
                        <div class="inputHead">Telefon</div>
                        <textarea class="mytextarea" name="telefon" id=""><?php if(isset($content["PHONE"])) echo $content["PHONE"];?> </textarea>
                    </div>

                    <div class="inputBox">
                        <div class="inputHead">Adres</div>
                        <textarea class="mytextarea" name="adres" id=""><?php if(isset($content["ADRESS"])) echo $content["ADRESS"];?> </textarea>
                    </div>

                    <div class="inputBox">
                        <div class="inputHead">Mail</div>
                        <textarea class="mytextarea" name="mail" id="" ><?php if(isset($content["MAIL"])) echo $content["MAIL"];?> </textarea>
                    </div>

                    <div class="buttons">
                        <input type="submit" name="submit" id="submitButton" value="KAYDET" class="button">
                    </div>
                </form>

</body>