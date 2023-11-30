<?php 
    /***
     * 0. include database connection file
     * 1. receive form values from post and insert them into the table (match table field with values from name atributte)
     * 2. for the destination_image insert the value "destination-placeholder.webp"
     * 3. redirect to destinations-list. php after complete the insert into
     */

     require_once '../database.php';

     // Reference: https://medoo.in/api/select
     

     // Reference: https://medoo.in/api/select
     $categories = $database->select("tb_for_categories","*");
     $categories_groups = $database->select("tb_categories_groups","*");
                        
     $message="";

     if ($_POST){
        if (isset($_FILES["dish_image"])){
            $errors = [];
            $file_name = $_FILES["dish_image"]["name"];
            $file_size = $_FILES["dish_image"]["size"];
            $file_tmp = $_FILES["dish_image"]["tmp_name"];
            $file_type = $_FILES["dish_image"]["type"];
            $file_ext_arr = explode(".", $_FILES["dish_image"]["name"]);

            $file_ext = end($file_ext_arr);
            $img_ext = ["jpge", "png", "jpg", "webp"];

            if(!in_array($file_ext, $img_ext)){
                $errors[] = "File type is not valid";
                $message = "File type is not valid";
            }

            if(empty($errors)){
                $filename = strtolower($_POST["dish_name"]);
                $filename = str_replace(',', '', $filename);
                $filename = str_replace('.', '', $filename);
                $filename = str_replace(' ', '-', $filename);
                $img = "dish-".$filename.".".$file_ext;
                
                move_uploaded_file($file_tmp, "../imgs/".$img);

                $database->insert("tb_for_dishes",[
                    "id_category"=>$_POST["name_category"],
                    "id_category_group"=>$_POST["category_group_name"],
                    "dish_name"=>$_POST["dish_name"],
                    "dish_name_chinese"=>$_POST["dish_name_chinese"],
                    "dish_description"=>$_POST["dish_description"],
                    "dish_description_chinese"=>$_POST["dish_description_chinese"],
                    "dish_image"=> $img,
                    "dish_price"=>$_POST["dish_price"],
                ]);
            }
        }
     }

    /*if($_POST){
        
    }*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Dish</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
</head>
<body>
    <div class="container">
        <h2>Add New Dish</h2>
        <form method="post" action="add-dish.php" enctype="multipart/form-data">
            <div class="form-items">
                <label for="dish_name">Dish Name</label>
                <input id="dish_name" class="textfield" name="dish_name" type="text">
            </div>
            <div class="form-items">
                <label for="dish_name_chinese">Dish name - CH</label>
                <input id="dish_name_chinese" class="textfield" name="dish_name_chinese" type="text">
            </div>

            <div class="form-items">
                <label for="name_category">Dish Category</label>
                <select name="name_category" id="name_category">
                    <?php 
                        foreach ($categories as $category){
                            echo "<option value=".$category["id_category"].">".$category["name_category"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="category_group_name">Dish Category Group</label>
                <select name="category_group_name" id="category_group_name">
                    <?php 
                    var_dump($categories_groups);
                        foreach($categories_groups as $category_group){
                            if($item[0]["id_category_group"] == $category_group["id_category_group"]){
                                echo "<option value='".$category_group["id_category_group"]."' selected>".$category_group["category_group_name"]."</option>";
                            }else{
                                echo "<option value='".$category_group["id_category_group"]."'>".$category_group["category_group_name"]."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-items">
                <label for="dish_description">Dish Description</label>
                <textarea id="dish_description" name="dish_description" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="form-items">
                <label for="dish_description_chinese">Dish Description - CH</label>
                <textarea id="dish_description_chinese" name="dish_description_chinese" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="form-items">
                <label for="dish_image">Dish Image</label>
                <img id="preview" src="../imgs/destination-placeholder.webp" alt="Preview">
                <input id="dish_image" type="file" name="dish_image" onchange="readURL(this)">
            </div>
            <div class="form-items">
                <label for="dish_price">Dish Price</label>
                <input id="dish_price" class="textfield" name="dish_price" type="text">
            </div>
            <div class="form-items">
                <input class="submit-btn" type="submit" value="Add New Dish">
            </div>
        </form>
    </div>

    <script>
        function readURL(input) {
            if(input.files && input.files[0]){
                let reader = new FileReader();

                reader.onload = function(e) {
                    let preview = document.getElementById('preview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
    </script>
    
</body>
</html>