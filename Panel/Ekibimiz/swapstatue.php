<?php require_once('../checkLogin.php'); ?>
<?php require_once('../utilities.php'); ?>

<?php 
error_reporting(E_ALL);
    $s = 0;    
    if(isset($_POST["status"]) && isset($_POST["uyeid"]))
    {
        if ($_POST["status"] == '1')
        {   
            $control = $db->prepare("UPDATE ekip SET AKTIF = '0' WHERE ID = :id");
            $control->bindParam(":id", $_POST["uyeid"]);
            $control->execute();
        }
        else
        {
            $control = $db->prepare("UPDATE ekip SET AKTIF = '1' WHERE ID = :id");
            $control->bindParam(":id", $_POST["uyeid"]);
            $control->execute();
        }
    }
    else if(isset($_POST["delete"]))
    {

        $control = $db->prepare("DELETE FROM ekip WHERE ID = :id");
            $control->bindParam(":id", $_POST["delete"]);
            if($_POST["picway"] != "../../images/Ekip/ORNEK_RESIM.jpg")
            {
                unlink($_POST["picway"]);
            }
            $control->execute();

    }


?>