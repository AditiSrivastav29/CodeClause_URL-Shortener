<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "url_shortener";
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $code = $_GET['code'];

    
    $sql = "SELECT original_url FROM urls WHERE short_code = '$code'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $originalUrl = $row['original_url'];
        header("Location: $originalUrl");
        exit;
    } else {
        echo "Invalid short code.";
    }
}

$conn->close();
?>
