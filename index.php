<?php
require_once __DIR__ . '/helpers/connect-to-db.php';

$sql = "SELECT * FROM articles WHERE is_deleted='0'";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все статьи</title>
</head>
<body>
    <?php
if ($result->num_rows > 0) {
    ?><h1>Все статьи</h1>
    <ul><?php
while($row = $result->fetch_assoc()) {
    ?>
    <li><a href="show-article.php?article_id=<?=$row['id'];?>"><?=$row['title'];?></a></li>
    <?php
}echo '</ul>';} else {
    ?><p>На вики нет статей</p><?php
}
?>
</body>
</html>