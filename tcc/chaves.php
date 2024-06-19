<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="assets/css/alunos.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<section class="home-section">
    <div class="container">
        <div class="text">Cadastro de Chaves</div>

        <div class="row">
            <div class="col-md-6">
                <input type="text" id="search-input" placeholder="Pesquisar chaves..." class="form-control">
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#addModal">
                    + NOVO
                </button>
            </div>
        </div>

        <div class="table-responsive table-container">
            <table class="table table-striped" id="chaves-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prateleira</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';
                    $sql = "SELECT * FROM chaves";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['prateleira']; ?></td>
                            <td id="status-<?php echo $row['id']; ?>"></td>
                            <td class="actions">
                            <a href="#" class="btn btn-success edit-btn" data-toggle="modal" data-target="#editModal"
                                    data-id="<?php echo $row['id']; ?>" data-prateleira="<?php echo $row['prateleira']; ?>">Editar</a>
                                <a href="#" class="btn btn-danger delete-btn" data-id="<?php echo $row['id']; ?>">Deletar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal de Adição -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Adicionar Chave</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process.php" method="POST">
                    <div class="input-group">
                        <label for="add-prateleira">Prateleira</label>
                        <input type="text" name="prateleira" id="add-prateleira" required>
                    </div>
                    <button type="submit" name="add_chave" class="btn btn-primary">Adicionar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Chave</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process.php" method="POST">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="input-group">
                        <label for="edit-prateleira">Prateleira</label>
                        <input type="text" name="prateleira" id="edit-prateleira" required>
                    </div>
                    <button type="submit" name="update_chave" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
    // Função para formatar e validar o campo de prateleira
    $('#add-prateleira, #edit-prateleira').on('input', function () {
        var prateleira = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
        if (prateleira.length > 3) {
            prateleira = prateleira.slice(0, 3); // Limita a 3 caracteres
        }
        if (prateleira.length > 1) {
            // Adiciona um hífen após o primeiro número
            prateleira = prateleira.slice(0, 1) + '-' + prateleira.slice(1);
        }
        $(this).val(prateleira);
    });

    // Intercepta a submissão do formulário de adição de chave
    $('#addModal form').submit(function (event) {
        // Verifica se a prateleira está preenchida corretamente
        var prateleira = $('#add-prateleira').val().replace(/\D/g, ''); // Remove caracteres não numéricos
        if (prateleira.length !== 3) {
            // Se a prateleira estiver incorreta, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Por favor, preencha corretamente a prateleira.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        }
    });

    // Intercepta a submissão do formulário de edição de chave
    $('#editModal form').submit(function (event) {
        // Verifica se a prateleira está preenchida corretamente
        var prateleira = $('#edit-prateleira').val().replace(/\D/g, ''); // Remove caracteres não numéricos
        if (prateleira.length !== 3) {
            // Se a prateleira estiver incorreta, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Por favor, preencha corretamente a prateleira.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        }
    });
});

    $(document).ready(function () {
        // Função para atualizar o status da chave
        function atualizarStatusChave(chave_id) {
            $.ajax({
                url: 'get-status-chaves.php',
                type: 'GET',
                data: { chave_id: chave_id },
                success: function (response) {
                    $('#status-' + chave_id).text(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Atualizar o status da chave para cada chave na inicialização da página
        $('#chaves-table tbody tr').each(function () {
            var chave_id = $(this).find('td:first').text();
            atualizarStatusChave(chave_id);
        });

        // Atualizar o status da chave sempre que a página for carregada
        $('#chaves-table').on('draw.dt', function () {
            $('#chaves-table tbody tr').each(function () {
                var chave_id = $(this).find('td:first').text();
                atualizarStatusChave(chave_id);
            });
        });
    });
    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        const msg = urlParams.get('msg');

        if (msg === 'success_chave') {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Chave adicionada com sucesso!',
                confirmButtonText: 'OK'
            });
        } else if (msg === 'updated_chave') {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Chave atualizada com sucesso!',
                confirmButtonText: 'OK'
            });
        } else if (msg === 'deleted_chave') {
            Swal.fire({
                icon: 'error',
                title: 'Deletado!',
                text: 'Chave deletada com sucesso!',
                confirmButtonText: 'OK'
            });
        }

        $('.edit-btn').click(function () {
            var id = $(this).data('id');
            var prateleira = $(this).data('prateleira');

            $('#edit-id').val(id);
            $('#edit-prateleira').val(prateleira);
        });

        $('#search-input').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('#chaves-table tbody tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    // Interceptar o clique no botão de deletar
    $('.delete-btn').click(function (event) {
            event.preventDefault();
            var chave_id = $(this).data('id');

            // Verificar se a chave está emprestada
            $.ajax({
                url: 'get-status-chaves.php',
                type: 'GET',
                data: { chave_id: chave_id },
                success: function (response) {
                    if (response === 'Indisponível') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: 'Não é possível deletar uma chave que está sendo emprestada.',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        // Se a chave estiver disponível, proceder com a exclusão
                        Swal.fire({
                            title: 'Você tem certeza?',
                            text: "Você não poderá desfazer essa ação!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sim, deletar!',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirecionar para o process.php com a ação de deletar
                                window.location.href = 'process.php?delete_chave=' + chave_id;
                            }
                        });
                    }
                }
            });
        });
</script>