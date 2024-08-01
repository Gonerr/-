var countOfPeople = 1;

function toggleVisibility() {
    const element = document.getElementById('rootElement');
    if (element.style.display === 'none' || element.style.display === '') {
        element.style.display = 'block';
    } else {
        element.style.display = 'none';
    }
}

function updateElementPosition() {
    const button = document.getElementById('Button_Count');
    const element = document.getElementById('rootElement');
    const buttonRect = button.getBoundingClientRect(); // Получаем размеры и позицию кнопки
    const date = document.getElementById('arrivalDate').getBoundingClientRect(); 
    const dateName = document.getElementById('arrivalDateName');


    const arrivalDateElement = document.getElementById('departureDate');
    if (arrivalDateElement !== null) {
        const date2 = document.getElementById('departureDate').getBoundingClientRect(); 
        const dateName2 = document.getElementById('nameDepartureDate');
        dateName2.style.top = date2.top + window.scrollY  + 'px';
        dateName2.style.left = date2.left + 5 + 'px';
    }
    

    const countOfMens= document.getElementById('Button_Count').getBoundingClientRect(); 
    const countName = document.getElementById('CountName');

    const LocationType= document.getElementById('LocationType').getBoundingClientRect(); 
    const LocationName = document.getElementById('LocationName');


    // Применяем координаты кнопки к элементу
    element.style.top = buttonRect.top + window.scrollY + 50 + 'px';
    element.style.left = buttonRect.left + 'px';

    dateName.style.top = date.top + window.scrollY  + 'px';
    dateName.style.left = date.left + 5 + 'px';

    countName.style.top = countOfMens.top + window.scrollY + 'px';
    countName.style.left = countOfMens.left + 5 +'px';

    LocationName.style.top = LocationType.top + window.scrollY + 'px';
    LocationName.style.left = LocationType.left + 5 +'px';
}

// Закрытие элемента при клике вне его области
window.onclick = function(event) {
    const element = document.getElementById('rootElement');
    const button = document.getElementById('Button_Count');
    if (!button.contains(event.target) && !element.contains(event.target)) {
        element.style.display = 'none';
    }
}

window.onload = function() {
    updateElementPosition(); // Обновляем положение блока при загрузке страницы
    window.addEventListener('resize', updateElementPosition); // Подписываемся на событие изменения размеров окна
    window.addEventListener('scroll', updateElementPosition); // Подписываемся на событие прокрутки страницы
}



// Получаем ссылки на элементы счетчиков
const adultCountElement = document.getElementById('Count_of_parents');
const childCountElement = document.getElementById('Count_of_children');

// Функция для увеличения или уменьшения счетчика взрослых
function changeAdultCount(amount) {
    let currentCount = parseInt(adultCountElement.innerText);
    currentCount += amount;
    if (currentCount >= 1  && currentCount<=4) {
        adultCountElement.innerText = currentCount;
        updateButtonText(currentCount, parseInt(childCountElement.innerText));
    }else if (currentCount < 1) {
        document.querySelector('.count-of-men-icon:nth-of-type(1)').setAttribute("fill","#bbbbc3");
    }else if (currentCount > 4) {
        document.querySelector('.count-of-men-icon:nth-of-type(2)').setAttribute("fill","#bbbbc3");
    }
}

// Функция для увеличения или уменьшения счетчика детей
function changeChildCount(amount) {
    let currentCount = parseInt(childCountElement.innerText);
    currentCount += amount;
    if (currentCount >= 0 && currentCount<=4) {
        childCountElement.innerText = currentCount;
        updateButtonText(parseInt(adultCountElement.innerText), currentCount);
    }else if (currentCount < 0) {
        console.log('цвет');
        document.getElementById('minus_children').setAttribute("fill","#bbbbc3");
    }else if (currentCount > 4) {
        console.log('цвет');
        document.getElementById('plus_children').setAttribute("fill","#bbbbc3");
    }
}
function updateButtonText(adultCount, childCount) {
    if (childCount===0){
        document.getElementById('Button_Count').textContent = "Взрослых: " + adultCount;
    } else {
        document.getElementById('Button_Count').textContent = "Взрослых: " + adultCount + ", Детей: " + childCount;
    }
    var rootPath = '';

        if (window.location.pathname === '/Omutninsk/index.php') {
            rootPath = './require/save_button_count.php';
        } else {
            rootPath = '../require/save_button_count.php';
        }
    $.ajax({
        url: rootPath, 
        method: 'POST',
        data: { buttonCountText: document.getElementById('Button_Count').textContent }, 
        success: function(response) {
            console.log('Данные о количестве людей успешно отправлены на сервер');
        },
        error: function(xhr, status, error) {
            console.error('Ошибка при отправке данных на сервер: ' + error);
        }
    });
}
// Обработчики событий для кнопок "Минус" и "Плюс" для взрослых и детей
document.querySelector('.count-of-men-icon:nth-of-type(1)').addEventListener('click', function() {
    changeAdultCount(-1); // Уменьшаем счетчик взрослых на 1
});

document.querySelector('.count-of-men-icon:nth-of-type(2)').addEventListener('click', function() {
    changeAdultCount(1); // Увеличиваем счетчик взрослых на 1
});

document.getElementById('minus_children').addEventListener('click', function() {
    changeChildCount(-1); // Уменьшаем счетчик детей на 1
});

document.getElementById('plus_children').addEventListener('click', function() {
    changeChildCount(1); // Увеличиваем счетчик детей на 1
});

