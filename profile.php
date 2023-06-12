<?php
require_once "../config/system.php";
checkSession();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../styles/profile.css" />
  <link rel="icon" href="../src/icons/main_icon.png" />
  <script src="../scripts/index.js" defer></script>
  <title>AuThOrIzKeY - Профиль</title>
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
            <a href="../php/log_out.php"><img src="../src/icons/log_out.png" width="40" height="40" alt="log out icon" /></a>
          <?php else: ?>  
          <?php if ($_SESSION["gender"] <= 1) : ?>
            <a href="../php/log_out.php"><img src="../src/icons/log_out.png" width="40" height="40" alt="log out icon" /></a>
          <?php else : ?>
            <a href="../php/log_out.php"><img src="../src/icons/log_out.png" width="40" height="40" alt="log out icon" /></a>
          <?php endif; ?>
          <?php endif; ?>
        </li>


      </ul>
    </nav>
  </header>

  <main class="main">
    <article class="profile_info">
      <?php if ($_SESSION["gender"] <= 1) : ?>
        <img src="../src/icons/male.png" width="128" height="128" alt="male avatar" />
      <?php else : ?>
        <img src="../src/icons/famale.png" width="128" height="128" alt="famale avatar" />
      <?php endif; ?>
      <figure class="user_info">
        <h1 class="user_login"><?= $_SESSION["login"] ?></h1>
        <figcaption>
          <p class="user_description">Описание пользователя: <?= $_SESSION["description"] ?></p>
        </figcaption>
        <time class="user_regtime" datetime="">Дата регистрации: <?= $_SESSION["time"] ?></time>
      </figure>
      <?php
        if (checkRule() == 75) {
            echo '
              <h2 class="user_login">Добавить ключ</h2>
              <form action="../php/add_key.php" method="post">
                  <input name="key" type="text" class="" placeholder="Ключ" required>
                  <input name="product" type="text" class="" placeholder="ID продукта" required>
                  <button type="submit" name="submit" class="buy_btn">Купить</button>
              </form>
            ';
        }
        elseif (checkRule() == 100) {
          $productall = '1';
          $product = $connect->getProduct($productall);
          $tetetete = '1';
          $ustk = $connect->getUsersList($tetetete);
          ?>
            <h2 class="user_login">Список товаров</h2>
            <table class="users_table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Название товара</th>
                  <th>Цена</th>
                  <th>Удаление</th>
                </tr>
              </thead>
              <tbody>
          <?php foreach ($product as $productsd) : ?>
                <tr>
                  <td><?= $productsd['id'];?></td>
                  <td><?= $productsd['name'];?></td>
                  <td><?= $productsd['price'];?></td>
                  <td class="del_section"><a id="<?= $productsd['id'];?>" href="../php/product_item_del.php?c=products&productsd=<?= $productsd['id'];?>" class="del_btn_admin">-</a><td>
                </tr>
          <?php endforeach; ?>
              </tbody>
            </table>

            <h2 class="user_login">Список пользователей</h2>
            <table class="users_table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Login</th>
                  <th>Роль</th>
                  <th>Баланс</th>
                  <th>Редактирование</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($ustk as $kkkkkkk) : ?>
                  <form action="../php/update_user.php?c=update&kkkkkkk=<?=$kkkkkkk['id_user'];?>" method="post">
                      <tr>
                        <td>
                          <input name="id_user" type="text" value="<?= $kkkkkkk['id_user'];?>" class="" placeholder="ФИО" required disabled>
                        </td>
                        <td>
                          <input name="user_login" type="text" value="<?= $kkkkkkk['user_login'];?>" class="" placeholder="ФИО" required>
                        </td>
                        <td>
                          <input name="id_group" type="text" value="<?= $kkkkkkk['id_group'];?>" class="" placeholder="ФИО" required>
                        </td>
                        <td>
                          <input name="balance" type="text" value="<?= $kkkkkkk['balance'];?>" class="" placeholder="ФИО" required>
                        </td>
                        <td class="del_section">
                          <button class="btn_save" type="submit">Сохранить</button>
                          <!-- <a id="<?= $kkkkkkk['user_login'];?>" href="../php/product_item_del.php?c=products&productsd=<?= $kkkkkkk['user_login'];?>" class="del_btn_admin">-</a> -->
                        <td>
                      </tr>
                  </form>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php
        }
        else {
      }
      ?>

    </article>


  </main>

  <footer class="footer">
    <p class="footer_item copyright">© Copyrights Lis. All Rights Reserved</p>
    <a class="footer_item_call" href="message.php"><img class="footer_icon" src="../src/icons/call.png" width="30" height="30" alt="message_icon"></a>
  </footer>
</body>

</html>