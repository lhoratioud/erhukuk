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

        $decrement_tags = $db->prepare("UPDATE taglist SET TAG_BLOG_COUNT = TAG_BLOG_COUNT - 1 WHERE ID = :tagid");
        $update_tags = $db->prepare("DELETE FROM taglist WHERE TAG_BLOG_COUNT = 0");
        $select_tags = $db->prepare("SELECT TAG_ID FROM tags WHERE BLOG_ID = :id");
        $remove_tags = $db->prepare("DELETE FROM tags WHERE BLOG_ID = :id");
        $select_tags->bindParam(":id", $_POST["delete"]);
        $select_tags->execute();
        $rows = $select_tags->fetchAll(PDO::FETCH_ASSOC);
        if($select_tags->rowCount() > 0)
        {
            foreach($rows as $tag => $name)
            {
                $decrement_tags->bindParam(":tagid", $name["TAG_ID"], PDO::PARAM_INT);
                $decrement_tags->execute();
            }
            $remove_tags->bindParam(":id", $_POST["delete"], PDO::PARAM_INT);
            $remove_tags->execute();
            $update_tags->execute();
        }

        $control = $db->prepare("DELETE FROM blog WHERE ID = :id");
            $control->bindParam(":id", $_POST["delete"]);
            unlink($_POST["picway"]);
            unlink($_POST["small_picway"]);
            $control->execute();

    }


?>