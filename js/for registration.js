document.addEventListener('DOMContentLoaded', function() {
    var loginLink = document.getElementById('login-link');
    var registerLink = document.getElementById('register-link');

    // Проверяем значение из сессии и отображаем соответствующую форму
    var selectedForm = "<?php echo isset($_SESSION['selected_form']) ? $_SESSION['selected_form'] : 'register'?>";
    if (selectedForm === 'login') {
        document.getElementById('form_login').style.display = 'block';
        document.getElementById('registration_form').style.display = 'none';
    } else if (selectedForm === 'register') {
        document.getElementById('form_login').style.display = 'none';
        document.getElementById('registration_form').style.display = 'block';
    }

    if (loginLink) {
        loginLink.addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form_login').style.display = 'block';
            document.getElementById('registration_form').style.display = 'none';
        });
    }

    if (registerLink) {
        registerLink.addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('form_login').style.display = 'none';
            document.getElementById('registration_form').style.display = 'block';
        });
    }
});