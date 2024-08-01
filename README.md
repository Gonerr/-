# ОмутОтдых

**ОмутОтдых** - это веб-сайт, предоставляющий возможность бронирования различных баз отдыха, гостиниц и санаториев в городе Омутнинске. Сайт выполнен на языке PHP и соответствует следующим требованиям:

## 📋 О проекте

Сайт выполнен в соответствии с требованиями по логической структуре и дизайну. Он включает следующие ключевые аспекты:

### Структура и дизайн
- Соблюдена логическая структура сайта.
- Макетирование сайта выполнено с использованием различных технологий верстки.
- Присутствуют необходимые разделы: заголовок, меню, раздел для контента, "подвал" и т.д.
- Код программы структурирован.

### Функциональные возможности
- Реализован механизм сессии/куки.
- Вход в личный кабинет или на страницу администратора осуществляется посредством авторизации.
- Реализовано разделение пользователей:
  - Обычный пользователь видит общую информацию.
  - Зарегистрированный клиент видит информацию, относящуюся к нему.
  - Сотрудник видит свои функции.
  - Администратор видит все и имеет доступ к отдельной странице для выполнения операций добавления/удаления/обновления данных.
- Реализована возможность отправки форматированных сообщений на почту.
- На сайте реализованы различные виды выбора данных: ручной ввод, выпадающий список, чекбоксы, радиокнопки, текстовые поля.
- Добавление/удаление данных возможно как по одному элементу, так и несколькими сразу.
- Для выборки данных из базы используется объектная модель и инструмент подготовленных запросов (prepared statements).
- Реализована возможность использования графических библиотек.

### База данных
- База данных представлена в нормализованном виде.
- Практически все запросы реализованы в виде представлений, функций или хранимых процедур.
- Реализовано каскадное добавление/удаление данных.

## 📜 Лицензия

Этот проект находится под лицензией MIT. Подробности можно найти в файле LICENSE.

## 📞 Контакты

Если у вас есть вопросы или предложения, пожалуйста, свяжитесь с нами через [почту](mailto:lihacheva03@yandex.ru).