

<!DOCTYPE html>
<html lang="tr">
<head>
    <link rel="stylesheet" href="Login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="YCjcnxP8QU76BRKZjsX7txYgBvK4oV3C1ML6juLck8I" />
    <title>Admin Paneli</title>
	

	
</head>
<body>

	<script src="Login.js"></script>
    <div class="fullScreen">
        <div class="mainScreen">

        <form action=""  method="POST" class="box">
                <img src="../images/Login/avatar4.png" alt="" class="personpicture">
            
            <div class="header">ER HUKUK ADMİN PANELİ</div>
            <div id="MESAJ"></div>
            <img src="../images/Login/loading5.gif" class="loadingimg" id="loadingimg" alt="">
            <div class="inputs">
                <input type="text" class="username input" name="username" id="username" placeholder="Kullanıcı Adı" required>
                <input type="password" name="password" class="password input" id="password" placeholder="Şifre" required>
            </div>

            <input type="submit" class="button" name="button" value="Panele Giriş">
        </form>


        <?php

            session_start();


            if (isset($_SESSION['loggedin'])) {
                header('Location: ../Anasayfa/Anasayfa.php');
                exit;
            }

            require_once("../../Utilities/conn.php");

             
            if ( !isset($_POST['username'], $_POST['password']) ) {
            	// Could not get the data that should have been sent.
            	exit('');
            }

            if(isset($_POST["button"]))
            {
                echo '<script type="text/javascript">',
                'gifstart();',
                 '</script>';


                if ($control = $db->prepare("SELECT USERNAME, NAME, ID, PASSWORD FROM users WHERE USERNAME = :usr")) {
                    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                    $control->bindParam(':usr', $_POST['username']);
                    $control->execute();
                    // Store the result so we can check if the account exists in the database.
                    $check = $control->fetch();
                
                    if($check) {
                        $id = $check['ID'];
                        $pass = $check['PASSWORD'];
                        $name = $check['NAME'];
                    
                        if(password_verify($_POST['password'], $pass)) {
                        
                            $_SESSION["MESAJ"] = "Giriş Başarılı !!!! Yönlendiriliyorsunuz...";
                            echo '<script type="text/javascript">',
                            'gifstop();',
                            '</script>';
                            session_regenerate_id();
                            $_SESSION['loggedin'] = TRUE;
                            $_SESSION['name'] = $name;
                            $_SESSION['id'] = $id;
                            header('Location: ../Anasayfa/Anasayfa.php');
	                        exit;
                        }
                        else {
                            $_SESSION["MESAJ"] = "Geçersiz Kullanıcı Adı / Parola lütfen tekrar deneyiniz.";
                            echo '<script type="text/javascript">',
                            'gifstop();',
                            '</script>';
                        }
                    }
                    else {
                        $_SESSION["MESAJ"] = "Geçersiz Kullanıcı Adı / Parola lütfen tekrar deneyiniz.";
                        echo '<script type="text/javascript">',
                            'gifstop();',
                            '</script>';
                    }
                }
            }
            $control = null;
            $db = null;
            ?>
        <input type="hidden" id="hiddenMessage" name="" value="<?php if(isset($_SESSION["MESAJ"])) echo $_SESSION["MESAJ"]  ?>">
        <script>checkMesaj();</script>
            
            
        </div>
    </div>

    
</body>
</html>
