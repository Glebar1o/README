<?php 
require_once "../config/system.php";
checkSession();
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../src/icons/main_icon.png" />
    <link rel="stylesheet" href="../styles/forms.css" />
    <title>AuThOrIzKeY - Создание раздела</title>
  </head>
  <body>
    <header class="header">
      <nav class="header_nav">
        <button
          type="button"
          class="logo btnToTop"
          aria-label="none"
          onclick="document.location='../index.php?topic=1'"
        ></button>
      </nav>
    </header>

    <main class="main">
      <form action="../php/chapter_add.php" method="post">
        <h1>
          Добавление раздела
          <img
            class="icon"
            src="../src/icons/plus.png"
            width="30"
            height="30"
            alt="add icon"
          />
        </h1>
        <input
          name="chapter_name"
          placeholder="Введите название раздела"
          required
        />
        <button class="button" type="submit">Создать раздел</button>
      </form>
    </main>

    <footer class="footer">
    <p class="footer_item copyright">© Copyrights by Me. All Rights Reserved</p>
      <a class="footer_item_call" href="message.php"
        ><img
          class="footer_icon"
          src="../src/icons/call.png"
          width="30"
          height="30"
          alt="message_icon"
      /></a>
    </footer>
  </body>
</html>
