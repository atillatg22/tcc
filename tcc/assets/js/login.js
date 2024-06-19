const users = {
    "admin": "admin"
};

document.getElementById('loginButton').addEventListener('click', function() {
    const login = document.getElementById('login').value;
    const senha = document.getElementById('senha').value;
    const recaptchaResponse = grecaptcha.getResponse(); // Obtém a resposta do reCAPTCHA
    if (login.trim() === '' || senha.trim() === '') {
        // Exibe mensagem de erro se o login ou a senha estiverem em branco
        document.getElementById('blankFieldsErrorMessage').style.display = 'block';
        // Oculta a mensagem após 10 segundos
        setTimeout(function() {
            document.getElementById('blankFieldsErrorMessage').style.display = 'none';
        }, 4000);
        // Limpa os campos de login e senha
        document.getElementById('login').value = '';
        document.getElementById('senha').value = '';
    } else if (users[login] && users[login] === senha) {
        if (recaptchaResponse !== '') {
            // Adiciona classe para animar a saída suave da tela de login
            document.getElementById('loginContainer').classList.add('fade-out');
            // Redireciona para o site após a animação
            setTimeout(function() {
                window.location.href = 'assets/menu.php'; // Altere para o site desejado
            }, 100);
        } else {
            // Exibe mensagem de erro se o reCAPTCHA não estiver ativado
            document.getElementById('recaptchaErrorMessage').style.display = 'block';
            // Oculta a mensagem após 10 segundos
            setTimeout(function() {
                document.getElementById('recaptchaErrorMessage').style.display = 'none';
            }, 4000);
        }
    } else {
        // Exibe mensagem de erro
        document.getElementById('errorMessage').style.display = 'block';
        // Oculta a mensagem após 10 segundos
        setTimeout(function() {
            document.getElementById('errorMessage').style.display = 'none';
        }, 4000);
        // Limpa os campos de login e senha
        document.getElementById('login').value = '';
        document.getElementById('senha').value = '';
    }
});
