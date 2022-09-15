<?php
include '../repository/UserRepository.php';
include '../config/SecurityApp.php';
include '../repository/AccessRepository.php';
include '../response/ResponseHTTP.php';

class UserController {

    private $repository;
    private $repositoryAccess;

    public function __construct(){
        $this->repository = new UserRepository();
        $this->repositoryAccess = new AccessRepository();
    }

    public function updateUsername($data){
        $idUser = SecurityApp::realEscapeString($data['idUser']);
        $username = SecurityApp::realEscapeString($data['username']);
        $token = SecurityApp::realEscapeString($data['token']);

        $getToken = $this->repositoryAccess->getTokenUser($idUser);
        
        if($token == $getToken){
            if($this->repository->userExists($username)){
                return ResponseHTTP::response404('El usuario ya existe.');
            }
            $repository = $this->repository->updateUsername($idUser, $username);
            if($repository){
                $user = $this->repository->getUser($idUser);
                if($user != null){
                    return ResponseHTTP::response200($user, "Usuario actualizado correctamente");
                }else{
                    return ResponseHTTP::response500('Ha ocurrido un error inesperado');
                }
            }else{
                return ResponseHTTP::response500('Ha ocurrido un error inesperado');
            }
        }else{
            return ResponseHTTP::response401('El usuario no tiene permisos para realizar esta operación');
        }

    }

    public function updatePassword($data){
        $idUser = SecurityApp::realEscapeString($data['idUser']);
        $password = SecurityApp::realEscapeString($data['password']);
        $token = SecurityApp::realEscapeString($data['token']);
        $passwordVerify = SecurityApp::hash($password);

        $getToken = $this->repositoryAccess->getTokenUser($idUser);

        if($token == $getToken){
            $repository = $this->repository->updatePassword($idUser, $passwordVerify);
            if($repository){
                return ResponseHTTP::response200(null, "Contraseña actualizada correctamente");
            }else{
                return ResponseHTTP::response500('Ha ocurrido un error inesperado');
            }
        }else{
            return ResponseHTTP::response401('El usuario no tiene permisos para realizar esta operación');
        }

    }
}