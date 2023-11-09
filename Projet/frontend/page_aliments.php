<?php 
    session_start();
    require_once('header.html');
    require_once("template_menu.php");
    $currentPageId = 'page_aliments';
    renderMenuToHTML($currentPageId);
?>

<table class="table" id="AlimentsTable">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Energie (kcal)</th>
                <th scope="col">Lipides (g)</th>
                <th scope="col">Glucides (g)</th>
                <th scope="col">Sucres (g)</th>
                <th scope="col">Fibres (g)</th>
                <th scope="col">Proteines (g)</th>
                <th scope="col">Sel (g)</th>
                <th scope="col">Modifier/Supprimer</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
<div id="addAliment">
    <h2>Ajouter un aliment</h2>
    <form id="formAliment" onsubmit="addAlimentAjax();">
        <div class="form-group">
            <label for="nom_aliment">Nom de l'aliment</label>
            <input type="text" id="nom_aliment" name="nom_aliment" required>
        </div>
        <div class="form-group">
            <label for="energie">Energie (pour 100g)</label>
            <input type="number" id="energie" name="energie" required>
        </div>
        <div class="form-group">
            <label for="lipides">Lipides (pour 100g)</label>
            <input type="number" id="lipides" name="lipides" required>
        </div>
        <div class="form-group">
            <label for="glucides">Lipides (pour 100g)</label>
            <input type="number" id="glucides" name="glucides" required>
        </div>
        <div class="form-group">
            <label for="sucre">Sucre (pour 100g)</label>
            <input type="number" id="sucre" name="sucre" required>
        </div>
        <div class="form-group">
            <label for="fibres">Fibres (pour 100g)</label>
            <input type="number" id="fibres" name="fibres" required>
        </div>
        <div class="form-group">
            <label for="proteines">Lipides (pour 100g)</label>
            <input type="number" id="proteines" name="proteines" required>
        </div>
        <div class="form-group">
            <label for="sel">Sel (pour 100g)</label>
            <input type="number" id="sel" name="sel" required>
        </div>
        <div class="form-group">
            <button type="submit">Ajouter</button>
        </div>
</form>
</div>



<script>defTableAliments()</script>