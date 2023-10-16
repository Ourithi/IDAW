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
    if(isset($_POST['user']) && isset($_POST['email']) && isset($_POST['id'])){
        $user=$_POST['user'];
        $email=$_POST['email'];
        $request = $pdo->prepare('UPDATE `users` SET `name`="'.$user.'",`email`="'.$email.'" WHERE `id`="'.$_POST['id'].'"');
        $request->execute();
        echo "<p>L'utilisateur à bien été modifié</p><br>";
    }
    elseif(isset($_POST['user']) && isset($_POST['email'])){
        $user=$_POST['user'];
        $email=$_POST['email'];
        $request = $pdo->prepare('INSERT INTO `users`(`name`, `email`) VALUES ("'.$user.'","'.$email.'")');
        $request->execute();
        echo "<p>L'utilisateur à bien été ajouté</p><br>";
    }

    if(isset($_POST['delete'])){
        $request = $pdo->prepare("delete from `users` WHERE `id` =".$_POST['delete']);
        $request->execute();
        echo "<p>L'utilisateur à bien été supprimé</p><br>";
        
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
        $delete= '<td><form action="users.php" method="POST"><input type="hidden"  name="delete" value="'.$ligne->id.'"><input type="submit" value="Supprimer"></form></td>';
        echo "<tr><td>".$ligne->id."</td><td>".$ligne->name."</td><td>".$ligne->email."</td>".$delete."</tr>";
    }
    echo "</tbody></table>";

    $pdo = null;
?>
<br>
<br>
<tr>
    <form action="users.php" method="POST">
        <label for="user">user: </label>
        <input type="text" id="user" name="user"><br><br>
        <label for="lname">email: </label>
        <input type="text" id="email" name="email"><br><br>
        <button type="submit" value="Ajouter">Ajouter</button>
    </form>
</tr>
<tr>
    <form action="users.php" method="POST">
        <label for="id">Id de l'utilisateur à modifier: </label>
        <input type="text" id="id" name="id"><br><br>
        <label for="user">user: </label>
        <input type="text" id="user" name="user"><br><br>
        <label for="lname">email: </label>
        <input type="text" id="email" name="email"><br><br>
        <button type="submit" value="Ajouter">Ajouter</button>
    </form>
</tr>
</body>