<?php
session_start();
include "connectDB.php";

function saveUserDataToSession($name, $nickname, $allow, $gender)
{
    $_SESSION['user_data'] = array(
        'name' => $name,
        'nickname' => $nickname,
        'allow' => $allow,
        'gender' => $gender,
    );
}

function getUserDataFromSession()
{
    return isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $nickname = $_POST["nickname"];
    $allow = isset($_POST["allow"]) ? $_POST["allow"] : 0; 
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : null;

    saveUserDataToSession($name, $nickname, $allow, $gender);

    $sql = "INSERT INTO users (name, nickname, allow, gender) VALUES ('$name', '$nickname', $allow, '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Data has been submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
