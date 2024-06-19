<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="assets/css/alunos.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<section class="home-section">
    <div class="container">
        <div class="text">Empréstimo de Chaves</div>

        <form id="emprestimo-form" action="process.php" method="POST">
            <div class="form-group">
                <label for="chave-id">ID da Chave</label>
                <select id="chave-id" name="chave_id" class="form-control select2" required>
                    <option value="">Selecione a Chave</option>
                    <?php
                    include 'db.php';
                    $sql = "SELECT id FROM chaves WHERE disponivel = 1";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()):
                        echo '<option value="'.$row['id'].'">'.$row['id'].'</option>';
                    endwhile;
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="aluno-cpf">CPF do Aluno</label>
                <select id="aluno-cpf" name="aluno_cpf" class="form-control select2" required>
                    <option value="">Selecione o CPF do Aluno</option>
                    <?php
                    $sql = "SELECT id, cpf FROM alunos";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()):
                        echo '<option value="'.$row['cpf'].'" data-aluno-id="'.$row['id'].'">'.$row['cpf'].'</option>';
                    endwhile;
                    ?>
                </select>
            </div>

            <div id="aluno-info" style="display: none;">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="matricula">Matrícula</label>
                    <input type="text" id="matricula" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="turma">Turma</label>
                    <input type="text" id="turma" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
            </div>

            <button type="submit" id="submit-btn" name="add_emprestimo" class="btn btn-primary">Registrar Empréstimo</button>
        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Selecione uma opção",
            allowClear: true
        });

        $('#aluno-cpf').on('change', function () {
            var cpf = $(this).val();
            var aluno_id = $('#aluno-cpf option:selected').data('aluno-id');
            if (cpf) {
                $.ajax({
                    url: 'get_aluno.php',
                    type: 'GET',
                    data: { cpf: cpf },
                    success: function (data) {
                        var aluno = JSON.parse(data);
                        if (aluno) {
                            $('#nome').val(aluno.nome);
                            $('#matricula').val(aluno.matricula);
                            $('#turma').val(aluno.turma);
                            $('#telefone').val(aluno.telefone);
                            $('#email').val(aluno.email);
                            $('#aluno-info').show();
                        }
                    }
                });

                $.ajax({
                    url: 'get-status-alunos.php',
                    type: 'GET',
                    data: { aluno_id: aluno_id },
                    success: function (status) {
                        if (status === 'Indisponível') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro!',
                                text: 'Este aluno já possui uma chave emprestada.',
                                confirmButtonText: 'OK'
                            });
                            $('#submit-btn').prop('disabled', true);
                        } else {
                            $('#submit-btn').prop('disabled', false);
                        }
                    }
                });

            } else {
                $('#aluno-info').hide();
                $('#nome').val('');
                $('#matricula').val('');
                $('#turma').val('');
                $('#telefone').val('');
                $('#email').val('');
                $('#submit-btn').prop('disabled', false);
            }
        });

        $('#chave-id').on('change', function () {
            var chave_id = $(this).val();
            if (chave_id) {
                $.ajax({
                    url: 'get-status-chaves.php',
                    type: 'GET',
                    data: { chave_id: chave_id },
                    success: function (status) {
                        if (status === 'Indisponível') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro!',
                                text: 'Esta chave está indisponível para empréstimo.',
                                confirmButtonText: 'OK'
                            });
                            $('#submit-btn').prop('disabled', true);
                        } else {
                            $('#submit-btn').prop('disabled', false);
                        }
                    }
                });
            } else {
                $('#submit-btn').prop('disabled', false);
            }
        });
    });
</script>
