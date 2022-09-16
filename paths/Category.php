<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: PUT");
include '../controller/CategoryController.php';

$controller = new CategoryController();

if(isset($_GET['save']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $data = json_decode(file_get_contents('php://input'), true);
    $dataArray = array(
        "idUser"     => $data['idUser'],
        "category"   => $data['category'],
        "token"      => $data['token'],
    );
    echo $controller->saveCategory($dataArray);
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    $data = json_decode(file_get_contents('php://input'), true);
    $dataArray = array(
        "idUser"     => $data['idUser'],
        "idCategory" => $data['idCategory'],
        "category"   => $data['category'],
        "token"      => $data['token'],
    );
    echo $controller->updateCategory($dataArray);
}

if(isset($_GET['getCategories'])){
    echo $controller->getCateries();

}

if(isset($_GET['searchCategory'])){
    echo $controller->searchCategory($_GET['searchCategory']);
}

if(isset($_GET['idCategory']) && isset($_GET['token']) && isset($_GET['idUser'])){
    
    echo $controller->deleteCategory($_GET['idCategory'], $_GET['token'], $_GET['idUser']);
}



