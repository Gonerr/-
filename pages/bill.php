<?php
require_once('../require/bill_require.php');
?>

<html>
    <head>
        <title>Мой заказ</title>
        <meta charset="utf-8">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <link href="../css/index.css" rel="stylesheet" type="text/css">
        <link href="../css/bill.css" rel="stylesheet" type="text/css">
        <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"/>

    </head>
    <body>
    <div>
        <div class="flex-container-column"> 
            <div data-role="Header" class="navbar">
            <h1 class="logo">ОтдыхОмут</h1>
            <div class="right-side">
              <div class="links-container">
              <a href="../index.php" class="text_li">Главная</a>
              <a href="about.php" class="text_li">О нас</a>
              <a href="orders.php" class="text_li">Базы отдыха</a>
              <span class="text_li">Контакты</span>
            </div>
            <?php 
              if (isset($_COOKIE['auth']) && $_COOKIE['auth'] === 'true'){ ?>
              
                <a href="account.php" class="link">
                    <svg viewBox="0 0 1024 1024" class="icon2">
                      <path d="M870.286 765.143c-14.857-106.857-58.286-201.714-155.429-214.857-50.286 54.857-122.857 89.714-202.857 89.714s-152.571-34.857-202.857-89.714c-97.143 13.143-140.571 108-155.429 214.857 79.429 112 210.286 185.714 358.286 185.714s278.857-73.714 358.286-185.714zM731.429 365.714c0-121.143-98.286-219.429-219.429-219.429s-219.429 98.286-219.429 219.429 98.286 219.429 219.429 219.429 219.429-98.286 219.429-219.429zM1024 512c0 281.714-228.571 512-512 512-282.857 0-512-229.714-512-512 0-282.857 229.143-512 512-512s512 229.143 512 512z" ></path>
                  </svg>
                </a>
              <?php } else { ?>
                <a href="registration.php" class="link">
                <div class="solid-button-container">
                  <button class="solid-button-button">
                    <span>Регистрация</span>
                  </button>
                </div>
              </a>
              <?php }; ?>
            </div>
            <div data-role="BurgerMenu" class="burger-menu">
              <svg viewBox="0 0 1024 1024" class="icon">
                <path d="M810.667 725.333h-597.333c-47.061 0-85.333 38.272-85.333 85.333s38.272 85.333 85.333 85.333h597.333c47.061 0 85.333-38.272 85.333-85.333s-38.272-85.333-85.333-85.333z"></path>
                <path d="M810.667 426.667h-597.333c-47.061 0-85.333 38.272-85.333 85.333s38.272 85.333 85.333 85.333h597.333c47.061 0 85.333-38.272 85.333-85.333s-38.272-85.333-85.333-85.333z" ></path>
                <path d="M810.667 128h-597.333c-47.061 0-85.333 38.272-85.333 85.333s38.272 85.333 85.333 85.333h597.333c47.061 0 85.333-38.272 85.333-85.333s-38.272-85.333-85.333-85.333z"  ></path>
              </svg>
            </div>
            <div data-role="MobileMenu" class="mobile-menu">
              <div class="container-column">
                <div class="top">
                  <h1>ОтдыхОмут</h1>
                  <div data-role="CloseMobileMenu" class="container-column">
                    <svg viewBox="0 0 1024 1024" class="icon">
                      <path d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z" ></path>
                    </svg>
                  </div>
                </div>
                <div class="right-side-column">
                  <div class="links-container1">
                    <span class="text-column">Главная</span>
                    <span class="text-column">О нас</span>
                    <span class="text-column">Базы отдыха</span>
                    <span>Контакты</span>
                  </div>
                  <a href="#main-section" class="link">
                    <div class="solid-button-container">
                      <button class="solid-button-button">
                        <span>Войти</span>
                      </button>
                    </div>
                  </a>
                </div>
              </div>
              <div class="right-side-column">
                <span class="text-with-padding">Подпишитесь на нас</span>
                <div class="icons-container">
                  <a href="https://instagram.com" class="link">
                    <svg viewBox="0 0 877.7142857142857 1024" class="icon" >
                      <path  d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z" ></path>
                    </svg>
                  </a>
                  <a href="https://facebook.com" class="link">
                    <svg
                      viewBox="0 0 602.2582857142856 1024"
                      class="icon">
                      <path d="M548 6.857v150.857h-89.714c-70.286 0-83.429 33.714-83.429 82.286v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571c0-144.571 88.571-223.429 217.714-223.429 61.714 0 114.857 4.571 130.286 6.857z"></path>
                    </svg>
                  </a>
                  <a href="https://twitter.com" class="link">
                    <svg
                      viewBox="0 0 950.8571428571428 1024"
                      class="icon">
                      <path d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z" ></path>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
        </div>
        <div class="main-component">
        <form action="" method="post" style="width: 100%; display: flex; flex-direction: column;">
        
          <div class="container01">
            <div class="container02">
              <h2><?php  echo $hotel['Название'].', номер '.$room['Название_номера']  ?></h2>
              <span class="text12"><?php  echo $hotel['Адрес']?></span>
              <div class="container03">
                <svg viewBox="0 0 1024 1024" class="icon">
                  <path
                    d="M810 854v-470h-596v470h596zM810 170q34 0 60 26t26 60v598q0 34-26 59t-60 25h-596q-36 0-61-24t-25-60v-598q0-34 25-60t61-26h42v-84h86v84h340v-84h86v84h42zM726 470v84h-86v-84h86zM554 470v84h-84v-84h84zM384 470v84h-86v-84h86z"
                  ></path>
                </svg>
                <label><?php  echo 'Заезд: '.$_SESSION['arrivalDate'].', выезд: '.$_SESSION['departureDate'];?></label>
              </div>
              <div class="container04">
                <svg viewBox="0 0 1024 1024" class="icon">
                  <path
                    d="M384 554q64 0 140 18t139 60 63 94v128h-684v-128q0-52 63-94t139-60 140-18zM640 512q-26 0-56-10 56-66 56-160 0-38-16-86t-40-76q30-10 56-10 70 0 120 51t50 121-50 120-120 50zM214 342q0-70 50-121t120-51 120 51 50 121-50 120-120 50-120-50-50-120zM712 560q106 16 188 59t82 107v128h-172v-128q0-98-98-166z"
                  ></path>
                </svg>
                <?php if ($_SESSION['maxOccupancy']==1) { ?>
                  <label>1 человек</label>
                <?php } else { ?>
                  <label><?php echo $_SESSION['maxOccupancy']?> человека</label>
                <?php } ?>
              </div>
              <div class="container05">
                <svg viewBox="0 0 1024 1024" class="icon">
                  <path
                    d="M224 0c-106.040 0-192 100.288-192 224 0 105.924 63.022 194.666 147.706 217.998l-31.788 518.124c-2.154 35.132 24.882 63.878 60.082 63.878h32c35.2 0 62.236-28.746 60.082-63.878l-31.788-518.124c84.684-23.332 147.706-112.074 147.706-217.998 0-123.712-85.96-224-192-224zM869.334 0l-53.334 320h-40l-26.666-320h-26.668l-26.666 320h-40l-53.334-320h-26.666v416c0 17.672 14.326 32 32 32h83.338l-31.42 512.122c-2.154 35.132 24.882 63.878 60.082 63.878h32c35.2 0 62.236-28.746 60.082-63.878l-31.42-512.122h83.338c17.674 0 32-14.328 32-32v-416h-26.666z"
                  ></path>
                </svg>
                <label><?php echo $_SESSION['chosen_food_type'].', '.$foodCost.'₽ на '.$days.' дней' ?></label>
              </div>
              <label class="text16">Выбранные услуги на <?php echo $ServicesCost.'₽ : '. implode(', ', $_SESSION['service'])?></label>
              <h3> Общая стоимость: <span class="primaryText" ><?php echo $cost?> </span> рублей </h3>
            </div>
            <img
              alt="image"
              src=<?php echo "../img/".$hotel['Фото']?>
              class="image"
            />
          </div>
          <div class="container06">
            <h2>Контактная информация</h2>
            <span>Пришлем чек и информацию о бронировании</span>
            <div class="container07">
              <input
                type="text"
                placeholder="Email"
                class="hotel1-textinput input"
                value="<?php if (!isset($_SESSION['email_input'])) 
                                        {if (isset($_COOKIE['login'])) 
                                            {echo $_COOKIE['login'];}}
                                     elseif  (isset($_SESSION['email_input'])) {echo $_SESSION['email_input'];} else echo "";?>"
                required
                name="input_email"
              />
              <input
                type="text"
                placeholder="Телефон"
                name="phone_input"
                class="hotel1-textinput input"
                value="<?php if (!isset($_SESSION['phone_input'])) 
                                        {if (isset($_SESSION['phone'])) 
                                            {echo $_SESSION['phone'];}}
                                     elseif  (isset($_SESSION['phone_input'])) {echo $_SESSION['phone_input'];} else echo "";?>"
                pattern="\d{1,11}"
                required
              />
            </div>
          </div>
          <div class="container08">
          <?php if ($_SESSION['maxOccupancy']==1) { ?>
                <h2>Гости, 1 человек</h2>
                <?php } else { ?>
                  <h2>Гости, <?php echo $_SESSION['maxOccupancy']?> человека</h2>
                <?php } ?>
            <span>Укажите данные о гостях</span>
            <div class="container09">
              <h4>
                <span>Основной гость</span>
                <br />
              </h4>
              <span>Взрослый</span>
              <div class="container10">
                <input
                  type="text"
                  placeholder="Имя"
                  name="firstname_input"
                  class="hotel1-textinput input"
                  value="<?php if (!isset($_SESSION['firstname_input'])) 
                                        {if (isset($_SESSION['firstname'])) 
                                            {echo $_SESSION['firstname'];}}
                                     elseif  (isset($_SESSION['firstname_input'])) {echo $_SESSION['firstname_input'];} else echo "";?>"
                  required
                />
                <input
                  type="text"
                  placeholder="Фамилия"
                  name="lastname_input"
                  class="hotel1-textinput input"
                  value="<?php if (!isset($_SESSION['lastname_input'])) 
                                        {if (isset($_SESSION['lastname'])) 
                                            {echo $_SESSION['lastname'];}}
                                     elseif  (isset($_SESSION['lastname_input'])) {echo $_SESSION['lastname_input'];} else echo "";?>"
                  required
                />
              </div>
            </div>
          </div>
              <button name="booking_the_room" type="submit" class="hotel1-button">Забронировать</button>
             
        </form>
        <?php if (isset($_POST['booking_the_room'])) {?> 
                     <a href="<?php echo $file_path;?>" download>
                        <button> Сохранить чек </button>
                    </a><?php 
                };?>
        </div>
        <div class="footer">
          <div class="menu">
            <h1>
              <span>ОтдыхОмут</span>
              <br />
            </h1>
            <div class="links-container2">
              <div class="container3">
                <a href="https://example.com" class="link-footer"> Все базы отдыха </a>
                <a href="https://example.com" class="link-footer"> Персональные предложения </a>
                <a href="https://example.com" class="link-footer"> Ваш заказ </a>
                <a href="https://example.com" class="link08"> Работа у нас </a>
              </div>
              <div class="container4">
                <a href="https://example.com" class="link-footer"> О нас </a>
                <a href="https://example.com" class="link-footer"> FAQ </a>
                <a href="https://example.com" class="link08"> Контакты </a>
              </div>
            </div>
            <div class="follow-container1"></div>
          </div>
        </div>
      </div>
    </div>
    <script
      defer=""
      src="https://unpkg.com/@teleporthq/teleport-custom-scripts"
    ></script>
    </body>
</html>