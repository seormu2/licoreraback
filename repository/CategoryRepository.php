<?php

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

    public function updateCategory($id, $category){
        $connectionDB = $this->connection->connectDB();

        $sql = "UPDATE categories SET category = '$category' WHERE id_category = '$id'";
        return $connectionDB->query($sql);
    }

    public function existCategory($categorie){
        $connectionDB = $this->connection->connectDB();

        $sql = "SELECT * FROM categories WHERE category = '$categorie'";
        $query = $connectionDB->query($sql);
        if($query->num_rows > 0){
            return true;
        }
        return false;
    }

    public function deleteCategory($id){
        $connectionDB = $this->connection->connectDB();

        $sql = "UPDATE categories set state = '6' WHERE id_category = '$id'";
        return $connectionDB->query($sql);
    }

    public function saveCategory($category){
        $connectionDB = $this->connection->connectDB();

        $sql = "INSERT INTO categories (`id_category`, `category`, `state`) VALUES(null, '$category', 5)";
        $query = $connectionDB->query($sql);
        if($query){
            return true;
        }
        return false;
    }
}