<?php

class Token{

    public static function generateToken(){
        return bin2hex(random_bytes((16 - (16 % 2)) / 2));
    }
}