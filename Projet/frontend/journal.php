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
    var id_user=<?php echo json_encode($id_user);?>;
    console.log(id_user);
    window.onload=function(){
        getValuesJournalAjax("2023-07-12","2023-07-15",id_user);
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
            <th scope="col">Id</th>
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

<div id="addRepas">
    <h2>Ajouter un repas</h2>
    <form id="meal-form">
            <div class="form-group">
                <label for="dateRepas">Date:</label>
                <input type="date" id="dateRepas" name="dateRepas" value="2023-10-30" min="2018-01-01" max="2023-12-31">
            </div>
            <div class="form-group">
                <label for="typeRepas">Type de repas:</label>
                <select name="typeRepas" id="typeRepas">
                    <option value="1">Petit-Déjeuner</option>
                    <option value="2">Déjeuner</option>
                    <option value="3">Goûter</option>
                    <option value="4">Dîner</option>
                </select>
            </div>
            
            <br>
</div>
<div class="form-group" id="ajoutAlimentFromDB">
    <label for="autocomplete">Search: </label>
    <input type="text" id="autocomplete">
    <div id="suggestions"></div>
    <input type="hidden" id="valueId">
    <p>Aliments du repas</p>
</div>
<div class="buttonWrapper">
    <input type="hidden" value="0" id="hasAliment">
    <button onclick="addAlimentFromDB(id_user);">Ajouter un aliment</button>
</div>
<div id="autocomplete-value">

</div>