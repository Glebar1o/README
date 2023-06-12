<?php
require_once "../config/system.php";
checkSession();
if (isset($_POST["answer_text"])) :
    $cur_id = $_GET["id_user"] = $_SESSION["id"];
    $author = $_GET["topic_author"] = $_SESSION["login"];
    $gender = $_GET["author_gender"] = $_SESSION["gender"];
    $chapter = $_GET["chapter"];
    $topic = $_GET["topic"];
    $connect->actionsAnswer("addAnswer", $chapter, $topic, "", "", $cur_id, $author, $gender);
    $user = $_GET["user"] = $_SESSION["login"];
    $connect->logInfo("add_answer", $user);
    header("Location: ../index.php?topic=1");
else :
?>

    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/" />
        <link rel="icon" href="../src/icons/main_icon.png" />
        <link rel="stylesheet" href="../styles/forms.css" />
        <title>AuThOrIzKeY - Создание ответа</title>
    </head>

    <body>
        <header class="header">
            <nav class="header_nav">
                <button type="button" class="logo btnToTop" aria-label="none" onclick="document.location='../index.php?topic=1'"></button>
            </nav>
        </header>

        <main class="main">
            <form method="post">
                <h1>Добавление ответа <img class="icon" src="../src/icons/answer.png" width="30" height="30" alt="add icon" /></h1>
                <input name="answer_text" placeholder="Введите текст ответа">
                <button class="button" type="submit">Ответить</button>
            </form>
        </main>

        <footer class="footer">
            <p class="footer_item copyright">© Copyrights by Me. All Rights Reserved</p>
            <a class="footer_item_call" href="message.php"><img class="footer_icon" src="../src/icons/call.png" width="30" height="30" alt="message_icon"></a>
        </footer>
    </body>

    </html>
<?php endif; ?>