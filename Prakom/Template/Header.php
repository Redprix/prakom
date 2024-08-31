<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prototype library</title>
    <link href="../Packages/Bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../css/Styles.css" rel="stylesheet">
    <link href="../css/mcstyle.css" rel="stylesheet">
    <link href="../packages/Googleapis/W300;G200;O40px/googleapis.css" rel="stylesheet">
    <link rel="stylesheet" href="../Packages/DataTables/jquery.dataTables.min.css">
    <!-- jQuery library -->

    <style>
        /* Add the CSS here */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .tooltipimg {
            aspect-ratio: 3/4;
            width: 90px;
        }
    </style>
</head>

<body>
    <?php
    $baseUrl = '/prakom';
    include "../system/Conn.php";
    ?>