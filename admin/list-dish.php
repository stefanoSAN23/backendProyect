<?php 
    require_once '../database.php';
    // Reference: https://medoo.in/api/select
    $dishes = $database->select("tb_for_dishes","*");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Dishes</title>
</head>
<body>
    <h2>Registered Dishes</h2>
    <table>
        <?php
            foreach($dishes as $dish){
                echo "<tr>";
                echo "<td>".$dish["dish_name"]."</td>";
                //echo "<td>".$item["email"]."</td>";
                echo "<td><a href='edit-dish.php?id=".$dish["id_dish"]."'>Edit</a> <a href='delete-dish.php?id=".$dish["id_dish"]."'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    
</body>
</html>