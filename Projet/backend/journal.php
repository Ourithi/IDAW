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
        //on récupère tous les aliments pour un repas
        $values=array();
        if(isset($_GET['date_min']) && $_GET['date_max'] && $_GET['id_user']){
            $date_min=$_GET['date_min'];
            $date_max=$_GET['date_max'];
            $id_user = $_GET['id_user'];
            $query=$pdo->prepare('SELECT repas.id_repas, repas.date_repas,aliment.nom_aliment, type.nom_type,aliment.energie,aliment.lipides,aliment.glucides,aliment.sucre,aliment.fibres,aliment.proteines,aliment.sel, contenir.quantite 
            FROM repas 
            INNER JOIN contenir ON repas.ID_REPAS = contenir.ID_REPAS
            INNER JOIN type ON type.ID_TYPE = repas.ID_TYPE
            INNER JOIN aliment ON aliment.id_aliment = contenir.ID_ALIMENT
            WHERE repas.date_repas BETWEEN" '.$date_min.'" AND "'.$date_max.'" AND repas.id_user ='.$id_user);
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


    }