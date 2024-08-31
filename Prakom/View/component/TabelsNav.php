<?php

if (isset($_GET['tables']) and $_GET['tables'] === 'genre') {

    // Pagination settings
    $itemsPerPage = 10;

    // Get the current page from the query string
    $current_page = isset($_GET['pages']) ? $_GET['pages'] : 1;
    $current_page = max(1, intval($current_page));

    // Calculate the offset for the SQL query
    $offset = ($current_page - 1) * $itemsPerPage;

    // Fetch total count of items
    $countQuery = "SELECT COUNT(*) AS total FROM genre";
    $countResult = mysqli_query($connRun, $countQuery);
    $rowCount = mysqli_fetch_assoc($countResult)['total'];

    // Total items and pages
    $totalItems = $rowCount;
    $totalPages = ceil($totalItems / $itemsPerPage);

    // SQL query to fetch the subset of rows
    $sql = "SELECT * FROM genre LIMIT $offset, $itemsPerPage";
    $sqlrun = mysqli_query($connRun, $sql);

    // Fetch all rows into an array
    $data = mysqli_fetch_all($sqlrun, MYSQLI_ASSOC);
    // Initialize $dataSubset to an empty array
    $dataSubset = [];

    // Check if there is data fetched
    if ($data) {
        $dataSubset = $data;
    }

?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class=" nav-link active" aria-current="page" href="#">genre</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=author&pages=1">Author</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=publisher&pages=1">Publisher</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=books&pages=1">Books</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=units&pages=1">Units</a>
        </li>

    </ul>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Genre Name</th>
                <th class="text-center" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $rowNumber = ($current_page - 1) * $itemsPerPage + 1;
            if ($dataSubset) {
                foreach ($dataSubset as $item) {
            ?>
                    <tr>
                        <td><?= $rowNumber++; ?></td>
                        <td>
                            <?= $item['GenreName']; ?>
                        </td>
                        <td class="text-center">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-warning" href="../system/BookManagementSys.php?update=genre&genreid=<?php echo $item['GenreId']; ?>" type="button">Update</a>
                                </div>
                                <div class="col">
                                    <a class="btn btn-danger" href="../system/BookManagementSys.php?delete=genre&genreid=<?php echo $item['GenreId']; ?>" type="button">delete</a>
                                </div>
                            </div>
                        </td>

                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination links -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            // Define the number of page links to show on either side of the current page
            $count = 2; // Adjust this value to show more or fewer page links

            // Calculate the start and end page numbers
            $startPage = max(1, $current_page - $count);
            $endPage = min($totalPages, $current_page + $count);

            if ($startPage > 1) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=genre&pages=1'>First</a> ";
                echo "... ";
            }
            if ($current_page > 1) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=genre&pages=" . ($current_page - 1) . "'>Previous</a> ";
            }
            // Generate the page links
            for ($i = $startPage; $i <= $endPage; $i++) {
                if ($i == $current_page) {
                    echo " <a type='button' class='btn'><strong>$i</strong></a> "; // The current page number is not a link
                } else {
                    echo "<a type='button' class='btn' href='?page=operate&section=book&tables=genre&pages=$i'>$i</a> ";
                }
            }
            // Optionally, you can add "First", "Last", "Previous", and "Next" links
            if ($current_page < $totalPages) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=genre&pages=" . ($current_page + 1) . "'>Next</a> ";
            }
            if ($endPage < $totalPages) {
                echo "... ";
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=genre&pages=$totalPages'>Last</a>";
            }
            ?>
        </ul>
    </nav>
<?php

}
// ===========================================================================================================
// ===========================================================================================================
// ===========================================================================================================

elseif (isset($_GET['tables']) and $_GET['tables'] === 'author') {
    // Pagination settings
    $itemsPerPage = 10;

    // Get the current page from the query string
    $current_page = isset($_GET['pages']) ? $_GET['pages'] : 1;
    $current_page = max(1, intval($current_page));

    // Calculate the offset for the SQL query
    $offset = ($current_page - 1) * $itemsPerPage;

    // Fetch total count of items
    $countQuery = "SELECT COUNT(*) AS total FROM author";
    $countResult = mysqli_query($connRun, $countQuery);
    $rowCount = mysqli_fetch_assoc($countResult)['total'];

    // Total items and pages
    $totalItems = $rowCount;
    $totalPages = ceil($totalItems / $itemsPerPage);

    // SQL query to fetch the subset of rows
    $sql = "SELECT * FROM author LIMIT $offset, $itemsPerPage";
    $sqlrun = mysqli_query($connRun, $sql);

    // Fetch all rows into an array
    $data = mysqli_fetch_all($sqlrun, MYSQLI_ASSOC);
    // Initialize $dataSubset to an empty array
    $dataSubset = [];

    // Check if there is data fetched
    if ($data) {
        $dataSubset = $data;
    }

?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class=" nav-link" aria-current="page" href="../view/mainpage.php?page=operate&section=book&tables=genre&pages=1">genre</a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="#">Author</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=publisher&pages=1">Publisher</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=books&pages=1">Books</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=units&pages=1">Units</a>
        </li>


    </ul>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Author Name</th>
                <th scope="col">Author Email</th>
                <th class="text-center" scope="col" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $rowNumber = ($current_page - 1) * $itemsPerPage + 1;
            if ($dataSubset) {
                foreach ($dataSubset as $item) {
            ?>
                    <tr>
                        <td><?= $rowNumber++; ?></td>
                        <td>
                            <?= $item['AuthorName']; ?>
                        </td>
                        <td>
                            <?= $item['AuthorContact']; ?>
                        </td>
                        <td class="text-center">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-warning" href="../system/BookManagementSys.php?update=author&authorid=<?php echo $item['AuthorId']; ?>" type="button">Update</a>
                                </div>
                                <div class="col">
                                    <a class="btn btn-danger" href="../system/BookManagementSys.php?delete=author&authorid=<?php echo $item['AuthorId']; ?>" type="button">delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>

    </table>

    <!-- Pagination links -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            // Define the number of page links to show on either side of the current page
            $count = 2; // Adjust this value to show more or fewer page links

            // Calculate the start and end page numbers
            $startPage = max(1, $current_page - $count);
            $endPage = min($totalPages, $current_page + $count);

            if ($startPage > 1) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=author&pages=1'>First</a> ";
                echo "... ";
            }
            if ($current_page > 1) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=author&pages=" . ($current_page - 1) . "'>Previous</a> ";
            }
            // Generate the page links
            for ($i = $startPage; $i <= $endPage; $i++) {
                if ($i == $current_page) {
                    echo " <a type='button' class='btn'><strong>$i</strong></a> "; // The current page number is not a link
                } else {
                    echo "<a type='button' class='btn' href='?page=operate&section=book&tables=author&pages=$i'>$i</a> ";
                }
            }
            // Optionally, you can add "First", "Last", "Previous", and "Next" links
            if ($current_page < $totalPages) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=author&pages=" . ($current_page + 1) . "'>Next</a> ";
            }
            if ($endPage < $totalPages) {
                echo "... ";
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=author&pages=$totalPages'>Last</a>";
            }
            ?>
        </ul>
    </nav>
<?php
}
// ===========================================================================================================
// ===========================================================================================================
// ===========================================================================================================

elseif (isset($_GET['tables']) and $_GET['tables'] === 'publisher') {
    // Pagination settings
    $itemsPerPage = 10;

    // Get the current page from the query string
    $current_page = isset($_GET['pages']) ? $_GET['pages'] : 1;
    $current_page = max(1, intval($current_page));

    // Calculate the offset for the SQL query
    $offset = ($current_page - 1) * $itemsPerPage;

    // Fetch total count of items
    $countQuery = "SELECT COUNT(*) AS total FROM Publisher";
    $countResult = mysqli_query($connRun, $countQuery);
    $rowCount = mysqli_fetch_assoc($countResult)['total'];

    // Total items and pages
    $totalItems = $rowCount;
    $totalPages = ceil($totalItems / $itemsPerPage);

    // SQL query to fetch the subset of rows
    $sql = "SELECT * FROM Publisher LIMIT $offset, $itemsPerPage";
    $sqlrun = mysqli_query($connRun, $sql);

    // Fetch all rows into an array
    $data = mysqli_fetch_all($sqlrun, MYSQLI_ASSOC);
    // Initialize $dataSubset to an empty array
    $dataSubset = [];

    // Check if there is data fetched
    if ($data) {
        $dataSubset = $data;
    }

?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class=" nav-link" aria-current="page" href="../view/mainpage.php?page=operate&section=book&tables=genre&pages=1">genre</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=author&pages=1">Author</a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="#">Publisher</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=books&pages=1">Books</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=units&pages=1">Units</a>
        </li>


    </ul>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Publisher Name</th>
                <th scope="col">Publisher Email</th>
                <th class="text-center" scope="col" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $rowNumber = ($current_page - 1) * $itemsPerPage + 1;
            if ($dataSubset) {
                foreach ($dataSubset as $item) {
            ?>
                    <tr>
                        <td><?= $rowNumber++; ?></td>
                        <td>
                            <?= $item['PublisherName']; ?>
                        </td>
                        <td>

                            <?= $item['PublisherEmail']; ?>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-warning" href="../system/BookManagementSys.php?update=publisher&publisherid=<?php echo $item['PublisherId']; ?>" type="button">update</a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-danger" href="../system/BookManagementSys.php?delete=publisher&publisherid=<?php echo $item['PublisherId']; ?>" type="button">delete</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination links -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            // Define the number of page links to show on either side of the current page
            $count = 2; // Adjust this value to show more or fewer page links

            // Calculate the start and end page numbers
            $startPage = max(1, $current_page - $count);
            $endPage = min($totalPages, $current_page + $count);

            if ($startPage > 1) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=publisher&pages=1'>First</a> ";
                echo "... ";
            }
            if ($current_page > 1) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=publisher&pages=" . ($current_page - 1) . "'>Previous</a> ";
            }
            // Generate the page links
            for ($i = $startPage; $i <= $endPage; $i++) {
                if ($i == $current_page) {
                    echo " <a type='button' class='btn'><strong>$i</strong></a> "; // The current page number is not a link
                } else {
                    echo "<a type='button' class='btn' href='?page=operate&section=book&tables=publisher&pages=$i'>$i</a> ";
                }
            }
            // Optionally, you can add "First", "Last", "Previous", and "Next" links
            if ($current_page < $totalPages) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=publisher&pages=" . ($current_page + 1) . "'>Next</a> ";
            }
            if ($endPage < $totalPages) {
                echo "... ";
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=publisher&pages=$totalPages'>Last</a>";
            }
            ?>
        </ul>
    </nav>
<?php
}
// ===========================================================================================================
// ===========================================================================================================
// ===========================================================================================================
elseif (isset($_GET['tables']) and $_GET['tables'] === 'books') {
    // Pagination settings
    $itemsPerPage = 10;

    // Get the current page from the query string
    $current_page = isset($_GET['pages']) ? $_GET['pages'] : 1;
    $current_page = max(1, intval($current_page));

    // Calculate the offset for the SQL query
    $offset = ($current_page - 1) * $itemsPerPage;

    // Fetch total count of items
    $countQuery = "SELECT COUNT(*) AS total FROM Books";
    $countResult = mysqli_query($connRun, $countQuery);
    $rowCount = mysqli_fetch_assoc($countResult)['total'];

    // Total items and pages
    $totalItems = $rowCount;
    $totalPages = ceil($totalItems / $itemsPerPage);

    // SQL query to fetch the subset of rows
    $sql = "SELECT Books.*, GROUP_CONCAT(genre.GenreName SEPARATOR ', ') AS Genres, author.AuthorName, publisher.PublisherName FROM Books LEFT JOIN bookgenre ON Books.BookId = bookgenre.BookId LEFT JOIN genre ON bookgenre.GenreId = genre.GenreId INNER JOIN author ON Books.AuthorId = author.AuthorId INNER JOIN publisher ON Books.PublisherId = publisher.PublisherId GROUP BY Books.BookId LIMIT $offset, $itemsPerPage";
    $sqlrun = mysqli_query($connRun, $sql);

    // Fetch all rows into an array
    $data = mysqli_fetch_all($sqlrun, MYSQLI_ASSOC);
    // Initialize $dataSubset to an empty array
    $dataSubset = [];

    // Check if there is data fetched
    if ($data) {
        $dataSubset = $data;
    }

?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class=" nav-link" aria-current="page" href="../view/mainpage.php?page=operate&section=book&tables=genre&pages=1">genre</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=author&pages=1">Author</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=publisher&pages=1">Publisher</a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="#">Books</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=units&pages=1">Units</a>
        </li>


    </ul>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Cover Image</th>
                <th scope="col">Book Details</th>
                <th scope="col">ISBN</th>
                <th class="text-center" scope="col" colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $rowNumber = ($current_page - 1) * $itemsPerPage + 1;
            if ($dataSubset) {
                foreach ($dataSubset as $item) {
            ?>

                    <div class="modal fade" id="ModalHomePage<?= $item['BookId']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php echo $item['BookName'] ?>
                                </div>

                            </div>
                        </div>
                    </div>


                    <tr>
                        <td><?= $rowNumber++; ?></td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalHomePage<?= $item['BookId']; ?>"><img src="../images/Public/<?php echo $item['BookCover'] ?>" style="aspect-ratio: 3/4; width: 80px;"></a>
                        </td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalHomePage<?= $item['BookId']; ?>"><?php echo $item['BookName']; ?></a>
                            <p class="text-muted">Made by <?php echo $item['AuthorName']; ?><br>Published by <?php echo $item['PublisherName']; ?></p>

                        </td>
                        <td>
                            <?= $item['IsbnCode']; ?>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-success" href="" type="button">Details</a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-warning" href="../system/BookManagementSys.php?update=book&bookid=<?php echo $item['BookId']; ?>" type="button">update</a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-danger" href="../system/BookManagementSys.php?delete=book&bookid=<?php echo $item['BookId']; ?>" type="button">delete</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination links -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            // Define the number of page links to show on either side of the current page
            $count = 2; // Adjust this value to show more or fewer page links

            // Calculate the start and end page numbers
            $startPage = max(1, $current_page - $count);
            $endPage = min($totalPages, $current_page + $count);

            if ($startPage > 1) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=books&pages=1'>First</a> ";
                echo "... ";
            }
            if ($current_page > 1) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=books&pages=" . ($current_page - 1) . "'>Previous</a> ";
            }
            // Generate the page links
            for ($i = $startPage; $i <= $endPage; $i++) {
                if ($i == $current_page) {
                    echo " <a type='button' class='btn'><strong>$i</strong></a> "; // The current page number is not a link
                } else {
                    echo "<a type='button' class='btn' href='?page=operate&section=book&tables=books&pages=$i'>$i</a> ";
                }
            }
            // Optionally, you can add "First", "Last", "Previous", and "Next" links
            if ($current_page < $totalPages) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=books&pages=" . ($current_page + 1) . "'>Next</a> ";
            }
            if ($endPage < $totalPages) {
                echo "... ";
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=books&pages=$totalPages'>Last</a>";
            }
            ?>
        </ul>
    </nav>
<?php
}

// ===========================================================================================================
// ===========================================================================================================
// ===========================================================================================================

elseif (isset($_GET['tables']) and $_GET['tables'] === 'units') {
    // Pagination settings
    $itemsPerPage = 10;

    // Get the current page from the query string
    $current_page = isset($_GET['pages']) ? $_GET['pages'] : 1;
    $current_page = max(1, intval($current_page));

    // Calculate the offset for the SQL query
    $offset = ($current_page - 1) * $itemsPerPage;

    // Fetch total count of items
    $countQuery = "SELECT COUNT(*) AS total FROM bookunit";
    $countResult = mysqli_query($connRun, $countQuery);
    $rowCount = mysqli_fetch_assoc($countResult)['total'];

    // Total items and pages
    $totalItems = $rowCount;
    $totalPages = ceil($totalItems / $itemsPerPage);

    // SQL query to fetch the subset of rows
    $sql = "SELECT bookunit.BookUnitId, bookunit.Condition, books.BookName FROM books INNER JOIN bookunit ON bookunit.BookId = books.BookId LIMIT $offset, $itemsPerPage";
    $sqlrun = mysqli_query($connRun, $sql);

    // Fetch all rows into an array
    $data = mysqli_fetch_all($sqlrun, MYSQLI_ASSOC);
    // Initialize $dataSubset to an empty array
    $dataSubset = [];

    // Check if there is data fetched
    if ($data) {
        $dataSubset = $data;
    }


?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class=" nav-link" aria-current="page" href="../view/mainpage.php?page=operate&section=book&tables=genre&pages=1">genre</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=author&pages=1">Author</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=publisher&pages=1">Publisher</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="../view/mainpage.php?page=operate&section=book&tables=books&pages=1">Books</a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="#">Units</a>
        </li>


    </ul>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Units Id</th>
                <th scope="col">Condition</th>
                <th class="text-center" scope="col" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $rowNumber = ($current_page - 1) * $itemsPerPage + 1;
            if ($dataSubset) {
                foreach ($dataSubset as $item) {
                    if ($item['Condition'] === 'B') {
                        $Condition = "Perfect";
                    } elseif ($item['Condition'] === 'CB') {
                        $Condition = "Acceptable";
                    } elseif ($item['Condition'] === 'R') {
                        $Condition = "Need Replacement";
                    }
            ?>

                    <tr>
                        <td><?= $rowNumber++; ?></td>
                        <td>
                            <?php echo $item['BookUnitId']; ?>
                        </td>
                        <td>

                            <?php echo $Condition ?>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-warning" href="../system/BookManagementSys.php?update=unit&unitid=<?php echo $item['BookUnitId']; ?>" type="button">update</a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-danger" href="../system/BookManagementSys.php?delete=unit&unitid=<?php echo $item['BookUnitId']; ?>" type="button">delete</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination links -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            // Define the number of page links to show on either side of the current page
            $count = 2; // Adjust this value to show more or fewer page links

            // Calculate the start and end page numbers
            $startPage = max(1, $current_page - $count);
            $endPage = min($totalPages, $current_page + $count);

            if ($startPage > 1) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=units&pages=1'>First</a> ";
                echo "... ";
            }
            if ($current_page > 1) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=units&pages=" . ($current_page - 1) . "'>Previous</a> ";
            }
            // Generate the page links
            for ($i = $startPage; $i <= $endPage; $i++) {
                if ($i == $current_page) {
                    echo " <a type='button' class='btn'><strong>$i</strong></a> "; // The current page number is not a link
                } else {
                    echo "<a type='button' class='btn' href='?page=operate&section=book&tables=units&pages=$i'>$i</a> ";
                }
            }
            // Optionally, you can add "First", "Last", "Previous", and "Next" links
            if ($current_page < $totalPages) {
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=units&pages=" . ($current_page + 1) . "'>Next</a> ";
            }
            if ($endPage < $totalPages) {
                echo "... ";
                echo "<a type='button' class='btn' href='?page=operate&section=book&tables=units&pages=$totalPages'>Last</a>";
            }
            ?>
        </ul>
    </nav>
<?php
}
?>