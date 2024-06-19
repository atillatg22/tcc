<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="assets/css/alunos.css">

<section class="home-section">
    <div class="container">
        <div class="text">Relatório de Empréstimos de Chaves</div>
        
        <div class="table-responsive table-container">
            <table class="table table-striped" id="emprestimos-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Chave</th>
                        <th>CPF</th>
                        <th>Data do Empréstimo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';
                    $sql = "SELECT * FROM emprestimos WHERE data_devolucao IS NULL";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['chave_id']; ?></td>
                            <td><?php echo $row['aluno_cpf']; ?></td>
                            <td><?php echo $row['data_emprestimo']; ?></td>
                            <td>
                                <button class="btn btn-warning" data-id="<?php echo $row['id']; ?>">
                                    <i class="fas fa-key"></i> Devolver
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Capturar o clique no botão de devolução
        $('button.btn-warning').click(function () {
            var emprestimo_id = $(this).data('id');

            // Exibir uma confirmação antes de proceder com a devolução
            Swal.fire({
                title: 'Tem certeza?',
                text: "Esta ação irá devolver a chave emprestada!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, devolver!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar solicitação AJAX para atualizar a data de devolução no banco de dados
                    $.ajax({
                        url: 'devolver-emprestimo.php',
                        type: 'POST',
                        data: { emprestimo_id: emprestimo_id },
                        success: function (response) {
                            // Atualizar a página após a devolução
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    });
</script>
