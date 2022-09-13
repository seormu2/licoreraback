<?php
class SecurityApp {

    private $connection;

    public function __construct(){
        $this->connection = new ConfigDB();
    }

    public static function verify($password, $hash){
        return password_verify($password, $hash);
    }

    public static function hash($password) {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);
    }

    public static function realEscapeString($data){
        //$connectionDB = $this->connection->connectDB();
        $connection = new ConfigDB();
        $connectionDB = $connection->connectDB();
        return $connectionDB->real_escape_string($data);
    }
}