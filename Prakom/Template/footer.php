<script src="../js/jquery.min.js"></script>

<script src="../Packages/Bootstrap/bootstrap.bundle.min.js"></script>
<script src="../Packages/SweetAlert/sweetalert.min.js"></script>
<script src="../Packages/DataTables/jquery.dataTables.min.js"></script>
<script src="../Packages/chart.js/chart.js"></script>

<!-- <script type="module" src="../Packages/ionic_icons/ionicons.esm.js"></script>
<script nomodule src="../Packages/ionic_icons/ionicons.js"></script> -->


<!-- year form scripts -->
<script>
    // Get the current year
    var currentYear = new Date().getFullYear();

    // Set the range of years (adjust as needed)
    var startYear = 1900;
    var endYear = 2100;

    // Create options for the dropdown
    var dropdown = document.getElementById("yearDropdown");

    for (var year = startYear; year <= endYear; year++) {
        var option = document.createElement("option");
        option.text = year;
        option.value = year;
        dropdown.add(option);
    }

    // Set the default value to the current year
    dropdown.value = currentYear.toString();
</script>


<!-- dynamic input for genre -->
<script>
    $(document).ready(function() {
        var maxFields = 6;
        var addButton = $('#addInput');
        var wrapper = $('#dynamicInput');
        var x = 1;
        $('#inputCount').val(x);

        $(addButton).click(function() {
            if (x < maxFields) {
                x++;

                $.get("../system/reference/AdditionalGenre.php", function(data) {
                    var fieldHTML = '<div class="inputField row"><select class="form-control my-1 w-100 col" name="Genre' + x + '">' + data + '</select><button type="button" class="col-2 remove btn btn-sm my-1 btn-danger">x</button></div>';
                    $(wrapper).append(fieldHTML);
                });
                $('#inputCount').val(x);
            }
        });

        $(wrapper).on('click', '.remove', function(e) {
            e.preventDefault();
            if ($(wrapper).children('div').length > 1) {
                $(this).parent('div').remove();
                x--;

                // Re-index the remaining input fields
                $(wrapper).children('div').each(function(index) {
                    $(this).find('select').attr('name', 'Genre1' + (index + 1));
                });

                $('#inputCount').val(x);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'One genre must be present!',
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 1500

                })
            }
        });
    });
</script>



<!-- notification for input -->
<script>
    // Wait for the DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Find the toast element by class
        var toastElement = document.querySelector('.toast');

        // Create a Bootstrap Toast instance
        var toast = new bootstrap.Toast(toastElement);

        // Show the toast
        toast.show();
    });
</script>



<script>
    $(document).ready(function() {
        var maxFields = 4;
        var addButton = $('#addInput2');
        var wrapper = $('#dynamicInput2');
        var x = 1;
        $('#inputCount2').val(x);

        $(addButton).click(function() {
            if (x < maxFields) {
                x++;

                $.get("../system/reference/AdditionalBorrow.php", function(data) {
                    var fieldHTML = '<div class="inputField row"><input list="DatalistsBorrow" class="form-control my-1 w-100 col" name="BookUnitId' + x + '" placeholder="insert the book ids"><datalist id="DatalistsBorrow">' + data + '</datalist><button type="button" class="col-2 remove btn btn-sm my-1 btn-danger">x</button></div>';
                    $(wrapper).append(fieldHTML);
                });
                $('#inputCount2').val(x);
            }
        });

        $(wrapper).on('click', '.remove', function(e) {
            e.preventDefault();
            if ($(wrapper).children('div').length > 1) {
                $(this).parent('div').remove();
                x--;

                // Re-index the remaining input fields
                $(wrapper).children('div').each(function(index) {
                    $(this).find('input').attr('name', 'BookUnitId' + (index + 1));
                });

                $('#inputCount2').val(x);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'One genre must be present!',
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
</script>

<!-- one collapse at a times -->
<script>
    var myCollapseOne = document.getElementById('collapseborrow')
    var bsCollapseOne = new bootstrap.Collapse(myCollapseOne, {
        toggle: false
    })

    var myCollapseTwo = document.getElementById('collapsereturn')
    var bsCollapseTwo = new bootstrap.Collapse(myCollapseTwo, {
        toggle: false
    })

    var myCollapseThree = document.getElementById('collapsetable')
    var bsCollapseThree = new bootstrap.Collapse(myCollapseThree, {
        toggle: true
    })

    myCollapseOne.addEventListener('show.bs.collapse', function() {
        bsCollapseTwo.hide();
        bsCollapseThree.hide();
    })

    myCollapseTwo.addEventListener('show.bs.collapse', function() {
        bsCollapseOne.hide();
        bsCollapseThree.hide();
    })

    myCollapseThree.addEventListener('show.bs.collapse', function() {
        bsCollapseOne.hide();
        bsCollapseTwo.hide();
    })
</script>

<script>
    $(document).ready(function() {
        $('table tbody tr').on('click', function() {
            var target = $(this).data('target');
            $(target).modal('show');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip({
            html: true
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.ihatepaginate').DataTable({
            searching: false,
            lengthChange: false
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.ihatepaginates').DataTable({});
    });
</script>

<script>
    <?php
    $queryAvailable = "SELECT * FROM `bookunit` WHERE BookStatus = 'A' AND bookunit.Condition != 'R';";
    $queryava = mysqli_query($connRun, $queryAvailable);
    $outputava = mysqli_num_rows($queryava);

    $queryReserved = "SELECT * FROM `bookunit` WHERE BookStatus = 'R'";
    $queryres = mysqli_query($connRun, $queryReserved);
    $outputres = mysqli_num_rows($queryres);

    $PresentDate = date("Y-m-d");
    $queryDues = "SELECT * FROM `BorrowDetail` INNER JOIN Borrow ON Borrow.BorrowId = BorrowDetail.BorrowId WHERE BorrowDetail.BorrowStatus = 'DPJ' AND Borrow.ReturnDate < '$PresentDate' ";
    $querydue = mysqli_query($connRun, $queryDues);
    $outputdue = mysqli_num_rows($querydue);

    $queryReplacement = "SELECT * FROM `BookUnit` WHERE BookUnit.Condition = 'R' ";
    $queryrep = mysqli_query($connRun, $queryReplacement);
    $outputrep = mysqli_num_rows($queryrep);
    ?>

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Available Books', 'Reserved Books', 'Books on Due', 'Need Replacement'],
            datasets: [{
                label: 'Books',
                data: [<?php echo $outputava . ", " . $outputres . ", " . $outputdue . ", " .  $outputrep ?>],
                backgroundColor: [
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)',

                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',

                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
<script>
    var onDateSelect = function(selectedDate, input) {
        if (input.id === 'Start') {
            // Start date selected - update End Date picker
            $("#End").datepicker('option', 'minDate', selectedDate);
        } else {
            // End date selected - update Start Date picker
            $("#Start").datepicker('option', 'maxDate', selectedDate);
        }
    };

    var onDocumentReady = function() {
        var datepickerConfiguration = {
            dateFormat: "mm/yy",
            onSelect: onDateSelect
        };

        $('#Start, #End').datepicker(datepickerConfiguration);
    };

    $(onDocumentReady);
</script>

</body>

</html>