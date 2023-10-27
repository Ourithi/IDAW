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
        $get=json_decode(file_get_contents('php://input'),true);
        if (isset($_GET['id_user'])){
            $id_user=$_GET['id_user'];
            if(isset($_GET['id_repas'])){
                $id_repas=$_GET['id_repas'];
                $query=$pdo->prepare('SELECT id_type, date_repas from `user` JOIN `repas` ON user.ID_USER = repas.ID_USER where `id_repas`="'.$id_repas.'"');
                $success=$query->execute();
                if ($success){
                    $repas=$query->fetch(PDO::FETCH_OBJ);
                    if ($repas){
                        echo json_encode($repas);
                        http_response_code(200);
                    }
                    else{
                        http_response_code(400);
                        echo json_encode(array("message"=> "User doesn't exist"));
                    }

                }
                else{
                    http_response_code(500);
                    echo json_encode(array("message"=> "Internal server error"));
                }
            }
            elseif(isset($_GET['date_max']) && isset($_GET['date_min'])){

            }
        }
        else{
            http_response_code(400);
            echo json_encode(array("message"=> "Bad request"));
        }
        
        break;


    case 'POST':

        $post=json_decode(file_get_contents('php://input'),true);
        //echo json_encode($post);
        if(isset($post['id_user']) && isset($post['date']) && isset($post['id_type']) ){
            $id_user=$post['id_user'];
            $date=$post['date'];
            $id_type=$post['id_type'];
            $query=$pdo->prepare('INSERT INTO `repas`( `id_user`, `date_repas`, `id_type`) VALUES ("'.$id_user.'","'.$date.'","'.$id_type.'")');
            $success=$query->execute();
            if($success){
                $query=$pdo->prepare('SELECT max(id_repas) AS id_repas FROM `repas`');
                $success=$query->execute();
                if($success){
                    $id_repas=$query->fetch(PDO::FETCH_OBJ);
                    echo json_encode($id_repas);
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
        if(isset($put['id_repas'])){
            $queryString = "UPDATE `repas` SET";
            foreach ($put as $key => $value) {
                if($key !='id_repas'){
                    $queryString = $queryString."`".$key."`='".$value."' ,"; // Ajoute les valeurs a modifier a la query
                }
                else{
                    $id_repas=$value;
                }
            }
            $queryString = substr($queryString, 0, -1); //on enlève la dernière virgule
            $queryString=$queryString."WHERE `ID_REPAS`=".$id_repas;
            //echo json_encode($queryString);

            $query=$pdo->prepare($queryString);
            $success=$query->execute();
            if($success){
                $query=$pdo->prepare('SELECT * FROM `repas`WHERE `ID_REPAS`="'.$id_repas.'"');
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
        if(isset($del['id_repas'])){
            $id_repas=$del['id_repas'];
            $query=$pdo->prepare("DELETE FROM `repas` WHERE `ID_repas`=".$id_repas);
            $success=$query->execute();
            if($success){
                http_response_code(200);
                echo json_encode(array(
                    'message'=> "Le repas a bien été supprimé")
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