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
        if(isset($_GET['id_repas'])){
            $values=array();
            $id_repas=$_GET['id_repas'];
            $query=$pdo->prepare('SELECT aliment.id_aliment, aliment.nom_aliment, aliment.energie,aliment.lipides,aliment.glucides,aliment.sucre,aliment.fibres,aliment.proteines,aliment.sel, contenir.quantite 
            FROM repas 
            INNER JOIN contenir ON repas.ID_REPAS = contenir.ID_REPAS
            INNER JOIN aliment ON aliment.id_aliment = contenir.ID_ALIMENT
            WHERE repas.id_repas= '.$id_repas);
            $success=$query->execute();

            if($success){
                //on loop sur toutes les lignes du tableau et on fait un array par aliment qu'on met dans un array qui les contient tous
                while($ligne=($query->fetch(PDO::FETCH_OBJ))){
                    array_push($values,$ligne);
                }
                http_response_code(200);
                echo json_encode($values);
            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
            }
        }
        else{
            //$query=$pdo->prepare('select * from `aliment`');
        }
        break;

    case 'DELETE':
        $del=json_decode(file_get_contents('php://input'), true);
        if(isset($del['id_repas']) && isset($del['id_aliment'])){
            $id_repas=$del['id_repas'];
            $id_aliment=$del['id_aliment'];
            $query=$pdo->prepare("DELETE FROM `contenir` WHERE `id_repas`=".$id_repas." AND `id_aliment`=".$id_aliment);
            $success=$query->execute();
            if($success){
                http_response_code(200);
                echo json_encode(array(
                    'message'=> "L'aliment a bien été supprimé du repas")
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
    
    case 'PUT':
        $put=json_decode(file_get_contents('php://input'), true);
        if(isset($put['id_repas']) && isset($put['id_aliment']) && isset($put['qte'])){
            $id_repas=$put['id_repas'];
            $id_aliment=$put['id_aliment'];
            $qte=$put['qte'];
            $query=$pdo->prepare("UPDATE `contenir` SET `quantite`=".$qte." WHERE `id_repas`=".$id_repas." AND `id_aliment`=".$id_aliment);
            $success=$query->execute();
            if($success){
                http_response_code(200);
                echo json_encode(array(
                    'message'=> "L'aliment a bien été modifié du repas")
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