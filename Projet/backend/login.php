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
        //check params pour login
        if(isset($_GET['name']) && isset($_GET['pwd'])){
            $name=$_GET['name'];
            $pwd=$_GET['pwd'];
            $query=$pdo->prepare('SELECT `id_user` from `user` where `name`="'.$name.'"and `pwd`="'.$pwd.'"');
            $success=$query->execute();
            //check succès query
            if ($success){
                $id_user=$query->fetch(PDO::FETCH_OBJ);
                //check match user/pwd
                if ($id_user){
                    http_response_code(200);
                    echo json_encode($id_user);
                }
                else{
                    http_response_code(401);
                    echo json_encode(array("message"=> "Mauvais nom d'utilisateur/mot de passe"));
                }
            }
            else{
                http_response_code(500);
                echo json_encode(array("message"=> "Internal server error"));
            }
        }
}