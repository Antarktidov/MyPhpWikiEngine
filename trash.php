<?php
require_once __DIR__ . '/helpers/connect-to-db.php';

require_once __DIR__ . '/helpers/is_admin.php';

$is_admin = is_admin($conn);

if (!$is_admin) {
    exit('<h1>403</h1><p>Доступ запрещён</p>');
}

$sql = "SELECT * FROM articles WHERE is_deleted='1'";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все удалённые статьи</title>
</head>
<body>
    <?php
if ($result->num_rows > 0) {
    ?><h1>Все статьи</h1>
    <ul><?php
while($row = $result->fetch_assoc()) {
    ?>
    <li><a href="trashed-article.php?article_id=<?=$row['id'];?>"><?=$row['title'];?></a></li>
    <?php
}echo '</ul>';} else {
    ?><p>На вики нет удалённых статей</p><?php
}
?>
</body>
</html>