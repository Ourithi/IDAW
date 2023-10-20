<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
header("Cache-Control: no-cache");

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

elseif($_SERVER['REQUEST_METHOD']== 'POST'){

    $post=json_decode(file_get_contents('php://input'),true);
    if(isset($post['user']) && isset($post['email'])){
        $user=$post['user'];
        $email=$post['email'];
        $query=$pdo->prepare('INSERT INTO `users`(`name`, `email`) VALUES ("'.$user.'","'.$email.'")');
        $success=$query->execute();
        if($success){
            $query=$pdo->prepare('SELECT * FROM `users`WHERE `email`="'.$email.'"');
            $success=$query->execute();
            if($success){
                $user=$query->fetch(PDO::FETCH_OBJ);
                $user=array(
                    "id"=> $user->id,
                    "name"=> $user->name,
                    "email"=>$user->email
                );
                echo json_encode($user);
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
}

elseif($_SERVER['REQUEST_METHOD']=='PUT'){

    $put=json_decode(file_get_contents('php://input'),true);

    if(isset($put['id']) && isset($put['name']) && isset($put['email'])){
        $id=$put['id'];
        $name=$put['name'];
        $email=$put['email'];
        $query=$pdo->prepare('UPDATE `users` SET `name`="'.$name.'",`email`="'.$email.'" WHERE `id`="'.$id.'"');
        $success=$query->execute();
        if($success){
            $query=$pdo->prepare('SELECT * FROM `users`WHERE `id`="'.$id.'"');
            $success=$query->execute();
            if($success){
                $user=$query->fetch(PDO::FETCH_OBJ);
                $user=array(
                    "id"=> $user->id,
                    "name"=> $user->name,
                    "email"=>$user->email
                );
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
}

elseif($_SERVER['REQUEST_METHOD']=='DELETE'){
    $del=json_decode(file_get_contents('php://input'), true);
    if(isset($del['id'])){
        $id=$del['id'];
        $query=$pdo->prepare("DELETE FROM `users` WHERE `id`=".$id);
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
}

else{
    http_response_code(405);
    echo json_encode(array("message"=> "Method not allowed"));
}