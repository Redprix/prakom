<div class="row parentorder">
    <div class="col-md-12 col-lg-8 mb-2 ">

        <div class="card contentstyle childloan">
            <h4 class="headertext">On Loan</h4>
            <div class="imagecontainer">
                <!-- max on loan 5 books -->
                <img src="../images/arknights.jpg" alt="">

                <img src="../images/arknights.jpg" alt="">

                <img src="../images/arknights.jpg" alt="">

                <img src="../images/arknights.jpg" alt="">

                <img src="../images/arknights.jpg" alt="">

            </div>

        </div>

        <div class="mt-3 d-none d-lg-block">
            <!-- recomendation testing for large screens -->
            <div class="card">
                test
                <div class="row">
                    <?php
                    $i = 0;
                    while ($i < 3) {
                    ?>
                        <div class="col">
                            <img src="../images/arknights.jpg" style="border:black; border-radius: 400px; width:130px; height:130px; object-fit:cover" alt="">
                        </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>


    <!-- reserved books component -->
    <div class="col-md childreserved">

        <div class="card">
            <ul class=" list-group list-group-flush">
                <li class="list-group-item">
                    <h4>Reserved Books</h4>
                </li>
                <?php
                $i = 1;
                while ($i < 6) {
                ?>
                    <li class="list-group-item">
                        <div class="row ReservedBooks">
                            <div class="col-4">
                                <img src="../images/arknights.jpg" alt="">
                            </div>
                            <div class="col">
                                <Span>Arknights Artbook</Span>
                                <p>yostar</p>
                                <span class="Duetime">Due 2025/01/22</span>
                                <p class="Duetime">@thisguy's Loan</p>
                            </div>
                        </div>
                    </li>
                <?php
                    $i++;
                }
                ?>
            </ul>
            <div class="card-footer">
                <a href="">see more>></a>
            </div>
        </div>


    </div>
    <div class="col-md-8 childrandom d-block d-lg-none">

        <div class="card">
            test
            <div class="row">
                <?php
                $i = 0;
                while ($i < 6) {
                ?>
                    <div class="col">
                        <img src="../images/arknights.jpg" style="border:black; border-radius: 400px; width:130px; height:130px; object-fit:cover" alt="">
                    </div>
                <?php
                    $i++;
                }
                ?>
            </div>
        </div>

    </div>


</div>