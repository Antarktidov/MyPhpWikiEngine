<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История статьи</title>
    <style>
        /* внешние границы таблицы серого цвета толщиной 1px */
        table {
        border: 1px solid grey;
        }
        /* границы ячеек первого ряда таблицы */
        th {
        border: 1px solid grey;
        text-align: left;
        }
        /* границы ячеек тела таблицы */
        td {
        border: 1px solid grey;
        }
    </style>
</head>
<body>
    <h1>История статьи</h1>
<?php
$article_id = '';
if (isset($_GET["article_id"])) {
    $article_id = $_GET["article_id"];
    require_once __DIR__ . '/helpers/connect-to-db.php';
    require_once __DIR__ . '/helpers/is_admin.php';

    $is_admin = is_admin($conn);

    $sql = "SELECT * FROM articles WHERE is_deleted='0' AND id='$article_id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $title = $row['title'];
    
            $sql2 = "SELECT * FROM revisions WHERE article_id='$article_id'";

            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                ?><table>
                    <tr><th>Имя участника</th>
                    <?php if ($is_admin) {?><th>IP-адрес участника</th><?php } ?>
                    <th>Дата</th>
                    <th>Заголовок</th>
                    <th>Текст</th></tr>
                    <?php
            
            while($row = $result2->fetch_assoc()) {
                $user_id = $row['user_id'];
                $user_ip = $row['user_ip'];
                $updated_at = $row['updated_at'];
                $title2 = $row['title'];
                $text = $row['text'];

                if ($user_id != 0) {
                    $sql3 = "SELECT * FROM users WHERE id='$user_id'";
                    $username = '';

                    $result3 = $conn->query($sql3);

                    if ($result3->num_rows > 0) {
                        while($row3 = $result3->fetch_assoc()) {
                            $username = $row3['name'];
                        }
                    }
                    if ($username == '') {
                        $username = 'Анонимный участник';
                    }
                } else {
                    $username = 'Анонимный участник';
                }
                ?>
                <tr><td><?=$username;?></td>
                <?php if ($is_admin) {?><td><?=$user_ip;?></td><?php } ?>
                <td><?=$updated_at;?></td>
                <td><?=$title2;?></td>
                <td><?=$text;?></td></tr>
                <?php
            }
        }?></table><?php
    }
}}
?>
    
</body>
</html>