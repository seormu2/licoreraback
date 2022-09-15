<?php

include '../repository/CategoryRepository.php';
include '../repository/AccessRepository.php';
include '../config/SecurityApp.php';
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
}