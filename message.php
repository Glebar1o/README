<?php
require_once "../config/system.php";
checkSession();
if (isset($_POST["message_text"])) :
  $connect->messageAdd();
  $user = $_GET["user"] = $_SESSION["login"];
  $connect->logInfo("add_message", $user);
  header("Location: ../index.php?topic=1");
else :
?>



  <!DOCTYPE html>
  <html lang="ru">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/icons/main_icon.png" />
    <link rel="stylesheet" href="../styles/forms.css" />
    <title>AuThOrIzKeY - Обратная связь</title>
  </head>

  <body>
    <header class="header">
      <nav class="header_nav">
        <button type="button" class="logo btnToTop" aria-label="none" onclick="document.location='../index.php?topic=1'"></button>
      </nav>
    </header>

    <main class="main">
      <form method="post">
        <h1>
          Обратная связь с администрацией
          <img class="icon" src="../src/icons/call.png" width="30" height="30" alt="add icon" />
        </h1>
        <h2>8(977)751-07-80</h2>
        <input name="message_text" placeholder="Введите текст сообщения" required />
        <button class="button" type="submit">Отправить</button>
      </form>
    </main>

    <footer class="footer">
    <p class="footer_item copyright">© Copyrights by Me. All Rights Reserved</p>
    </footer>
  </body>

  </html>
<?php endif; ?>