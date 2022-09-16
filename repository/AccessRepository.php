<?php
include '../config/ConfigDB.php';
class AccessRepository{

    private $connection;

    public function __construct(){
        $this->connection = new ConfigDB();
    }

    public function getUser($username){
        $connectionDB = $this->connection->connectDB();

        $sql = "SELECT * FROM PERSONAS WHERE username = '$username'";
        $query = $connectionDB->query($sql);
        if($query->num_rows > 0){
            if($row = $query->fetch_object()){
                return array(
                    "id" => $row->id_user,
                    "username" => $row->username,
                    "token" => $row->token,
                    "password" => $row->password
                );
            }
        }
        return null;
    }

    public function refreshToken($id, $token){
        $conectar = $this->connection->connectDB();
        $sql = "UPDATE personas
            SET token = '$token'
            WHERE id_user = $id";
        return $conectar->query($sql);
        
    }

    public function getTokenUser($idUser){
        $connectionDB = $this->connection->connectDB();

        $sql = "SELECT * FROM PERSONAS WHERE id_user = '$idUser'";
        $query = $connectionDB->query($sql);
        if($query->num_rows > 0){
            if($row = $query->fetch_object()){
                return $row->token;
            }
        }
        return null;
    }
}