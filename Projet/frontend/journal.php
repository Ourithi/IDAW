<?php require_once('header.html');
    require_once("template_menu.php");
    $currentPageId = 'journal';
    renderMenuToHTML($currentPageId);
?>

<table class="table" id="RepasTable">
        <thead>
            <tr>
                <th scope="col">Type de repas</th>
                <th scope="col">Contenu du repas</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>

<script>getRepasAjax(1,1);</script>