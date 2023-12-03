<?php
require_once './database.php';

$dish = [];

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        if ($decoded["language"] == "en") {
            $item = $database->select("tb_for_dishes", [
                "tb_for_dishes.dish_name",
                "tb_for_dishes.dish_description"
            ],[
                "id_dish" => $decoded["id_dish"]
            ]);
            $dish["name"] = $item[0]["dish_name"];
            $dish["description"] = $item[0]["dish_description"];
        } else {
            $item = $database->select("tb_for_dishes", [
                "tb_for_dishes.dish_name_chinese",
                "tb_for_dishes.dish_description_chinese"
            ],
                [
                "id_dish" => $decoded["id_dish"]
            ]);
            $dish["name"] = $item[0]["dish_name_chinese"];
            $dish["description"] = $item[0]["dish_description_chinese"];
        }

        echo json_encode($dish);
    }
}
?>
