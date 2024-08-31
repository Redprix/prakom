<?php
session_start();
include "Conn.php";

if (!isset($_POST['do'])) {
    $do = $_GET['do'];
} elseif (isset($_POST['do'])) {
    $do = $_POST['do'];
}

// login
if ($do == "login") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $LoginSql = "SELECT * FROM user WHERE UserEmail = '$email' AND UserPassword ='$password'";
    $RunLoginSql = mysqli_query($connRun, $LoginSql);

    $AccountIsTrue = mysqli_num_rows($RunLoginSql);

    if ($AccountIsTrue > 0) {

        $Data = mysqli_fetch_array($RunLoginSql);
        $Level = $Data['UserLevel'];
        $Email = $Data['UserEmail'];
        $UserId = $Data['Userid'];

        $_SESSION['Email'] = $Email;
        $_SESSION['Level'] = $Level;
        $_SESSION['UserId'] = $UserId;


        header("location:../view/mainpage.php?page=home");
    } else {
        $_SESSION['NotifLoginWrong'] = "Wrong password or email";
        header("location:../view/Accounts.php");
    }
}

// register
elseif ($do == "register") {
    $Email = $_POST['emailregister'];
    $Pass = $_POST['Pass'];
    $Name = $_POST['nameregister'];
    $Level = $_POST['levelregister'];
    $sqlregis = "INSERT INTO `user` (`Userid`, `Username`, `UserPassword`, `UserLevel`, `UserFullName`, `UserContact`, `UserEmail`, `UserAddress`) VALUES (NULL, NULL, '$Pass', '$Level', '$Name', NULL, '$Email', NULL);";
    $sqlregis1 = mysqli_query($connRun, $sqlregis);
    if ($sqlregis1) {
        if ($Level === 'PTG') {
            $notiflevel = "Officer";
        } else {
            $notiflevel = "User";
        }
        $_SESSION['NotifR'] =  $notiflevel;
        header("location:../view/mainpage.php?page=operate&section=user");
    }
}
// updateing user data
elseif ($do == "updatedata") {
    $data1 = $_POST['Password'];
    $data2 = $_POST['Username'];
    $data3 = $_POST['Address'];
    $data4 = $_POST['Contact'];

    $Userid = $_SESSION['UserId'];

    if ($data2 === '') {
        $sqladd2 = ", `Username` = NULL";
    } else {
        $sqladd2 = ", `Username` = '$data2'";
    }
    if ($data3 === '') {
        $sqladd3 = ", `UserAddress` = NULL";
    } else {
        $sqladd3 = ", `UserAddress` = '$data3'";
    }
    if ($data4 === '') {
        $sqladd4 = ", `UserContact` = NULL";
    } else {
        $sqladd4 = ", `UserContact` = '$data4'";
    }

    echo $sqlupdating = "UPDATE `user` SET `UserPassword` = '$data1'$sqladd2$sqladd3$sqladd4 WHERE `user`.`Userid` = $Userid;";
    $runupdating = mysqli_query($connRun, $sqlupdating);
    if ($runupdating) {
        header("location:../View/mainpage.php?page=profile");
    }
}

// logout
elseif ($do == "logout") {
    session_destroy();
    header("location:../view/mainpage.php");
}
