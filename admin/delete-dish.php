<?php 
    require_once '../database.php';
    // Reference: https://medoo.in/api/where
    if($_GET){
        $data = $database->select("tb_for_dishes","*",[
            "id_dish"=>$_GET["id"]
        ]);
    }

    if($_POST){
        // Reference: https://medoo.in/api/delete
        $database->delete("tb_for_dishes",[
            "id_dish"=>$_POST["id"]
        ]);

        header("location: list-dish.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Dish</title>
</head>
<body>
    <h2>Delete: <?php echo $data[0]["dish_name"]; ?></h2>
    <form method="post" action="delete-dish.php">
        <input name="id" type="hidden" value="<?php echo $data[0]["id_dish"]; ?>">
        <input type="button" onclick="history.back();" value="CANCEL">
        <input type="submit" value="DELETE">
    </form>
</body>
</html>