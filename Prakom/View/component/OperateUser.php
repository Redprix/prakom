<div class="row">
    <div class="col">
        <div class="card">
            <div class="p-3">
                <h5>User Data</h5>
                <table class="table ihatepaginate" id="ihatepaginate">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $Sqlforuser = "SELECT * FROM User order by userid desc";
                        $sqlforuser2 = mysqli_query($connRun, $Sqlforuser);
                        $i = 1;
                        while ($aa = mysqli_fetch_assoc($sqlforuser2)) {
                            // Now, $aa is an array that represents a single row
                            if ($aa['UserLevel'] == 'ADM') {
                                $Level = 'Administrator';
                            } elseif ($aa['UserLevel'] == 'PTG') {
                                $Level = 'Officer';
                            } else {
                                $Level = 'User';
                            }
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td style="text-wrap:nowrap;"><?php echo $aa['UserEmail'] ?></td>
                                <td style="text-wrap:nowrap;"><?php echo $aa['UserFullName'] ?></td>
                                <td><?php echo $Level; ?></td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <form class="row g-3 p-3" action="../system/SysAccounts.php?do=register" method="post">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" placeholder="viegar@yahoo.co.id" name="emailregister" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="number" name="Pass" class="form-control readonly" readonly value="123" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">User full name</label>
                    <input type="text" class="form-control" name="nameregister" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" checked name="levelregister" value="PMJ" type="Radio" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            User Account
                        </label>
                        <?php if ($_SESSION['Level'] === 'ADM') {
                        ?>
                            <br>
                            <input class="form-check-input" name="levelregister" type="Radio" value="PTG" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Officer Account
                            </label>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Add Account</button>
                </div>
            </form>
        </div>
    </div>
</div>