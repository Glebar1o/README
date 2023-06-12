<?php
require_once "../config/system.php";
checkSession();
if (isset($_POST["text"])) :
    $answer_text = $_POST["text"];
    $chapter = $_GET["chapter"];
    $topic = $_GET["topic"];
    $answer = $_GET["answer"];
    $connect->actionsAnswer("editAnswer", $chapter, $topic, $answer, $answer_text, "", "", "");
    $user = $_GET["user"] = $_SESSION["login"];
    $connect->logInfo("edit_answer", $user);
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
        <title>AuThOrIzKeY - Редактирование ответа</title>
    </head>

    <body>
        <header class="header">
            <nav class="header_nav">
                <button type="button" class="logo btnToTop" aria-label="none" onclick="document.location='../index.php?topic=1'"></button>
            </nav>
        </header>

        <main class="main">
            <form method="post">
                <h1>Редактирование ответа <img class="icon" src="../src/icons/answer.png" width="30" height="30" alt="add icon" /></h1>
                <input name="text" type="text" placeholder="Введите текст ответа"></textarea>
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