<?php require_once('../checkLogin.php'); ?>
<?php require_once('../utilities.php'); ?>

<?php 
error_reporting(E_ALL);
    $s = 0;    
    if(isset($_POST["status"]) && isset($_POST["hizmetid"]))
    {
        if ($_POST["status"] == '1')
        {   
            $control = $db->prepare("UPDATE hizmetler SET AKTIF = '0' WHERE ID = :id");
            $control->bindParam(":id", $_POST["hizmetid"]);
            $control->execute();
        }
        else
        {
            $control = $db->prepare("UPDATE hizmetler SET AKTIF = '1' WHERE ID = :id");
            $control->bindParam(":id", $_POST["hizmetid"]);
            $control->execute();
        }
    }
    else if(isset($_POST["delete"]))
    {

        $control = $db->prepare("DELETE FROM hizmetler WHERE ID = :id");
            $control->bindParam(":id", $_POST["delete"]);
            $control->execute();

    }


?>