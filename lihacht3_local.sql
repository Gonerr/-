-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 02 2024 г., 00:37
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lihacht3_local`
--

DELIMITER $$
--
-- Процедуры
--
DROP PROCEDURE IF EXISTS `getAvailableRooms`$$
CREATE DEFINER=`lihacht3_local`@`localhost` PROCEDURE `getAvailableRooms` (IN `maxOccupancy` INT, IN `placeType` VARCHAR(255), IN `arrivalDate` DATE, IN `departureDate` DATE)   BEGIN
    -- Вызов процедуры для создания временной таблицы с информацией о номерах
    CALL getRoomInfo(maxOccupancy, placeType);
    -- Создание временной таблицы для хранения свободных номеров
    CREATE TEMPORARY TABLE IF NOT EXISTS AvailableRooms AS
    SELECT 
        r.ID_Типа_номера,
        r.ID_Места,
        r.Уровень_сервиса AS Название_номера,
        r.Cтоимость_номера AS Стоимость_номера,
        r.Макс_кол_во_проживающих AS Колво,
        r.Фотография AS Фото_номера,
        (
            SELECT GROUP_CONCAT(тп.Состав)
            FROM пропитание п
            LEFT JOIN типы_питания тп ON тп.ID_Питания = п.ID_Питания 
            WHERE r.ID_Места = п.ID_Места
        ) AS Состав_питания,
        (
            SELECT GROUP_CONCAT(п.Стоимость)
            FROM пропитание п
            LEFT JOIN типы_питания тп ON тп.ID_Питания = п.ID_Питания 
            WHERE r.ID_Места = п.ID_Места
        ) AS Стоимость_питания
    FROM TempRoomInfo r
    WHERE r.ID_Типа_номера NOT IN (
        SELECT b.ID_Типа_номера
        FROM бронирующие b
        WHERE b.Дата_приезда < departureDate AND b.Дата_выезда > arrivalDate
    );
    
    -- Возвращение результатов
    SELECT * FROM AvailableRooms;
    
    -- Удаление временных таблиц
    DROP TEMPORARY TABLE IF EXISTS TempRoomInfo;
    DROP TEMPORARY TABLE IF EXISTS AvailableRooms;
END$$

DROP PROCEDURE IF EXISTS `GetBookingDetailsByEmail`$$
CREATE DEFINER=`lihacht3_local`@`localhost` PROCEDURE `GetBookingDetailsByEmail` (IN `userEmail` VARCHAR(50))   BEGIN
    SELECT DISTINCT
        уд.ID_Учетной_записи AS ID,
        б.ID_Типа_Номера AS ID_Типа_номера,
        б.Количество_проживающих AS колво,
        б.Дата_приезда AS дата_приезда,
        б.Дата_выезда AS дата_выезда,
        бд.Название AS Название_отеля,
        CONCAT(бд.Улица, ' улица, д. ', бд.Дом) AS Адрес,
        н.Фотография AS Фото_отеля,
        н.Уровень_сервиса AS Название_номера,
        тп.Состав AS Питание,
        б.Стоимость AS Стоимость_номера
    FROM учетные_данные уд 
    JOIN пользователи п ON уд.ID_Учетной_записи = п.ID_Учетной_записи
    JOIN бронирующие б ON п.ID_Пользователя = б.ID_Пользователя 
    JOIN активы_и_бронь аиб ON б.ID_Брони = аиб.ID_Брони 
    JOIN базы_отдыха бд ON бд.ID_Места = аиб.ID_Места 
    JOIN номера н ON б.ID_Типа_Номера = н.ID_Типа_номера 
    JOIN типы_питания тп ON аиб.ID_Питания = тп.ID_Питания 
    WHERE уд.Email = userEmail;
END$$

DROP PROCEDURE IF EXISTS `getRoomInfo`$$
CREATE DEFINER=`lihacht3_local`@`localhost` PROCEDURE `getRoomInfo` (IN `maxOccupancy` INT, IN `placeType` VARCHAR(255))   BEGIN
    CREATE TEMPORARY TABLE IF NOT EXISTS TempRoomInfo AS
	    SELECT 
	        n.ID_Типа_номера,
	        n.ID_Места,
	        n.Макс_кол_во_проживающих,
	        d.Тип_места,
	        n.Уровень_сервиса,
	        n.Cтоимость_номера,
	        n.Фотография
	    FROM номера n
	    JOIN базы_отдыха d ON n.ID_Места = d.ID_Места
	    WHERE n.Макс_кол_во_проживающих >= maxOccupancy
	      AND d.Тип_места = placeType;
END$$

DROP PROCEDURE IF EXISTS `getServicesCost`$$
CREATE DEFINER=`lihacht3_local`@`localhost` PROCEDURE `getServicesCost` (IN `hotelID` INT, IN `service_name` VARCHAR(255))   BEGIN
    SELECT с.Стоимость
    FROM стоимость_услуг с
    LEFT JOIN услуги у ON у.ID_Услуги = с.ID_Услуги 
    WHERE ID_Места = hotelID AND у.Наименование  = service_name;
END$$

DROP PROCEDURE IF EXISTS `GetUserCredentials`$$
CREATE DEFINER=`lihacht3_local`@`localhost` PROCEDURE `GetUserCredentials` (IN `p_email` VARCHAR(255), OUT `p_password` VARCHAR(255), OUT `p_role` VARCHAR(255))   BEGIN
    SELECT Пароль, Роль 
    INTO p_password, p_role
    FROM учетные_данные
    WHERE Email = p_email;
END$$

DROP PROCEDURE IF EXISTS `get_booking_counts_by_hotel`$$
CREATE DEFINER=`lihacht3_local`@`localhost` PROCEDURE `get_booking_counts_by_hotel` ()   BEGIN
    SELECT
        h.Название AS Название,
        COUNT(DISTINCT b.ID_Пользователя) AS Количество_Человек
    FROM бронирующие b
    JOIN номера n ON b.ID_Типа_Номера = n.ID_Типа_номера
    JOIN базы_отдыха h ON n.ID_Места = h.ID_Места
    GROUP BY h.Название;
END$$

--
-- Функции
--
DROP FUNCTION IF EXISTS `getTotalBookings`$$
CREATE DEFINER=`lihacht3_local`@`localhost` FUNCTION `getTotalBookings` () RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE total INT;
    SELECT COUNT(*) INTO total FROM бронирующие;
    RETURN total;
END$$

DROP FUNCTION IF EXISTS `getTotalIncome`$$
CREATE DEFINER=`lihacht3_local`@`localhost` FUNCTION `getTotalIncome` () RETURNS DECIMAL(10,2) DETERMINISTIC BEGIN
    DECLARE total DECIMAL(10, 2);
    SELECT SUM(Стоимость) INTO total FROM бронирующие;
    RETURN total;
END$$

DROP FUNCTION IF EXISTS `GetUserDetailsByID`$$
CREATE DEFINER=`lihacht3_local`@`localhost` FUNCTION `GetUserDetailsByID` (`userID` INT) RETURNS VARCHAR(100) CHARSET utf8 DETERMINISTIC BEGIN
    DECLARE user_data VARCHAR(100);
    SELECT CONCAT(Имя, ', ', Фамилия, ', ', Отчество, ', ', Телефон)
    INTO user_data
    FROM пользователи
    WHERE ID_Учетной_записи = userID
    LIMIT 1;

    RETURN user_data;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `hotelInfo`
-- (См. Ниже фактическое представление)
--
DROP VIEW IF EXISTS `hotelInfo`;
CREATE TABLE `hotelInfo` (
`ID` int(11)
,`Название` varchar(40)
,`Тип_отеля` varchar(30)
,`Описание` varchar(3000)
,`До_воды` int(11)
,`Адрес` varchar(78)
,`Оценка` char(4)
,`Фото` varchar(100)
,`Тип_питания` text
,`Услуги` text
,`Мин_стоимость` char(18)
,`Макс_стоимость` char(18)
);

-- --------------------------------------------------------

--
-- Структура таблицы `активы_и_бронь`
--
-- Создание: Май 27 2024 г., 18:38
--

DROP TABLE IF EXISTS `активы_и_бронь`;
CREATE TABLE `активы_и_бронь` (
  `ID_Брони` int(11) NOT NULL,
  `ID_Места` int(11) NOT NULL,
  `ID_Питания` int(11) NOT NULL,
  `ID_Услуги` int(11) DEFAULT NULL,
  `Резервационный_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `активы_и_бронь`
--

INSERT INTO `активы_и_бронь` (`ID_Брони`, `ID_Места`, `ID_Питания`, `ID_Услуги`, `Резервационный_ID`) VALUES
(20, 1, 4, 8, 22),
(20, 1, 4, 4, 23),
(20, 1, 4, 9, 24),
(29, 1, 4, 5, 32),
(29, 1, 4, 8, 33),
(29, 1, 4, 3, 34),
(29, 1, 4, 4, 35),
(29, 1, 4, 1, 36),
(29, 1, 4, 9, 37),
(29, 1, 4, 7, 38),
(30, 1, 4, 1, 39),
(40, 3, 4, 5, 71),
(40, 3, 4, 3, 72),
(40, 3, 4, 1, 73),
(41, 2, 1, 2, 74),
(42, 2, 1, 1, 75),
(43, 1, 4, 1, 76),
(43, 1, 4, 9, 77),
(44, 1, 3, 1, 78),
(44, 1, 3, 9, 79),
(45, 4, 4, 9, 80),
(46, 1, 3, 5, 81),
(46, 1, 3, 9, 85),
(47, 1, 3, 5, 86),
(47, 1, 3, 8, 87),
(47, 1, 3, 3, 88),
(47, 1, 3, 4, 89),
(47, 1, 3, 9, 90),
(48, 4, 3, 5, 91),
(48, 4, 3, 8, 92),
(48, 4, 3, 3, 93),
(48, 4, 3, 9, 94);

-- --------------------------------------------------------

--
-- Структура таблицы `базы_отдыха`
--
-- Создание: Май 27 2024 г., 18:38
--

DROP TABLE IF EXISTS `базы_отдыха`;
CREATE TABLE `базы_отдыха` (
  `ID_Места` int(11) NOT NULL,
  `Название` varchar(40) NOT NULL,
  `Улица` varchar(50) NOT NULL,
  `Дом` char(18) NOT NULL,
  `Количество_звезд` int(11) DEFAULT NULL,
  `Средняя_оценка_гостей` char(4) DEFAULT NULL,
  `Удаленность_от_водоёма` int(11) DEFAULT NULL,
  `Описание` varchar(3000) NOT NULL,
  `Фотография` varchar(100) NOT NULL,
  `Тип_места` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `базы_отдыха`
--

INSERT INTO `базы_отдыха` (`ID_Места`, `Название`, `Улица`, `Дом`, `Количество_звезд`, `Средняя_оценка_гостей`, `Удаленность_от_водоёма`, `Описание`, `Фотография`, `Тип_места`) VALUES
(1, 'Лесная сказка', 'Сосновая', '2', NULL, '4', 15, 'Санаторий Лесная сказка Омутнинск в Кировской области находится в живописной зоне. Гостей ждут парки, спортплощадки, бассейн. В путёвку входят проживание, трёхразовое питание и основные лечебные процедуры, обеспечивающие комфортный отдых и оздоровление.', 'Лесная_сказка.jpg', 'Санаторий'),
(2, 'Омутнинское рыбное хозяйство', 'Парковая', '41', NULL, NULL, 5, 'Омутнинское рыбное хозяйство в Кировской области предлагает отдых на природе с рыбалкой и активным досугом. На территории есть оборудованные места для рыбалки, пикниковые зоны и уютные домики. В стоимость входят аренда снастей и консультации опытных рыболовов.', 'Рыбное_хозяйство.jpg', 'База отдыха'),
(3, '7 холмов', 'Ленина', '10', NULL, NULL, 10, 'База отдыха \"7 холмов\" в живописной Кировской области приглашает на рыбалку и охоту. На территории есть оборудованные зоны для рыбалки, охотничьи угодья и уютные домики. В стоимость входят аренда снаряжения, сопровождение егерей и возможность насладиться дикой природой.', '7_холмов.jpg', 'База отдыха'),
(4, 'Металлург', 'Пролетарская', '2-а', NULL, '4', 100, 'Санаторий \"Металлург\" в Омутнинске, центре металлургии, предлагает уникальный отдых с акцентом на здоровье. Уютные номера, вкусное трехразовое питание и лечебные процедуры помогут восстановить силы. Откройте для себя спортплощадки и бассейн в окружении красивой природы.', 'Металлург.jpg', 'Санаторий'),
(5, 'Центральная', '30-летия Победы', '35', 2, NULL, 1210, ' Гостиница \"Центральная\" в Омутнинске, сердце металлургического края, предлагает уютные номера и внимательное обслуживание. Удобное расположение в центре города, рядом с ключевыми достопримечательностями и деловыми объектами. Идеальный выбор для комфортного отдыха и деловых поездок.', 'Центральная.jpg', 'Гостиница'),
(6, 'Колокольчик', 'Осокино', '1', NULL, '4.6', 35, 'Лагерь \"Колокольчик\" приглашает детей на яркие приключения в окружении природы. Расположенный в живописном уголке, он предоставляет уникальную возможность для игр, занятий спортом и творчеством под руководством опытных инструкторов. Открытые площадки, интересные мероприятия и дружеская атмосфера создают незабываемые впечатления для каждого ребенка.', 'колокольчик.jpg', 'Лагерь');

-- --------------------------------------------------------

--
-- Структура таблицы `бронирующие`
--
-- Создание: Май 27 2024 г., 18:38
--

DROP TABLE IF EXISTS `бронирующие`;
CREATE TABLE `бронирующие` (
  `Дата_приезда` datetime NOT NULL,
  `Дата_выезда` datetime NOT NULL,
  `Количество_проживающих` int(11) NOT NULL,
  `ID_Брони` int(11) NOT NULL,
  `ID_Пользователя` int(11) DEFAULT NULL,
  `ID_Типа_Номера` int(11) NOT NULL,
  `Стоимость` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `бронирующие`
--

INSERT INTO `бронирующие` (`Дата_приезда`, `Дата_выезда`, `Количество_проживающих`, `ID_Брони`, `ID_Пользователя`, `ID_Типа_Номера`, `Стоимость`) VALUES
('2024-05-27 00:00:00', '2024-05-30 00:00:00', 2, 20, 21, 7, 6600),
('2024-05-27 00:00:00', '2024-05-31 00:00:00', 1, 21, 21, 20, 13500),
('2024-05-31 00:00:00', '2024-06-04 00:00:00', 4, 22, 21, 15, 6200),
('2024-05-27 00:00:00', '2024-05-30 00:00:00', 1, 25, 14, 15, 4900),
('2024-05-27 00:00:00', '2024-05-29 00:00:00', 1, 26, 24, 19, 5300),
('2024-05-29 00:00:00', '2024-05-31 00:00:00', 2, 27, 25, 22, 3700),
('2024-05-29 00:00:00', '2024-05-31 00:00:00', 2, 28, 26, 23, 6700),
('2024-05-31 00:00:00', '2024-06-06 00:00:00', 1, 29, 30, 3, 14400),
('2024-06-08 00:00:00', '2024-06-09 00:00:00', 2, 30, 30, 6, 4200),
('2024-05-27 00:00:00', '2024-05-31 00:00:00', 1, 31, 31, 16, 5200),
('2024-05-28 00:00:00', '0000-00-00 00:00:00', 2, 39, 24, 17, 6000),
('2024-05-29 00:00:00', '2024-05-31 00:00:00', 1, 40, 24, 14, 8000),
('2024-05-29 00:00:00', '2024-06-01 00:00:00', 1, 41, 24, 2, 2900),
('2024-05-29 00:00:00', '2024-06-12 00:00:00', 1, 42, 24, 1, 24200),
('2024-05-31 00:00:00', '2024-06-24 00:00:00', 1, 43, 24, 4, 61300),
('2024-06-01 00:00:00', '2024-06-24 00:00:00', 1, 44, 24, 7, 45000),
('2024-06-12 00:00:00', '2024-06-24 00:00:00', 1, 45, 24, 19, 24700),
('2024-05-29 00:00:00', '2024-05-31 00:00:00', 2, 46, 42, 4, 6900),
('2024-06-04 00:00:00', '2024-06-08 00:00:00', 4, 47, 42, 6, 17900),
('2024-06-11 00:00:00', '2024-06-14 00:00:00', 1, 48, 42, 18, 12900);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `количество_бронировавших_в_отелях`
-- (См. Ниже фактическое представление)
--
DROP VIEW IF EXISTS `количество_бронировавших_в_отелях`;
CREATE TABLE `количество_бронировавших_в_отелях` (
`Название` varchar(40)
,`Количество_Человек` bigint(21)
);

-- --------------------------------------------------------

--
-- Структура таблицы `номера`
--
-- Создание: Май 27 2024 г., 18:38
--

DROP TABLE IF EXISTS `номера`;
CREATE TABLE `номера` (
  `Уровень_сервиса` char(18) NOT NULL,
  `Cтоимость_номера` char(18) DEFAULT NULL,
  `ID_Места` int(11) NOT NULL,
  `Макс_кол_во_проживающих` int(11) NOT NULL,
  `ID_Типа_номера` int(11) NOT NULL,
  `Фотография` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `номера`
--

INSERT INTO `номера` (`Уровень_сервиса`, `Cтоимость_номера`, `ID_Места`, `Макс_кол_во_проживающих`, `ID_Типа_номера`, `Фотография`) VALUES
('Люкс', '1700', 2, 2, 1, 'Рыбное-Люкс.jpg'),
('Эконом', '800', 2, 4, 2, 'Рыбное-Эконом.jpg'),
('Стандарт', '1800', 1, 2, 3, 'ЛС-Стандарт-2.jpg'),
('Комфорт', '2200', 1, 2, 4, 'ЛС-Комфорт-2.jpg'),
('Студия', '2800', 1, 2, 5, 'ЛС-Студия-2.jpg'),
('Люкс', '3600', 1, 4, 6, 'ЛС-Люкс-2.jpg'),
('Эконом', '1400', 1, 2, 7, 'ЛС-Эконом-2.jpg'),
('Эконом', '1100', 1, 1, 13, 'ЛС-Эконом-1.jpg'),
('Люкс', '3000', 3, 2, 14, '7х-Люкс.jpg'),
('Эконом', '800', 3, 4, 15, '7х-Эконом.jpg'),
('Эконом', '1100', 4, 1, 16, 'ЛС-Эконом-1.jpg'),
('Эконом', '1400', 4, 2, 17, 'ЛС-Эконом-2.jpg'),
('Люкс', '3600', 4, 4, 18, 'ЛС-Люкс-2.jpg'),
('Стандарт', '1800', 4, 2, 19, 'ЛС-Стандарт-2.jpg'),
('Студия', '2800', 4, 2, 20, 'ЛС-Студия-2.jpg'),
('Комфорт', '2200', 4, 2, 21, 'ЛС-Комфорт-2.jpg'),
('Эконом', '1500', 5, 2, 22, 'Ц-Эконом-2.jpeg'),
('Комфорт', '3000', 5, 2, 23, 'Ц-Комфорт-2.jpg'),
('Комфорт', '22400', 6, 1, 24, 'Лагерь.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `пользователи`
--
-- Создание: Май 27 2024 г., 18:52
--

DROP TABLE IF EXISTS `пользователи`;
CREATE TABLE `пользователи` (
  `ID_Пользователя` int(11) NOT NULL,
  `Имя` varchar(20) NOT NULL,
  `Фамилия` varchar(20) NOT NULL,
  `Дата_рождения` datetime DEFAULT NULL,
  `Отчество` varchar(20) DEFAULT NULL,
  `Телефон` varchar(11) NOT NULL,
  `ID_Учетной_записи` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `пользователи`
--

INSERT INTO `пользователи` (`ID_Пользователя`, `Имя`, `Фамилия`, `Дата_рождения`, `Отчество`, `Телефон`, `ID_Учетной_записи`) VALUES
(14, 'Кирилл', 'Васнецов', NULL, NULL, '5555', 8),
(21, 'Анастасия', 'Лихачева', NULL, NULL, '11111', 8),
(23, 'Елена', 'Лихачева', NULL, NULL, '2222', 8),
(24, 'Анастасия', 'Лихачева', NULL, NULL, '89642521747', 1),
(25, 'Кирилл', 'Егоркин', NULL, NULL, '896444', 8),
(26, 'Кирилл', 'Егоркин', NULL, NULL, '8964445', 8),
(30, 'Анастасия', 'Лихачева', NULL, 'Алексеевна', '89642521741', 8),
(31, 'Кирилл', 'Лихачев', NULL, 'Алексеевич', '1234442', 8),
(42, 'Елена', 'Елена', NULL, NULL, '9111111', 11),
(43, 'Филипп', 'Киркоров', NULL, 'Бедросович', '79082700880', 12);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `популярные_услуги`
-- (См. Ниже фактическое представление)
--
DROP VIEW IF EXISTS `популярные_услуги`;
CREATE TABLE `популярные_услуги` (
`услуга` varchar(100)
,`количество` bigint(21)
);

-- --------------------------------------------------------

--
-- Структура таблицы `пропитание`
--
-- Создание: Май 27 2024 г., 18:51
--

DROP TABLE IF EXISTS `пропитание`;
CREATE TABLE `пропитание` (
  `ID_Места` int(11) NOT NULL,
  `Стоимость` char(18) NOT NULL,
  `ID_Питания` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `пропитание`
--

INSERT INTO `пропитание` (`ID_Места`, `Стоимость`, `ID_Питания`) VALUES
(2, '0', 1),
(3, '0', 1),
(5, '350', 2),
(1, '500', 3),
(4, '300', 3),
(6, '600', 3),
(1, '300', 4),
(3, '500', 4),
(4, '200', 4),
(1, '100', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `сотрудники`
--
-- Создание: Май 27 2024 г., 18:58
--

DROP TABLE IF EXISTS `сотрудники`;
CREATE TABLE `сотрудники` (
  `Должность` varchar(20) NOT NULL,
  `Дата_приема_на_работу` datetime NOT NULL,
  `Дата_увольнения` datetime DEFAULT NULL,
  `ID_Пользователя` int(11) NOT NULL,
  `ID_Сотрудника` int(11) NOT NULL,
  `ID_Места` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `сотрудники`
--

INSERT INTO `сотрудники` (`Должность`, `Дата_приема_на_работу`, `Дата_увольнения`, `ID_Пользователя`, `ID_Сотрудника`, `ID_Места`) VALUES
('Директор', '2024-05-01 22:03:19', NULL, 14, 1, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `стоимость_услуг`
--
-- Создание: Май 27 2024 г., 18:52
--

DROP TABLE IF EXISTS `стоимость_услуг`;
CREATE TABLE `стоимость_услуг` (
  `ID_Услуги` int(11) NOT NULL,
  `ID_Места` int(11) NOT NULL,
  `Стоимость` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `стоимость_услуг`
--

INSERT INTO `стоимость_услуг` (`ID_Услуги`, `ID_Места`, `Стоимость`) VALUES
(1, 1, 300),
(1, 2, 400),
(1, 3, 1000),
(2, 2, 500),
(3, 1, 0),
(3, 3, 0),
(3, 4, 100),
(4, 1, 0),
(5, 1, 0),
(5, 3, 0),
(5, 4, 0),
(5, 5, 0),
(6, 4, 0),
(7, 1, 0),
(7, 4, 0),
(8, 1, 500),
(8, 4, 400),
(8, 6, 100),
(9, 1, 1000),
(9, 4, 700);

-- --------------------------------------------------------

--
-- Структура таблицы `типы_питания`
--
-- Создание: Май 27 2024 г., 18:50
--

DROP TABLE IF EXISTS `типы_питания`;
CREATE TABLE `типы_питания` (
  `ID_Питания` int(11) NOT NULL,
  `Состав` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `типы_питания`
--

INSERT INTO `типы_питания` (`ID_Питания`, `Состав`) VALUES
(4, 'Двухразовое питание'),
(2, 'Завтрак'),
(5, 'Обед'),
(1, 'Питание не включено'),
(3, 'Трехразовое питание');

-- --------------------------------------------------------

--
-- Структура таблицы `услуги`
--
-- Создание: Май 27 2024 г., 18:52
--

DROP TABLE IF EXISTS `услуги`;
CREATE TABLE `услуги` (
  `ID_Услуги` int(11) NOT NULL,
  `Наименование` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `услуги`
--

INSERT INTO `услуги` (`ID_Услуги`, `Наименование`) VALUES
(5, 'Бесплатный Wi-Fi'),
(8, 'Массажный кабинет'),
(6, 'Можно с домашними животными'),
(3, 'Парковка'),
(4, 'Ресторан'),
(1, 'Рыболовство и охота'),
(9, 'Сауны'),
(7, 'Спортзал'),
(10, 'Холодильник в номере'),
(2, 'Экскурсии');

-- --------------------------------------------------------

--
-- Структура таблицы `учетные_данные`
--
-- Создание: Май 27 2024 г., 18:52
--

DROP TABLE IF EXISTS `учетные_данные`;
CREATE TABLE `учетные_данные` (
  `Email` varchar(30) NOT NULL,
  `Пароль` varchar(20) NOT NULL,
  `ID_Учетной_записи` int(11) NOT NULL,
  `Роль` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `учетные_данные`
--

INSERT INTO `учетные_данные` (`Email`, `Пароль`, `ID_Учетной_записи`, `Роль`) VALUES
('admin@123', '123', 1, 'Админ'),
('example@yandex.ru', 'example', 3, 'Пользователь'),
('example2@com', 'example', 8, 'Сотрудник'),
('Anastasia@1111', '1111', 9, 'Пользователь'),
('lihacheva03@yandex.ru', 'ahodut22', 10, 'Пользователь'),
('ekom@yandex.ru', '123', 11, 'Пользователь'),
('dasc@gmail.com', '123', 12, 'Сотрудник'),
('chan.h@edu.spbstu.ru', '123456789', 13, 'Сотрудник'),
('kkkk@jj', 'wepto2-qerqaV-singic', 14, 'Пользователь'),
('kartalievafarida@mail.ru', '1234lkjh', 15, 'Пользователь'),
('pppp@pppp.ru', 'nastya123', 16, 'Сотрудник'),
('piska_popka123@yandex.ru', 'mamapapa', 17, 'Пользователь');

-- --------------------------------------------------------

--
-- Структура для представления `hotelInfo`
--
DROP TABLE IF EXISTS `hotelInfo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`lihacht3_local`@`localhost` SQL SECURITY DEFINER VIEW `hotelInfo`  AS SELECT `d`.`ID_Места` AS `ID`, `d`.`Название` AS `Название`, `d`.`Тип_места` AS `Тип_отеля`, `d`.`Описание` AS `Описание`, `d`.`Удаленность_от_водоёма` AS `До_воды`, concat(`d`.`Улица`,' ул., дом ',`d`.`Дом`) AS `Адрес`, `d`.`Средняя_оценка_гостей` AS `Оценка`, `d`.`Фотография` AS `Фото`, group_concat(distinct `тп`.`Состав` order by `тп`.`Состав` ASC separator ',') AS `Тип_питания`, group_concat(distinct `s1`.`Наименование` order by `s1`.`Наименование` ASC separator ',') AS `Услуги`, min(`н`.`Cтоимость_номера`) AS `Мин_стоимость`, max(`н`.`Cтоимость_номера`) AS `Макс_стоимость` FROM (((((`базы_отдыха` `d` left join `стоимость_услуг` `s` on((`d`.`ID_Места` = `s`.`ID_Места`))) left join `услуги` `s1` on((`s`.`ID_Услуги` = `s1`.`ID_Услуги`))) left join `пропитание` `f` on((`d`.`ID_Места` = `f`.`ID_Места`))) left join `типы_питания` `тп` on((`тп`.`ID_Питания` = `f`.`ID_Питания`))) left join `номера` `н` on((`н`.`ID_Места` = `d`.`ID_Места`))) GROUP BY `d`.`ID_Места`, `d`.`Название`, `d`.`Тип_места`, `d`.`Удаленность_от_водоёма`, `d`.`Улица`, `d`.`Дом`, `d`.`Средняя_оценка_гостей`, `d`.`Фотография``Фотография` ;

-- --------------------------------------------------------

--
-- Структура для представления `количество_бронировавших_в_отелях`
--
DROP TABLE IF EXISTS `количество_бронировавших_в_отелях`;

CREATE ALGORITHM=UNDEFINED DEFINER=`lihacht3_local`@`localhost` SQL SECURITY DEFINER VIEW `количество_бронировавших_в_отелях`  AS SELECT `h`.`Название` AS `Название`, count(distinct `b`.`ID_Пользователя`) AS `Количество_Человек` FROM ((`бронирующие` `b` join `номера` `n` on((`b`.`ID_Типа_Номера` = `n`.`ID_Типа_номера`))) join `базы_отдыха` `h` on((`n`.`ID_Места` = `h`.`ID_Места`))) GROUP BY `h`.`Название``Название` ;

-- --------------------------------------------------------

--
-- Структура для представления `популярные_услуги`
--
DROP TABLE IF EXISTS `популярные_услуги`;

CREATE ALGORITHM=UNDEFINED DEFINER=`lihacht3_local`@`localhost` SQL SECURITY DEFINER VIEW `популярные_услуги`  AS SELECT `у`.`Наименование` AS `услуга`, count(0) AS `количество` FROM (`активы_и_бронь` `аиб` left join `услуги` `у` on((`у`.`ID_Услуги` = `аиб`.`ID_Услуги`))) GROUP BY `услуга` ORDER BY `количество` DESC LIMIT 0, 55 ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `активы_и_бронь`
--
ALTER TABLE `активы_и_бронь`
  ADD PRIMARY KEY (`Резервационный_ID`),
  ADD UNIQUE KEY `XPKАктивы_и_бронь` (`Резервационный_ID`),
  ADD KEY `R_79` (`ID_Брони`),
  ADD KEY `R_80` (`ID_Места`,`ID_Питания`),
  ADD KEY `R_81` (`ID_Услуги`,`ID_Места`);

--
-- Индексы таблицы `базы_отдыха`
--
ALTER TABLE `базы_отдыха`
  ADD PRIMARY KEY (`ID_Места`),
  ADD UNIQUE KEY `XPKБазы_отдыха` (`ID_Места`),
  ADD UNIQUE KEY `XAK1Базы_отдыха` (`Название`,`Улица`,`Дом`);

--
-- Индексы таблицы `бронирующие`
--
ALTER TABLE `бронирующие`
  ADD PRIMARY KEY (`ID_Брони`),
  ADD UNIQUE KEY `XPKБронирующие` (`ID_Брони`),
  ADD UNIQUE KEY `бронирующие_un` (`Дата_приезда`,`Дата_выезда`,`ID_Типа_Номера`),
  ADD UNIQUE KEY `XAK1Бронирующие` (`ID_Пользователя`,`Дата_приезда`,`Дата_выезда`),
  ADD KEY `бронирующие_FK` (`ID_Типа_Номера`);

--
-- Индексы таблицы `номера`
--
ALTER TABLE `номера`
  ADD PRIMARY KEY (`ID_Типа_номера`),
  ADD UNIQUE KEY `XPKНомера` (`ID_Типа_номера`),
  ADD UNIQUE KEY `номера_un` (`ID_Места`,`Уровень_сервиса`,`Макс_кол_во_проживающих`);

--
-- Индексы таблицы `пользователи`
--
ALTER TABLE `пользователи`
  ADD PRIMARY KEY (`ID_Пользователя`),
  ADD UNIQUE KEY `XPKПользователи` (`ID_Пользователя`),
  ADD UNIQUE KEY `XAK1Пользователи` (`Телефон`),
  ADD KEY `R_55` (`ID_Учетной_записи`);

--
-- Индексы таблицы `пропитание`
--
ALTER TABLE `пропитание`
  ADD PRIMARY KEY (`ID_Питания`,`ID_Места`),
  ADD UNIQUE KEY `XPKПропитание` (`ID_Места`,`ID_Питания`),
  ADD KEY `XIE1Пропитание` (`ID_Питания`);

--
-- Индексы таблицы `сотрудники`
--
ALTER TABLE `сотрудники`
  ADD PRIMARY KEY (`ID_Сотрудника`),
  ADD UNIQUE KEY `XPKСотрудники` (`ID_Сотрудника`),
  ADD UNIQUE KEY `XAK1Сотрудники` (`ID_Пользователя`,`Дата_приема_на_работу`),
  ADD KEY `R_67` (`ID_Места`);

--
-- Индексы таблицы `стоимость_услуг`
--
ALTER TABLE `стоимость_услуг`
  ADD PRIMARY KEY (`ID_Услуги`,`ID_Места`),
  ADD UNIQUE KEY `XPKСтоимость_услуг` (`ID_Услуги`,`ID_Места`),
  ADD KEY `R_74` (`ID_Места`);

--
-- Индексы таблицы `типы_питания`
--
ALTER TABLE `типы_питания`
  ADD PRIMARY KEY (`ID_Питания`),
  ADD UNIQUE KEY `XPKТипы_питания` (`ID_Питания`),
  ADD UNIQUE KEY `XAK1Типы_питания` (`Состав`);

--
-- Индексы таблицы `услуги`
--
ALTER TABLE `услуги`
  ADD PRIMARY KEY (`ID_Услуги`),
  ADD UNIQUE KEY `XPKУслуги` (`ID_Услуги`),
  ADD UNIQUE KEY `XAK1Услуги` (`Наименование`);

--
-- Индексы таблицы `учетные_данные`
--
ALTER TABLE `учетные_данные`
  ADD PRIMARY KEY (`ID_Учетной_записи`),
  ADD UNIQUE KEY `XPKУчетные_данные` (`ID_Учетной_записи`),
  ADD UNIQUE KEY `XAK1Учетные_данные` (`Email`,`Роль`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `активы_и_бронь`
--
ALTER TABLE `активы_и_бронь`
  MODIFY `Резервационный_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT для таблицы `базы_отдыха`
--
ALTER TABLE `базы_отдыха`
  MODIFY `ID_Места` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `бронирующие`
--
ALTER TABLE `бронирующие`
  MODIFY `ID_Брони` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `номера`
--
ALTER TABLE `номера`
  MODIFY `ID_Типа_номера` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `пользователи`
--
ALTER TABLE `пользователи`
  MODIFY `ID_Пользователя` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `сотрудники`
--
ALTER TABLE `сотрудники`
  MODIFY `ID_Сотрудника` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `типы_питания`
--
ALTER TABLE `типы_питания`
  MODIFY `ID_Питания` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `услуги`
--
ALTER TABLE `услуги`
  MODIFY `ID_Услуги` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `учетные_данные`
--
ALTER TABLE `учетные_данные`
  MODIFY `ID_Учетной_записи` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `активы_и_бронь`
--
ALTER TABLE `активы_и_бронь`
  ADD CONSTRAINT `R_79` FOREIGN KEY (`ID_Брони`) REFERENCES `бронирующие` (`ID_Брони`) ON DELETE CASCADE,
  ADD CONSTRAINT `R_80` FOREIGN KEY (`ID_Места`,`ID_Питания`) REFERENCES `пропитание` (`ID_Места`, `ID_Питания`) ON DELETE CASCADE,
  ADD CONSTRAINT `R_81` FOREIGN KEY (`ID_Услуги`,`ID_Места`) REFERENCES `стоимость_услуг` (`ID_Услуги`, `ID_Места`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `бронирующие`
--
ALTER TABLE `бронирующие`
  ADD CONSTRAINT `R_64` FOREIGN KEY (`ID_Пользователя`) REFERENCES `пользователи` (`ID_Пользователя`) ON DELETE CASCADE,
  ADD CONSTRAINT `бронирующие_FK` FOREIGN KEY (`ID_Типа_Номера`) REFERENCES `номера` (`ID_Типа_номера`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `номера`
--
ALTER TABLE `номера`
  ADD CONSTRAINT `номера_FK` FOREIGN KEY (`ID_Места`) REFERENCES `базы_отдыха` (`ID_Места`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `пользователи`
--
ALTER TABLE `пользователи`
  ADD CONSTRAINT `R_55` FOREIGN KEY (`ID_Учетной_записи`) REFERENCES `учетные_данные` (`ID_Учетной_записи`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `пропитание`
--
ALTER TABLE `пропитание`
  ADD CONSTRAINT `R_3` FOREIGN KEY (`ID_Места`) REFERENCES `базы_отдыха` (`ID_Места`),
  ADD CONSTRAINT `R_4` FOREIGN KEY (`ID_Питания`) REFERENCES `типы_питания` (`ID_Питания`);

--
-- Ограничения внешнего ключа таблицы `сотрудники`
--
ALTER TABLE `сотрудники`
  ADD CONSTRAINT `R_66` FOREIGN KEY (`ID_Пользователя`) REFERENCES `пользователи` (`ID_Пользователя`) ON DELETE CASCADE,
  ADD CONSTRAINT `R_67` FOREIGN KEY (`ID_Места`) REFERENCES `базы_отдыха` (`ID_Места`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `стоимость_услуг`
--
ALTER TABLE `стоимость_услуг`
  ADD CONSTRAINT `R_73` FOREIGN KEY (`ID_Услуги`) REFERENCES `услуги` (`ID_Услуги`),
  ADD CONSTRAINT `R_74` FOREIGN KEY (`ID_Места`) REFERENCES `базы_отдыха` (`ID_Места`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
