<?php

use LDAP\ResultEntry;

include '../config/SecurityApp.php';
include '../repository/AccessRepository.php';
include '../response/ResponseHTTP.php';
include '../repository/ProductsRepository.php';
class ProductsController {

    private $repositoryAccess ;
    private $repository;

    public function __construct(){
        $this->repositoryAccess = new AccessRepository();
        $this->repository = new ProductsRepository();
    }

    public function saveProduct($data){
        $nameProduct = SecurityApp::realEscapeString($data['nameProduct']);
        $brand       = SecurityApp::realEscapeString($data['brand']);
        $amount      = SecurityApp::realEscapeString($data['amount']);
        $price       = SecurityApp::realEscapeString($data['price']);
        $category    = SecurityApp::realEscapeString($data['category']);
        $codeProduct = SecurityApp::realEscapeString($data['codeProduct']);
        $idPerson    = SecurityApp::realEscapeString($data['idPerson']);
        $token       = SecurityApp::realEscapeString($data['token']);

        $getToken = $this->repositoryAccess->getTokenUser($idPerson);
        if($getToken == $token){
            $validateNameProduct = $this->repository->validateNameProduct($nameProduct);
            if($validateNameProduct) return ResponseHTTP::response404("El nombre del producto ya existe");

            $validateCodeProduct = $this->repository->validateCodeProduct($codeProduct);
            if($validateCodeProduct) return ResponseHTTP::response404("El codigo del producto ya existe");

            $save = $this->repository->saveProduct($nameProduct,$brand,$amount,$price,$category,$codeProduct);
            if($save){
                return ResponseHTTP::response200(null,"Producto guardado correctamente");
            }else{
                 return ResponseHTTP::response500("Ha ocurrido un error inesperado");
            }

        }else{
            return ResponseHTTP::response401("El usuario no tiene acceso para realizar esta operación");
        }
    }

    public function searchProducts($data){
        $data = SecurityApp::realEscapeString($data);

        return json_encode($this->repository->searchProducts($data));
    }

}