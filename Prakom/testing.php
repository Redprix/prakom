<!DOCTYPE html>
<html lang="en">
<!-- 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoverable Images</title>
</head>

<body> -->
<style>
    .image-container {
        position: relative;
        display: inline-block;
        margin: 10px;
    }

    .hoverable-image {
        width: 200px;
        /* Adjust the width as needed */
        height: auto;
        opacity: 1;
        transition: opacity 0.3s ease-in-out;
    }

    .image-container:hover .hoverable-image {
        opacity: 0.4;
        /* Adjust this value based on your preference */
    }

    .image-container:hover .hoverable-image:hover {
        opacity: 1;
    }
</style>
<!-- <div class="image-container">
        <img src="/images/arknights.jpg" alt="Image 1" class="hoverable-image">
    </div>

    <div class="image-container">
        <img src="/images/himi milan.jpg" alt="Image 2" class="hoverable-image">
    </div>

    <form action="test.php" method="post">
        <select name="2" id="">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <br>
        <select name="a" id="">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <button type="submit">done</button>
    </form>

</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Bootstrap Toggle Button</title>
    <style>
        .image-container {

            width: 200px;
            /* Adjust the width as needed */
            height: 200px;
            /* Adjust the height as needed */
        }

        .image-container img {
            position: absolute;
            top: 0;
            left: 0;
            object-fit: cover;
            aspect-ratio: 3/4;
            /* Preserve aspect ratio */
        }

        .second-image {
            position: absolute;
            /* Adjust the width as needed */

        }
    </style>
</head>

<body>
    <table class="table">
        <tbody>
            <tr data-info="Info 1">
                <td>Row 1</td>
            </tr>
            <tr data-info="Info 2">
                <td>Row 2</td>
            </tr>
        </tbody>
    </table>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <!-- Your content goes here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="image-container">
        <img src="images/arknights.jpg" alt="First Image" style="width: 50px;">
        <img class="second-image" src="images/65d6ebbce8255.jpg" alt="Second Image" style="width: 40px;">
    </div>
    <br> -->
    <?php
    // if (isset($_POST['lmao'])) {
    //     echo $_POST['lmao'];
    // }
    ?>
    <!-- <div class="container">
        <form action="test.php" method="post">
            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
            <label for="vehicle1"> I have a bike</label><br>

            <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
            <label for="vehicle2"> I have a car</label><br>

            <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
            <label for="vehicle3"> I have a boat</label><br>
            <input type="submit">
        </form>
    </div> -->
    <!-- <div>
        <button class="btn btncollapse btn-primary" data-toggle="collapse" data-target="#collapseborrow" aria-expanded="false" aria-controls="collapseborrow">
            Toggle Collapse One
        </button>
        <button class="btn btncollapse btn-primary" data-toggle="collapse" data-target="#collapsereturn" aria-expanded="false" aria-controls="collapsereturn">
            Toggle Collapse Two
        </button>
    </div>

    <div class="collapse" id="collapseborrow">
        <div class="card card-body">
            Content for Collapse One
        </div>
    </div>

    <div class="collapse" id="collapsereturn">
        <div class="card card-body">
            Content for Collapse Two
        </div>
    </div> -->
    <!-- <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('table tbody tr').css('cursor', 'pointer');
            $('table tbody tr').on('click', function() {
                var data = $(this).data('info');
                // Update the modal with the data and then show it
                $('.modal-body').text(data);
                $('#myModal').modal('show');
            });
        });
    </script>
    <!-- <script>
        $(document).ready(function() {
            // Handle the toggle button click event
            $('.btncollapse').on('click', function() {
                // Get the target collapse ID from the button's data-target attribute
                var targetCollapse = $(this).data('target');

                // Close all collapses except the one targeted by the clicked button
                $('.collapse').not(targetCollapse).collapse('hide');
            });
        });
    </script> -->

    <!-- </body>

</html> -->


    <!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Borrowing System</title>
</head>

<body>

    <form id="borrowForm">
        <label for="bookName">Book Name:</label>
        <input type="text" id="bookName" name="book_name">

        <label for="bookId">Book ID:</label>
        <select id="bookId" name="book_id">
             Options will be populated dynamically using AJAX -->
    <!-- </select>
</form>

<script>
    $(document).ready(function() {
        $('#bookName').on('input', function() {
            var bookName = $(this).val();

            $.ajax({
                type: 'POST',
                url: 'ajax_handler.php',
                data: {
                    book_name: bookName
                },
                dataType: 'json', // Specify the expected data type
                success: function(data) {
                    // Clear previous options
                    $('#bookId').empty();

                    // Add new options based on the response
                    for (var i = 0; i < data.length; i++) {
                        $('#bookId').append('<option value="' + data[i] + '">' + data[i] + '</option>');
                    }
                }
            });
        });
    });
</script> -->

    <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var bookNameInput = document.getElementById('bookName');
        var bookIdSelect = document.getElementById('bookId');

        bookNameInput.addEventListener('input', function() {
            var bookName = bookNameInput.value;

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure it: POST-request for the ajax_handler.php script
            xhr.open('POST', 'ajax_handler.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Send the request with the book name as data
            xhr.send('book_name=' + encodeURIComponent(bookName));

            // This will be called after the response is received
            xhr.onload = function() {
                if (xhr.status == 200) {
                    // Clear previous options
                    bookIdSelect.innerHTML = '';

                    // Add new options based on the response
                    var options = JSON.parse(xhr.responseText);
                    options.forEach(function(option) {
                        var optionElement = document.createElement('option');
                        optionElement.value = option.book_id;
                        optionElement.textContent = option.book_id;
                        bookIdSelect.appendChild(optionElement);
                    });
                } else {
                    // Handle the error
                    console.error('Request failed. Status: ' + xhr.status);
                }
            };
        });
    });
</script>

</body>

</html> -->
    <!-- <?php
            // if (isset($_POST['lmao'])) {
            //     echo $_POST['lmao'];
            // } -->
            ?>
 <form action="testing.php" method="post">

    <input type="text" name="lmao" id="">
    <input type="submit" id="">
</form> -->