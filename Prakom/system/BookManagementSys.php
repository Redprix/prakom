<?php
include "Conn.php";
if ($_SESSION['Level'] === 'ADM' or $_SESSION['Level'] === 'PTG')

    // if (!isset($_GET['input'])) {
    //     header("location:../../prakom/view/mainpage.php");
    // }
    if (isset($_GET['input'])) {

        $input = $_GET['input'];



        // insert genre to the database  VV
        if ($input === 'genre') {

            $Genre  = $_POST['genrename'];

            $sql    = "INSERT INTO `genre` (`GenreId`, `GenreName`) VALUES (NULL, '$Genre');";
            $Run    = mysqli_query($connRun, $sql);
            if ($Run) {
                $_SESSION['NotifG'] = $Genre;
                header("location:../view/mainpage.php?page=operate&section=book&tables=genre&pages=1");
            }
        }

        // insert author to the database VV
        elseif ($input === 'author') {

            $Author     = $_POST['authorname'];
            $Contact    = $_POST['authorcontact'];

            $sql        = "INSERT INTO `author` (`AuthorId`, `AuthorName`, `AuthorContact`) VALUES (NULL, '$Author', '$Contact');";
            $Run        = mysqli_query($connRun, $sql);
            if ($Run) {
                $_SESSION['NotifA'] =  $Author;
                header("location:../view/mainpage.php?page=operate&section=book&tables=author&pages=1");
            }
        }
        // insert publisher to the database
        elseif ($input === 'publisher') {

            $Publisher  = $_POST['publishername'];
            $Email      = $_POST['publisheremail'];
            $Contact    = $_POST['publishercontact'];
            $Address    = $_POST['publisheraddress'];

            $sql        = "INSERT INTO `publisher` (`PublisherId`, `PublisherName`, `PublisherAddress`, `PublisherEmail`, `PublsiherContact`) VALUES (NULL, '$Publisher', '$Address', '$Email', '$Contact');";
            $Run        = mysqli_query($connRun, $sql);
            if ($Run) {
                $_SESSION['NotifP'] =  $Publisher;
                header("location:../view/mainpage.php?page=operate&section=book&tables=publisher&pages=1");
            }
        }
        // insert book to the database
        elseif ($input === 'book') {
            $DateAdded  = date('Y-m-d');
            $inputCount = $_POST['inputCount'];
            $Name       = $_POST['Name'];
            $Author     = $_POST['Author'];
            $Publisher  = $_POST['Publisher'];
            $ISBN       = $_POST['ISBN'];
            $Release    = $_POST['ReleaseDate'];
            $Pages      = $_POST['Bpages'];

            // filtering synopsis 
            $UnfilteredSynopsis = $_POST['UnfilteredSynopsis'];
            $FilteredSynopsis = str_replace("'", "", $UnfilteredSynopsis);


            // getting the genres into an array
            for ($i = 1; $i <= $inputCount; $i++) {
                // Check if the current input has been submitted
                if (isset($_POST['Genre' . $i])) {
                    // Get the value of the current input
                    $value = $_POST['Genre' . $i];
                    // Add the value to the data array
                    $data[]  = $value;
                }
            }
            // var_dump($data);
            // Implode the data array into a single string using a delimiter
            $ImplodedKategori = implode(',', $data);

            // inserting images for book cover
            $baseUrl = '/prakom';
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . $baseUrl . '/images/Public/';
            $uploadOk = 1;

            // Check if directory exists
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            // $target_dir = "Image/";
            $target_file = $target_dir . basename($_FILES["Cover"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                $new_name = uniqid() . '.' . $imageFileType;
                $new_target_file    = $target_dir . $new_name;


                // inserting multiple genre====================================================================================


                // Insert into 'books' table
                $insertBookSql = "INSERT INTO books (BookName, BookSynopsis, BookPages, BookCover, BookAdded, ReleasedOn, IsbnCode, AuthorId, PublisherId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($connRun, $insertBookSql);
                mysqli_stmt_bind_param($stmt, "sssssssss", $Name, $FilteredSynopsis, $Pages, $new_name, $DateAdded, $Release, $ISBN, $Author, $Publisher);

                // Getting Genres ready and uploading
                if (mysqli_stmt_execute($stmt)) {
                    // Get the auto-incremented book ID
                    $BookId = mysqli_insert_id($connRun);

                    // Get genre IDs from the form
                    $data = array();

                    for ($i = 1; $i <= $inputCount; $i++) {
                        // Check if the current input has been submitted
                        if (isset($_POST['Genre' . $i])) {
                            // Get the value of the current input
                            $value = $_POST['Genre' . $i];
                            // Add the value to the data array
                            $data[] = $value;
                        }
                    }

                    // Insert into 'bookgenre' table for each genre
                    $insertGenreSql = "INSERT INTO bookgenre (BookId, GenreId) VALUES (?, ?)";
                    $stmt = mysqli_prepare($connRun, $insertGenreSql);

                    foreach ($data as $GenreId) {
                        mysqli_stmt_bind_param($stmt, "ii", $BookId, $GenreId);

                        if (mysqli_stmt_execute($stmt)) {
                            echo "Book and genres inserted successfully!";
                        } else {
                            echo "Error inserting genres: " . mysqli_stmt_error($stmt);
                        }

                        // Reset parameters for the next iteration
                        mysqli_stmt_reset($stmt);
                    }
                } else {
                    echo "Error inserting book: " . mysqli_error($connRun);
                }

                // Close statement
                mysqli_stmt_close($stmt);



                // lastly insert the images
                $imagemove = move_uploaded_file($_FILES["Cover"]["tmp_name"], $new_target_file);

                if ($imagemove) {
                    // simple notifications ux
                    $_SESSION['NotifB'] = array(
                        'BookName' => $Name,
                        'Release' => $Release,
                        'Cover' => $new_name,
                    );
                    header("location:../../Prakom/view/mainpage.php?page=operate&section=book&tables=books&pages=1");
                }
            }
        }
        // insert Units to the database
        elseif ($input === 'units') {

            $BookId    = $_POST['BookId'];
            $NumberAdd  = $_POST['NumberAdd'];
            // fixed value between B (Default), CB, R 
            $Condition  = 'B';

            $sql        = "INSERT INTO `bookunit` (`BookUnitId`, `Condition`,`BookStatus` ,`BookId`) VALUES (NULL, '$Condition', 'A' ,'$BookId');";

            $i = 1;
            while ($i <= $NumberAdd) {

                $Run = mysqli_query($connRun, $sql);
                $i++;
            }
            if ($Run) {
                $_SESSION['NotifU'] = $NumberAdd;
            }
            header("location:../view/mainpage.php?page=operate&section=book&tables=units&pages=1");
        }
    }












    // ===========================================================================================================
    // ===========================================================================================================
    // UPDATE
    // ===========================================================================================================
    // ===========================================================================================================
    elseif (isset($_GET['update'])) {
        $update = $_GET['update'];
    }





    // ===========================================================================================================
    // ===========================================================================================================
    // DELETE
    // ===========================================================================================================
    // ===========================================================================================================
    elseif (isset($_GET['delete'])) {
        $delete = $_GET['delete'];
        if ($delete === 'genre') {

            $Genre  = $_GET['genreid'];

            $sql    = "DELETE FROM `genre` WHERE `genre`.`GenreId` = $Genre";
            $Run    = mysqli_query($connRun, $sql);

            header("location:../view/mainpage.php?page=operate&section=book&tables=genre&pages=1");
        } elseif ($delete === 'author') {

            $author  = $_GET['authorid'];

            $sql    = "DELETE FROM `author` WHERE `author`.`authorId` = $author";
            $Run    = mysqli_query($connRun, $sql);

            header("location:../view/mainpage.php?page=operate&section=book&tables=author&pages=1");
        } elseif ($delete === 'publisher') {

            $publisher  = $_GET['publisherid'];

            $sql    = "DELETE FROM `publisher` WHERE `publisher`.`publisherId` = $publisher";
            $Run    = mysqli_query($connRun, $sql);

            header("location:../view/mainpage.php?page=operate&section=book&tables=publisher&pages=1");
        } elseif ($delete === 'book') {

            $book  = $_GET['bookid'];
            $imageremove = "select * from books where BookId = $book";
            $imageremove2 = mysqli_query($connRun, $imageremove);
            $imageremove3 = mysqli_fetch_array($imageremove2);

            $sql    = "DELETE FROM `bookgenre` WHERE `bookgenre`.`bookId` = $book";
            $Run    = mysqli_query($connRun, $sql);
            if ($Run) {
                $bookCoverPath = "../images/public/" . $imageremove3['BookCover'];
                if (file_exists($bookCoverPath)) {
                    if (unlink($bookCoverPath)) {
                        $sql    = "DELETE FROM `books` WHERE `books`.`bookId` = $book";
                        $Run    = mysqli_query($connRun, $sql);
                        header("location:../view/mainpage.php?page=operate&section=book&tables=books&pages=1");
                    } else {
                        echo "Failed to delete file";
                    }
                } else {
                    echo "File does not exist";
                }
            }
        } elseif ($delete === 'unit') {

            $unit  = $_GET['unitid'];

            $sql    = "DELETE FROM `bookunit` WHERE `bookunit`.`bookunitId` = $unit";
            $Run    = mysqli_query($connRun, $sql);

            header("location:../view/mainpage.php?page=operate&section=book&tables=units&pages=1");
        }
    }
