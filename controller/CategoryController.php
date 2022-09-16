<?php

include '../repository/CategoryRepository.php';
include '../repository/AccessRepository.php';
include '../config/SecurityApp.php';
include '../response/ResponseHTTP.php';
class CategoryController{

    private $repository;
    private $accessRepository;

    public function __construct(){
        $this->repository = new CategoryRepository();
        $this->accessRepository = new AccessRepository();
    }

    public function getCateries(){
        return json_encode($this->repository->getCategories());
    }

    public function searchCategory($category){
        $sentency = SecurityApp::realEscapeString($category);
        return json_encode($this->repository->searchCategory($sentency));
    }

    public function updateCategory($data){
        $idUser = SecurityApp::realEscapeString($data['idUser']);
        $idCategory = SecurityApp::realEscapeString($data['idCategory']);
        $category = SecurityApp::realEscapeString($data['category']);
        $token = SecurityApp::realEscapeString($data['token']);
        
        $getToken = $this->accessRepository->getTokenUser($idUser);
        if($getToken == $token){
            $existCategory = $this->repository->existCategory($category);
            if($existCategory){
                return ResponseHTTP::response404("La categoria ya se encuentra registrada");
            }
            $result = $this->repository->updateCategory($idCategory, $category);
            if($result){
                return ResponseHTTP::response200(null, "Categoria actualizada correctamente");
            }else{
                return ResponseHTTP::response500('Ha ocurrido un error inesperado');
            }
        }else{
            return ResponseHTTP::response401('El usuario no tiene permisos para realizar esta operación');
        }
    }
    
    public function deleteCategory($idCategory, $token, $idPerson){
        $idCategory = SecurityApp::realEscapeString($idCategory);
        $tokenUser = SecurityApp::realEscapeString($token);
        $idPerson = SecurityApp::realEscapeString($idPerson);

        $getToken = $this->accessRepository->getTokenUser($idPerson);

        if($getToken == $tokenUser){
            $delete = $this->repository->deleteCategory($idCategory);
            if($delete){
                return ResponseHTTP::response200(null, "Categoria eliminada correctamente");
            }else{
                return ResponseHTTP::response500('Ha ocurrido un error inesperado');
            }
        }else{
            return ResponseHTTP::response401('El usuario no tiene permisos para realizar esta operación');
        }
    }

    public function saveCategory($data){
        $idUser   = SecurityApp::realEscapeString($data['idUser']);
        $category = SecurityApp::realEscapeString($data['category']);
        $token    = SecurityApp::realEscapeString($data['token']);

        $getToken = $this->accessRepository->getTokenUser($idUser);

        if($token == $getToken){
            $existCategory = $this->repository->existCategory($category);
            if($existCategory){
                return ResponseHTTP::response404("La categoria ya se encuentra registrada");
            }
            $save = $this->repository->saveCategory($category);
            if($save){
                return ResponseHTTP::response200(null, "Categoria guardada correctamente");
            }else{
                return ResponseHTTP::response500('Ha ocurrido un error inesperado');
            }
        }else{
            return ResponseHTTP::response401('El usuario no tiene permisos para realizar esta operación');
        }

    }
}