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
    $currentPageId = 'journal';
    renderMenuToHTML($currentPageId);
?>
<script>
    var id_user='<?php echo json_encode($id_user);?>';
    console.log(id_user);
    window.onload=function(){
        document.getElementById("sendDates").onclick= function() {
            updateJournal(id_user);
        };
    };
</script>

<div id="inputDates">
    <input id="dateMin" type="date" value="2023-10-30" min="2018-01-01" max="2023-12-31">
    <input id="dateMax" type="date" value="2023-10-31" min="2018-01-01" max="2023-12-31">
    <button id="sendDates" type="submit">Actualiser</button>
</div>
<table class="table" id="JournalTable">
        <thead>
            <tr>
                <th scope="col">Date du repas</th>
                <th scope="col">Type du repas</th>
                <th scope="col">Energie (kcal)</th>
                <th scope="col">Lipides (g)</th>
                <th scope="col">Glucides (g)</th>
                <th scope="col">Sucres (g)</th>
                <th scope="col">Fibres (g)</th>
                <th scope="col">Proteines (g)</th>
                <th scope="col">Sel (g)</th>
                <th scope="col">Voir le contenu du repas<th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>

<script>window.onload= function(){getValuesJournalAjax("2023-07-12","2023-07-15",id_user);
    };</script>