<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = test_input($_POST["title"]);
    $content = test_input($_POST["content"]);
  } else {
    $html_output = 'Неизвестная ошибка';
  }

    require_once __DIR__ . '/helpers/connect-to-db.php';
    
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO articles (title)
    VALUES ('$title')";

    $article_id = null;

    if ($conn->query($sql) === TRUE) {

     $article_id = $conn->insert_id; // Используем $conn->insert_id вместо mysql_insert_id
    } else {
        $html_output = "Произошла неизвестная ошибка при сохранении статьи";
    }
    if (isset($_SESSION['logged_in_user_id'])) {
        $user_id = $_SESSION['logged_in_user_id'];
    } else {
        $user_id = 0;
    }
    $user_ip = $_SERVER['REMOTE_ADDR'];

    $sql2 = "INSERT INTO revisions (article_id, title, text, user_id, user_ip)
    VALUES ('$article_id', '$title', '$content', '$user_id', '$user_ip')";

    if ($conn->query($sql2) === TRUE) {

        $html_output = 'Статья успешно сохранена';
    } else {
        $html_output =  "Произошла неизвестная ошибка при сохранении статьи";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$html_output;?></title>
</head>
<body>
    <p><?=$html_output;?></p>
</body>
</html>