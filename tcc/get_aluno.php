<?php
include 'db.php';

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];
    $sql = "SELECT * FROM alunos WHERE cpf = '$cpf'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $aluno = $result->fetch_assoc();
        echo json_encode($aluno);
    } else {
        echo json_encode([]);
    }
}
?>
