<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article_id = test_input($_POST["id"]);
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

    if (isset($_SESSION['logged_in_user_id'])) {
        $user_id = $_SESSION['logged_in_user_id'];
    } else {
        $user_id = 0;
    }

    $user_ip = $_SERVER['REMOTE_ADDR'];

    $sql = "INSERT INTO revisions (article_id, title, text, user_id, user_ip)
    VALUES ('$article_id', '$title', '$content', '$user_id', '$user_ip')";

    if ($conn->query($sql) === TRUE) {
        $html_output = 'Статья успешно обновлена';

        $sql2 = "UPDATE articles SET title='$title' WHERE id=$article_id";

        if ($conn->query($sql2) === TRUE) {
        $html_output = 'Статья успешно обновлена';
        } else {
            $html_output = "Произошла неизвестная ошибка при редактировании статьи";
        }
    } else {
        $html_output = "Произошла неизвестная ошибка при редактировании статьи";
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