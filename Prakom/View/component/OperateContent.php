<?php
if (!isset($_GET['section'])) {
    header("location:mainpage.php?page=operate&section=book");
}
if (isset($_GET['section']) and $_GET['section'] === 'book') {
    if (!isset($_GET['section'])) {
        header("location:mainpage.php?page=operate&section=book&tables=genre&pages=1");
    } elseif (!isset($_GET['tables'])) {
        header("location:mainpage.php?page=operate&section=book&tables=genre&pages=1");
    } elseif (!isset($_GET['pages'])) {
        header("location:mainpage.php?page=operate&section=book&tables=genre&pages=1");
    }
?>

    <div class="row">
        <div class="col">
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <a href="" type="button" class="btn btn-outline-success active">Book management</a>
                <a href="../view/mainpage.php?page=operate&section=borrow" type="button" class="btn btn-outline-success">Borrow management</a>
                <a href="../view/mainpage.php?page=operate&section=user" type="button" class="btn btn-outline-success">User management</a>

            </div>

            <div class="card text-bg-light mt-3">
                <div class="btn-group px-5 pt-3" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#GenreModal">Add Genre</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#AuthorModal">Add Author</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#PublisherModal">Add Publisher</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#BookModal">Add Book</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#UnitsModal">Add Units</button>
                </div>

                <hr>

                <div class="px-2">
                    <?php
                    include "TabelsNav.php";
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php
} elseif (isset($_GET['section']) and $_GET['section'] === 'borrow') {
?>

    <!-- admin borrow page view -->
    <div class="row">
        <div class="col">
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <a href="../view/mainpage.php?page=operate&section=book" type="button" class="btn btn-outline-success">Book management</a>
                <a href="" type="button" class="btn btn-outline-success active">Borrow management</a>
                <a href="../view/mainpage.php?page=operate&section=user" type="button" class="btn btn-outline-success">User management</a>
            </div>
        </div>
        <div class="card text-bg-light mt-3">
            <div class="px-2 py-2">


                <?php include "borrowFront.php" ?>
            </div>
        </div>
    </div>
<?php
} elseif (isset($_GET['section']) and $_GET['section'] === 'user') {
?>

    <!-- admin user management view -->
    <div class="row">
        <div class="col">
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <a href="../view/mainpage.php?page=operate&section=book" type="button" class="btn btn-outline-success">Book management</a>
                <a href="../view/mainpage.php?page=operate&section=borrow" type="button" class="btn btn-outline-success">Borrow management</a>
                <a href="" type="button" class="btn btn-outline-success active">User management</a>
            </div>
        </div>
        <div class="card text-bg-light mt-3">
            <div class="px-2 py-2">

                <?php include "OperateUser.php" ?>
            </div>
        </div>
    </div>
<?php
}
?>