
<?php 
require_once('../checkLogin.php'); 
require_once('../utilities.php');
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <script src="../JQuery.js"></script>
    <link rel="stylesheet" href="../Template.css">
    <link rel="stylesheet" href="Hakkimizda.css">
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

        $TARIHCE_TEXT = htmlspecialchars($_POST['tarihce'], ENT_QUOTES, 'UTF-8');
        $VIZYON_TEXT = htmlspecialchars($_POST['vizyon'], ENT_QUOTES, 'UTF-8');
        $MISYON_TEXT = htmlspecialchars($_POST['misyon'], ENT_QUOTES, 'UTF-8');

        $INSERT =  $db->prepare("UPDATE hakkimizda SET TARIHCE = :t, VIZYON = :v, MISYON = :m WHERE ID = 1");

        $INSERT->bindParam(':t', $TARIHCE_TEXT, PDO::PARAM_STR);
        $INSERT->bindParam(':v', $VIZYON_TEXT, PDO::PARAM_STR);
        $INSERT->bindParam(':m', $MISYON_TEXT, PDO::PARAM_STR);

        if($INSERT->execute())
        {
            header("Location: Hakkimizda.php?duzenleme=basarili");
        }

    }

    $hakkimizda = $db->prepare("SELECT * FROM hakkimizda LIMIT 1");
    $hakkimizda->execute();
    $content = $hakkimizda->fetch(PDO::FETCH_ASSOC);

?>

	<div class="fullScreen">
	<?php require_once('../navbar.php'); ?>
	<div class="header">
        <div class="pagename">Hakkımızda </div>
    </div>
        <div class="mainScreen">
			
                <form method="POST" id="myForm" class="hakkimizdaForm" enctype="multipart/form-data">

                    <div class="inputBox">
                        <div class="inputHead">Tarihçe</div>
                        <textarea class="mytextarea" name="tarihce" id=""><?php if(isset($content["TARIHCE"])) echo $content["TARIHCE"];?> </textarea>
                    </div>

                    <div class="inputBox">
                        <div class="inputHead">Vizyonumuz</div>
                        <textarea class="mytextarea" name="vizyon" id=""><?php if(isset($content["VIZYON"])) echo $content["VIZYON"];?> </textarea>
                    </div>

                    <div class="inputBox">
                        <div class="inputHead">Misyonumuz</div>
                        <textarea class="mytextarea" name="misyon" id="" ><?php if(isset($content["MISYON"])) echo $content["MISYON"];?> </textarea>
                    </div>

                    <div class="buttons">
                        <input type="submit" name="submit" id="submitButton" value="KAYDET" class="button">
                    </div>
                </form>

</body>