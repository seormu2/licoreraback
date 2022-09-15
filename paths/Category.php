<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: PUT");
include '../controller/CategoryController.php';

$controller = new CategoryController();

if(isset($_GET['getCategories'])){
    echo $controller->getCateries();

}

if(isset($_GET['searchCategory'])){
    echo $controller->searchCategory($_GET['searchCategory']);
}