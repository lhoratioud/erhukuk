<?php require_once('../checkLogin.php'); ?>
<?php require_once('../utilities.php'); ?>

<?php 
error_reporting(E_ALL);
    $s = 0;    
    if(isset($_POST["status"]) && isset($_POST["blogid"]))
    {
        if ($_POST["status"] == '1')
        {   
            $control = $db->prepare("UPDATE blog SET AKTIF = '0' WHERE ID = :id");
            $control->bindParam(":id", $_POST["blogid"]);
            $control->execute();
        }
        else
        {
            $control = $db->prepare("UPDATE blog SET AKTIF = '1' WHERE ID = :id");
            $control->bindParam(":id", $_POST["blogid"]);
            $control->execute();
        }
    }
    else if(isset($_POST["delete"]))
    {

        $control = $db->prepare("DELETE FROM blog WHERE ID = :id");
            $control->bindParam(":id", $_POST["delete"]);
            unlink($_POST["picway"]);
            $control->execute();
    }


?>