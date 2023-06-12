<?php
require_once "../config/system.php";
$chapters = $connect->actionsChapter("getChapter", "", "");
checkSession();
if (isset($_POST["topic_name"]) && (isset($_POST["topic_text"]))) :
  $cur_id = $_GET["id_user"] = $_SESSION["id"];
  $author = $_GET["topic_author"] = $_SESSION["login"];
  $topic_name = $_POST["topic_name"];
  $topic_text = $_POST["topic_text"];
  $chapter = $_GET["chapter"];
  $connect->actionsTopic("addTopic", $chapter, "", "", "", $cur_id, $author);
  $user = $_GET["user"] = $_SESSION["login"];
  $connect->logInfo("add_topic", $user);
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
    <title>AuThOrIzKeY - Добавление темы</title>
  </head>

  <body>
    <header class="header">
      <nav class="header_nav">
        <button type="button" class="logo btnToTop" aria-label="none" onclick="document.location='../index.php?topic=1'"></button>
      </nav>
    </header>

    <main class="main">
      <form method="post">
        <h1>Добавление темы <img class="icon" src="../src/icons/plus.png" width="30" height="30" alt="add icon" /></h1>
        <input name="topic_name" placeholder="Введите название темы">
        <input name="topic_text" placeholder="Введите текст">
        <button class="button" type="submit">Добавить тему</button>
      </form>
    </main>

    <footer class="footer">
    <p class="footer_item copyright">© Copyrights by Me. All Rights Reserved</p>
      <a class="footer_item_call" href="message.php"><img class="footer_icon" src="../src/icons/call.png" width="30" height="30" alt="message_icon"></a>
    </footer>
  </body>

  </html>
<?php endif; ?>