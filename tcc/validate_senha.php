<?php
include 'db.php';

if (isset($_POST['cpf']) && isset($_POST['senha'])) {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $sql = "SELECT senha FROM alunos WHERE cpf = '$cpf'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['senha'] === $senha) {
            echo 'valid';
        } else {
            echo 'invalid';
        }
    } else {
        echo 'invalid';
    }
}
?>
