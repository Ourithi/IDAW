<?php
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
    $request = $pdo->prepare("select * from users");
    // TODO: add your code here
    // retrieve data from database using fetch(PDO::FETCH_OBJ) and
    // display them in HTML array
    /*** close the database connection ***/
    require_once('template_header.php');
    $request->execute();

    echo "<table><thead><tr><th>id</th><th>name</th><th>email</th></thead><tbody>";
    while($ligne=($request->fetch(PDO::FETCH_OBJ))){
        //echo $ligne;
        echo "<tr><td>".$ligne->id."</td><td>".$ligne->name."</td><td>".$ligne->email."</td></tr>";
    }
    echo "</tbody>";
    echo "</body>";
    $pdo = null;
