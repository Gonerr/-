var hotelIDs = [];
          $(document).ready(function() {
              // Загрузка карточек при загрузке страницы
              loadCards();
          });

          function loadCards() {
                hotelIDs = [];
                $.ajax({
                    url: '../require/database_of_hotels.php',
                    method: 'GET',
                    success: function(data) {
                        $('#all-container35').html(data);
                    },
                    error: function(xhr, status, error) {
                        $('#all-container35').html('<p>Ошибка загрузки данных: ' + error + '</p>');
                    }
                });
            }

            function filteredCards_afterPreSearch() {
              console.log('функция вызвана');
              
                $.ajax({
                    url: '../require/database_of_hotels.php',
                    method: 'POST',
                    data: {
                      hotels: hotelIDs
                    },
                    success: function(data) {
                        $('#all-container35').html(data);
                    },
                    error: function(xhr, status, error) {
                        $('#all-container35').html('<p>Ошибка загрузки данных: ' + error + '</p>');
                    }
                });
            }

            function FindRooms(event) {
              event.preventDefault();
              console.log('ищем номера');

               // Получаем значения из формы
              var locationTypes = $('#LocationType').val();
              var arrivalDate = $('#arrivalDate').val();
              var departureDate = $('#departureDate').val();

              // Получаем текст из элемента Button_Count
              var buttonCountText = document.getElementById('Button_Count').textContent;

              // Удаляем все символы, кроме цифр, из текста
              var digitsOnly = buttonCountText.replace(/\D/g, '');

              // Преобразуем строку в массив цифр и суммируем их
              var countOfPeople = digitsOnly.split('').reduce((acc, digit) => acc + parseInt(digit), 0);

                $.ajax({
                    url: '../require/find_the_rooms.php',
                    method: 'POST',
                    data: {
                      locationType: locationTypes,
                      countOfPeople: countOfPeople,
                      arrivalDate: arrivalDate,
                      departureDate: departureDate
                    },
                    success: function(data) {
                        $('#all-container35').html(data);

                         // Предположим, что data содержит JSON-массив с ID мест
                        hotelIDs = JSON.parse(data);
                        console.log('Найденные ID мест:', hotelIDs);
                        
                        if (hotelIDs.length === 0){
                          $('#all-container35').html('<p> Извините, для выбранных данных сейчас нет подходящих отелей <br> Попробуйте изменить число прибывающих или даты заезда </p> ');
                        }else{
                          // Теперь вызовем вторую функцию после получения данных
                          filteredCards(event)
                        }
                        
                    },
                    error: function(xhr, status, error) {
                        $('#all-container35').html('<p>Ошибка загрузки данных: ' + error + '</p>');
                    }
                });
            }
            function filteredCards(event) {
              event.preventDefault();
              console.log('функция вызвана');

               // Собираем значения всех выбранных чекбоксов
              var relaxTypes = [];
              $('input[name="type_of_relax[]"]:checked').each(function() {
                  relaxTypes.push($(this).val());
              });

              var foodTypes = [];
              $('input[name="food_type[]"]:checked').each(function() {
                  foodTypes.push($(this).val());
              });

              var services = [];
              $('input[name="service[]"]:checked').each(function() {
                  services.push($(this).val());
              });

              var budgets = $('input[name="budget"]:checked').val();

              // Получаем значение выбранной радиокнопки
              var rating = $('input[name="rate"]:checked').val();

              console.log(foodTypes,rating);
                $.ajax({
                    url: '../require/database_of_hotels.php',
                    method: 'POST',
                    data: {
                        hotels: hotelIDs,
                        type_of_relax: relaxTypes,
                        food_type: foodTypes,
                        service: services,
                        budget: budgets,
                        rating: rating
                    },
                    success: function(data) {
                        $('#all-container35').html(data);
                    },
                    error: function(xhr, status, error) {
                        $('#all-container35').html('<p>Ошибка загрузки данных: ' + error + '</p>');
                    }
                });
            }