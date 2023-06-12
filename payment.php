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
  <title>AuThOrIzKeY - Оплата</title>
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
    <div class="cart_box payment_container">
        <h2>Оплатить товар</h2>
        <form action="../php/payment_process.php" method="post">
            <input name="fio" type="text" class="" placeholder="ФИО" required>
            <input name="email" type="email" class="" placeholder="Email" required>
            <input name="role" type="text" class="" placeholder="Должность" required>
            <input name="id_product" class="none" value="<?= $_GET["cartbtn"];?>" placeholder="">
            <?php $keytck = $_GET["cartbtn"];
            $keyss = $connect->addKey($keytck); ?>
              <?php foreach ($keyss as $product) : ?>  
                <input name="key" class="none" value="<?= $product['id'];?>" placeholder="">
              <?php endforeach; ?>  
        <?php foreach ($usbalance as $kkkkkk) : ?>
          <?php
            $resultpay = $kkkkkk['balance']-$_GET["price"]; 
            if($resultpay >= 0){
              echo'
              <button type="submit" name="submit" class="buy_btn">Купить</button>
              <h6>Остаток после покупки: <input name="itogbalance" class="balancecheck" value="', $resultpay ,'"> баллов</h6>
              ';
            }
            else{
              echo'У вас недостаточно баллов для оплаты!';
            }
          ?>
        <?php endforeach; ?>
        </form>
    </div>

  </main>

  <footer class="footer">
    <p class="footer_item copyright">© Copyrights Lis. All Rights Reserved</p>
    <a class="footer_item_call" href="message.php"><img class="footer_icon" src="../src/icons/call.png" width="30" height="30" alt="message_icon"></a>
  </footer>
</body>

</html>