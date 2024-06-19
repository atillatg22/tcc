<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="assets/css/alunos.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

<style>
    .chart-container {
        position: relative;
        margin: auto;
        width: 100%;
        height: auto;
    }

    canvas {
        display: block;
        width: 100%;
        height: auto;
    }
</style>

<section class="home-section">
<div class="container">
    <div class="text">Dashboard</div>
    <div class="chart-container">
        <canvas id="myChart"></canvas>
    </div>
    </div>
</section>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total de Empréstimos', 'Total de Chaves Cadastradas', 'Total de Alunos Cadastrados'],
            datasets: [{
                label: 'Quantidade',
                data: [<?php
        include 'db.php';
        $sql = "SELECT COUNT(*) AS total_emprestimos FROM emprestimos";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo $row['total_emprestimos'];
    ?>, <?php
    include 'db.php';
    $sql = "SELECT COUNT(*) AS total_chaves FROM chaves";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo $row['total_chaves'];
?>, <?php
include 'db.php';
$sql = "SELECT COUNT(*) AS total_alunos FROM alunos";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo $row['total_alunos'];
?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
