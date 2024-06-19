<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="assets/css/alunos.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<section class="home-section">
    <div class="container">
        <div class="text">Relatórios e Históricos de Empréstimos</div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID do Empréstimo</th>
                    <th>Chave</th>
                    <th>Aluno</th>
                    <th>Data de Empréstimo</th>
                    <th>Data de Devolução</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                
                // Consulta SQL para buscar os dados dos empréstimos
                $sql = "SELECT emprestimos.id, chaves.prateleira, alunos.nome, emprestimos.data_emprestimo, emprestimos.data_devolucao 
                        FROM emprestimos
                        JOIN chaves ON emprestimos.chave_id = chaves.id
                        JOIN alunos ON emprestimos.aluno_cpf = alunos.cpf
                        ORDER BY emprestimos.data_emprestimo DESC";
                
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['prateleira'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['data_emprestimo'] . "</td>";
                        echo "<td>" . ($row['data_devolucao'] ? $row['data_devolucao'] : 'Em aberto') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum empréstimo encontrado</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php include 'footer.php'; ?>
