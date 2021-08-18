<?php
if(strcmp($_GET["token"], $_SERVER['TOKEN']) !== 0)
    die('Access denied!');
$servername = $_SERVER['DB_HOST'];
$username =  $_SERVER['DB_USERNAME'];
$password =  $_SERVER['DB_PASSWORD'];

// Create connection
$conn = new mysqli($servername, $username, $password, "sms");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET["action"]) && strcmp($_GET["action"], "create") == 0) {
    $sql = 'INSERT INTO sms (content, created_at) VALUES ("' . $_GET["content"] . '", now())';
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM sms ORDER BY id DESC LIMIT 5";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "Content: <b>" . $row["content"]. "</b> " . $row["created_at"]. "<br>";
      }
    } else {
      echo "0 results";
    }
}

$conn->close();
?>