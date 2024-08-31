<?php
echo '<option value="NULL" selected disabled hidden>Select Genre</option>';


include "../Conn.php";
$Genre = "SELECT * FROM genre";
$GenreRun = mysqli_query($connRun, $Genre);
while ($GenreRun1 = mysqli_fetch_array($GenreRun)) {
    echo '<option value="' . $GenreRun1['GenreId'] . '">' . $GenreRun1['GenreName'] . '</option>';
}
