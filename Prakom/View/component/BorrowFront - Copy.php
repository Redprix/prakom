<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_POST['UserId']) and !isset($_POST['inputCount2']) and isset($_POST['Search']) or isset($_POST['SearchMonths'])) {
    if ($_POST['Search'] != NULL and $_POST['SearchMonths'] == NULL) {
        // echo $Search = $_POST['Search'];
        if (strtolower($_POST['Search']) == 'borrowed') {

            $sqlsearch = "SELECT * FROM `borrow` INNER JOIN borrowdetail on borrowdetail.BorrowId = borrow.BorrowId WHERE Borrowdetail.BorrowStatus = 'DPJ';";
            $runningsearch = mysqli_query($connRun, $sqlsearch);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            if (!$runningsearch) {
                echo "Error: " . mysqli_error($connRun);
            }
            if (mysqli_num_rows($runningsearch) > 0) {
?>
                <table class="table table-hover ihatepaginate" id="ihatepaginate">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Borrow Id</th>
                            <th scope="col">Borrower Name</th>
                            <th scope="col">Borrowed</th>
                            <th scope="col">Borrowed on</th>
                            <th scope="col">Return on</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `borrow` inner JOIN `user` on user.userid = borrow.UserId INNER JOIN `borrowdetail` on borrowdetail.BorrowId = borrow.BorrowId INNER JOIN `bookunit` on bookunit.BookUnitId = borrowdetail.BookUnitId INNER JOIN `books` on books.bookid = bookunit.BookId WHERE Borrowdetail.BorrowStatus = 'DPJ' ORDER BY borrow.borrowId DESC;";
                        $result = mysqli_query($connRun, $sql);
                        // Assume $results contains the result of your SQL query
                        $results = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        $seen = []; // To keep track of seen borrowids
                        $skippedRows = []; // To store the skipped rows
                        $i = 1;

                        foreach ($results as $row) {

                            $borrowid = $row['BorrowId'];
                            if (isset($seen[$borrowid])) {
                                // This borrowid has been seen before, store this row in skippedRows
                                $skippedRows[] = $row;
                                continue;
                            }

                            // This borrowid has not been seen before, remember it
                            $seen[$borrowid] = true;

                            // Process the row, for example, output it
                            // echo "BorrowId: " . $row['BorrowId'] . ", UserId: " . $row['UserId'] . "<br>";


                            // Now, $skippedRows contains the rows that were skipped. You can output them if you want.
                            // foreach ($skippedRows as $row) {
                            //     echo "Skipped row - BorrowId: " . $row['BorrowId'] . ", UserId: " . $row['UserId'] . "<br>";
                            // }
                            $borrowidpoint = $row['BorrowId'];
                            $sqlforloan = "SELECT * FROM `borrowdetail` inner join BookUnit on BookUnit.BookUnitId = borrowdetail.BookUnitId inner JOIN books on books.BookId = bookunit.BookId WHERE BorrowId = $borrowidpoint;";
                            $sqlrunforloan = mysqli_query($connRun, $sqlforloan);
                            $runloan = mysqli_fetch_array($sqlrunforloan);
                            $hmloan = mysqli_num_rows($sqlrunforloan);

                            $return_date = strtotime($row['ReturnDate']);
                            $now = time();
                            $days_due = round(($return_date - $now) / (60 * 60 * 24));

                        ?>
                            <tr data-toggle="modal" data-target="#borrow<?php echo $borrowidpoint ?>">
                                <th scope="row"><?php echo $i ?></th>
                                <td><?php echo $row['BorrowId'] ?></td>
                                <td><?php echo $row['UserFullName'] ?></td>
                                <td>
                                    <?php
                                    if ($hmloan == 1) {
                                        echo $hmloan . " book";
                                    } else
                                        echo $hmloan . " books"
                                    ?>
                                </td>
                                <td><?php echo $row['BorrowingDate'] ?></td>
                                <td><?php echo $row['ReturnDate'] ?></td>
                                <td>
                                    <?php
                                    // Get the whole book that are being loaned
                                    $sqlstatus1 = "SELECT * FROM borrowdetail INNER JOIN BookUnit ON BookUnit.BookUnitId = BorrowDetail.BookUnitId INNER JOIN Books ON Books.BookId = BookUnit.BookId WHERE BorrowId = $borrowidpoint";
                                    $runstatus1 = mysqli_query($connRun, $sqlstatus1);
                                    $Status1 = mysqli_num_rows($runstatus1);
                                    $Status1_ = mysqli_fetch_all($runstatus1, MYSQLI_ASSOC);

                                    // Get the whole book that are already been returned
                                    $sqlstatus2 = "SELECT * FROM borrowdetail WHERE BorrowId = $borrowidpoint AND BorrowStatus = 'DONE'";
                                    $runstatus2 = mysqli_query($connRun, $sqlstatus2);
                                    $Status2 = mysqli_num_rows($runstatus2);

                                    echo $Status2 . " of " . $Status1 . " returned";

                                    ?>
                                </td>
                            </tr>
                            <div class="modal fade" id="borrow<?php echo $borrowidpoint ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Borrow Id : <?php echo $borrowidpoint ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="card p-2">
                                                        <span>Borrower name :</span>
                                                        <p><?php echo $row['UserFullName'] ?></p>
                                                        <span>Borrowing date :</span>
                                                        <p><?php echo $row['BorrowingDate'] . " to " . $row['ReturnDate'] ?> </p>

                                                    </div>
                                                </div>
                                                <div class="col-8">

                                                    <h5>Books Borrowed :</h5>
                                                    <ul class="list-group">
                                                        <?php
                                                        foreach ($Status1_ as $brwbk) {
                                                            if ($brwbk['ReturnedDate'] == NULL) {
                                                                if ($days_due > 0) {

                                                        ?>


                                                                    <li class="list-group-item">
                                                                        <div tabindex="0" class="tooltip-wrapper" data-toggle="tooltip" data-bs-placement="right" title="<img class='tooltipimg' src='../images/Public/<?php echo $brwbk['BookCover'] ?>'>">
                                                                            <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled>
                                                                            <label class="form-check-label" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                                <br>
                                                                                Waiting for return
                                                                            </label>
                                                                        </div>
                                                                    </li>

                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <li class="list-group-item">
                                                                        <div tabindex="0" class="tooltip-wrapper" data-toggle="tooltip" data-bs-placement="right" title="<img class='tooltipimg' src='../images/Public/<?php echo $brwbk['BookCover'] ?>'>">

                                                                            <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled>
                                                                            <label class="form-check-label text-danger" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                                <br>
                                                                                <?php echo "The book is due $days_due days."; ?>
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                <?php
                                                                }
                                                            } elseif ($brwbk['ReturnedDate'] !== NULL) {
                                                                ?>
                                                                <div tabindex="0" class="tooltip-wrapper" data-toggle="tooltip" data-bs-placement="right" title="<img class='tooltipimg' src='../images/Public/<?php echo $brwbk['BookCover'] ?>'>">
                                                                    <?php
                                                                    // check if its late or not when already being returned
                                                                    $Patokan = $brwbk['BorrowId'];
                                                                    $sqlcheckdue = "SELECT * FROM Borrow WHERE BorrowId = '$Patokan'";
                                                                    $chekdue = mysqli_fetch_array(mysqli_query($connRun, $sqlcheckdue));
                                                                    if ($brwbk['ReturnedDate'] < $chekdue['ReturnDate']) {
                                                                    ?>
                                                                        <li class="list-group-item">
                                                                            <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled checked>
                                                                            <label class="form-check-label" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                                <br>
                                                                                Returned on <?php echo $brwbk['ReturnedDate'] ?>
                                                                            </label>
                                                                        </li>
                                                                    <?php
                                                                    } else {

                                                                    ?>
                                                                        <li class="list-group-item">
                                                                            <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled checked>
                                                                            <label class="form-check-label text-danger" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                                <br>
                                                                                Returned late (<?php echo $days_due ?> days) on <?php echo $brwbk['ReturnedDate'] ?>
                                                                            </label>
                                                                        </li>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        <?php
                            $i++;
                        }

                        ?>
                    </tbody>
                </table>
            <?php

            } else {
                echo "No data found";
            }
        } elseif (strtolower($_POST['Search']) == 'due') {

            $sqlsearch = "SELECT * FROM `borrow` INNER JOIN borrowdetail on borrowdetail.BorrowId = borrow.BorrowId WHERE Borrowdetail.BorrowStatus = 'DPJ';";
            $runningsearch = mysqli_query($connRun, $sqlsearch);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            if (!$runningsearch) {
                echo "Error: " . mysqli_error($connRun);
            }
            if (mysqli_num_rows($runningsearch) > 0) {
            }
        }
    } elseif ($_POST['Search'] == NULL and $_POST['SearchMonths'] != NULL) {
        $SearchMonths = $_POST['SearchMonths'];
        list($year, $month) = explode('-', $SearchMonths);
        "Year: $year, Month: $month";
        $sqlsearch = "SELECT * FROM `borrow` INNER JOIN borrowdetail on borrowdetail.BorrowId = borrow.BorrowId WHERE MONTH(Borrow.BorrowingDate) = '$month' AND YEAR(borrow.BorrowingDate) = '$year';";
        $runningsearch = mysqli_query($connRun, $sqlsearch);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        if (!$runningsearch) {
            echo "Error: " . mysqli_error($connRun);
        }

        if (mysqli_num_rows($runningsearch) > 0) {


            ?>

            <table class="table table-hover ihatepaginate" id="ihatepaginate">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Borrow Id</th>
                        <th scope="col">Borrower Name</th>
                        <th scope="col">Borrowed</th>
                        <th scope="col">Borrowed on</th>
                        <th scope="col">Return on</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `borrow` inner JOIN `user` on user.userid = borrow.UserId INNER JOIN `borrowdetail` on borrowdetail.BorrowId = borrow.BorrowId INNER JOIN `bookunit` on bookunit.BookUnitId = borrowdetail.BookUnitId INNER JOIN `books` on books.bookid = bookunit.BookId WHERE MONTH(Borrow.BorrowingDate) = '$month' AND YEAR(borrow.BorrowingDate) = '$year' ORDER BY borrow.borrowId DESC;";
                    $result = mysqli_query($connRun, $sql);
                    // Assume $results contains the result of your SQL query
                    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    $seen = []; // To keep track of seen borrowids
                    $skippedRows = []; // To store the skipped rows
                    $i = 1;

                    foreach ($results as $row) {

                        $borrowid = $row['BorrowId'];
                        if (isset($seen[$borrowid])) {
                            // This borrowid has been seen before, store this row in skippedRows
                            $skippedRows[] = $row;
                            continue;
                        }

                        // This borrowid has not been seen before, remember it
                        $seen[$borrowid] = true;

                        // Process the row, for example, output it
                        // echo "BorrowId: " . $row['BorrowId'] . ", UserId: " . $row['UserId'] . "<br>";


                        // Now, $skippedRows contains the rows that were skipped. You can output them if you want.
                        // foreach ($skippedRows as $row) {
                        //     echo "Skipped row - BorrowId: " . $row['BorrowId'] . ", UserId: " . $row['UserId'] . "<br>";
                        // }
                        $borrowidpoint = $row['BorrowId'];
                        $sqlforloan = "SELECT * FROM `borrowdetail` inner join BookUnit on BookUnit.BookUnitId = borrowdetail.BookUnitId inner JOIN books on books.BookId = bookunit.BookId WHERE BorrowId = $borrowidpoint;";
                        $sqlrunforloan = mysqli_query($connRun, $sqlforloan);
                        $runloan = mysqli_fetch_array($sqlrunforloan);
                        $hmloan = mysqli_num_rows($sqlrunforloan);

                        $return_date = strtotime($row['ReturnDate']);
                        $now = time();
                        $days_due = round(($return_date - $now) / (60 * 60 * 24));

                    ?>
                        <tr data-toggle="modal" data-target="#borrow<?php echo $borrowidpoint ?>">
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $row['BorrowId'] ?></td>
                            <td><?php echo $row['UserFullName'] ?></td>
                            <td>
                                <?php
                                if ($hmloan == 1) {
                                    echo $hmloan . " book";
                                } else
                                    echo $hmloan . " books"
                                ?>
                            </td>
                            <td><?php echo $row['BorrowingDate'] ?></td>
                            <td><?php echo $row['ReturnDate'] ?></td>
                            <td>
                                <?php
                                // Get the whole book that are being loaned
                                $sqlstatus1 = "SELECT * FROM borrowdetail INNER JOIN BookUnit ON BookUnit.BookUnitId = BorrowDetail.BookUnitId INNER JOIN Books ON Books.BookId = BookUnit.BookId WHERE BorrowId = $borrowidpoint";
                                $runstatus1 = mysqli_query($connRun, $sqlstatus1);
                                $Status1 = mysqli_num_rows($runstatus1);
                                $Status1_ = mysqli_fetch_all($runstatus1, MYSQLI_ASSOC);

                                // Get the whole book that are already been returned
                                $sqlstatus2 = "SELECT * FROM borrowdetail WHERE BorrowId = $borrowidpoint AND BorrowStatus = 'DONE'";
                                $runstatus2 = mysqli_query($connRun, $sqlstatus2);
                                $Status2 = mysqli_num_rows($runstatus2);

                                echo $Status2 . " of " . $Status1 . " returned";

                                ?>
                            </td>
                        </tr>
                        <div class="modal fade" id="borrow<?php echo $borrowidpoint ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Borrow Id : <?php echo $borrowidpoint ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-4">
                                                <div class="card p-2">
                                                    <span>Borrower name :</span>
                                                    <p><?php echo $row['UserFullName'] ?></p>
                                                    <span>Borrowing date :</span>
                                                    <p><?php echo $row['BorrowingDate'] . " to " . $row['ReturnDate'] ?> </p>

                                                </div>
                                            </div>
                                            <div class="col-8">

                                                <h5>Books Borrowed :</h5>
                                                <ul class="list-group">
                                                    <?php
                                                    foreach ($Status1_ as $brwbk) {
                                                        if ($brwbk['ReturnedDate'] == NULL) {
                                                            if ($days_due > 0) {

                                                    ?>


                                                                <li class="list-group-item">
                                                                    <div tabindex="0" class="tooltip-wrapper" data-toggle="tooltip" data-bs-placement="right" title="<img class='tooltipimg' src='../images/Public/<?php echo $brwbk['BookCover'] ?>'>">
                                                                        <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled>
                                                                        <label class="form-check-label" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                            <br>
                                                                            Waiting for return
                                                                        </label>
                                                                    </div>
                                                                </li>

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <li class="list-group-item">
                                                                    <div tabindex="0" class="tooltip-wrapper" data-toggle="tooltip" data-bs-placement="right" title="<img class='tooltipimg' src='../images/Public/<?php echo $brwbk['BookCover'] ?>'>">

                                                                        <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled>
                                                                        <label class="form-check-label text-danger" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                            <br>
                                                                            <?php echo "The book is due $days_due days."; ?>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            <?php
                                                            }
                                                        } elseif ($brwbk['ReturnedDate'] !== NULL) {
                                                            ?>
                                                            <div tabindex="0" class="tooltip-wrapper" data-toggle="tooltip" data-bs-placement="right" title="<img class='tooltipimg' src='../images/Public/<?php echo $brwbk['BookCover'] ?>'>">
                                                                <?php
                                                                // check if its late or not when already being returned
                                                                $Patokan = $brwbk['BorrowId'];
                                                                $sqlcheckdue = "SELECT * FROM Borrow WHERE BorrowId = '$Patokan'";
                                                                $chekdue = mysqli_fetch_array(mysqli_query($connRun, $sqlcheckdue));
                                                                if ($brwbk['ReturnedDate'] < $chekdue['ReturnDate']) {
                                                                ?>
                                                                    <li class="list-group-item">
                                                                        <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled checked>
                                                                        <label class="form-check-label" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                            <br>
                                                                            Returned on <?php echo $brwbk['ReturnedDate'] ?>
                                                                        </label>
                                                                    </li>
                                                                <?php
                                                                } else {

                                                                ?>
                                                                    <li class="list-group-item">
                                                                        <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled checked>
                                                                        <label class="form-check-label text-danger" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                            <br>
                                                                            Returned late (<?php echo $days_due ?> days) on <?php echo $brwbk['ReturnedDate'] ?>
                                                                        </label>
                                                                    </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php
                        $i++;
                    }

                    ?>
                </tbody>
            </table>
    <?php

        } else {
            echo "No data found";
        }
    } elseif ($_POST['Search'] != NULL and $_POST['SearchMonths'] != NULL) {
        echo $SearchMonths = $_POST['SearchMonths'];
        echo $Search = $_POST['Search'];
    } else {
        echo "Data not found";
        // header("location:/prakom/view/mainpage.php?page=operate&section=borrow");
    }
    ?>


<?php
} else
    if (!isset($_POST['UserId']) and !isset($_POST['inputCount2']) and !isset($_POST['Search']) or !isset($_POST['SearchMonths'])) {
?>

    <div class="d-flex justify-content-between">
        <div class="flex-items">
            <div class="btn-group mt-2" role="group" aria-label="Basic example">
                <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetable" aria-expanded="false" aria-controls="collapsedata">
                    Data
                </button>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseborrow" aria-expanded="false" aria-controls="collapseborrow">
                    Borrowing
                </button>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapsereturn" aria-expanded="false" aria-controls="collapsereturn">
                    Returning
                </button>
            </div>
        </div>
        <form action="mainpage.php?page=operate&section=borrow" method="post">
            <div class="input-group" style="margin-right: 5px; margin-left:5px; margin-top:5px">
                <input name="SearchMonths" type="month" class="form-control" placeholder="months" id="bdaymonth" name="bdaymonth">
                <input name="Search" type="text" class="form-control" placeholder="Universal borrow management search" aria-label="Universal search" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">search</button>
            </div>
        </form>


    </div>


    <hr>

    <div class="container">

        <div class="collapse mb-3" id="collapseborrow">
            <div class="card card-body">
                <form class="row g-3" action="mainpage.php?page=operate&section=borrow" method="post">
                    <div class="col-auto">
                        <label for="DatalistBorrow2">Borrower Id</label>
                        <input required class="form-control" list="DatalistsBorrow2" name="UserId" id="DatalistBorrow2" placeholder="insert the borrower id">
                        <datalist id="DatalistsBorrow2">
                            <!-- <option value="San Francisco"> -->
                            <?php
                            $User = "SELECT * FROM `user` WHERE UserLevel = 'PMJ';";
                            $UserRun = mysqli_query($connRun, $User);
                            while ($UserRun1 = mysqli_fetch_array($UserRun)) {
                            ?>
                                <option value="<?php echo $UserRun1['Userid'] ?>">
                                    <?php echo $UserRun1['UserFullName']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class="col-auto">
                        <label for="DatalistBorrow">unit Id</label>
                        <div id="dynamicInput2" class="container">
                            <div class="inputField row">
                                <input required class="form-control w-100 col" list="DatalistsBorrow" name="BookUnitId1" id="DatalistBorrow" placeholder="insert the book ids">
                                <datalist id="DatalistsBorrow">
                                    <?php
                                    include "../system/reference/AdditionalBorrow.php";
                                    ?>
                                </datalist>
                                <button type="button" class="col-2 remove btn btn-sm  btn-danger">x</button>
                            </div>
                        </div>
                        <button style="border: 0;" type="button" class="w-100 my-1 btn btn-success" id="addInput2">Add Books</button>
                    </div>
                    <div class="col-12">
                        <input type="hidden" id="inputCount2" name="inputCount2" value="1">

                        <button type="submit" class="btn btn-primary ">Next ></button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Returning -->

        <div class="collapse mb-3" id="collapsereturn">
            <div class="card card-body">
                <form class="row g-3" action="mainpage.php?page=operate&section=borrow" method="post">
                    <div class="col-auto">
                        <label for="DetailsReturn">Borrower Id</label>
                        <input type="hidden" name="nextreturn" value="true">
                        <input required class="form-control" list="DetailsReturn2" name="UserId" id="DetailsReturn" placeholder="insert the borrower id">
                        <datalist id="DetailsReturn2">
                            <!-- <option value="San Francisco"> -->
                            <?php
                            $User = "SELECT b.borrowid, b.BorrowingDate, b.ReturnDate, b.userid, u.*
                                FROM (
                                    SELECT userid, MIN(borrowid) as MinBorrowId
                                    FROM borrow
                                    WHERE userid != ''
                                    GROUP BY userid
                                ) AS groupedB
                                INNER JOIN borrow b ON b.userid = groupedB.userid AND b.borrowid = groupedB.MinBorrowId
                                INNER JOIN user u ON u.UserId = b.userid";
                            $UserRun = mysqli_query($connRun, $User);
                            while ($UserRun1 = mysqli_fetch_array($UserRun)) {
                            ?>
                                <option value="<?php echo $UserRun1['Userid'] ?>">
                                    <?php echo $UserRun1['UserFullName']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </datalist>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mb-3">Next ></button>
                    </div>
                </form>
            </div>
        </div>


        <!-- collapse data report? -->
        <div class="collapse" id="collapsetable">
            <table class="table table-hover ihatepaginate" id="ihatepaginate">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Borrow Id</th>
                        <th scope="col">Borrower Name</th>
                        <th scope="col">Borrowed</th>
                        <th scope="col">Borrowed on</th>
                        <th scope="col">Return on</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `borrow` inner JOIN `user` on user.userid = borrow.UserId INNER JOIN `borrowdetail` on borrowdetail.BorrowId = borrow.BorrowId INNER JOIN `bookunit` on bookunit.BookUnitId = borrowdetail.BookUnitId INNER JOIN `books` on books.bookid = bookunit.BookId ORDER BY borrow.borrowId DESC;";
                    $result = mysqli_query($connRun, $sql);
                    // Assume $results contains the result of your SQL query
                    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    $seen = []; // To keep track of seen borrowids
                    $skippedRows = []; // To store the skipped rows
                    $i = 1;

                    foreach ($results as $row) {

                        $borrowid = $row['BorrowId'];
                        if (isset($seen[$borrowid])) {
                            // This borrowid has been seen before, store this row in skippedRows
                            $skippedRows[] = $row;
                            continue;
                        }

                        // This borrowid has not been seen before, remember it
                        $seen[$borrowid] = true;

                        // Process the row, for example, output it
                        // echo "BorrowId: " . $row['BorrowId'] . ", UserId: " . $row['UserId'] . "<br>";


                        // Now, $skippedRows contains the rows that were skipped. You can output them if you want.
                        // foreach ($skippedRows as $row) {
                        //     echo "Skipped row - BorrowId: " . $row['BorrowId'] . ", UserId: " . $row['UserId'] . "<br>";
                        // }
                        $borrowidpoint = $row['BorrowId'];
                        $sqlforloan = "SELECT * FROM `borrowdetail` inner join BookUnit on BookUnit.BookUnitId = borrowdetail.BookUnitId inner JOIN books on books.BookId = bookunit.BookId WHERE BorrowId = $borrowidpoint;";
                        $sqlrunforloan = mysqli_query($connRun, $sqlforloan);
                        $runloan = mysqli_fetch_array($sqlrunforloan);
                        $hmloan = mysqli_num_rows($sqlrunforloan);

                        $return_date = strtotime($row['ReturnDate']);
                        $now = time();
                        $days_due = round(($return_date - $now) / (60 * 60 * 24));

                    ?>
                        <tr data-toggle="modal" data-target="#borrow<?php echo $borrowidpoint ?>">
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $row['BorrowId'] ?></td>
                            <td><?php echo $row['UserFullName'] ?></td>
                            <td>
                                <?php
                                if ($hmloan == 1) {
                                    echo $hmloan . " book";
                                } else
                                    echo $hmloan . " books"
                                ?>
                            </td>
                            <td><?php echo $row['BorrowingDate'] ?></td>
                            <td><?php echo $row['ReturnDate'] ?></td>
                            <td>
                                <?php
                                // Get the whole book that are being loaned
                                $sqlstatus1 = "SELECT * FROM borrowdetail INNER JOIN BookUnit ON BookUnit.BookUnitId = BorrowDetail.BookUnitId INNER JOIN Books ON Books.BookId = BookUnit.BookId WHERE BorrowId = $borrowidpoint";
                                $runstatus1 = mysqli_query($connRun, $sqlstatus1);
                                $Status1 = mysqli_num_rows($runstatus1);
                                $Status1_ = mysqli_fetch_all($runstatus1, MYSQLI_ASSOC);

                                // Get the whole book that are already been returned
                                $sqlstatus2 = "SELECT * FROM borrowdetail WHERE BorrowId = $borrowidpoint AND BorrowStatus = 'DONE'";
                                $runstatus2 = mysqli_query($connRun, $sqlstatus2);
                                $Status2 = mysqli_num_rows($runstatus2);

                                echo $Status2 . " of " . $Status1 . " returned";

                                ?>
                            </td>
                        </tr>
                        <div class="modal fade" id="borrow<?php echo $borrowidpoint ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Borrow Id : <?php echo $borrowidpoint ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-4">
                                                <div class="card p-2">
                                                    <span>Borrower name :</span>
                                                    <p><?php echo $row['UserFullName'] ?></p>
                                                    <span>Borrowing date :</span>
                                                    <p><?php echo $row['BorrowingDate'] . " to " . $row['ReturnDate'] ?> </p>

                                                </div>
                                            </div>
                                            <div class="col-8">

                                                <h5>Books Borrowed :</h5>
                                                <ul class="list-group">
                                                    <?php
                                                    foreach ($Status1_ as $brwbk) {
                                                        if ($brwbk['ReturnedDate'] == NULL) {
                                                            if ($days_due > 0) {

                                                    ?>


                                                                <li class="list-group-item">
                                                                    <div tabindex="0" class="tooltip-wrapper" data-toggle="tooltip" data-bs-placement="right" title="<img class='tooltipimg' src='../images/Public/<?php echo $brwbk['BookCover'] ?>'>">
                                                                        <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled>
                                                                        <label class="form-check-label" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                            <br>
                                                                            Waiting for return
                                                                        </label>
                                                                    </div>
                                                                </li>

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <li class="list-group-item">
                                                                    <div tabindex="0" class="tooltip-wrapper" data-toggle="tooltip" data-bs-placement="right" title="<img class='tooltipimg' src='../images/Public/<?php echo $brwbk['BookCover'] ?>'>">

                                                                        <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled>
                                                                        <label class="form-check-label text-danger" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                            <br>
                                                                            <?php echo "The book is due $days_due days."; ?>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            <?php
                                                            }
                                                        } elseif ($brwbk['ReturnedDate'] !== NULL) {
                                                            ?>
                                                            <div tabindex="0" class="tooltip-wrapper" data-toggle="tooltip" data-bs-placement="right" title="<img class='tooltipimg' src='../images/Public/<?php echo $brwbk['BookCover'] ?>'>">
                                                                <?php
                                                                // check if its late or not when already being returned
                                                                $Patokan = $brwbk['BorrowId'];
                                                                $sqlcheckdue = "SELECT * FROM Borrow WHERE BorrowId = '$Patokan'";
                                                                $chekdue = mysqli_fetch_array(mysqli_query($connRun, $sqlcheckdue));
                                                                if ($brwbk['ReturnedDate'] < $chekdue['ReturnDate']) {
                                                                ?>
                                                                    <li class="list-group-item">
                                                                        <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled checked>
                                                                        <label class="form-check-label" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                            <br>
                                                                            Returned on <?php echo $brwbk['ReturnedDate'] ?>
                                                                        </label>
                                                                    </li>
                                                                <?php
                                                                } else {

                                                                ?>
                                                                    <li class="list-group-item">
                                                                        <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox" disabled checked>
                                                                        <label class="form-check-label text-danger" for="firstCheckbox">Unit <?php echo $brwbk['BookUnitId'] ?> | <?php echo $brwbk['BookName'] ?>
                                                                            <br>
                                                                            Returned late (<?php echo $days_due ?> days) on <?php echo $brwbk['ReturnedDate'] ?>
                                                                        </label>
                                                                    </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php
                        $i++;
                    }

                    ?>
                </tbody>
            </table>

        </div>
    </div>
<?Php
} elseif (isset($_POST['UserId']) and isset($_POST['inputCount2'])) {

    $inputCount = $_POST['inputCount2'];
    $UserId = $_POST['UserId'];
?>
    <form class="row g-3" action="../system/BorrowingnReturnSys.php?type=borrow" method="post">
        <div class="col-auto">
            <input type="hidden" name="InputCount" value="<?php echo $inputCount ?>">
            <label for="DatalistBorrow2">User Id :</label>
            <input class="form-control-plaintext readonly" readonly name="User" id="DatalistBorrow2" required value="<?php echo $UserId ?>">
            <?php

            $sqlname = "SELECT * FROM user where UserId = $UserId";
            $why = mysqli_query($connRun, $sqlname);
            $why2 = mysqli_fetch_array($why);
            ?>
            <label for="DatalistBorrow2">Name :</label>
            <input class="form-control-plaintext readonly" readonly id="DatalistBorrow2" required value="<?php echo $why2['UserFullName'] ?>">
        </div>
        <div class="col-auto">
            <?php
            // getting the BookUnitId into an array
            $data = array();
            for ($i = 1; $i <= $inputCount; $i++) {
                // Check if the current input has been submitted
                if (isset($_POST['BookUnitId' . $i])) {
                    // Get the value of the current input
                    $value = $_POST['BookUnitId' . $i];
                    // Add the value to the data array
                    $data[]  = $value;
                }
            }
            // var_dump($data);
            foreach ($data as $index => $value) {
                $fieldName = 'BookUnitId' . ($index + 1);
                echo '<div class="col-12">';
                echo '<label for="' . $fieldName . '">Unit Id ' . ($index + 1) . ' :</label>';
                echo '<input required readonly class="form-control-plaintext readonly" name="' . $fieldName . '" id="' . $fieldName . '" value="' . $value . '">';
                echo '</div>';
            }
            ?>
        </div>
        <div class="col-auto">
            <?php

            foreach ($data as $index => $value) {

                // Customize the SQL query based on $value
                $Units = "SELECT * FROM Books INNER JOIN BookUnit ON Books.BookId = BookUnit.BookId WHERE BookUnit.BookUnitId = $value";
                $UnitsRun = mysqli_query($connRun, $Units);
                $limau = mysqli_fetch_array($UnitsRun);
                $fieldName = 'BookName' . ($index + 1);
                echo '<div class="col-12">';
                echo '<label for="' . $fieldName . '">Book Name :'  . '</label>';
                echo '<input required readonly class="form-control-plaintext readonly" name="' . $fieldName . '" id="' . $fieldName . '" value="' . $limau['BookName'] . '">';
                echo '</div>';
            }
            ?>


        </div>
        <div class="col-12">
            <a class="btn mb-3" href="http://localhost/Prakom/view/mainpage.php?page=operate&section=borrow">Cancel</a>
            <button type="submit" class="btn btn-primary mb-3">Confirm</button>
        </div>
    </form>
<?php
} elseif (isset($_POST['nextreturn'])) {
    $UserId = $_POST['UserId'];
    $sql = "SELECT * FROM user WHERE Userid = $UserId";
    $shie = mysqli_query($connRun, $sql);
    $shiet = mysqli_fetch_array($shie);
?>

    <form class="row g-3" action="../system/BorrowingnReturnSys.php?type=return" method="post">
        <div class="col-2">
            <h5>Select the returned book</h5>
            <hr>
            <p>User Id : <?php echo $UserId ?></p>
            <div class="input-group">
                <label for="DatalistBorrow2">User Name :</label>
                <input style="margin-top: -10px; margin-left:15px;" class="form-control-plaintext readonly" readonly id="DatalistBorrow2" value="<?php echo $shiet['UserFullName'] ?>">
                <input class="form-control-plaintext hidden" hidden name="UserId" value="<?php echo $UserId ?>">
            </div>
            <hr>
            <a class="btn" href="http://localhost/Prakom/view/mainpage.php?page=operate&section=borrow">Back</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Next
            </button>

        </div>

        <?php
        $sqlReturn = "SELECT borrowdetail.BookUnitId, Books.BookName, BookUnit.Condition, Books.BookCover FROM `borrowdetail` INNER JOIN Borrow on borrowdetail.borrowId = borrow.BorrowId INNER JOIN bookunit on BorrowDetail.BookUnitId = bookunit.BookUnitId INNER JOIN books on books.BookId = bookunit.BookId WHERE BorrowStatus = 'DPJ' AND borrow.UserId = '$UserId';";
        $sqlReturn2 = mysqli_query($connRun, $sqlReturn);
        $Data = mysqli_fetch_all($sqlReturn2, MYSQLI_ASSOC);

        $Rowsget = mysqli_num_rows($sqlReturn2);
        if ($Rowsget < 1) {

        ?>
            <div class="col-10">
                <h4 class="text-center">
                    <br><br>
                    This user doesnt have any
                    <br>books in loan
                    <br>
                    <span class="material-symbols-outlined" style="font-size: 65px;">
                        book_5
                    </span>
                </h4>
            </div>
        <?php
        } else {


        ?>
            <div class="col-10">
                <div class="row">
                    <?php
                    $i = 1;
                    if ($Data) {
                        foreach ($Data as $item) {
                    ?>
                            <div class="col-3">
                                <div class="card h-100">
                                    <input type="radio" class="btn-check h-100" id="btn-check-<?php echo $i; ?>" autocomplete="off" name="Unit" value="<?php echo $item['BookUnitId'] ?>">
                                    <label class="btn h-100" for="btn-check-<?php echo $i; ?>">
                                        <center>
                                            <p style="margin-top:1px ;margin-bottom:-2px">Unit : <?php echo $item['BookUnitId'] ?></p>
                                            <img src="../images/Public/<?php echo $item['BookCover'] ?>" style="width: 120px;" alt="">
                                            <p class="px-1 pt-1" style="max-height:35px"><?php echo $item['BookName'] ?></p>
                                        </center>
                                    </label>
                                </div>
                            </div>


                    <?php
                            $i++;
                        }
                    }
                    ?>

                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <label for="">Latest Condition</label>
                            <select class="form-select disabled" disabled aria-label="Default select example">
                                <?php
                                if ($item['Condition'] === 'B') {
                                    $condition = 'Pecfect';
                                } elseif ($item['Condition'] === 'CB') {
                                    $condition = 'Acceptable';
                                }
                                ?>
                                <option selected><?php echo $condition ?></option>
                            </select>

                            <label for="">current Condition</label>
                            <select name="condition" class="form-select" aria-label="Default select example">
                                <option selected disabled hidden>Select one</option>
                                <option value="B">Pecfect</option>
                                <option value="CB">Acceptable</option>
                                <option value="R">Need Replacement</option>
                            </select>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-success">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>

<?php
        }
    }
?>