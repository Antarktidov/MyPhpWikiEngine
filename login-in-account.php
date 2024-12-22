<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    //$confirm_password = test_input($_POST["confirm-password"]);
  } else {
    $html_output = 'Неизвестная ошибка';
  }
    require_once __DIR__ . '/helpers/connect-to-db.php';
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $hash = $row['password'];

        if (password_verify($password, $hash)) {
            $_SESSION['logged_in_user_id'] = $row['id'];
            $html_output = 'Вы успешно вошли';
        } else {
            $html_output = 'Неверный пароль';
        }
    }
} else {
  echo "0 results";
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