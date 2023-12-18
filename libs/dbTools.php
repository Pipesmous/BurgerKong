<?php 
	define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DB','test');

    function connectDB(){
        $conexion = new mysqli(HOST,USER,PASSWORD,DB);
        if(!$conexion){
            echo('<p style="font-size:5rem;color:red">ERROR CON LA CONEXION DE LA BASE DE DATOS</p>');
            exit;
        }
        return $conexion;
    }

    function query($sentence,$show){
        $db = connectDB();
        $response = $db->query($sentence);

        if($db->errno){
            if($show){
                echo('<p style="font-size:5rem;color:red">HAY UN ERROR EN LA SENTENCIA SQL</p>');
                echo $db->error;
            }
            return false;
        }
        if($response !== true){
            $result = $response->fetch_all(MYSQLI_ASSOC);
            return $result;
        }
        return -3;
    }

?>