<!-- Modal add genre -->
<div class="modal fade" id="GenreModal" tabindex="-1" aria-labelledby="GenreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../../../prakom/system/BookManagementSys.php?input=genre" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="GenreModalLabel">Imsert Genre To The Database</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="Genreinput" class="form-label">Name of the genre</label>
                        <input type="text" class="form-control" id="Genreinput" placeholder="novels /comic /action /psychological, etc" required name="genrename">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal add Author -->
<div class="modal fade" id="AuthorModal" tabindex="-1" aria-labelledby="AuthorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../../../prakom/system/BookManagementSys.php?input=author" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="AuthorModalLabel">Insert Author To The Database</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="Authorinput" class="form-label">Name of the Author</label>
                        <input type="text" class="form-control" id="Authorinput" placeholder="The person full name preferably" required name="authorname">
                    </div>
                    <div class="mb-3">
                        <label for="Authorinput2" class="form-label">Email of the Author</label>
                        <input type="Email" class="form-control" id="Authorinput2" placeholder="Thisperson@Gmail.com" required name="authorcontact">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal add publisher -->
<div class="modal fade" id="PublisherModal" tabindex="-1" aria-labelledby="publisherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../../../prakom/system/BookManagementSys.php?input=publisher" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="publisherModalLabel">Insert Publisher To The Database</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-7">
                            <div class="mb-3">
                                <label for="publisherinput" class="form-label">Name of the publisher</label>
                                <input type="text" class="form-control" id="publisherinput" placeholder="The publisher name" required name="publishername">
                            </div>
                            <div class="mb-3">
                                <label for="publisherinput2" class="form-label">Email of the publisher</label>
                                <input type="Email" class="form-control" id="publisherinput2" placeholder="Thiscompany@Gmail.com" required name="publisheremail">
                            </div>
                            <div class="mb-3">
                                <label for="publisherinput3" class="form-label">Contact of the publisher</label>
                                <input type="text" class="form-control" id="publisherinput3" placeholder="+23 123123" required name="publishercontact">
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="example : canada, toronto" id="floatingTextarea" name="publisheraddress" style="height: 243px; max-height:243px;"></textarea>
                                <label for="floatingTextarea">Publisher office addresses</label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- ----------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Modal add Book -->
<div class="modal fade" id="BookModal" tabindex="-1" aria-labelledby="BookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../../../prakom/system/BookManagementSys.php?input=book" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="BookModalLabel">Insert Book To The Database</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Book name</label>
                                        <input type="Text" class="form-control" name="Name" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Author</label>
                                        <select name="Author" id="" class="form-control">
                                            <option selected disabled hidden>Select Author</option>
                                            <?php
                                            $Author = "SELECT * FROM author";
                                            $AuthorRun = mysqli_query($connRun, $Author);
                                            while ($AuthorRun1 = mysqli_fetch_array($AuthorRun)) {
                                            ?>
                                                <option value="<?php echo $AuthorRun1['AuthorId'] ?>">
                                                    <?php echo $AuthorRun1['AuthorName']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Publisher</label>
                                        <select name="Publisher" id="" class="form-control">
                                            <option selected disabled hidden>Select Publisher</option>
                                            <?php
                                            $Publisher = "SELECT * FROM publisher";
                                            $PublisherRun = mysqli_query($connRun, $Publisher);
                                            while ($PublisherRun1 = mysqli_fetch_array($PublisherRun)) {
                                            ?>
                                                <option value="<?php echo $PublisherRun1['PublisherId'] ?>">
                                                    <?php echo $PublisherRun1['PublisherName']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="mb-3">
                                        <label class="form-label">ISBN</label>
                                        <input type="Number" class="form-control" name="ISBN" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="yearDropdown" class="form-label">Year Published</label>
                                        <select id="yearDropdown" name="ReleaseDate" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Pages</label>
                                        <input type="Number" class="form-control" name="Bpages" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="" class="form-label">Sinopsis/ Detail</label>
                                    <textarea name="UnfilteredSynopsis" class="form-control" id="" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Book Cover</label>
                                    <input type="file" name="Cover" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <br>
                            <div class="card">
                                <div class="container my-1">
                                    <label class="form-label">Genre</label>
                                    <div id="dynamicInput" class="container">
                                        <div class="inputField row">
                                            <select name="Genre1" class="form-control my-1 w-100 col">

                                                <?php

                                                include($_SERVER['DOCUMENT_ROOT'] . $baseUrl . '/system/reference/additionalgenre.php');
                                                ?>
                                            </select>
                                            <button type="button" class="col-2 remove btn btn-sm btn-danger my-1">x</button>
                                        </div>
                                    </div>
                                    <button style="border: 0;" type="button" class="w-100 my-1 btn btn-success" id="addInput">Add Categories</button>
                                    <input type="hidden" id="inputCount" name="inputCount" value="1">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal add book units -->
<div class="modal fade" id="UnitsModal" tabindex="-1" aria-labelledby="UnitsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../../../prakom/system/BookManagementSys.php?input=units" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="UnitsModalLabel">Adding Book Units</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col mb-3">
                            <label for="DatalistUnits" class="form-label">Insert the book Id</label>
                            <input class="form-control" list="DatalistsUnitsOption" name="BookId" id="DatalistUnits" placeholder="32 for example">
                            <datalist id="DatalistsUnitsOption">
                                <!-- <option value="San Francisco"> -->
                                <?php
                                $Books = "SELECT * FROM Books";
                                $BooksRun = mysqli_query($connRun, $Books);
                                while ($BooksRun1 = mysqli_fetch_array($BooksRun)) {
                                ?>
                                    <option value="<?php echo $BooksRun1['BookId'] ?>">
                                        <?php echo $BooksRun1['BookName']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="col mb-3">
                            <label for="UnitsInput" class="form-label">How many book units?</label>
                            <input type="number" class="form-control" id="UnitsInput" placeholder="0" required name="NumberAdd">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal for borrowing books -->
<div class="modal fade" id="UnitsModal" tabindex="-1" aria-labelledby="UnitsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../../../prakom/system/BookManagementSys.php?input=units" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="UnitsModalLabel">Adding Book Units</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col mb-3">
                            <label for="DatalistUnits" class="form-label">Insert the book Id</label>
                            <input class="form-control" list="DatalistsUnitsOption" name="BookId" id="DatalistUnits" placeholder="32 for example">
                            <datalist id="DatalistsUnitsOption">
                                <!-- <option value="San Francisco"> -->
                                <?php
                                $Books = "SELECT * FROM Books";
                                $BooksRun = mysqli_query($connRun, $Books);
                                while ($BooksRun1 = mysqli_fetch_array($BooksRun)) {
                                ?>
                                    <option value="<?php echo $BooksRun1['BookId'] ?>">
                                        <?php echo $BooksRun1['BookName']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="col mb-3">
                            <label for="UnitsInput" class="form-label">How many book units?</label>
                            <input type="number" class="form-control" id="UnitsInput" placeholder="0" required name="NumberAdd">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal for returning books -->
<div class="modal fade" id="UnitsModal" tabindex="-1" aria-labelledby="UnitsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../../../prakom/system/BookManagementSys.php?input=units" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="UnitsModalLabel">Adding Book Units</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col mb-3">
                            <label for="DatalistUnits" class="form-label">Insert the book Id</label>
                            <input class="form-control" list="DatalistsUnitsOption" name="BookId" id="DatalistUnits" placeholder="32 for example">
                            <datalist id="DatalistsUnitsOption">
                                <!-- <option value="San Francisco"> -->
                                <?php
                                $Books = "SELECT * FROM Books";
                                $BooksRun = mysqli_query($connRun, $Books);
                                while ($BooksRun1 = mysqli_fetch_array($BooksRun)) {
                                ?>
                                    <option value="<?php echo $BooksRun1['BookId'] ?>">
                                        <?php echo $BooksRun1['BookName']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="col mb-3">
                            <label for="UnitsInput" class="form-label">How many book units?</label>
                            <input type="number" class="form-control" id="UnitsInput" placeholder="0" required name="NumberAdd">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>