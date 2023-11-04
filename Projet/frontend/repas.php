<?php 
    session_start();
    if(isset($_SESSION['id_user'])){
        $id_user =$_SESSION['id_user'];
    }
    else{
        header('Location: ./login.php');
    }

    require_once('header.html');

    require_once("template_menu.php");
    $currentPageId = 'repas';
    renderMenuToHTML($currentPageId);
    if(isset($_GET['id_repas'])){
        $id_repas =$_GET['id_repas'];
    }
    else{
        header('Location: ./login.php');
    }
?>

<script>
    var id_repas=<?php echo json_encode($id_repas);?>;
</script>


<table class="table" id="RepasTable">
        <thead>
            <tr>
                <th scope="col">Id aliment</th>
                <th scope="col">Nom</th>
                <th scope="col">Energie (kcal)</th>
                <th scope="col">Lipides (g)</th>
                <th scope="col">Glucides (g)</th>
                <th scope="col">Sucres (g)</th>
                <th scope="col">Fibres (g)</th>
                <th scope="col">Proteines (g)</th>
                <th scope="col">Sel (g)</th>
                <th scope="col">Quantite (g)</th>
                <th scope="col">Edit/delete</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>

<script>defTableAlimentsRepas(id_repas)</script>