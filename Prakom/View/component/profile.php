<?php
if ($_SESSION['Level'] == 'ADM') {
    $AccStat = 'Administrator';
} elseif ($_SESSION['Level'] == 'PTG') {
    $AccStat = 'Officer';
} else {
    $AccStat = 'User';
}
?>
<h3>Logged in as <span><?php echo $AccStat ?></span></h3>
<hr>
<?php
if ($_SESSION['Level'] == 'ADM' or 'PTG') {
    $Userlvl = $_SESSION['Level'];
    $Userid = $_SESSION['UserId'];
    $sql = "SELECT * FROM User WHERE Userid = '$Userid' AND UserLevel = '$Userlvl'";
    $sqlrun = mysqli_query($connRun, $sql);

    if (!$sqlrun) {
        die('Query Error: ' . mysqli_error($connRun));
    }

    $run = mysqli_fetch_array($sqlrun);


?>
    <h4>Personal Data</h4>
    <div class="card p-3">
        <form class="row g-3" action="../system/SysAccounts.php?do=updatedata" method="POST">
            <div class="col-md-6">
                <div class=" form-floating">
                    <input type="email" name="email" value="<?php echo $run['UserEmail'] ?>" class="form-control readonly" disabled id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="Password" name="Password" value="<?php echo $run['UserPassword'] ?>" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
            </div>
            <div class="col-2">
                <div class=" form-floating">
                    <input type="text" name="Userid" value="<?php if ($run['UserFullName'] !== NULL) echo $run['Userid'] ?>" disabled class="form-control" id="floatingInput" placeholder="none">
                    <label for="floatingInput">UserId</label>
                </div>
            </div>
            <div class="col-5">
                <div class=" form-floating">
                    <input type="text" name="fullname" value="<?php echo $run['UserFullName'] ?>" class="form-control readonly" disabled id="floatingInput" placeholder="name">
                    <label for="floatingInput">Full Name</label>
                </div>
            </div>
            <div class="col-5">
                <div class=" form-floating">
                    <input type="text" name="Username" value="<?php if ($run['UserFullName'] !== NULL) echo $run['Username'] ?>" class="form-control" id="floatingInput" placeholder="none">
                    <label for="floatingInput">Username (Optional)</label>
                </div>
            </div>
            <div class="col-6">
                <div class=" form-floating">
                    <input type="text" name="Address" value="<?php if ($run['UserAddress'] !== NULL) echo $run['UserAddress'] ?>" class="form-control" id="floatingInput" placeholder="none">
                    <label for="floatingInput">Address (Optional)</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class=" form-floating">
                    <input type="number" name="Contact" value="<?php if ($run['UserContact'] !== NULL) echo $run['UserContact'] ?>" class="form-control" id="floatingInput" placeholder="none">
                    <label for="floatingInput">Phone number (Optional)</label>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save Data</button>
            </div>
        </form>
        <br>
        <hr width="10%">
        <div class="d-flex">
            <button type="button" class="btn btn-danger tooltip-wrapper" data-toggle="tooltip" data-bs-placement="right" title="<a href='../system/SysAccounts.php?do=logout' class=' btn btn-outline-danger'>Confirm</a>">
                Logout
            </button>
        </div>

    </div>

<?php
}
?>