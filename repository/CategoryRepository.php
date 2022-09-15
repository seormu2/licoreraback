<?php
include '../config/ConfigDB.php';

class CategoryRepository{

    private $connection;

    public function __construct(){
        $this->connection = new ConfigDB();
    }

    public function getCategories(){
        $connectionDB = $this->connection->connectDB();

        $sql = "SELECT * FROM categories as ca INNER JOIN estados as es ON ca.state = es.id WHERE es.estado = 'ACTIVO'";
        $query = $connectionDB->query($sql);

        $arrayTotal = array();

        while($row = $query->fetch_object()){
            $arrayObject = array(
                "id" => $row->id_category,
                "category" => $row->category,
                "state" => $row->estado
            );
            array_push($arrayTotal, $arrayObject);
        }
        return $arrayTotal;
    }

    public function searchCategory($sentency){
        $connectionDB = $this->connection->connectDB();

        $sql = "SELECT * FROM categories as ca INNER JOIN estados as es ON ca.state = es.id WHERE es.estado = 'ACTIVO' AND  category like '%$sentency%'";
        $query = $connectionDB->query($sql);

        $arrayTotal = array();

        while($row = $query->fetch_object()){
            $arrayObject = array(
                "id" => $row->id_category,
                "category" => $row->category,
                "state" => $row->estado
            );
            array_push($arrayTotal, $arrayObject);
        }
        return $arrayTotal;
    }
}