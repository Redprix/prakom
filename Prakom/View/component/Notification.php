<?php

// simple notifications for books
if (isset($_SESSION['NotifB'])) {
    $NotifData = $_SESSION['NotifB'];
?>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="../../../Prakom/images/Public/<?php echo $NotifData['Cover'] ?>" style="aspect-ratio: 3/4;" width="30px" alt="...">
                <strong class="mx-2  me-auto"><?php echo $NotifData['BookName'] ?></strong>
                <small>Published in <?php echo $NotifData['Release'] ?></small>

            </div>
            <div class="toast-body">
                The book has successfully been inserted to the database
            </div>
        </div>
    </div>

<?php
    unset($_SESSION['NotifB']);
}
?>


<?php
// simple notifications for publisher
if (isset($_SESSION['NotifP'])) {
?>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                <?php echo $_SESSION['NotifP'] ?> has successfully been inserted to the database
            </div>
        </div>
    </div>

<?php
    unset($_SESSION['NotifP']);
}
?>


<?php
// simple notifications for Genre
if (isset($_SESSION['NotifG'])) {

?>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                Genre <?php echo $_SESSION['NotifG'] ?> has successfully been inserted to the database
            </div>
        </div>
    </div>

<?php
    unset($_SESSION['NotifG']);
}
?>


<?php
// simple notifications for Author
if (isset($_SESSION['NotifA'])) {

?>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                Author, <?php echo $_SESSION['NotifA'] ?> has successfully been inserted to the database
            </div>
        </div>
    </div>

<?php
    unset($_SESSION['NotifA']);
}
?>


<?php
// simple notifications for Units
if (isset($_SESSION['NotifU'])) {
    $NotifData = $_SESSION['NotifU'];
?>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                successfully Addded <?php echo $_SESSION['NotifU'] ?> Books to the database
            </div>
        </div>
    </div>

<?php
    unset($_SESSION['NotifU']);
}
?>


<?php
// simple notifications for Units
if (isset($_SESSION['NotifR'])) {
    $NotifData = $_SESSION['NotifR'];
?>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                successfully Addded one <?php echo $_SESSION['NotifR'] ?> to the database
            </div>
        </div>
    </div>

<?php
    unset($_SESSION['NotifR']);
}
?>