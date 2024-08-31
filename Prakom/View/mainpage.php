<?php
include "../Template/Header.php";

if (!isset($_SESSION['Level'])) {
    // echo $_SESSION['Level'];
    header("location:Accounts.php");
}

$pages = $_GET['page'];

if (!isset($pages)) {
    header("location:mainpage.php?page=home");
}
?>

<?php
// $links1 = $_SERVER['DOCUMENT_ROOT'] . $baseUrl . '/View/component/Notification.php';
include "component/Notification.php";
?>

<div class="screen">
    <?php
    include "component/sidebar.php";
    ?>
    <div class="content" style="background-color: #efefef;">
        <!-- <h4>hello there</h4> -->
        <?php
        if ($_SESSION['Level'] === 'PMJ' and $pages === 'home') {
            include "component/PublicFront.php";
        } elseif ($pages === 'home' and ($_SESSION['Level'] === 'ADM' or $_SESSION['Level'] === 'PTG')) {
            include "component/AdmContent.php";
        } elseif ($pages === 'operate' and ($_SESSION['Level'] === 'ADM' or $_SESSION['Level'] === 'PTG')) {
            include "component/OperateContent.php";
        } elseif ($pages === 'profile') {
            include "component/profile.php";
        }
        ?>

    </div>



</div>






<?php

include "../View/component/Modals.php";
include "../Template/footer.php";
?>