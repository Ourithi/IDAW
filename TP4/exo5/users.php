<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once('config.php');
require_once('db_conn.php');
if($_SERVER['REQUEST_METHOD']== 'GET'){
    //on initialise une liste d'user vide
    $users=array();
    $query=$pdo->prepare('select * from `users`');
    $success=$query->execute();

    if($success){
        //on loop sur toutes les lignes du tableau et on fait un array par user qu'on met dans un array qui les contient tous
        while($ligne=($query->fetch(PDO::FETCH_OBJ))){
            $user=array(
                "id"=> $ligne->id,
                "name"=> $ligne->name,
                "email"=>$ligne->email
            );
            array_push($users,$user);
        }
        http_response_code(200);
        echo json_encode($users);
    }
    else{
        http_response_code(500);
        echo json_encode(array("message"=> "Internal server error"));
    }
}

elseif($_SERVER['REQUEST_METHOD']== 'POST')