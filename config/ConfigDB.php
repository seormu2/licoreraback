<?php
//include 'Constants.php';

class ConfigDB{

    private $host;
    private $username;
    private $password;
    private $nameBD;
    private $connection;

    public function __construct(){
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->nameBD = "guacharos";
    }

    public function connectDB(){
        $this->connection = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->nameBD
        );
        return $this->connection;
    }

    public function disconnect(){
        return $this->connection->close();
    }

}