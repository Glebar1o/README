<?php
require_once "config/system.php";
$chapters = $connect->actionsChapter("getChapter", "", "");
guestSession();
checkTab();
?>


<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Форум по вопросам спорта" />
  <meta name="Keywords" content="Спорт, Форум, Вопросы спорт, Ответы спорт" />
  <link rel="stylesheet" href="styles/style.css" />
  <link rel="icon" href="src/icons/main_icon.png" />
  <script src="scripts/index.js" defer></script>
  <title>AuThOrIzKeY - Главная страница</title>
</head>

<body>
  <header class="header">
    <nav class="header_nav">
      <button type="button" class="logo btnToTop" aria-label="none"></button>
      <a class="add_chapter" href="pages/producs_list.php">Товары<img class="nav_icon" src="src/icons/plus.png" width="40" height="40" alt="plus icon"></a>
      <a class="add_chapter" href="pages/cart.php">Корзина<img class="nav_icon" src="./src/icons/plus.png" width="40" height="40" alt="plus icon"></a>
      <a class="add_chapter" href="pages/basket.php">Желаемое<img class="nav_icon" src="./src/icons/plus.png" width="40" height="40" alt="plus icon"></a>
      <?php if (checkRule() >= 100) : ?>
        <a class="add_chapter" href="pages/chapter_add.php">Создать раздел <img class="nav_icon" src="src/icons/plus.png" width="40" height="40" alt="plus icon"></a>
      <?php endif; ?>
      <ul class="header_list">
        <li class="header_item"><?= $_SESSION["login"] ?></li>
        <li class="header_item">|</li>
        <li class="header_item"><?= $_SESSION["status"] ?></li>
        <li>
          <?php if(is_null($_SESSION["id"])) : ?>
            <a href="pages/log_in.html"><img src="src/icons/male.png" width="40" height="40" alt="male avatar" /></a>
          <?php else: ?>  
          <?php if ($_SESSION["gender"] <= 1) : ?>
            <a href="pages/profile.php"><img src="src/icons/male.png" width="40" height="40" alt="male avatar" /></a>
          <?php else : ?>
            <a href="pages/profile.php"><img src="src/icons/famale.png" width="40" height="40" alt="male avatar" /></a>
          <?php endif; ?>
          <?php endif; ?>
        </li>
      </ul>
    </nav>
  </header>

  <main class="main">

    <aside class="main_aside">
      <figure class="aside_info">
        <img src="src/icons/list.png" width="40" height="40" alt="list icon">
        <figcaption>
          <h1 class="aside_title">Текущие разделы</h1>
        </figcaption>
      </figure>
      <?php foreach ($chapters as $item) : ?>
        <article class="chapter">
          <nav class="chapter_nav">
            <h1 class="chapter_name"><?= $item["chapter_name"] ?></h1>
            <a href="pages/topic_add.php?chapter=<?= $item["id_chapter"] ?>"><img class="nav_icon" src="src/icons/plus.png" width="32" height="32" alt="plus icon"></a>
            <?php if (checkRule() >= 100) : ?>
              <a href="pages/chapter_edit.php?chapter=<?= $item["id_chapter"] ?>"><img class="nav_icon" src="src/icons/edit.png" width="32" height="32" alt="pencil icon"></a>
              <a href="php/chapter_delete.php?chapter=<?= $item["id_chapter"] ?>"><img class="nav_icon" src="src/icons/delete.png" width="32" height="32" alt="trash icon"></a>
            <?php endif; ?>
          </nav>


          <?php $chapter = $item["id_chapter"];
          $topics = $connect->actionsTopic("getTopic", $chapter, "", "", "", "", "");
          foreach ($topics as $topic) : ?>
            <article class="topic_info">
              <a class="topic_title" href="index.php?topic=<?= $topic["id_topic"] ?>"><?= $topic["topic_name"] ?></a>
            </article>
          <?php endforeach; ?>
        </article>
      <?php endforeach; ?>
    </aside>

    <?php $topic = $_GET["topic"];
    $info = $connect->getTopinfo($topic); ?>
    <section class="topic_list">
      <?php foreach ($info as $top) : ?>
        <article class="top_info">
          <nav class="topic_nav">
            <h1 class="topic_name"><?= $top["topic_name"] ?></h1>
            <?php if (($_SESSION["id"] == $top["id_user"]) || (checkRule() >= 100)) : ?>
              <a href="pages/topic_edit.php?chapter=<?= $top["id_chapter"] ?>&topic=<?= $top["id_topic"] ?>"><img class="nav_icon" src="src/icons/edit.png" width="30" height="30" alt="pencil icon"></a>
              <a href="php/topic_delete.php?chapter=<?= $top["id_chapter"] ?>&topic=<?= $top["id_topic"] ?>"><img class="nav_icon" src="src/icons/delete.png" width="30" height="30" alt="trash icon"></a>
            <?php endif; ?>
          </nav>

          <p class="topic_text"><?= $top["topic_text"] ?></p>
          <p class="topic_author">Автор: <?= $top["topic_author"] ?></p>
          <time class="topic_time" datetime="<?= $top["topic_datetime"] ?>">Время добавления: <?= date("j F Y \г\. \в H:i", strtotime($top["topic_datetime"])) ?>
            <a class="add_answer" href="pages/answer_add.php?chapter=<?= $top["id_chapter"] ?>&topic=<?= $top["id_topic"] ?>">Ответить <img class="answer_icon" src="src/icons/answer.png" width="25" height="25" alt="dialog icon"></a>
        </article>
      <?php endforeach; ?>


      <?php $topic = $_GET['topic'];
      $answers = $connect->actionsAnswer("getAnswer", "", $topic, "", "", "", "", "");
      foreach ($answers as $answer) : ?>
        <article class="answer_info">
          <nav class="answer_nav">
            <h1 class="answer_author">
              <?php if ($answer["author_gender"] <= 1) : ?>
                <img class="answer_icon_author" src="src/icons/male.png" width="25" height="25" alt="male avatar" />
              <?php else : ?>
                <img class="answer_icon_author" src="src/icons/famale.png" width="25" height="25" alt="male avatar" />
              <?php endif; ?>
              <?= $answer["answer_author"] ?>
            </h1>
            <?php if (($_SESSION["id"] == $answer["id_user"]) || (checkRule() >= 75)) : ?>
              <a href="pages/answer_edit.php?chapter=<?= $answer["id_chapter"] ?>&topic=<?= $answer["id_topic"] ?>&answer=<?= $answer["id_answer"] ?>"><img class="nav_icon" src="src/icons/edit.png" width="25" height="25" alt="pencil icon"></a>
              <a href="php/answer_delete.php?chapter=<?= $answer["id_chapter"] ?>&topic=<?= $answer["id_topic"] ?>&answer=<?= $answer["id_answer"] ?>"><img class="nav_icon" src="src/icons/delete.png" width="25" height="25" alt="trash icon"></a>
            <?php endif; ?>
          </nav>

          <p class="answer_text"><?= $answer["answer_text"] ?></p>
          <time class="answer_time" datetime="<?= $answer["answer_datetime"] ?>">Время добавления: <?= date("j F Y \г\. \в H:i", strtotime($answer["answer_datetime"])) ?>
        </article>
      <?php endforeach; ?>
    </section>
  </main>

  <footer class="footer">
    <p class="footer_item copyright">© Copyrights by Me. All Rights Reserved</p>
    <a class="footer_item_call" href="pages/message.php"><img class="footer_icon" src="src/icons/call.png" width="30" height="30" alt="message_icon"></a>
  </footer>
</body>

</html>