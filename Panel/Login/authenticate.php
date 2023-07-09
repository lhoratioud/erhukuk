<?php
session_start();

require_once(../../Utilities/conn.php;)

if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Lütfen kullanıcı adı ve parola girin.');
}

if ($control = $conn->prepare("SELECT USERNAME, ID, PASSWORD FROM users WHERE USERNAME = :usr")) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $control->bindParam(':usr', $_POST['username']);
	$control->execute();
	// Store the result so we can check if the account exists in the database.
	$check = $control->fetch();

    echo $check['USERNAME'];
    echo 'adasfasfgagads';
    echo $_POST['username'];

    if($check) {
        $id = $check['ID'];
        $pass = $check['PASSWORD'];

        if(password_verify($_POST['password'], $pass)) {

            echo 'Başarıyla giriş yaptınız.';
        }
        else {
            echo 'Parola hatalı.';
        }
    }
    else {
        echo 'Kullanıcı bulunamadı.';
    }

	$control = null;
    $conn = null;

}
?>