<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "url_shortener";
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function generateShortCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $shortCode = '';
    $length = 5; 

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $shortCode .= $characters[$index];
    }

    return $shortCode;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];

    
    $shortCode = generateShortCode();

    
    $sql = "INSERT INTO urls (short_code, original_url) VALUES ('$shortCode', '$url')";

    if ($conn->query($sql) === TRUE) {
        $response = [
            'shortUrl' => 'http://localhost/url_shortener/redirect.php?code='. $shortCode
        ];
        echo json_encode($response);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
