<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow React frontend

$items = [
    ["id" => "1", "name" => "Apple", "category" => "Fruits"],
    ["id" => "2", "name" => "Carrot", "category" => "Vegetables"],
    ["id" => "3", "name" => "Banana", "category" => "Fruits"],
    ["id" => "4", "name" => "Broccoli", "category" => "Vegetables"]
];

echo json_encode($items);
?>
