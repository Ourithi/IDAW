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
        if(isset($post['aliment']) && isset($post['email'])){
            $aliment=$post['aliment'];
            $email=$post['email'];
            $query=$pdo->prepare('INSERT INTO `aliments`(`name`, `email`) VALUES ("'.$aliment.'","'.$email.'")');
            $success=$query->execute();
            if($success){
                $query=$pdo->prepare('SELECT * FROM `aliments`WHERE `email`="'.$email.'"');
                $success=$query->execute();
                if($success){
                    $aliment=$query->fetch(PDO::FETCH_OBJ);
                    $aliment=array(
                        "id"=> $aliment->id,
                        "name"=> $aliment->name,
                        "email"=>$aliment->email
                    );
                    echo json_encode($aliment);
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

        if(isset($put['id']) && isset($put['name']) && isset($put['email'])){
            $id=$put['id'];
            $name=$put['name'];
            $email=$put['email'];
            $query=$pdo->prepare('UPDATE `aliments` SET `name`="'.$name.'",`email`="'.$email.'" WHERE `id`="'.$id.'"');
            $success=$query->execute();
            if($success){
                $query=$pdo->prepare('SELECT * FROM `aliments`WHERE `id`="'.$id.'"');
                $success=$query->execute();
                if($success){
                    $aliment=$query->fetch(PDO::FETCH_OBJ);
                    $aliment=array(
                        "id"=> $aliment->id,
                        "name"=> $aliment->name,
                        "email"=>$aliment->email
                    );
                    echo json_encode($aliment);
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
        if(isset($del['id'])){
            $id=$del['id'];
            $query=$pdo->prepare("DELETE FROM `aliments` WHERE `id`=".$id);
            $success=$query->execute();
            if($success){
                http_response_code(200);
                echo json_encode(array(
                    'message'=> "L'utilisateur a bien été supprimé")
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