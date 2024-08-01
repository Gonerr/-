<?php
require_once "../require/index_auth.php";
?>

<html>
    <head>
        <title>Вход в ОмутОтдых</title>
        <meta charset="utf-8">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <link href="../css/index.css" rel="stylesheet" type="text/css">
        <link href="../css/registration.css" rel="stylesheet" type="text/css">
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
                <a href="../index.php" class="text">Главная</a>
                <a href="about.php" class="text">О нас</a>
                <a href="orders.php" class="text">Базы отдыха</a>
                <span class="text">Контакты</span>
              </div>
              <a href="#registration-section" class="link">
                <div class="solid-button-container">
                  <button class="solid-button-button">
                    <span>Регистрация</span>
                  </button>
                </div>
              </a>
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

        <div id ="registration-section" class="authorization-form-new">
          <div class="sign-in1-container thq-section-padding sign-in1-root-class-name">
            <div class="sign-in1-max-width thq-section-max-width">
            <div class="sign-in1-form-root" id="form_login">
            <div class="sign-in1-form">
                <div class="sign-in1-title-root">
                    <h2 class="sign-in1-text thq-heading-2">
                    Начать исследование Омутнинска
                </h2>
            <span class="sign-in1-text1 thq-body-large">
                Получите доступ к эксклюзивным сделкам и
                персонализированным предложениям, войдя в свою учетную
                запись.
            </span>
            </div>
                <form class="sign-in1-form1" name="registration-form" action="registration.php" method="post" enctype="multipart/form-data">
                    <div class="sign-in1-email">
                        <label for="thq-sign-in-1-email" class="sign-in1-text2 thq-body-large">
                            Адрес электронной почты:
                        </label>
                        <!-- Форма для ввода электронной почты -->
                        <input
                            name="login" 
                            type="email" 
                            id="thq-sign-in-1-email" 
                            required="true" 
                            placeholder="Email-адрес"
                            class="sign-in1-textinput thq-body-large thq-input"
                            value="<?php echo isset($_POST["login"]) ? $_POST["login"] : ""; ?>"/>
                    </div>
                    <div class="sign-in1-password">
                        <div class="sign-in1-container1">
                            <label for="thq-sign-in-1-password" class="sign-in1-text3 thq-body-large"> Пароль: </label>
                            <div class="sign-in1-hide-password">
                            <svg viewBox="0 0 1024 1024" class="sign-in1-icon">
                                <path d="M317.143 762.857l44.571-80.571c-66.286-48-105.714-125.143-105.714-206.857 0-45.143 12-89.714 34.857-128.571-89.143 45.714-163.429 117.714-217.714 201.714 59.429 92 143.429 169.143 244 214.286zM539.429 329.143c0-14.857-12.571-27.429-27.429-27.429-95.429 0-173.714 78.286-173.714 173.714 0 14.857 12.571 27.429 27.429 27.429s27.429-12.571 27.429-27.429c0-65.714 53.714-118.857 118.857-118.857 14.857 0 27.429-12.571 27.429-27.429zM746.857 220c0 1.143 0 4-0.571 5.143-120.571 215.429-240 432-360.571 647.429l-28 50.857c-3.429 5.714-9.714 9.143-16 9.143-10.286 0-64.571-33.143-76.571-40-5.714-3.429-9.143-9.143-9.143-16 0-9.143 19.429-40 25.143-49.714-110.857-50.286-204-136-269.714-238.857-7.429-11.429-11.429-25.143-11.429-39.429 0-13.714 4-28 11.429-39.429 113.143-173.714 289.714-289.714 500.571-289.714 34.286 0 69.143 3.429 102.857 9.714l30.857-55.429c3.429-5.714 9.143-9.143 16-9.143 10.286 0 64 33.143 76 40 5.714 3.429 9.143 9.143 9.143 15.429zM768 475.429c0 106.286-65.714 201.143-164.571 238.857l160-286.857c2.857 16 4.571 32 4.571 48zM1024 548.571c0 14.857-4 26.857-11.429 39.429-17.714 29.143-40 57.143-62.286 82.857-112 128.571-266.286 206.857-438.286 206.857l42.286-75.429c166.286-14.286 307.429-115.429 396.571-253.714-42.286-65.714-96.571-123.429-161.143-168l36-64c70.857 47.429 142.286 118.857 186.857 192.571 7.429 12.571 11.429 24.571 11.429 39.429z"></path>
                            </svg>
                            <span class="thq-body-small">Спрятать</span>
                            </div>
                        </div>
                    <input
                        name = "password"
                        type="password"
                        id="thq-sign-in-1-password"
                        required="true"
                        placeholder="Пароль"
                        class="sign-in1-textinput1 thq-body-large thq-input" />
                    </div>
                
                <div class="sign-in1-container2">
                    <div class="sign-in1-container3">
                        <button
                            type="submit"
                            name="login_button"
                            class="sign-in1-button thq-button-filled">
                            <span class="sign-in1-text5 thq-body-small">
                            Войти в аккаунт
                            </span>
                        </button>
                    </div>
                    <span class="Warning"> <?php echo $warning1 ?></span>
                    <div class="sign-in1-container4">
                    <span class="sign-in1-text6 thq-body-small">
                        Проблемы со входом
                    </span>
                    <span class="sign-in1-text7 thq-body-small">
                        Забыл пароль
                    </span>
                    </div>
                </div>
                <div class="sign-in1-divider">
                    <div class="sign-in1-divider1"></div>
                    <div class="sign-in1-divider2"></div>
                </div>
                <button
                    type="button"
                    class="sign-in1-button1 thq-button-outline" id="register-link">
                    <span class="thq-body-small">
                    Ещё нет аккаунта? Нажмите для регистрации
                    </span>
                </button>
                </div>
                </div>
                </form>

                <div class="sign-in2-form-root" id="registration_form">
                    <div class="sign-in1-form">
                        <div class="sign-in1-title-root">
                            <h2 class="sign-in1-text thq-heading-2">
                        Зарегистрируйтесь для доступа к эксклюзивным предложениям
                        </h2>
                        <span class="sign-in1-text1 thq-body-large">
                            Уже зарегистрированы? <a href="" class="link" id="login-link">Войдите</a>
                        </span>
                    </div>
                    <form class="sign-in2-form1" 
                        name="new-registration-form" 
                        action="registration.php"
                        method="post" 
                        enctype="multipart/form-data">
                        <div class="sign-in1-email">
                        <label
                            for="thq-sign-in-1-email"
                            class="sign-in1-text2 thq-body-large">
                            Адрес электронной почты:
                        </label>
                        <input
                            type="email"
                            id="thq-sign-in-2-email"
                            required="true"
                            placeholder="Email-адрес"
                            class="sign-in1-textinput thq-body-large thq-input"
                            name="newLogin"
                            />
                        </div>
                        <div class="sign-in1-password">
                        <div class="sign-in1-container1">
                            <label for="thq-sign-in-1-password" class="sign-in1-text3 thq-body-large">
                            Пароль:
                            </label>
                        </div>
                        <input
                            type="password"
                            id="thq-sign-in-2-password"
                            required="true"
                            placeholder="Пароль"
                            class="sign-in1-textinput1 thq-body-large thq-input"
                            name="newPassword" />
                        </div>
                        <div class="sign-in1-password">
                        <div class="sign-in1-container1">
                            <label
                            for="thq-sign-in-1-password"
                            class="sign-in1-text3 thq-body-large">
                            Повторите пароль:
                            </label>
                        </div>
                        <input
                            type="password"
                            id="thq-sign-in-3-password"
                            required="true"
                            placeholder="Повторите пароль"
                            class="sign-in1-textinput1 thq-body-large thq-input" 
                            name="repeatNewPassword"/>
                        </div>
                        <div class="container-for-checkbox">
                        <input type="checkbox" class="hotel-checkbox" name="isEmployee"/>
                        <label>Я сотрудник</label>
                      </div>
                    <span class="sign-up2-text08 thq-body-small">
                      Присоединяйтесь к нам, чтобы открыть для себя специальные
                      предложения, персональные рекомендации и инсайдерские
                      советы для вашего путешествия в Омутнинск.
                    </span>
                    

                    <div class="sign-in1-container2">
                        <div class="sign-in1-container3">
                        <button
                            type="submit"
                            class="sign-in1-button thq-button-filled"
                            name="createUserButton">
                            <span class="sign-in1-text5 thq-body-small">
                            Создать аккаунт
                            </span>
                        </button> 
                    </div>
                    <span class="Warning"> <?php echo $warning2 ?></span>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
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
    <script defer="" src="https://unpkg.com/@teleporthq/teleport-custom-scripts"></script>
    <script src="../js/for registration.js"></script>
    </body>
</html>