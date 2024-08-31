<?php

include "../Template/Header.php";

?>
<link rel="stylesheet" href="../css/loginstyle.css">


<?php
if (isset($_SESSION['Level'])) {
    // echo $_SESSION['Level'];
    header("location:mainpage.php");
}
$do = "login";
?>

<div class="container py-5">
    <!-- <a href="" class="goback"><span class="material-symbols-outlined iconshie">chevron_left</span>Go Back</a> -->
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-5 d-none d-md-block">
                <img src="../images/library.jpg" style="height: 100%; object-fit: cover" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>
                    <form action="../system/SysAccounts.php" method="Post">
                        <div class=" form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>

                        <input type="hidden" name="do" value="<?php echo $do; ?>">
                        <!-- Change from <a> to <button> -->
                        <button type="submit" class="btn btn-success w-100">confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// simple notifications for Units
if (isset($_SESSION['NotifLoginWrong'])) {
    $NotifData = $_SESSION['NotifLoginWrong'];
?>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                <?php echo $_SESSION['NotifLoginWrong'] ?>
            </div>
        </div>
    </div>

<?php
    unset($_SESSION['NotifLoginWrong']);
}
?>


<?php
include "../Template/footer.php";
?>