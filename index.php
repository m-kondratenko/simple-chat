<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Chat</title>
    <link rel="stylesheet" href="css/main.css" title="test afterlogic">
    <script src="js/libs.min.js"></script>
  </head>
  <body>
    <h1><?php
      require_once '/php/main.php';
     ?></h1>
    <p>Введите свое имя:</p>
    <input data-bind="value: username" type="text"><br>
    <p>Введите сообщение:</p>
    <textarea data-bind="value: mesin"></textarea><br>
    <button data-bind="click: InsertMessage" type="button">Отправить сообщение, выведя историю </button><br>
    <button data-bind="click: GetMessages" type="button">Вывести историю сообщений</button>
    <div>* Чтобы отправить сообщение, введите свое имя и текст сообщения </div>
    <!--table for messages output-->
    <table>
      <!--head-->
      <thead>
        <tr>
          <th>Имя</th>
          <th>Сообщение</th>
          <th>Время отправления</th>
        </tr>
      </thead>
      <!--content-->
      <tbody data-bind="foreach: mes">
        <tr>
          <td data-bind="text: name"></td>
          <td data-bind="text: mesout"></td>
          <td data-bind="text: date"></td>
        </tr>
      </tbody>
    </table>
    <script src="js/viewModel.js"></script>
  </body>
</html>
