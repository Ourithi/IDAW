<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
header("Cache-Control: no-cache");

require_once('config.php');
require_once('init_pdo.php');
$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case 'GET':
        //on initialise une liste d'aliment vide
        $aliments=array();
        if(isset($_GET['id_aliment'])){
            $query=$pdo->prepare('select * from `aliment` WHERE `ID_ALIMENT`="'.$_GET['id_aliment'].'"');
        }
        elseif(isset($_GET['where'])){
            $query=$pdo->prepare('select * from `aliment` WHERE nom_aliment LIKE "'.$_GET['where'].'%"');
        }
        else{
            $query=$pdo->prepare('select * from `aliment`');
        }
        
        $success=$query->execute();

        if($success){
            //on loop sur toutes les lignes du tableau et on fait un array par aliment qu'on met dans un array qui les contient tous
            while($ligne=($query->fetch(PDO::FETCH_OBJ))){
                array_push($aliments,$ligne);
            }
            http_response_code(200);
            echo json_encode($aliments);
        }
        else{
            http_response_code(500);
            echo json_encode(array("message"=> "Internal server error"));
        }
        break;


    case 'POST':

        $post=json_decode(file_get_contents('php://input'),true);
        $queryFields = "(";
        $queryValues = "(";
        if( isset($post['nom_aliment']) && isset($post['energie']) && isset($post['glucides']) && isset($post['lipides']) && isset($post['sucre']) && isset($post['fibres']) && isset($post['proteines']) && isset($post['sel'])){
            foreach ($post as $key => $value) {
                if($key !='id_aliment'){
                    $queryFields = $queryFields."`".$key."`,";
                    $queryValues = $queryValues."'".$value."',";
                }
                else{
                    //$id_aliment=$key;
                }
            }
            $queryFields = substr($queryFields, 0, -1);
            $queryValues = substr($queryValues, 0, -1);
            $queryFields = $queryFields.")";
            $queryValues = $queryValues.")";
            $queryString = "INSERT INTO `aliment` ".$queryFields." VALUES ".$queryValues;
            //echo json_encode($queryString);

            $query=$pdo->prepare($queryString);
            $success=$query->execute();
            if($success){
                $query=$query=$pdo->prepare('SELECT max(id_aliment) AS id_aliment FROM `aliment`');
                $success=$query->execute();
                if($success){
                    $id_aliment=$query->fetch(PDO::FETCH_OBJ);
                    echo json_encode($id_aliment);
                    http_response_code(201);
                }
                else{
                    http_response_code(500);
                    echo json_encode(array("message"=> "Internal server error"));
                }
            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
            }
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=> "Bad request"));
        }
        break;


    case 'PUT':

        $put=json_decode(file_get_contents('php://input'),true);
        if(isset($put['id_aliment'])){
            $queryString = "UPDATE `aliment` SET";
            foreach ($put as $key => $value) {
                if($key !='id_aliment'){
                    $queryString = $queryString."`".$key."`='".$value."' ,"; // Ajoute les valeurs a modifier a la query
                }
                else{
                    $id_aliment=$value;
                }
            }
            $queryString = substr($queryString, 0, -1); //on enlève la dernière virgule
            $queryString=$queryString."WHERE `ID_ALIMENT`=".$id_aliment;
            //echo json_encode($queryString);

            $query=$pdo->prepare($queryString);
            $success=$query->execute();
            if($success){
                $query=$pdo->prepare('SELECT * FROM `aliment`WHERE `ID_ALIMENT`="'.$id_aliment.'"');
                $success=$query->execute();
                if($success){
                    $user=$query->fetch(PDO::FETCH_OBJ);
                    echo json_encode($user);
                    http_response_code(200);

                }
                else{
                    http_response_code(500);
                    echo json_encode(array("message"=> "Internal server error"));
                }

            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
            }
        
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=> "Bad request"));
        }
        break;

    case 'DELETE':
        $del=json_decode(file_get_contents('php://input'), true);
        if(isset($del['id_aliment'])){
            $id_aliment=$del['id_aliment'];
            $query=$pdo->prepare("DELETE FROM `aliment` WHERE `id_aliment`=".$id_aliment);
            $success=$query->execute();
            if($success){
                http_response_code(200);
                echo json_encode(array(
                    'message'=> "L'aliment a bien été supprimé")
                );
            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
            }
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=> "Bad request"));
        }
        break;

    default:
            http_response_code(405);
            echo json_encode(array("message"=> "Method not allowed"));
            break;
}