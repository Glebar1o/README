<?php
class Database
{
    private $host, $port, $db_name, $db_user, $db_psw, $db_enc;

    public function __construct($name)
    {
        $conf = parse_ini_file($name . ".ini");
        $conn = null;
        $this->host = $conf["host"];
        $this->port = $conf["port"];
        $this->db_name = $conf["db_name"];
        $this->db_user = $conf["db_user"];
        $this->db_psw = $conf["db_psw"];
        $this->db_enc = $conf["db_enc"];
        $this->conn = $conn;
    }

    public function getDb(): PDO
    {
        return $this->conn = new PDO(
            "mysql:host=$this->host;port=$this->port;dbname=$this->db_name;charset=$this->db_enc",
            $this->db_user,
            $this->db_psw
        );
    }

    public function regUser()
    {
        $sql = "INSERT INTO users (user_login, user_password, user_description, user_gender, id_group) VALUES (:login, :password, :description, :gender, '3')";
        $query = $this->getDb()->prepare($sql);
        $query->execute(array(
            "login" => $_POST["login"],
            "password" => $_POST["password"],
            "description" => $_POST["description"],
            "gender" => $_POST["gender"],
        ));
    }

    public function actionsChapter($type, $chapter, $chapter_name)
    {
        switch ($type) {
            case "getChapter":
                $sql = "SELECT * FROM chapters ORDER BY chapter_datetime DESC";
                $query = $this->getDb()->prepare($sql);
                $query->execute();
                $chapters = $query->fetchAll(PDO::FETCH_ASSOC);
                return $chapters;
                break;

            case "addChapter":
                $sql = "INSERT INTO chapters (chapter_name) VALUES (:name)";
                $query = $this->getDb()->prepare($sql);
                $query->execute(array(
                    "name" => $_POST["chapter_name"]
                ));
                break;

            case "deleteChapter":
                $sql = "DELETE FROM chapters WHERE id_chapter = :id_chapter";
                $query = $this->getDb()->prepare($sql);
                $query->bindParam(":id_chapter", $chapter);
                $query->execute();
                break;

            case "editChapter":
                $sql = "UPDATE chapters SET chapter_name = :chapter_name WHERE id_chapter = :id_chapter";
                $query = $this->getDb()->prepare($sql);
                $query->bindParam(":id_chapter", $chapter);
                $query->bindParam(":chapter_name", $chapter_name);
                $query->execute();
                break;
        }
    }

    public function getTopinfo($topic)
    {
        $sql = "SELECT * FROM topics WHERE id_topic = :id_topic";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(":id_topic", $topic);
        $query->execute();
        $info = $query->fetchAll(PDO::FETCH_ASSOC);
        return $info;
    }


    public function getProduct($productall)
    {
        $sql = "SELECT * FROM products";
        $query = $this->getDb()->prepare($sql);
        $query->execute();
        $product = $query->fetchAll(PDO::FETCH_ASSOC);
        return $product;
        $product =  getProduct();
    }

    public function getCartItem($productall)
    {
        $deeed = $_SESSION["id"];
        $sql = "SELECT * FROM products WHERE id IN (SELECT id_product FROM cart WHERE id_user = $deeed)";
        $query = $this->getDb()->prepare($sql);
        $query->execute();
        $cartitem = $query->fetchAll(PDO::FETCH_ASSOC);
        return $cartitem;
        $cartitem =  getCartItem();
    }

    public function getBasketItem($productall)
    {
        $deeed = $_SESSION["id"];
        $sql = "SELECT * FROM products WHERE id IN (SELECT id_product FROM basket WHERE id_user = $deeed)";
        $query = $this->getDb()->prepare($sql);
        $query->execute();
        $bsktitem = $query->fetchAll(PDO::FETCH_ASSOC);
        return $bsktitem;
        $bsktitem =  getBasketItem();
    }

    public function getProductInfo($productpage)
    {
        $sql = "SELECT * FROM products WHERE `id` = '$_GET[productpage]'";
        $query = $this->getDb()->prepare($sql);
        $query->execute();
        $productinfo = $query->fetchAll(PDO::FETCH_ASSOC);
        return $productinfo;
        $productinfo =  getProductInfo();
    }


    public function getBalance($bal)
    {
        $balancecheck = $_SESSION["id"];
        $sql = "SELECT * FROM users WHERE `id_user` = '$balancecheck'";
        $query = $this->getDb()->prepare($sql);
        $query->execute();
        $usbalance = $query->fetchAll(PDO::FETCH_ASSOC);
        return $usbalance;
        $usbalance =  getBalance();
    }


    public function addKey($keytck)
    {
        $sql = "SELECT * FROM keyp WHERE key_status = '1' AND id_product = '$_GET[cartbtn]'  limit 1";
        $query = $this->getDb()->prepare($sql);
        $query->execute();
        $keyss = $query->fetchAll(PDO::FETCH_ASSOC);
        return $keyss;
        $keyss =  addKey();
    }

    public function actionsCart($type = null, $productpage = null, $cur_id = null, $id_user = null)
    {
        switch ($type) {
            case "addCart":
                $sql = "INSERT INTO cart (id_user, id_product) VALUES (:id_user, :id_product)";
                $query = $this->getDb()->prepare($sql);
                $query->execute(array(
                    "id_product" => $productpage,
                    "id_user" => $cur_id,
                ));
                break;

            case "addBasket":
                $sql = "INSERT INTO basket (id_user, id_product) VALUES (:id_user, :id_product)";
                $query = $this->getDb()->prepare($sql);
                $query->execute(array(
                    "id_product" => $productpage,
                    "id_user" => $cur_id,
                ));
                break;

                case "getBBBB":
                    $idus=$_SESSION["id"];
                    $idpr=$productpage;
                    $sql = "SELECT * FROM basket WHERE id_user='$idus' AND id_product = '$idpr'";
                    $query = $this->getDb()->prepare($sql);
                    $query->execute();
                    $meeees = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $meeees;
                    break;


                case "deleteCartItem":
                    $sql = "DELETE FROM cart WHERE id_product = '$_GET[cartbtn]'";
                    $query = $this->getDb()->prepare($sql);
                    $query->execute();
                    break;

                case "deleteBasketItem":
                    $sql = "DELETE FROM basket WHERE id_product = '$_GET[cartbtn]'";
                    $query = $this->getDb()->prepare($sql);
                    $query->execute();
                    break;

                case "deleteProductByAdmin":
                    $sql = "DELETE FROM products WHERE id = '$_GET[productsd]'";
                    $query = $this->getDb()->prepare($sql);
                    $query->execute();
                    break;

                case "addOrder":
                    $sql = "INSERT INTO orders (fio, email, role, id_product, id_key, id_account) VALUES (:fio, :email, :role, :id_product, :id_key, :id_account)";
                    $query = $this->getDb()->prepare($sql);
                    $query->execute(array(
                        "fio" => $_POST["fio"],
                        "email" => $_POST["email"],
                        "role" => $_POST["role"],
                        "id_product" => $_POST["id_product"],
                        "id_key" => $_POST["key"],
                        "id_account" => '1',
                    ));
                    break;

                case "addOrderMessage":
                    $fio = $_POST["fio"];
                    $email = $_POST["email"];
                    $key = $_POST["key"];
                    $to = $_POST["email"];
                    $subject = 'Приобретенный ключ';
                    $head = 'От AUTHORIZKEY.ru'."\r\n";
                    
                    $message = 'Добрый день '. $fio."\n" . 'Ваш ключ: ' . $key. "\n";
                    
                    if (isset($_POST['submit'])){
                        mail($to, $subject, $message, $head);
                    }
                    
                    break;

                case "editKeyStatus":
                    $sql = "UPDATE keyp SET key_status = '2' WHERE id = :id_key";
                    $query = $this->getDb()->prepare($sql);
                    $query->bindParam(":id_key", $_POST["key"]);
                    $query->execute();
                    break;

                case "updateBalancePay":
                    $idus=$_SESSION["id"];
                    $sql = "UPDATE users SET balance = :balance WHERE id_user='$idus'";
                    $query = $this->getDb()->prepare($sql);
                    $query->execute(array(
                        "balance" => $_POST["itogbalance"],
                    ));
                    $query->execute();
                    break;

                case "addKeyAdmin":
                    $sql = "INSERT INTO keyp (key_name, id_product) VALUES (:key_name, :id_product)";
                    $query = $this->getDb()->prepare($sql);
                    $query->execute(array(
                        "key_name" => $_POST["key"],
                        "id_product" => $_POST["product"],
                    ));
                    break;

                case "editUserInfo":
                    $sql = "UPDATE users SET user_login = :user_login, id_group = :id_group, balance = :balance WHERE user_login = :user_login";
                    $query = $this->getDb()->prepare($sql);

                    $query->execute(array(
                        "user_login" => $_POST["user_login"],
                        "id_group" => $_POST["id_group"],
                        "balance" => $_POST["balance"],
                    ));
                    $query->execute();
                    break;
        }
    }

    public function getUsersList($tetetete)
    {
        $sql = "SELECT * FROM users";
        $query = $this->getDb()->prepare($sql);
        $query->execute();
        $ustk = $query->fetchAll(PDO::FETCH_ASSOC);
        return $ustk;
        $ustk =  getUsersList();
    }

    public function getCarrt($crt)
    {
        $sql = "SELECT count(*) FROM cart";
        $query = $this->getDb()->prepare($sql);
        $query->execute();
        $cc = $query->fetchAll(PDO::FETCH_ASSOC);
        return $cc;
    }


    public function actionsTopic($type, $chapter, $topic, $topic_name, $topic_text, $cur_id, $author)
    {
        switch ($type) {
            case "getTopic":
                $sql = "SELECT * FROM topics WHERE id_chapter=:id_chapter ORDER BY topic_datetime DESC";
                $query = $this->getDb()->prepare($sql);
                $query->bindParam(":id_chapter", $chapter);
                $query->execute();
                $topics = $query->fetchAll(PDO::FETCH_ASSOC);
                return $topics;
                break;

            case "addTopic":
                $sql = "INSERT INTO topics (id_user, topic_author, id_chapter, topic_name, topic_text) VALUES (:id_user, :topic_author, :id_chapter, :topic_name, :topic_text)";
                $query = $this->getDb()->prepare($sql);
                $query->execute(array(
                    "id_chapter" => $chapter,
                    "topic_name" => $_POST["topic_name"],
                    "topic_text" => $_POST["topic_text"],
                    "id_user" => $cur_id,
                    "topic_author" => $author,
                ));
                break;

            case "deleteTopic":
                $sql = "DELETE FROM topics WHERE id_chapter = :id_chapter AND id_topic = :id_topic";
                $query = $this->getDb()->prepare($sql);
                $query->bindParam(":id_chapter", $chapter);
                $query->bindParam(":id_topic", $topic);
                $query->execute();
                break;

            case "editTopic":
                $sql = "UPDATE topics SET topic_name = :topic_name, topic_text = :topic_text WHERE id_chapter = :id_chapter AND id_topic = :id_topic";
                $query = $this->getDb()->prepare($sql);
                $query->bindParam(":id_chapter", $chapter);
                $query->bindParam(":id_topic", $topic);
                $query->bindParam(":topic_name", $topic_name);
                $query->bindParam(":topic_text", $topic_text);
                $query->execute();
                break;
        }
    }

    public function actionsAnswer($type, $chapter, $topic, $answer, $answer_text, $cur_id, $author, $gender)
    {
        switch ($type) {
            case "getAnswer":
                $sql = "SELECT * FROM answers WHERE id_topic = :id_topic";
                $query = $this->getDb()->prepare($sql);
                $query->bindParam(":id_topic", $topic);
                $query->execute();
                $answers = $query->fetchAll(PDO::FETCH_ASSOC);
                return $answers;
                break;

            case "addAnswer":
                $sql = "INSERT answers (id_chapter, id_topic, answer_text, id_user, answer_author, author_gender) VALUES (:id_chapter, :id_topic, :answer_text, :id_user, :answer_author, :author_gender)";
                $query = $this->getDb()->prepare($sql);
                $query->execute(array(
                    "id_chapter" => $chapter,
                    "id_topic" => $topic,
                    "answer_text" => $_POST["answer_text"],
                    "id_user" => $cur_id,
                    "answer_author" => $author,
                    "author_gender" => $gender
                ));
                break;

            case "deleteAnswer":
                $sql = "DELETE FROM answers WHERE id_chapter = :id_chapter AND id_topic = :id_topic AND id_answer = :id_answer";
                $query = $this->getDb()->prepare($sql);
                $query->bindParam(":id_chapter", $chapter);
                $query->bindParam(":id_topic", $topic);
                $query->bindParam(":id_answer", $answer);
                $query->execute();
                break;

            case "editAnswer":
                $sql = "UPDATE answers SET answer_text = :answer_text WHERE id_chapter = :id_chapter AND id_topic = :id_topic AND id_answer = :id_answer";
                $query = $this->getDb()->prepare($sql);
                $query->bindParam(":id_chapter", $chapter);
                $query->bindParam(":id_topic", $topic);
                $query->bindParam(":id_answer", $answer);
                $query->bindParam(":answer_text", $answer_text);
                $query->execute();
                break;
        }
    }

    public function logInfo($type, $user)
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $agent = $_SERVER["HTTP_USER_AGENT"];
        $sql2 = "INSERT INTO logs (log_type, author_name, author_ip, author_agent) VALUES (:type, :user, :ip, :agent)";
        $query = $this->getDb()->prepare($sql2);
        $query->execute(array(
          "type" => $type,
          "user" => $user,
          "ip" => $ip,
          "agent" => $agent
        ));
    }

    public function messageAdd()
    {
        $sql = "INSERT INTO messages (id_user, message_author, message_text) VALUES (:id_user, :message_author, :message_text)";
        $query = $this->getDb()->prepare($sql);
        $query->execute(array(
          "id_user" => $_SESSION["id"],
          "message_author" => $_SESSION["login"],
          "message_text" => $_POST["message_text"]
        ));
    }
}
