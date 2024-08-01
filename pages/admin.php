<?php
require_once('../require/admin_require.php');
?>


<html>
    <head>
        <title>Административная панель</title>
        <meta charset="utf-8">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <link href="../css/index.css" rel="stylesheet" type="text/css">
        <link href="../css/admin.css" rel="stylesheet" type="text/css">
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
              <?php 
               if (isset($_COOKIE['auth']) && $_COOKIE['auth'] === 'true'){ ?>
                <a href="account.php" class="link">
                    <svg viewBox="0 0 1024 1024" class="icon2">
                      <path d="M870.286 765.143c-14.857-106.857-58.286-201.714-155.429-214.857-50.286 54.857-122.857 89.714-202.857 89.714s-152.571-34.857-202.857-89.714c-97.143 13.143-140.571 108-155.429 214.857 79.429 112 210.286 185.714 358.286 185.714s278.857-73.714 358.286-185.714zM731.429 365.714c0-121.143-98.286-219.429-219.429-219.429s-219.429 98.286-219.429 219.429 98.286 219.429 219.429 219.429 219.429-98.286 219.429-219.429zM1024 512c0 281.714-228.571 512-512 512-282.857 0-512-229.714-512-512 0-282.857 229.143-512 512-512s512 229.143 512 512z" ></path>
                  </svg>
                </a>
              <?php } ?>
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

        
        <div class="main-container">
        <h1>Административная панель</h1>
          <form id="tableForm" method="post" action="admin.php">
            <div>
              <label for="tableSelect">Выберите таблицу:</label>
              <select id="tableSelect" name="table">
                  <?php foreach ($tables as $table): ?>
                      <option value="<?php echo htmlspecialchars($table); ?>"
                            <?php echo (isset($_SESSION['selected_table']) && $_SESSION['selected_table'] === $table) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($table); ?>
                        </option>
                  <?php endforeach; ?>
              </select>
              <button type="submit" name="choose" class="solid-button-button" >Выбрать</button>
              </div>
          </form>
          

          <?php if (isset($_POST['table'])) { ?>
          <h2>Таблица: <?php $table = $_POST['table']; echo $table; ?></h2>
          <form id="tableForm2" method='post' action='admin.php'>
              <table class='styled-table'>
                  <thead>
                      <tr>
                          <?php
                          foreach ($result[0] as $key => $value) {
                              echo "<th>$key</th>";
                          }?>
                          <th>Выбрать</th>
                      </tr>
                  </thead>
                  <tbody id="tableBody">
                      <?php
                      foreach ($result as $row) {
                          echo "<tr>";
                          foreach ($row as $key => $value) {
                              echo "<td><input type='text' name='data[{$row[$primaryKey]}][$key]' value='".htmlspecialchars($value)."'></td>";
                          }
                          echo "<td><input type='checkbox' name='selectedRows[]' value='{$row[$primaryKey]}'></td>";
                          echo "</tr>";
                      }?>
                  </tbody>
              </table>
              <input type='hidden' name='table' value='<?php echo htmlspecialchars($table); ?>'>
              <input type='hidden' name='primaryKey' value='<?php echo htmlspecialchars($primaryKey); ?>'>

              <div style="margin:1em; display: flex; justify-content: space-evenly; width:70%">
              <button type='button'  id="deleteButton" name='delete' class="solid-button-button width30">Удалить</button>
              <button type='button' id="addButton" class="solid-button-button width30">Добавить</button>
              <button type='button' id="saveButton" class="solid-button-button width30">Сохранить</button>
              </div>
              <div id="Warning"> </div>
            </form>
          <?php } ?>
          
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
    <script>
        
        function sendData(formData) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../require/operation_with_tables.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(new URLSearchParams(formData).toString());
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      document.getElementById('Warning').innerHTML = xhr.responseText;
                      updateTable(); 
                    } else {
                        console.error('Ошибка: ' + xhr.status);
                    }
                }
            };
        }

        document.getElementById('deleteButton').addEventListener('click', function(event) {
              event.preventDefault();
              console.log('удаление');
              var formData = new FormData(document.getElementById('tableForm2'));
              formData.append('action', 'delete');
              sendData(formData);
        });

        // Обработчик события нажатия на кнопку "Добавить"
        document.getElementById('addButton').addEventListener('click', function(event) {
            event.preventDefault();
            console.log('добавление');
            var tableBody = document.getElementById('tableBody');
            var newRow = document.createElement('tr');
            
            <?php foreach ($result[0] as $key => $value) { ?>
                newRow.innerHTML += "<td><input type='text' name='newRow[<?php echo $key; ?>]' value=''></td>";
            <?php } ?>

            newRow.innerHTML += "<td></td>"; // Empty cell for the checkbox
            tableBody.appendChild(newRow);
        });

        // Обработчик события нажатия на кнопку "Сохранить"
        document.getElementById('saveButton').addEventListener('click', function(event) {
            event.preventDefault();
            console.log('сохранение');
            var formData = new FormData(document.getElementById('tableForm2'));
            formData.append('action', 'save');
            sendData(formData);
        });


        function updateTable() {
              // Создаем запрос на обновление таблицы
              var table = '<?php echo $table; ?>';
              var xhr = new XMLHttpRequest();
              xhr.open('GET', '../require/update_table.php?table=' + encodeURIComponent(table), true); 
              xhr.send();
              xhr.onreadystatechange = function() {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                      if (xhr.status === 200) {
                          document.getElementById('tableBody').innerHTML = xhr.responseText;
                      } else {
                        document.getElementById('Warning').innerText = 'Ошибка при загрузке данных таблицы.';
                      }
                  }
              };
          }
        </script>
    </body>
</html>