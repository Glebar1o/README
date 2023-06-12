<?php
require_once "../config/system.php";
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
  <link rel="stylesheet" href="../styles/productlist.css" />
  <link rel="icon" href="../src/icons/main_icon.png" />
  <script src="../scripts/index.js" defer></script>
  <title>AuThOrIzKeY - Товар</title>
</head>

<body>
<header class="header">
    <nav class="header_nav">
    <button type="button" class="logo btnToTop" aria-label="none" onclick="document.location='../index.php?topic=1'"></button>
    <a class="add_chapter" href="producs_list.php">Товары<img class="nav_icon" src="../src/icons/plus.png" width="40" height="40" alt="plus icon"></a>
    <a class="add_chapter" href="cart.php">Корзина<img class="nav_icon" src="../src/icons/plus.png" width="40" height="40" alt="plus icon"></a>
    <a class="add_chapter" href="basket.php">Желаемое<img class="nav_icon" src="../src/icons/plus.png" width="40" height="40" alt="plus icon"></a>
      <?php if (checkRule() >= 100) : ?>
        <a class="add_chapter" href="chapter_add.php">Создать раздел <img class="nav_icon" src="../src/icons/plus.png" width="40" height="40" alt="plus icon"></a>
      <?php endif; ?>
      <ul class="header_list">
        <li class="header_item"><?= $_SESSION["login"] ?></li>
        <li class="header_item">|</li>
        <li class="header_item"><?= $_SESSION["status"] ?></li>
        <li>
          <?php if(is_null($_SESSION["id"])) : ?>
            <a href="log_in.html"><img src="../src/icons/male.png" width="40" height="40" alt="male avatar" /></a>
          <?php else: ?>  
          <?php if ($_SESSION["gender"] <= 1) : ?>
            <a href="profile.php"><img src="../src/icons/male.png" width="40" height="40" alt="male avatar" /></a>
          <?php else : ?>
            <a href="profile.php"><img src="../src/icons/famale.png" width="40" height="40" alt="male avatar" /></a>
          <?php endif; ?>
          <?php endif; ?>
        </li>
      </ul>
    </nav>
  </header>

  <main class="main">
    <div class="producs">
        <?php
            $productall = $_GET["topic"];
            $product = $connect->getProduct($productall);
        ?>
        <?php foreach ($product as $productlist) : ?>
          <a id="<?= $productlist['id'];?>" href="product.php?c=products&productpage=<?= $productlist['id'];?>" class="product_card">
            <h1 class="title_card"><?= $productlist['name'];?></h1>
            <img class="product_img" src="../src/pictures/<?= $productlist['img'];?>" alt="фото товара">
            <h2 class="card_price">Цена: <?= $productlist['price'];?> баллов</h2>
            <h3 class="card_more_btn">Подробнее</h3>
          </a>
        <?php endforeach; ?>
    </div>

  </main>

  <footer class="footer">
    <p class="footer_item copyright">© Copyrights Lis. All Rights Reserved</p>
    <a class="footer_item_call" href="message.php"><img class="footer_icon" src="../src/icons/call.png" width="30" height="30" alt="message_icon"></a>
  </footer>
</body>

</html>