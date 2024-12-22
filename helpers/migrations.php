<?php
require_once 'connect-to-db.php';

$sql = "CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    
if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully\n";
} else {
    echo "Error creating table: " . $conn->error;
}


$sql2 = "CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
      
  if ($conn->query($sql2) === TRUE) {
    echo "Table articles created successfully\n";
  } else {
      echo "Error creating table: " . $conn->error;
  }

  $sql3 = "CREATE TABLE `revisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
        
    if ($conn->query($sql3) === TRUE) {
        echo "Table revisions created successfully\n";
    } else {
        echo "Error creating table: " . $conn->error;
    }
?>