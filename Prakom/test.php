<?php
// Assuming you have a connection to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prakom_library";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


echo $vehicle1 = $_POST['vehicle1'];
echo $vehicle2 = $_POST['vehicle2'];
echo $vehicle3 = $_POST['vehicle3'];


// Get the inputted book name from the AJAX request
// $inputtedBookName = $_POST['book_name'];

// // Use mysqli_real_escape_string for basic input sanitization
// $inputtedBookName = mysqli_real_escape_string($conn, $inputtedBookName);

// // Use a prepared statement to avoid SQL injection
// $stmt = mysqli_prepare($conn, "SELECT BookId FROM books WHERE BookName = ?");
// mysqli_stmt_bind_param($stmt, "s", $inputtedBookName);
// mysqli_stmt_execute($stmt);
// mysqli_stmt_bind_result($stmt, $bookId);

// // Fetch the results and store them in an array
// $bookIdOptions = array();
// while (mysqli_stmt_fetch($stmt)) {
//     $bookIdOptions[] = $bookId;
// }

// // Send the book ID options as JSON
// echo json_encode($bookIdOptions);

// mysqli_stmt_close($stmt);
// mysqli_close($conn);
