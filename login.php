<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
<form style="display: flex; flex-direction: column; max-width: 300px;" action="login-in-account.php" method="post">
        <label for="email">E-mail</label>
        <input name="email" id="email" type="email" required>
    <br>
        <label for="password">Пароль</label>
        <input name="password" id="password" type="password" required>
    <br>
    <button style="width: fit-content" type="submit">Войти</button>
</form>
</body>
</html>