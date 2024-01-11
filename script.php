<?php
  // Подключение к базе данных
  $conn = new mysqli("localhost", "root", "", "Car");

  // Проверка соединения
  if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
  }

  // Выполнение SQL запроса для получения обновленного списка машин
  $sql = "SELECT namy FROM cars";
  $result = $conn->query($sql);

  // Форматирование данных в HTML для отображения во всплывающем списке
  $html = "";
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $html .= "<option>" . $row["namy"] . "</option>";
    }
  } else {
    $html = "<option>Нет данных</option>";
  }

  // Возвращаем HTML список машин
  echo $html;

  $conn->close();
?>