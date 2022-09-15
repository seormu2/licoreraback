<?php
class ResponseHTTP{

    public static function response404($mensaje){
        http_response_code(404);
        return json_encode(array(
            "message" => $mensaje,
            "status" => 404
        ));
    }

    public static function response500($mensaje){
        http_response_code(500);
        return json_encode(array(
            "message" => $mensaje,
            "status" => 500
        ));
    }

    public static function response200($datos,$mensaje){
        http_response_code(200);
        return json_encode(array(
            "data" => $datos,
            "message" => $mensaje,
            "status" => 200
        ));
    }

    public static function response401($mensaje){
        http_response_code(401);
        return json_encode(array(
            "message" => $mensaje,
            "status" => 401
        ));
    }
}