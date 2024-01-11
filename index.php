<!DOCTYPE html>
<html>
  <head>
    <title>Лес</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Функция для обновления списка машин
    function refreshList() {
      // Выполняем AJAX запрос к файлу script.php для получения обновленного списка машин
      $.ajax({
        url: "script.php",
        type: "GET",
        success: function(data) {
          // Заменяем содержимое всплывающего списка новыми данными
          $("#carList").html(data);
        }
      });
    }
  </script>
  </head>
<body>
    <h2>Список названий</h2>
<!-- Водим данные машин -->
    <form method="post">
        <input type="text" id="text" name="namy">
        <input type="text" id="text" name="x1">
        <input type="text" id="text" name="y1">
        <input type="submit" value="Добавить">
    </form>

    <br><br><hr>
<!-- Всплывающий список -->
    <form method="post">
      <select name="namy">
        <?php
        // Устанавливаем соединение с базой данных
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'Car';
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Сделаем запрос к базе данных
        $sql = "SELECT id, namy FROM cars";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // выводим данные в виде всплывающего списка
            while($row = $result->fetch_assoc()) {
              echo "<option value='" . $row["id"] . "'>" . $row["id"] . " " . $row["namy"] . "</option>";
            }
        } else {
            echo "Нет данных";
        }
        $conn->close();
        ?>
      </select>
  <!-- Добавляем кнопку для обновления списка машин -->
      <button onclick="refreshList()">Обновить список</button>
      <input type="submit" value="Отправить">
    </form>
      <?php

          


        $mysql = new mysqli("localhost", "root", "", "Car");
        $mysql->query("SET NAMES 'utf8mb3' ");
        
        if ($mysql->connect_error) {
            echo 'Error Number: '.$mysql->connect_error.'<br>';
            echo 'Error: '.$mysql->connect_error;
        }
            // echo 'Host info: '.$mysql->host_info;
            // $mysql->query ("CREATE TABLE `cars` (
            // id INT NOT NULL,
            // namy VARCHAR(50) NOT NULL,
            // PRIMARY KEY(id)
            // )");
            
            
            // Добавить значение
            $namy = $_POST['namy'];
            $x1 = $_POST['x1'];
            $y1 = $_POST['y1'];
            $mysql->query("INSERT INTO cars (`namy`, `x1`, `y1`) VALUES('$namy', '$x1', '$y1') ");
            
            // Пример

            // Проверка, была ли выбрана опция из списка
          if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["namy"])) {
            // Получение выбранного значения
            $selected_namy = $_POST["namy"];
            }

            $sql = "SELECT х1, у1 FROM cars WHERE namy = '$selected_namy'";
            $result = $mysql->query($sql);

            if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
  
              // Использование значений в формуле
              $x = $row["х1"];
              $у = $row["у1"];
              $rez = $x * $у;

              // Вывод результата
            echo "<h2>Результат расчета:</h2>";
            echo "<p>Значение х: " . $x . "</p>";
            echo "<p>Значение у: " . $y . "</p>";
            echo "<p>Результат: " . $rez . "</p>";
        } else {
            echo "<p>Нет данных для выбранного значения.</p>";
        }










          //   $selected_car = $_POST["car"];
            
          //   $sql = "SELECT x1 FROM cars WHERE car = " . $selected_car;
          //   $result = $mysql->query($sql);

          //   if ($result->num_rows > 0) {
          //     while($row = $result->fetch_assoc()) {
          //         echo "Использование машины '{$selected_car}': " . $row["x1"];
          //     }
          // } 

            // if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //   $selectedCar = $_POST["car"];
            //   $result = 3 + 4 + $selectedCar;
            //   echo "Результат: " . $result;
            // }

        

        $mysql->close();
        ?>
    </body>

</html>
