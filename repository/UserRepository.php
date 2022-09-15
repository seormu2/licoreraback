<?php

class UserRepository{

    private $connection;

    public function __construct(){
        $this->connection = new ConfigDB();
    }

    public function updateUsername($id, $username){
       $connectDB = $this->connection->connectDB();

        $sql = "UPDATE personas SET username = '$username' WHERE id_user = '$id'";
        return $connectDB->query($sql);
    }

    public function updatePassword($id, $password){
        $connectDB = $this->connection->connectDB();

        $sql = "UPDATE personas SET password = '$password' WHERE id_user = '$id'";
        return $connectDB->query($sql);
    }

    public function getUser($id){
        $connectDB = $this->connection->connectDB();

        $sql = "SELECT * FROM personas WHERE id_user = '$id'";
        $query = $connectDB->query($sql);

        if($query->num_rows > 0){
            if($row = $query->fetch_object()){
                return array(
                    "id" => $row->id_user,
                    "username" => $row->username,
                    "token" => $row->token
                );
            }
        }
        return null;
    }

    public function userExists($username){
        $connectDB = $this->connection->connectDB();

        $sql = "SELECT * FROM personas WHERE username = '$username'";
        $query = $connectDB->query($sql);
        if($query->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

}