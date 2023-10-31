<?php require_once('header.html');
    require_once("template_menu.php");
    $currentPageId = 'journal';
    renderMenuToHTML($currentPageId);
?>

<div id="inputDates">
    <input id="dateMin" type="date" value="2023-10-30" min="2018-01-01" max="2023-12-31">
    <input id="dateMax" type="date" value="2023-10-31" min="2018-01-01" max="2023-12-31">
</div>
<table class="table" id="JournalTable">
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

<script>getValuesJournalAjax("2023-07-12","2023-07-15");</script>