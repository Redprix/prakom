<?php
if (isset($_GET['reports']) and $_GET['reports'] == 'available') {
    $sql = "SELECT * FROM `bookunit` INNER JOIN books ON books.BookId = bookunit.BookId WHERE bookunit.Condition != 'R' AND bookunit.BookStatus = 'A'";
    $sqlrun = mysqli_query($connRun, $sql);
    $i = 1;
?>
    <table class="table ihatepaginates">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book name</th>
                <th scope="col">Book Unit id</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($run = mysqli_fetch_array($sqlrun)) {

            ?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $run['BookName'] ?></td>
                    <td><?php echo $run['BookUnitId'] ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php
} elseif (isset($_GET['reports']) and $_GET['reports'] == 'reserved') {
    $sql = "SELECT * FROM `bookunit` INNER JOIN books ON books.BookId = bookunit.BookId WHERE bookunit.Condition != 'R' AND bookunit.BookStatus = 'R'";
    $sqlrun = mysqli_query($connRun, $sql);
    $i = 1;
?>
    <table class="table ihatepaginates">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book name</th>
                <th scope="col">Book Unit id</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($run = mysqli_fetch_array($sqlrun)) {

            ?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $run['BookName'] ?></td>
                    <td><?php echo $run['BookUnitId'] ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php
} elseif (isset($_GET['reports']) and $_GET['reports'] == 'due') {

    $PresentDate = date("Y-m-d");
    $queryDues = "SELECT * FROM `BorrowDetail` INNER JOIN Borrow ON Borrow.BorrowId = BorrowDetail.BorrowId 
    INNER JOIN user on user.Userid = borrow.UserId
    WHERE BorrowDetail.BorrowStatus = 'DPJ' AND Borrow.ReturnDate < ?";
    $stmt = mysqli_prepare($connRun, $queryDues);
    mysqli_stmt_bind_param($stmt, "s", $PresentDate);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $i = 1; // Initialize $i
?>
    <table class="table ihatepaginates">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Borrower</th>
                <th scope="col">Book Unit id</th>
                <th scope="col">status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($run = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $run['UserFullName'] ?></td>
                    <td><?php echo $run['BookUnitId'] ?></td>
                    <td>not yet being returned</td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php
    mysqli_stmt_close($stmt);
} elseif (isset($_GET['reports']) and $_GET['reports'] == 'late') {
    $queryDues = "SELECT * FROM `BorrowDetail` 
              INNER JOIN Borrow ON Borrow.BorrowId = BorrowDetail.BorrowId 
              INNER JOIN user ON user.Userid = Borrow.UserId
              WHERE BorrowDetail.BorrowStatus = 'Done' 
              AND Borrow.ReturnDate < Borrowdetail.ReturnedDate";
    $stmt = mysqli_prepare($connRun, $queryDues);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $i = 1; // Initialize $i
?>

    <table class="table ihatepaginates">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Borrower</th>
                <th scope="col">Should return on</th>
                <th scope="col">Returned at</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($run = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $run['UserFullName'] ?></td>
                    <td><?php echo $run['ReturnDate'] ?></td>
                    <td><?php echo $run['ReturnedDate'] ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php
} elseif (isset($_GET['reports']) and $_GET['reports'] == 'replacement') {
    $sql = "SELECT * FROM `bookunit` INNER JOIN books ON books.BookId = bookunit.BookId WHERE bookunit.Condition = 'R' ";
    $sqlrun = mysqli_query($connRun, $sql);
    $i = 1;
?>
    <table class="table ihatepaginates">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book name</th>
                <th scope="col">Book Unit id</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($run = mysqli_fetch_array($sqlrun)) {

            ?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $run['BookName'] ?></td>
                    <td><?php echo $run['BookUnitId'] ?></td>
                    <td><?php echo "Need Replacements" ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>

<?php
} else {


?>
    <div class="row">
        <div class="col">
            <?php
            // $queryAvailable = "SELECT * FROM `bookunit` WHERE BookStatus = 'A'";
            // $queryava = mysqli_query($connRun, $queryAvailable);
            // echo $outputavailable = mysqli_num_rows($queryava);


            ?>
            <div class="card p-3">
                <h4>Current Book Status :</h4>
                <div class="d-flex">
                    <div class="col-2">
                        <div class="btn-group-vertical w-100 mt-3" role="group" aria-label="Vertical button group">
                            <a type="button" class="btn btn-outline-dark disabled" disabled>-Data Reports-</a>
                            <a href="/Prakom/View/mainpage.php?page=home&reports=available" type="button" class="btn btn-outline-dark">Available Books</a>
                            <a href="/Prakom/View/mainpage.php?page=home&reports=reserved" type="button" class="btn btn-outline-dark">Books Reserved</a>
                            <a href="/Prakom/View/mainpage.php?page=home&reports=due" type="button" class="btn btn-outline-dark">Books on Due</a>
                            <a href="/Prakom/View/mainpage.php?page=home&reports=late" type="button" class="btn btn-outline-dark">Books Returned Late</a>
                            <a href="/Prakom/View/mainpage.php?page=home&reports=replacement" type="button" class="btn btn-outline-dark">Need Replacements</a>
                        </div>
                    </div>
                    <div class="col-10 mb-3">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-7">
            <div class="card p-3">
                <p style="text-align: center;">Simple Recent Borrow/return Log</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Borrower</th>
                            <th scope="col">Book Unit</th>
                            <th scope="col">Returned on</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlrecentbrw = "SELECT * FROM borrow INNER JOIN BorrowDetail ON BorrowDetail.BorrowId = Borrow.BorrowId INNER JOIN User ON Borrow.UserId = User.UserId ORDER BY `borrowdetail`.`ReturnedDate` DESC  Limit 12";
                        $recentbrw = mysqli_query($connRun, $sqlrecentbrw);
                        $i = 1;
                        while ($recentbrwdt = mysqli_fetch_array($recentbrw)) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?php echo $recentbrwdt['UserFullName'] ?></td>
                                <td><a href="#"><?php echo $recentbrwdt['BookUnitId'] ?></a></td>
                                <td>
                                    <?php
                                    if ($recentbrwdt['ReturnedDate'] > $recentbrwdt['ReturnDate']) {
                                        echo "<span class= 'text-danger'>" . $recentbrwdt['ReturnedDate'] . "</span>";
                                    } else {
                                        echo "<span class= 'text-success'>" . $recentbrwdt['ReturnedDate'] . "</span>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-5">
            <div class="card py-1">
                <p>
                    <center>Recent borrow log</center>
                </p>
                <ol class="list-group list-group-numbered">
                    <?php
                    $sqlgetborrow = "SELECT * FROM `borrow` INNER JOIN `User` ON User.UserId = Borrow.UserId  ORDER BY `BorrowingDate` DESC LIMIT 8";
                    $sqlgetborrow1 = mysqli_query($connRun, $sqlgetborrow);
                    while ($sqlgetborrow2 = mysqli_fetch_array($sqlgetborrow1)) {

                        $borrowidpoint = $sqlgetborrow2['BorrowId'];
                        $sqlgetmuch = "SELECT * FROM `BorrowDetail` WHERE BorrowId = '$borrowidpoint'";
                        $outrow = mysqli_num_rows(mysqli_query($connRun, $sqlgetmuch))

                    ?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"><?php echo $sqlgetborrow2['UserFullName'] ?></div>
                                <?php

                                $currentdate = date('Y-m-d');
                                if ($sqlgetborrow2['BorrowingDate'] === $currentdate) {
                                    echo 'Borrowed ' . $outrow . ' Books Today';
                                } else {
                                    echo 'Borrowed ' . $outrow . ' Books on ' . $sqlgetborrow2['BorrowingDate'];
                                }
                                ?>
                            </div>
                            <span class="badge bg-primary rounded-pill">id : <?php echo $borrowidpoint ?></span>
                        </li>
                    <?php
                    }
                    ?>

                </ol>
            </div>
        </div>
    </div>
<?php
}
?>