<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['chave_id'])) {
    $chave_id = $_GET['chave_id'];

    // Verificar se a chave está emprestada
    $sql = "SELECT aluno_cpf FROM emprestimos WHERE chave_id = '$chave_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Indisponível";
    } else {
        echo "Disponível";
    }
}
?>
