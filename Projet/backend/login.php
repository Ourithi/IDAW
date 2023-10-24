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
        //on initialise une liste d'user vide
        $get=json_decode(file_get_contents('php://input'),true);
        //check params pour login
        if(isset($get['name']) && isset($get['pwd'])){
            $name=$get['name'];
            $pwd=$get['pwd'];
            $query=$pdo->prepare('SELECT `id` from `users` where `name`="'.$name.'"and `pwd`="'.$pwd.'"');
            $success=$query->execute();
            //check succès query
            if ($success){
                $id=$query->fetch(PDO::FETCH_OBJ);
                //check match user/pwd
                if ($id){
                    http_response_code(200);
                    echo json_encode(array("message"=> "Success"));
                }
                else{
                    http_response_code(200);
                    echo json_encode(array("message"=> "Mauvais nom d'utilisateur/mot de passe"));
                }
            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
            }
        }
}