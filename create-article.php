<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать статью</title>
</head>
<body>
    <form style="display: flex; flex-direction: column; max-width: 300px;" action="store-article.php" method="post">
        <label for="title">Название</label>
        <input name="title" id="title" type="text" required>
    <br>
        <label for="content">Текст</label>
        <textarea name="content" id="content" required></textarea>
    <br>
    <button style="width: fit-content" type="submit">Создать статью</button>
    </form>
</body>
</html>