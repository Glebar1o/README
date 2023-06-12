<?php
require_once "../config/system.php";
checkSession();
if (isset($_POST["name"]) && ($_POST["text"])) :
    $topic_name = $_POST["name"];
    $topic_text = $_POST["text"];
    $chapter = $_GET["chapter"];
    $topic = $_GET["topic"];
    $connect->actionsTopic("editTopic", $chapter, $topic, $topic_name, $topic_text, "", "");
    $user = $_GET["user"] = $_SESSION["login"];
    $connect->logInfo("edit_topic", $user);
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
        <title>AuThOrIzKeY - Редактирование темы</title>
    </head>

    <body>
        <header class="header">
            <nav class="header_nav">
                <button type="button" class="logo btnToTop" aria-label="none" onclick="document.location='../index.php?topic=1'"></button>
            </nav>
        </header>

        <main class="main">
            <form method="post">
                <h1>Редактирование темы <img class="icon" src="../src/icons/edit.png" width="30" height="30" alt="add icon" /></h1>
                <input name="name" type="text" placeholder="Введите название темы">
                <input name="text" type="text" placeholder="Введите текст темы"></textarea>
                <button class="button" type="submit">Внести изменения</button>
            </form>
        </main>

        <footer class="footer">
        <p class="footer_item copyright">© Copyrights by Me. All Rights Reserved</p>
            <a class="footer_item_call" href="message.php"><img class="footer_icon" src="../src/icons/call.png" width="30" height="30" alt="message_icon"></a>
        </footer>
    </body>

    </html>


<?php endif; ?>