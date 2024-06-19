<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emprestimo_id'])) {
    $emprestimo_id = $_POST['emprestimo_id'];
    $data_devolucao = date('Y-m-d H:i:s');

    // Atualizar o empréstimo no banco de dados para registrar a data de devolução
    $sql = "UPDATE emprestimos SET data_devolucao = '$data_devolucao' WHERE id = $emprestimo_id";

    if ($conn->query($sql) === TRUE) {
        // Recuperar o ID da chave do empréstimo devolvido
        $chave_id_query = "SELECT chave_id FROM emprestimos WHERE id = $emprestimo_id";
        $chave_id_result = $conn->query($chave_id_query);
        if ($chave_id_result->num_rows > 0) {
            $chave_id_row = $chave_id_result->fetch_assoc();
            $chave_id = $chave_id_row['chave_id'];
            
            // Marcar a chave como disponível
            $update_chave_query = "UPDATE chaves SET disponivel = 1 WHERE id = $chave_id";
            if ($conn->query($update_chave_query) === TRUE) {
                echo "Empréstimo devolvido e chave marcada como disponível com sucesso!";
            } else {
                echo "Erro ao atualizar chave: " . $conn->error;
            }
        }
    } else {
        echo "Erro ao devolver empréstimo: " . $conn->error;
    }

    $conn->close();
}
?>
