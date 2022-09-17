<?php
class ProductsRepository {

    private $connection;

    public function __construct(){
        $this->connection = new ConfigDB();
    }

    public function saveProduct($nameProduct,$brand,$amount,$price,$category,$codeProduct){
        $connectionDB = $this->connection->connectDB();

        $sql = "INSERT INTO `products`(`id_product`, `name`, `brand`, `amount`, `price`, `codeProduct`, `category`,`state`) 
        VALUES (null,'$nameProduct','$brand','$amount','$price','$codeProduct','$category',5)";

        $query = $connectionDB->query($sql);
        if($query){
            return true;
        }
        return false;
    }

    public function validateCodeProduct($code){
        $connectionDB = $this->connection->connectDB();

        $sql = "SELECT * FROM products WHERE codeProduct = '$code'";
        $query = $connectionDB->query($sql);
        if($query->num_rows > 0){
            return true;
        }
        return false;
    }

    public function validateNameProduct($name){
        $connectionDB = $this->connection->connectDB();

        $sql = "SELECT * FROM products WHERE name = '$name'";
        $query = $connectionDB->query($sql);
        if($query->num_rows > 0){
            return true;
        }
        return false;
    }

    public function searchProducts($data){
        $connectionDB = $this->connection->connectDB();

        $sql = "SELECT * FROM products as pro INNER JOIN estados as es ON pro.state = es.id INNER JOIN categories as ca ON ca.id_category = pro.category WHERE es.estado = 'ACTIVO' AND name like '%$data%'";
        $query = $connectionDB->query($sql);

        $arrayTotal = array();

        while($row = $query->fetch_object()){
            $arrayObject = array(
                "id" => $row->id_product,
                "nameproduct" => $row->name,
                "brand" => $row->brand,
                "amount" => $row->amount,
                "price" => $row->price,
                "codeProduct" => $row->codeProduct,
                "id_category" => $row->codeProduct,
                "category" => $row->category,
                "state" => $row->state,

            );
            array_push($arrayTotal, $arrayObject);
        }
        return $arrayTotal;
    }
}