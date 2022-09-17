<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: PUT");
include '../controller/ProductsController.php';

$controller = new ProductsController();

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET['saveProduct'])) {
    $data = json_decode(file_get_contents('php://input'), true);
    $dataArray = array(
        "nameProduct" => $data['nameProduct'],
        "brand"       => $data['brand'],
        "amount"      => $data['amount'],
        "price"       => $data['price'],
        "category"    => $data['category'],
        "codeProduct" => $data['codeProduct'],
        "idPerson"    => $data['idPerson'],
        "token"       => $data['token']
    );
    
    echo $controller->saveProduct($data);
}else if(isset($_GET['search'])){
    echo $controller->searchProducts($_GET['search']);
}