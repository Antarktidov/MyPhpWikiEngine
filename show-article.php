<?php
$article_id = '';
if (isset($_GET["article_id"])) {
    $article_id = $_GET["article_id"];

    require_once __DIR__ . '/helpers/connect-to-db.php';
    require_once __DIR__ . '/helpers/is_admin.php';

    $is_admin = is_admin($conn);

    $sql = "SELECT * FROM articles WHERE id='$article_id' AND is_deleted='0'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //$title = $row['title'];

        $sql2 = '';

        if (isset($_GET["revision_id"])) {
            $revision_id = $_GET["revision_id"];
            $sql2 = "SELECT * FROM revisions WHERE article_id='$article_id' AND id='$revision_id'";
        } else {
            $sql2 = "SELECT * FROM revisions WHERE article_id='$article_id'";
        }

        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
        

        $iteration = 0;
        $total_rows = $result2->num_rows;
        while($row = $result2->fetch_assoc()) {
            $iteration++;
            if ($iteration == $total_rows) {
                $text = $row['text'];
                $title = $row['title'];
            }
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
    <h1><?=$title;?></h1>
    <div style="display: flex; gap: 10px;"><a href="edit-article.php?article_id=<?="$article_id";?>">Править</a><a href="article-history.php?article_id=<?="$article_id";?>">История</a><?php if ($is_admin) {?><a href="delete-article.php?article_id=<?="$article_id";?>">Удалить</a><?php } ?></div>
    <p><?=$text;?></p>
</body>
</html>