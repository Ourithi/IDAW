<?php require_once('header.html');
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
                <th scope="col">Edit/delete</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>

<script>defTable()</script>