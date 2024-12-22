<?php

function is_admin($conn) {
    if(!isset($_SESSION['logged_in_user_id'])) {
        return false;
    }

    $user_id = $_SESSION['logged_in_user_id'];

    $sql = "SELECT * FROM users WHERE id='$user_id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            return $row['is_admin'];
        }
    }
}
?>