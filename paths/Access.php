<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: POST");
include '../controller/AccessController.php';

 $controller = new AccessControlador();

if($_SERVER['REQUEST_METHOD'] == "POST"){
   
    $user = json_decode(file_get_contents('php://input'), true);
    $data = array(
        "username" => $user['username'],
        "password" => $user['password'],
    );
    
    $controller->createAccess($data);
}

if($_SERVER['REQUEST_METHOD'] == "GET"){
    echo $controller->getTokenUser($_GET['id'], $_GET['token']);
}
