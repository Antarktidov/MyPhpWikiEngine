<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $confirm_password = test_input($_POST["confirm-password"]);
  } else {
    $html_output = 'Неизвестная ошибка';
  }

  if ($password === $confirm_password)
  {
    require_once __DIR__ . '/helpers/connect-to-db.php';

    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (name, email, password)
    VALUES ('$name', '$email', '$hash')";

    if ($conn->query($sql) === TRUE) {
     $html_output = "Регистрация завершена";

     //$_SESSION['logged_in_user_id'] = 
    } else {
        $html_output =  "Произошла неизвестная ошибка при регистрации";
    }

    $sql2 = "SELECT id FROM users WHERE email='$email'";

    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $_SESSION['logged_in_user_id'] = $row["id"];
      }
    }

  } else {
    $html_output = "Ошибка: пароли не совпадают";
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