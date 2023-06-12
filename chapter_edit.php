<?php
require_once "../config/system.php";
checkSession();
if (isset($_POST["name"])) :
    $chapter_name = $_POST["name"];
    $chapter = $_GET["chapter"];
    $connect->actionsChapter("editChapter", $chapter, $chapter_name);
    $user = $_GET["user"] = $_SESSION["login"];
    $connect->logInfo("edit_chapter", $user);
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
        <title>AuThOrIzKeY - Редактирование раздела</title>
    </head>

    <body>
        <header class="header">
            <nav class="header_nav">
                <button type="button" class="logo btnToTop" aria-label="none" onclick="document.location='../index.php?topic=1'"></button>
            </nav>
        </header>

        <main class="main">
            <form method="post">
                <h1>Редактирование раздела <img class="icon" src="../src/icons/edit.png" width="30" height="30" alt="add icon" /></h1>
                <input name="name" placeholder="Введите название раздела">
                <button class="button" type="submit">Переименовать раздел</button>
            </form>
        </main>
        <footer class="footer">
        <p class="footer_item copyright">© Copyrights by Me. All Rights Reserved</p>
            <a class="footer_item_call" href="message.php"><img class="footer_icon" src="../src/icons/call.png" width="30" height="30" alt="message_icon"></a>
        </footer>
    </body>

    </html>


<?php endif; ?>