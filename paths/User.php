<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: PUT");
include '../controller/UserController.php';

 $controller = new UserController();

 if(isset($_GET['password'])){
    $user = json_decode(file_get_contents('php://input'), true);
    $data = array(
        "idUser"   => $user['idUser'],
        "password" => $user['password'],
        "token"    => $user['token']
    );
    
    echo $controller->updatePassword($data);

}else if($_SERVER['REQUEST_METHOD'] == "PUT"){
   
    $user = json_decode(file_get_contents('php://input'), true);
    $data = array(
        "idUser"  => $user['idUser'],
        "username" => $user['username'],
        "token"    => $user['token']
    );
    
    echo $controller->updateUsername($data);
}