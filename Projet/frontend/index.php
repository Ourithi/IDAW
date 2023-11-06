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
    document.addEventListener('DOMContentLoaded',function(){
        getGraphAjax("2023-07-7","2023-07-15",id_user);
    });
    window.onload=function(){
        document.getElementById("sendDates").onclick= function() {
            updateGraph(id_user);
        };
    };
</script>

<div id="inputDates">
    <input id="dateMin" type="date" value="2023-10-30" min="2018-01-01" max="2023-12-31">
    <input id="dateMax" type="date" value="2023-10-31" min="2018-01-01" max="2023-12-31">
    <button id="sendDates" type="submit">Actualiser</button>
</div>

<div class="charts-container">
    <div class="chart">
        <canvas id="energieChart"></canvas>
    </div>
    <div class="chart">
        <canvas id="glucidesChart"></canvas>
    </div>
    <div class="chart">
        <canvas id="sucreChart"></canvas>
    </div>
    <div class="chart">
        <canvas id="fibresChart"></canvas>
    </div>
    <div class="chart">
        <canvas id="proteinesChart"></canvas>
    </div>
    <div class="chart">
        <canvas id="selChart"></canvas>
    </div>
</div>


