<?php
include '../repository/AccessRepository.php';
include '../response/ResponseHTTP.php';
include '../config/Token.php';
include '../config/SecurityApp.php';
class AccessControlador{

    private $repository;

    public function __construct(){
        $this->repository = new AccessRepository();
    }

    public function createAccess($data){
        $username = SecurityApp::realEscapeString($data['username']);
        $password = SecurityApp::realEscapeString($data['password']);
        $user = $this->repository->getUser($username);
        if($user != null){
            $tokenAccess = Token::generateToken();
            $refreshToken = $this->repository->refreshToken($user['id'], $tokenAccess);
            if(SecurityApp::verify($password, $user['password'])){
                $this->sendValues($user,$tokenAccess);
            }else{
                echo ResponseHTTP::response404("Usuario o contraseña incorrecta");
            }
        }else{
            echo ResponseHTTP::response404("El usuario no se encuentra registrado");
        }
    }

    public function sendValues($user,$tokenAccess){
        echo ResponseHTTP::response200(
            array(
                "id"      => $user['id'],
                "username" => $user['username'],
                "token"   => $tokenAccess
            ),
            "true");
    }

    public function getTokenUser($id, $token){
        $tokenUser = SecurityApp::realEscapeString($token);
        $idUser = SecurityApp::realEscapeString($id);
        $token = $this->repository->getTokenUser($idUser);
        if($token == $tokenUser){
            return json_encode(array(
                "access" => true
            ));
        }else{
            return json_encode(array(
                "access" => false
            ));
        }
        
    }
}