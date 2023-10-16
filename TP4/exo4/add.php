<?php
    require_once('template_header.php');
    require_once('config.php');
    $connectionString = "mysql:host=". _MYSQL_HOST;
    if(defined('_MYSQL_PORT'))
        $connectionString .= ";port=". _MYSQL_PORT;
    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );
    $pdo = NULL;
    try {
        $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $erreur) {
        echo 'Erreur : '.$erreur->getMessage();
    }
    if(isset($_POST['user']) && isset($_POST['email'])){
        $user=$_POST['user'];
        $email=$_POST['email'];
        $request = $pdo->prepare('INSERT INTO `users`(`name`, `email`) VALUES ("'.$user.'","'.$email.'")');
        $request->execute();
        echo "<p>L'utilisateur à bien été ajouté</p><br><p><a href=users.php>Retour au tableau des utilisateurs</a></p>";
        
    }
