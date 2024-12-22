<?php
$article_id = '';
if (isset($_GET["article_id"])) {
    $article_id = $_GET["article_id"];

    require_once __DIR__ . '/helpers/connect-to-db.php';

    require_once __DIR__ . '/helpers/is_admin.php';

    $is_admin = is_admin($conn);
    if ($is_admin) {
        $sql = "UPDATE articles SET is_deleted='1' WHERE id='$article_id'";

        if ($conn->query($sql) === TRUE) {
            $html_output =  'Cтатья успешно удалена';
          } else {
            $html_output =  'Произошла ошибка';
          }
    } else {
        $html_output =  'Для удаления статьи нужны права администратора';
    }
} else {
    $html_output = 'Неуказана статья для удаления';
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