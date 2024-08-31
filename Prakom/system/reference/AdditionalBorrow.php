<?php
include "../Conn.php";

$Books = "SELECT bookunit.BookUnitId, books.BookName FROM `bookunit` INNER join books ON bookunit.BookId = books.BookId WHERE bookunit.BookStatus = 'A' AND bookunit.Condition != 'R';";
$BooksRun = mysqli_query($connRun, $Books);
while ($BooksRun1 = mysqli_fetch_array($BooksRun)) {
    echo '<option value="' . $BooksRun1['BookUnitId'] . '">' . $BooksRun1['BookName'] . '</option>';
}
