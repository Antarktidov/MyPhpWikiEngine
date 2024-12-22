<?php
//$text = '';
if (isset($_GET["article_id"])) {
    $article_id = $_GET["article_id"];

    require_once __DIR__ . '/helpers/connect-to-db.php';

    //$hash = password_hash($password, PASSWORD_DEFAULT);

    // Create connection

    $sql = "SELECT * FROM articles WHERE id='$article_id' AND is_deleted='0'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        $sql2 = "SELECT * FROM revisions WHERE article_id='$article_id'";

        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
        // output data of each row
        $iteration = 0;
        $total_rows = $result2->num_rows;
        while($row = $result2->fetch_assoc()) {
            $iteration++;
            if ($iteration == $total_rows) {
                $text = $row['text'];
                $title = $row['title'];
            }
            // Обработка остальных записей
        }
    }
}}
}
else {
    $title = '404';
    $text = 'Нет такой статьи';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
</head>
<body>
    <?php
    if (isset($_GET["article_id"])) {
    ?>
    <form style="display: flex; flex-direction: column; max-width: 300px;" action="update-article.php" method="post">
        <input name="id" id="id" type="number" value="<?=$article_id;?>" required hidden>    

        <label for="title">Название</label>
        <input name="title" id="title" type="text" value="<?=$title;?>" required>
    <br>
        <label for="content">Текст</label>
        <textarea name="content" id="content" required><?=$text;?></textarea>
    <br>
    <button style="width: fit-content" type="submit">Сохранить изменения</button>
    </form>
    <?php } else { ?>
    <h1><?=$title;?></h1>
    <p><?=$text;?></p>
    <?php } ?>
</body>
</html>