<?php
include "Conn.php";
if ($_SESSION['Level'] === 'ADM' or $_SESSION['Level'] === 'PTG') {

    $type = $_GET['type'];
    if ($type === 'borrow') {

        $InputCount = $_POST['InputCount'];
        $User = $_POST['User'];

        // Create DateTime objects
        $datein = new DateTime;
        $dateout = new DateTime;
        $dateout->modify('+5 day');

        // Format DateTime objects as strings
        $formattedDateIn = $datein->format('Y-m-d');
        $formattedDateOut = $dateout->format('Y-m-d');


        $sql = "INSERT INTO `borrow` (`BorrowId`, `BorrowingDate`, `ReturnDate`, `UserId`) VALUES (NULL, '$formattedDateIn', '$formattedDateOut', '$User');";
        $sqlrun = mysqli_query($connRun, $sql);

        $getid = "SELECT BorrowId FROM borrow ORDER BY BorrowId DESC LIMIT 1";
        $getids = mysqli_query($connRun, $getid);

        // Check if the query was successful
        if ($getids) {
            // Fetch the result as an associative array
            $get = mysqli_fetch_array($getids);

            // Check if there are any results
            if ($get) {
                // Access the value using the column name
                $lastBorrowId = $get['BorrowId'];
                echo "Last BorrowId: $lastBorrowId";
            } else {
                echo "No results found";
            }

            // Free the result set
            mysqli_free_result($getids);
        } else {
            // Handle the case where the query fails
            echo "Error executing the query: " . mysqli_error($connRun);
        }
        $Bdata = array();
        $Udata = array();

        // Assuming you have a connection $conn
        for ($i = 1; $i <= $InputCount; $i++) {
            if (isset($_POST['BookUnitId' . $i])) {

                $Uvalue = $_POST['BookUnitId' . $i];

                $sql2 = "INSERT INTO borrowdetail (BorrowId, bookunitid, BorrowStatus) VALUES ('$lastBorrowId', '$Uvalue', 'DPJ')";

                mysqli_query($connRun, $sql2);

                $sql3 = "UPDATE `bookunit` SET `BookStatus` = 'R' WHERE `bookunit`.`BookUnitId` = '$Uvalue';";
                mysqli_query($connRun, $sql3);
            }
        }

        header("location:../view/mainpage.php?page=operate&section=borrow");
    } elseif ($type === 'return') {


        function process_form($connRun)
        {
            $values = array(); // Initialize an empty array to store the values

            $datereturn = new DateTime;
            $formatteddatereturn = $datereturn->format('Y-m-d');
            $Condition = $_POST['condition'];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                foreach ($_POST as $key => $value) {
                    if (strpos($key, 'Unit') === 0) {
                        // Add the value to the array
                        $values[] = $value;

                        $sql1 = "UPDATE `borrowdetail` SET `BorrowStatus` = 'DONE', `ReturnedDate` = '$formatteddatereturn' WHERE `borrowdetail`.`BookUnitId` = $value;";
                        mysqli_query($connRun, $sql1);
                        $sql2 = "UPDATE `bookunit` SET `BookStatus` = 'A', `Condition` = '$Condition' WHERE `bookunit`.`BookUnitId` = $value;";
                        mysqli_query($connRun, $sql2);
                    }
                }
            }

            // Return the array of values
            return $values;
        }
        $User = $_POST['UserId'];

        // Call the function and store the returned array in a session variable
        process_form($connRun);
?>
        <form id="hiddenform" action="../view/mainpage.php?page=operate&section=borrow" method="post">
            <input type="hidden" name="nextreturn" value="True">
            <input type="hidden" name="UserId" value="<?php echo $User ?>">
            <!-- <input type="submit" value="submit"> -->
        </form>

        <script>
            document.getElementById("hiddenform").submit(); // Submit the form
        </script>
<?php
        // header("location:../view/mainpage.php?page=operate&section=borrow");
        // $_SESSION['values'] = process_form($connRun);
        // header("location:../view/mainpage.php?page=operate&section=borrow?lastcond=true");
    }
    // elseif ($type === 'returnlast') {
    //     $_POST['count'];
    //     $i = 1;
    //     foreach ($_SESSION['values'] as $value) {
    //     }
    // }

}
