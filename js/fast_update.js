function fetchData(event){
    event.preventDefault();
    var login = $('#login').val();
    var password = $('#password').val();
        $.ajax({
            url:    "require/for_index.php",
            type:     "POST", 
            data: {
                login: login,
                password: password
            },
            dataType: "json", 
            success: function(response) {
                console.log(response);
                $("#Warning").text(response.message); // обновляем текст в элементе с id 'Warning'
                if (response.success) {
                    window.location.href = 'pages/account.php'; // перенаправление на account.php
                }
            },
            error: function(xhr, status, error) {
                // console.error("Ошибка: ", xhr);
                $("#Warning").text("Произошла ошибка! Попробуйте зайти позже.");
            }
    });
}

