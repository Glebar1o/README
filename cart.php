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
  <link rel="stylesheet" href="../styles/cart.css" />
  <link rel="icon" href="../src/icons/main_icon.png" />
  <script src="../scripts/index.js" defer></script>
  <title>AuThOrIzKeY - Корзина</title>
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
      
        <?php
            $bal = $_SESSION["id"];
            $usbalance = $connect->getBalance($bal);
        ?>
        <?php foreach ($usbalance as $kkkkkk) : ?>
        <li class="header_item">Баланс: <?= $kkkkkk['balance']; ?></li>
        <?php endforeach; ?>

        <li class="header_item">|</li>
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
    <div class="cart_box_header">
        <h2 class="product">
            Корзина
        </h2>
    </div>
    <?php
    if(!isset($_SESSION["id"])) {
        echo '
        <div class="cart_box">
            <h3 class="product">
              Чтобы получить доступ к корзине нужно <a href="log_in.html">авторизироваться</a>!
            </h3>
        </div>
        ';
    }
    else {
      $productall = $_GET["topic"];
      $cartitem = $connect->getCartItem($productall);
      foreach ($cartitem as $cartbtn) {
      echo '
        <div class="cart_box">
            <h3 class="product">
            ', $cartbtn['name'],' - ', $cartbtn['price'],' ₽
            </h3>
            <a href="../php/product_delete.php?c=payments&cartbtn=', $cartbtn['id'],'" class="del_btn">Удалить</a>
            <a href="payment.php?c=payments&cartbtn=', $cartbtn['id'],'&price=',$cartbtn['price'],'" class="buy_btn">Купить</a>
        </div>
        ';
      }}?>
  </main>

  <footer class="footer">
    <p class="footer_item copyright">© Copyrights Lis. All Rights Reserved</p>
    <a class="footer_item_call" href="message.php"><img class="footer_icon" src="../src/icons/call.png" width="30" height="30" alt="message_icon"></a>
  </footer>
</body>

</html>