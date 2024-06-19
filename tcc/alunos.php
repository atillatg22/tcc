<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="assets/css/alunos.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<section class="home-section">
    <div class="container">
        <div class="text">Cadastro de Alunos</div>

        <div class="row">
            <div class="col-md-6">
                <input type="text" id="search-input" placeholder="Pesquisar alunos..." class="form-control">
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#addModal">
                    + NOVO
                </button>
            </div>
        </div>

        <div class="table-responsive table-container">
            <table class="table table-striped" id="alunos-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Matrícula</th>
                        <th>Turma</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';
                    $sql = "SELECT * FROM alunos";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['cpf']; ?></td>
                            <td><?php echo $row['matricula']; ?></td>
                            <td><?php echo $row['turma']; ?></td>
                            <td><?php echo $row['telefone']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td id="chave-<?php echo $row['id']; ?>"></td>
                            <td class="actions1">
                                <a href="#" class="btn btn-success edit-btn" data-toggle="modal" data-target="#editModal"
                                    data-id="<?php echo $row['id']; ?>" data-nome="<?php echo $row['nome']; ?>"
                                    data-cpf="<?php echo $row['cpf']; ?>" data-matricula="<?php echo $row['matricula']; ?>"
                                    data-turma="<?php echo $row['turma']; ?>"
                                    data-telefone="<?php echo $row['telefone']; ?>"
                                    data-email="<?php echo $row['email']; ?>"
                                    data-senha="<?php echo $row['senha']; ?>">Editar</a>
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
                <h5 class="modal-title" id="addModalLabel">Adicionar Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process.php" method="POST">
                    <div class="input-group">
                        <label for="add-nome">Nome</label>
                        <input type="text" name="nome" id="add-nome" required>
                    </div>
                    <div class="input-group">
                        <label for="add-cpf">CPF</label>
                        <input type="text" name="cpf" id="add-cpf" required>
                    </div>
                    <div class="input-group">
                        <label for="add-matricula">Matrícula</label>
                        <input type="text" name="matricula" id="add-matricula" required>
                    </div>
                    <div class="input-group">
                        <label for="add-turma">Turma</label>
                        <input type="text" name="turma" id="add-turma" required>
                    </div>
                    <div class="input-group">
                        <label for="add-telefone">Telefone</label>
                        <input type="text" name="telefone" id="add-telefone" required>
                    </div>
                    <div class="input-group">
                        <label for="add-email">Email</label>
                        <input type="email" name="email" id="add-email" required>
                    </div>
                    <div class="input-group">
                        <label for="add-senha">Senha</label>
                        <input type="password" name="senha" id="add-senha" required>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Adicionar</button>
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
                <h5 class="modal-title" id="editModalLabel">Editar Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process.php" method="POST">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="input-group">
                        <label for="edit-nome">Nome</label>
                        <input type="text" name="nome" id="edit-nome" required>
                    </div>
                    <div class="input-group">
                        <label for="edit-cpf">CPF</label>
                        <input type="text" name="cpf" id="edit-cpf" required>
                    </div>
                    <div class="input-group">
                        <label for="edit-matricula">Matrícula</label>
                        <input type="text" name="matricula" id="edit-matricula" required>
                    </div>
                    <div class="input-group">
                        <label for="edit-turma">Turma</label>
                        <input type="text" name="turma" id="edit-turma" required>
                    </div>
                    <div class="input-group">
                        <label for="edit-telefone">Telefone</label>
                        <input type="text" name="telefone" id="edit-telefone" required>
                    </div>
                    <div class="input-group">
                        <label for="edit-email">Email</label>
                        <input type="email" name="email" id="edit-email" required>
                    </div>
                    <div class="input-group">
                        <label for="edit-senha">Senha</label>
                        <input type="password" name="senha" id="edit-senha" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
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
    // Função para aceitar apenas números no campo de senha
    $('#add-senha, #edit-senha').on('input', function () {
        var senha = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
        $(this).val(senha);
    });

    $(document).ready(function () {
    // Intercepta a submissão do formulário de adição e edição de aluno
    $('#addModal form, #editModal form').submit(function (event) {
        // Verifica se a senha tem pelo menos 6 caracteres
        var senha = $(this).find('input[name="senha"]').val();
        if (senha.length < 6) {
            // Se a senha for menor que 6 caracteres, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'A senha deve ter no mínimo 6 números.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        }
    });
});

    // Função para aceitar apenas letras no campo de nome
    $('#add-nome, #edit-nome').on('input', function () {
        var nome = $(this).val().replace(/[^a-zA-ZÀ-ÿ\s]/g, ''); // Remove caracteres não alfabéticos
        $(this).val(nome);
    });

    // Função para formatar e validar o CPF
    $('#add-cpf, #edit-cpf').on('input', function () {
        var cpf = $(this).val().replace(/\D/g, '');
        if (cpf.length > 11) {
            cpf = cpf.slice(0, 11);
        }
        $(this).val(cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4"));
    });

    // Função para formatar e validar o telefone
    $('#add-telefone, #edit-telefone').on('input', function () {
        var telefone = $(this).val().replace(/\D/g, '');
        if (telefone.length > 11) {
            telefone = telefone.slice(0, 11);
        }
        $(this).val(telefone.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3"));
    });

    // Função para limitar o campo de matrícula a 7 números
    $('#add-matricula, #edit-matricula').on('input', function () {
        var matricula = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
        if (matricula.length > 7) {
            matricula = matricula.slice(0, 7); // Limita a 7 caracteres
        }
        $(this).val(matricula);
    });

    // Intercepta a submissão do formulário de adição de aluno
    $('#addModal form').submit(function (event) {
        // Verifica se o telefone, CPF, matrícula, nome e senha estão preenchidos corretamente
        var telefone = $('#add-telefone').val().replace(/\D/g, '');
        var cpf = $('#add-cpf').val().replace(/\D/g, '');
        var matricula = $('#add-matricula').val().replace(/\D/g, '');
        var nome = $('#add-nome').val();
        var senha = $('#add-senha').val();

        if (!nome.match(/^[a-zA-ZÀ-ÿ\s]+$/)) {
            // Se o nome conter caracteres inválidos, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Por favor, preencha corretamente o Nome.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        } else if (!senha.match(/^\d+$/)) {
            // Se a senha conter caracteres não numéricos, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'A senha deve conter apenas números.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        } else if (telefone.length !== 11) {
            // Se o telefone estiver incorreto, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Por favor, preencha corretamente o Telefone.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        } else if (cpf.length !== 11) {
            // Se o CPF estiver incorreto, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Por favor, preencha corretamente o CPF.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        } else if (matricula.length !== 7) {
            // Se a matrícula estiver incorreta, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Por favor, preencha corretamente a Matrícula.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        }
    });

    // Intercepta a submissão do formulário de edição de aluno
    $('#editModal form').submit(function (event) {
        // Verifica se o telefone, CPF, matrícula, nome e senha estão preenchidos corretamente
        var telefone = $('#edit-telefone').val().replace(/\D/g, '');
        var cpf = $('#edit-cpf').val().replace(/\D/g, '');
        var matricula = $('#edit-matricula').val().replace(/\D/g, '');
        var nome = $('#edit-nome').val();
        var senha = $('#edit-senha').val();

        if (!nome.match(/^[a-zA-ZÀ-ÿ\s]+$/)) {
            // Se o nome conter caracteres inválidos, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Por favor, preencha corretamente o Nome.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        } else if (!senha.match(/^\d+$/)) {
            // Se a senha conter caracteres não numéricos, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'A senha deve conter apenas números.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        } else if (telefone.length !== 11) {
            // Se o telefone estiver incorreto, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Por favor, preencha corretamente o Telefone.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        } else if (cpf.length !== 11) {
            // Se o CPF estiver incorreto, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Por favor, preencha corretamente o CPF.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        } else if (matricula.length !== 7) {
            // Se a matrícula estiver incorreta, exibe o SweetAlert2 de erro
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Por favor, preencha corretamente a Matrícula.',
                confirmButtonText: 'OK'
            });

            // Impede a submissão do formulário
            event.preventDefault();
        }
    });
});

    $(document).ready(function () {
        // Função para atualizar o status da chave
        function atualizarStatusChave(aluno_id) {
            $.ajax({
                url: 'get-status-alunos.php',
                type: 'GET',
                data: { aluno_id: aluno_id },
                success: function (response) {
                    $('#chave-' + aluno_id).text(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Atualizar o status da chave para cada aluno na inicialização da página
        $('#alunos-table tbody tr').each(function () {
            var aluno_id = $(this).find('td:first').text();
            atualizarStatusChave(aluno_id);
        });

        // Atualizar o status da chave sempre que a página for carregada
        $('#alunos-table').on('draw.dt', function () {
            $('#alunos-table tbody tr').each(function () {
                var aluno_id = $(this).find('td:first').text();
                atualizarStatusChave(aluno_id);
            });
        });
    });
    // Este script será executado quando o DOM estiver pronto
    $(document).ready(function () {
        // Verifique se há mensagens de sucesso ou erro na URL
        const urlParams = new URLSearchParams(window.location.search);
        const msg = urlParams.get('msg');

        // Exiba os alertas com base na mensagem recebida
        if (msg === 'success') {
            // Mensagem de sucesso para adição de aluno
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Aluno adicionado com sucesso!',
                confirmButtonText: 'OK'
            });
        } else if (msg === 'updated') {
            // Mensagem de sucesso para atualização de aluno
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Aluno atualizado com sucesso!',
                confirmButtonText: 'OK'
            });
        } else if (msg === 'deleted') {
            // Mensagem de erro para exclusão de aluno
            Swal.fire({
                icon: 'error',
                title: 'Deletado!',
                text: 'Aluno deletado com sucesso!',
                confirmButtonText: 'OK'
            });
        }

        // Função para preencher o formulário de edição ao clicar em "Editar"
        $('.edit-btn').click(function () {
            var id = $(this).data('id');
            var nome = $(this).data('nome');
            var cpf = $(this).data('cpf');
            var matricula = $(this).data('matricula');
            var turma = $(this).data('turma');
            var telefone = $(this).data('telefone');
            var email = $(this).data('email');
            var senha = $(this).data('senha');

            $('#edit-id').val(id);
            $('#edit-nome').val(nome);
            $('#edit-cpf').val(cpf);
            $('#edit-matricula').val(matricula);
            $('#edit-turma').val(turma);
            $('#edit-telefone').val(telefone);
            $('#edit-email').val(email);
            $('#edit-senha').val(senha);
        });

        // Função para filtrar a tabela de alunos com base na entrada do usuário
        $('#search-input').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('#alunos-table tbody tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $('.delete-btn').click(function (event) {
    event.preventDefault();
    var aluno_id = $(this).data('id');

    // Verificar se o aluno possui empréstimos
    $.ajax({
        url: 'get-status-alunos.php',
        type: 'GET',
        data: { aluno_id: aluno_id },
        success: function (response) {
            if (response === 'Indisponível') {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Não é possível deletar um aluno que possui empréstimos pendentes.',
                    confirmButtonText: 'OK'
                });
            } else {
                // Se o aluno não tiver empréstimos pendentes, confirmar a exclusão
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
                        window.location.href = 'process.php?delete=' + aluno_id;
                    }
                });
            }
        }
    });
});



</script>
