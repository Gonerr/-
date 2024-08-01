<?php
require_once('../require/orders_require.php');
?>
<html>
    <head>
        <title>ОмутОтдых</title>
        <meta charset="utf-8">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <link href="../css/index.css" rel="stylesheet" type="text/css">
        <link href="../css/orders.css" rel="stylesheet" type="text/css">
        <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        data-tag="font"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <a href="#hotels" class="text">Базы отдыха</a>
                <span class="text">Контакты</span>
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

        <form onsubmit="FindRooms(event)"  action="orders.php" method="post" class="search_form">
        <div class="container1">
            <h1 class="text24">
              Загородный отдых в Омутнинске
            </h1>
            <span class="text25">Выберите время, а мы подберём Вам подходящие варианты для отдыха</span>
           
            <div class="container2">

            
            <div id ="LocationName">
                <svg viewBox="0 0 822.272 1024" class="icon4">
                    <path d="M786.286 91.429c36.571 36.571 0 128-54.857 182.857l-92 92 91.429 397.714c1.714 6.857-1.143 14.286-6.857 18.857l-73.143 54.857c-2.857 2.286-6.857 3.429-10.857 3.429-1.143 0-2.286 0-4-0.571-5.143-1.143-9.714-4-12-9.143l-159.429-290.286-148 148 30.286 110.857c1.714 6.286 0 12.571-4.571 17.714l-54.857 54.857c-3.429 3.429-8.571 5.143-13.143 5.143h-1.143c-5.714-0.571-10.286-2.857-13.714-7.429l-108-144-144-108c-4.571-2.857-6.857-8-7.429-13.143s1.714-10.286 5.143-14.286l54.857-55.429c3.429-3.429 8.571-5.143 13.143-5.143 1.714 0 3.429 0 4.571 0.571l110.857 30.286 148-148-290.286-159.429c-5.143-2.857-8.571-8-9.714-13.714-0.571-5.143 1.143-11.429 5.143-15.429l73.143-73.143c4.571-4 11.429-6.286 17.143-4.571l380 90.857 91.429-91.429c54.857-54.857 146.286-91.429 182.857-54.857z"></path>
                </svg>
                <label>Выберите вид отдыха</label>
            </div>
            
              <select class="select" id="LocationType" name="type_of_journey">
                <option value="" disabled <?php echo ($selected_type_of_journey == '' && $_POST['type_of_journey']=='' ? 'selected' : ''); ?>>Место отдыха</option>
                <?php foreach ($journeys as $journeyType => $label) { ?>
                      <option value="<?php echo $journeyType; ?>"
                      <?php if (isset($_POST['type_of_journey']) && $_POST['type_of_journey'] === $journeyType) echo "selected";
                            elseif (!isset($_POST['type_of_journey']) && $selected_type_of_journey === $journeyType) echo "selected";?>>
                            <?php echo $journeyType; ?></option>
                  <?php } ?>
              </select>   

              <div id ="CountName">
                <svg viewBox="0 0 1024 1024" class="icon4">
                    <path d="M554 554q80 0 168 35t88 93v86h-512v-86q0-58 88-93t168-35zM838 562q74 12 130 43t56 77v86h-128v-86q0-68-58-120zM554 470q-52 0-90-38t-38-90 38-90 90-38 90 38 38 90-38 90-90 38zM768 470q-20 0-38-6 38-54 38-122t-38-122q18-6 38-6 52 0 90 38t38 90-38 90-90 38zM342 426v86h-128v128h-86v-128h-128v-86h128v-128h86v128h128z"></path>
                </svg>
                <label >Выберите число отдыхающих</label>
              </div>
              <div class="select" onclick="toggleVisibility()" id="Button_Count" name="Button_Count"  value="">
                <?php echo $text_for_button ?>
              </div>

              <div id = "arrivalDateName">
                <svg viewBox="0 0 950.8571428571428 1024" class="icon3">
                <path d="M73.143 950.857h164.571v-164.571h-164.571v164.571zM274.286 950.857h182.857v-164.571h-182.857v164.571zM73.143 749.714h164.571v-182.857h-164.571v182.857zM274.286 749.714h182.857v-182.857h-182.857v182.857zM73.143 530.286h164.571v-164.571h-164.571v164.571zM493.714 950.857h182.857v-164.571h-182.857v164.571zM274.286 530.286h182.857v-164.571h-182.857v164.571zM713.143 950.857h164.571v-164.571h-164.571v164.571zM493.714 749.714h182.857v-182.857h-182.857v182.857zM292.571 256v-164.571c0-9.714-8.571-18.286-18.286-18.286h-36.571c-9.714 0-18.286 8.571-18.286 18.286v164.571c0 9.714 8.571 18.286 18.286 18.286h36.571c9.714 0 18.286-8.571 18.286-18.286zM713.143 749.714h164.571v-182.857h-164.571v182.857zM493.714 530.286h182.857v-164.571h-182.857v164.571zM713.143 530.286h164.571v-164.571h-164.571v164.571zM731.429 256v-164.571c0-9.714-8.571-18.286-18.286-18.286h-36.571c-9.714 0-18.286 8.571-18.286 18.286v164.571c0 9.714 8.571 18.286 18.286 18.286h36.571c9.714 0 18.286-8.571 18.286-18.286zM950.857 219.429v731.429c0 40-33.143 73.143-73.143 73.143h-804.571c-40 0-73.143-33.143-73.143-73.143v-731.429c0-40 33.143-73.143 73.143-73.143h73.143v-54.857c0-50.286 41.143-91.429 91.429-91.429h36.571c50.286 0 91.429 41.143 91.429 91.429v54.857h219.429v-54.857c0-50.286 41.143-91.429 91.429-91.429h36.571c50.286 0 91.429 41.143 91.429 91.429v54.857h73.143c40 0 73.143 33.143 73.143 73.143z"></path></svg>
                <label>Выберите дату приезда</label>
              </div>
              <input type="date" id="arrivalDate" class="select" name="arrivalDate"
                value="<?php if (isset($_SESSION['arrivalDate'])) { 
                                    echo $_SESSION['arrivalDate']; 
                                } elseif (isset($_POST['arrivalDate'])) { 
                                    echo $_POST['arrivalDate']; 
                                } else { 
                                    echo ""; 
                                } ?>" min="<?php echo date('Y-m-d'); ?>" 
                                required/>


              <div id = "nameDepartureDate">
                <svg viewBox="0 0 950.8571428571428 1024" class="icon3">
                <path d="M73.143 950.857h164.571v-164.571h-164.571v164.571zM274.286 950.857h182.857v-164.571h-182.857v164.571zM73.143 749.714h164.571v-182.857h-164.571v182.857zM274.286 749.714h182.857v-182.857h-182.857v182.857zM73.143 530.286h164.571v-164.571h-164.571v164.571zM493.714 950.857h182.857v-164.571h-182.857v164.571zM274.286 530.286h182.857v-164.571h-182.857v164.571zM713.143 950.857h164.571v-164.571h-164.571v164.571zM493.714 749.714h182.857v-182.857h-182.857v182.857zM292.571 256v-164.571c0-9.714-8.571-18.286-18.286-18.286h-36.571c-9.714 0-18.286 8.571-18.286 18.286v164.571c0 9.714 8.571 18.286 18.286 18.286h36.571c9.714 0 18.286-8.571 18.286-18.286zM713.143 749.714h164.571v-182.857h-164.571v182.857zM493.714 530.286h182.857v-164.571h-182.857v164.571zM713.143 530.286h164.571v-164.571h-164.571v164.571zM731.429 256v-164.571c0-9.714-8.571-18.286-18.286-18.286h-36.571c-9.714 0-18.286 8.571-18.286 18.286v164.571c0 9.714 8.571 18.286 18.286 18.286h36.571c9.714 0 18.286-8.571 18.286-18.286zM950.857 219.429v731.429c0 40-33.143 73.143-73.143 73.143h-804.571c-40 0-73.143-33.143-73.143-73.143v-731.429c0-40 33.143-73.143 73.143-73.143h73.143v-54.857c0-50.286 41.143-91.429 91.429-91.429h36.571c50.286 0 91.429 41.143 91.429 91.429v54.857h219.429v-54.857c0-50.286 41.143-91.429 91.429-91.429h36.571c50.286 0 91.429 41.143 91.429 91.429v54.857h73.143c40 0 73.143 33.143 73.143 73.143z"></path></svg>
                <label>Выберите дату отъезда</label>
              </div>
                
              <input type="date" id="departureDate" class="select" name="departureDate"
                value="<?php if (isset($_SESSION['departureDate'])) { 
                                    echo $_SESSION['departureDate']; 
                                } elseif (isset($_POST['departureDate'])) { 
                                    echo $_POST['departureDate']; 
                                } else { 
                                    echo ""; 
                                } ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" 
                                required/>

              <button name="find_place_button" type="submit" class="landing-page-button button">
                Найти лучшее место
              </button>
            
            </div>
          </div>
        </div>
        </form>

        <div class="count-of-men root-class-name" id="rootElement">
          <div class="row">
            <div class="column-center">
              <h4>Взрослые</h4>
              <span>От 18 лет</span>
            </div>
            <div class="row-center">
              <svg
                viewBox="0 0 877.7142857142857 1024"
                class="count-of-men-icon">
                <path d="M694.857 548.571v-73.143c0-20-16.571-36.571-36.571-36.571h-438.857c-20 0-36.571 16.571-36.571 36.571v73.143c0 20 16.571 36.571 36.571 36.571h438.857c20 0 36.571-16.571 36.571-36.571zM877.714 512c0 242.286-196.571 438.857-438.857 438.857s-438.857-196.571-438.857-438.857 196.571-438.857 438.857-438.857 438.857 196.571 438.857 438.857z" ></path>
              </svg>
              <h2 id="Count_of_parents">1</h2>
              <svg
                viewBox="0 0 877.7142857142857 1024"
                class="count-of-men-icon">
                <path d="M694.857 548.571v-73.143c0-20-16.571-36.571-36.571-36.571h-146.286v-146.286c0-20-16.571-36.571-36.571-36.571h-73.143c-20 0-36.571 16.571-36.571 36.571v146.286h-146.286c-20 0-36.571 16.571-36.571 36.571v73.143c0 20 16.571 36.571 36.571 36.571h146.286v146.286c0 20 16.571 36.571 36.571 36.571h73.143c20 0 36.571-16.571 36.571-36.571v-146.286h146.286c20 0 36.571-16.571 36.571-36.571zM877.714 512c0 242.286-196.571 438.857-438.857 438.857s-438.857-196.571-438.857-438.857 196.571-438.857 438.857-438.857 438.857 196.571 438.857 438.857z"></path>
              </svg>
            </div>
          </div>
          <div class="count-of-men-delimetr"></div>
          <div class="row">
            <div class="column-center">
              <h4>Дети</h4>
              <span>От 0 до 17 лет</span>
            </div>
            <div class="row-center">
              <svg
                viewBox="0 0 877.7142857142857 1024"
                class="count-of-men-icon" id="minus_children">
                <path d="M694.857 548.571v-73.143c0-20-16.571-36.571-36.571-36.571h-438.857c-20 0-36.571 16.571-36.571 36.571v73.143c0 20 16.571 36.571 36.571 36.571h438.857c20 0 36.571-16.571 36.571-36.571zM877.714 512c0 242.286-196.571 438.857-438.857 438.857s-438.857-196.571-438.857-438.857 196.571-438.857 438.857-438.857 438.857 196.571 438.857 438.857z" ></path>
              </svg>
              <h2 id="Count_of_children">1</h2>
              <svg
                viewBox="0 0 877.7142857142857 1024"
                class="count-of-men-icon" id="plus_children">
                <path d="M694.857 548.571v-73.143c0-20-16.571-36.571-36.571-36.571h-146.286v-146.286c0-20-16.571-36.571-36.571-36.571h-73.143c-20 0-36.571 16.571-36.571 36.571v146.286h-146.286c-20 0-36.571 16.571-36.571 36.571v73.143c0 20 16.571 36.571 36.571 36.571h146.286v146.286c0 20 16.571 36.571 36.571 36.571h73.143c20 0 36.571-16.571 36.571-36.571v-146.286h146.286c20 0 36.571-16.571 36.571-36.571zM877.714 512c0 242.286-196.571 438.857-438.857 438.857s-438.857-196.571-438.857-438.857 196.571-438.857 438.857-438.857 438.857 196.571 438.857 438.857z"></path>
              </svg>
            </div>
          </div>
        </div>


        
        <div class="main-component" id="hotels">
         
          <div class="container02">
          <form onsubmit="filteredCards(event)" action="orders.php" method="get" class="Filter_form" id="FilterForm">
            <div class="container03">
            <?php if (isset($_COOKIE['auth']) && $_COOKIE['auth'] === 'true'){ ?>
              <div class="container04">
                <button type="button" class="all-button button text11">
                    <div class="row1">
                    <svg viewBox="0 0 1024 1024" class="icon13">
                        <path d="M726 128q34 0 59 26t25 60v682l-298-128-298 128v-682q0-34 25-60t59-26h428z"></path>
                    </svg>
                    Избранные места
                    </div>
                </button>
              </div>
              <?php } ?>
              <div class="container05"></div>
              <div class="options">

                <div class="one-option">
                    <label class="text14">Тип отдыха</label>
                    <?php foreach ($relax_types as $index => $relax_type): ?>
                        <div class="container-for-take">
                            <input type="checkbox" id="type_of_relax<?php echo $index + 1; ?>" name="type_of_relax[]" value ="<?= $relax_type ?>" class="all-checkbox"
                              <?php if (isset($_SESSION['type_of_relax']) && in_array($relax_type, $_SESSION['type_of_relax'])) echo "checked"; ?>
                            />
                            <label for="type_of_relax<?php echo $index + 1; ?>"><?php echo $relax_type; ?></label>
                        </div>
                    <?php endforeach; ?>
                    <div class="delimetr"></div>
                </div>

                <div class="one-option">
                    <label class="text14">Тип питания</label>
                    <?php foreach ($food_types as $index => $food_type): ?>
                        <div class="container-for-take">
                            <input type="checkbox" id="food_type<?php echo $index + 1; ?>" name="food_type[]"  value ="<?= $food_type ?>" class="all-checkbox"
                            <?php if (isset($_SESSION['food_type']) && in_array($food_type, $_SESSION['food_type'])) echo "checked"; ?>
                            />
                            <label for="food_type<?php echo $index + 1; ?>"><?php echo $food_type; ?></label>
                        </div>
                    <?php endforeach; ?>
                    <div class="container-for-take"></div>
                </div>

                <div class="one-option">
                    <label class="text14">Услуги</label>
                    <?php foreach ($services as $index => $service): ?>
                        <div class="container-for-take">
                            <input type="checkbox" id="service<?php echo $index + 1; ?>" name="service[]"  value="<?= $service ?>" class="all-checkbox"
                              <?php if (isset($_SESSION['service']) && in_array($service, $_SESSION['service'])) echo "checked"; ?>
                            />
                            <label for="service<?php echo $index + 1; ?>"><?php echo $service; ?></label>
                        </div>
                    <?php endforeach; ?>
                    <div class="delimetr"></div>
                </div>

                  <div class="one-option">
                      <label class="text14">Бюджет</label>
                      <?php foreach ($budgets as $index => $budget): ?>
                          <div class="container-for-take">
                              <input type="radio" id="budget<?php echo $index + 1; ?>" name="budget"  value="<?=$budget?>" class="all-radiobutton"
                              <?php if (isset($_SESSION['budget']) && $budget === $_SESSION['budget']) {echo "checked"; }
                                    elseif (!isset($_SESSION['budget']) && $index === 4) {echo 'checked';} ?> />
                              <label for="budget<?php echo $index + 1; ?>"><?php echo $budget; ?></label>
                          </div>
                      <?php endforeach; ?>
                      <div class="delimetr"></div>
                  </div>
                  
                <div class="one-option">
                  <label class="text14">Оценка гостей</label>
                    <?php foreach ($ratings as $index => $rating): ?>
                        <div class="container-for-take">
                            <input type="radio" id="rate<?php echo $index + 1; ?>" name="rate" value="<?=$rating?>" class="all-radiobutton"
                                <?php if (isset($_SESSION['rating']) && $rating === $_SESSION['rating']) {echo "checked"; }
                                        elseif (!isset($_SESSION['rating']) && $index === 3) {echo 'checked';} ?> /> 
                            <label for="rate<?php echo $index + 1; ?>"><?php echo $rating; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
              </div>
              <div class="all-container34"></div>
              <button type="submit" name="filter_hotels" class="all-button1 button">
                <span class="all-text42"> Поиск </span>
              </button>
              
            </div>
            </form>
            </div>
            
          
          <div class="cards">
            <div class="row-card1">
            <input type="text" placeholder="Поиск по названию" class="all-textinput input"/>
                <button type="button" onclick="loadCards()" class="all-button width20 button text11">
                    Сбросить поиск
                </button>
            </div>
          
            <div class="all-container35" id="all-container35">
              
              <div class="card">

                <img
                  src="https://images.unsplash.com/photo-1614018895964-710b5e422043?ixid=M3w5MTMyMXwwfDF8c2VhcmNofDZ8fCVEMSU4MSVEMCVCMCVEMCVCRCVEMCVCMCVEMSU4MiVEMCVCRSVEMSU4MCVEMCVCOCVEMCVCOXxlbnwwfHx8fDE3MTU5NDgxOTV8MA&amp;ixlib=rb-4.0.3&amp;w=1500"
                  alt="image"
                  class="card-image"
                />
                <div class="card-description">

                  <div class="row-card"> 

                  <div class="card-main-description">
                    <div class="card-container">
                      <p class="card-text">8,1</p>
                      <p class="card-text1">Очень хорошо</p>
                    </div>
                    <h4 class="card-text2">Тип отеля</h4>
                    <h3>Название отеля</h3>
                    <p class="card-text4">Расстояние до водоёма</p>
                  </div>

                  <div class="card-price">
                    <h2 class="text-price"> От 5500 руб. </h2>
                  </div>
                
                  </div>

                  <div class="card-no-main-description">
                    <p class="card-text5">Улица, дом</p>
                    <div class="card-container1">
                      <button class="card-button">
                        Выбрать &gt;
                      </button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <button class="all-button2">Выбрать &gt;</button>
        

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
    <script src="../js/buttons.js"></script>
    <script src="../js/for_orders.js"></script>

</html>