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
    
</script>

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


