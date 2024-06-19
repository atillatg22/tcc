<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="login-container" id="loginContainer">
        <img src="assets/img/senai-logo.png" alt="Logomarca" width="200">
        <form action="process.php" method="POST" id="loginForm">
            <label for="username">Login</label>
            <input type="text" id="username" name="username" placeholder="Digite seu login">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha">
            <button type="submit" value="Login" id="loginButton">Entrar</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginForm = document.getElementById('loginForm');
        
        loginForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Evita o envio padrão do formulário

            const formData = new FormData(loginForm);
            
            fetch('process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = 'dashboard.php'; // Redireciona para o painel após o login bem-sucedido
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Login ou senha incorretos!',
                    showConfirmButton: true,
                    confirmButtonText: 'Tentar Novamente'
                });
            });
        });
    });
</script>

</html>
