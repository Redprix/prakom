<?php
if (!session_id()) {
    session_start();
}
$host = "localhost";
$user = "root";
$password = "";
$db = "prakom_library";

$connRun = mysqli_connect($host, $user, $password, $db);
if (!$connRun) {
    die("Connection failed: " . mysqli_connect_error());
}
