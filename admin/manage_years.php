
<?php
include '../DB/DB.php';
global $connection;

$sql_loadYears = "SELECT * FROM years ORDER BY id DESC";

include './header.php';
include './menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Configurations</li>
                <li class="breadcrumb-item active">Leostic Year</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Excos</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Display</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result_year = mysqli_query($connection, $sql_loadYears);
                                if (mysqli_num_rows($result_year) > 0) {

                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($result_year)) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><?php echo $row['display']; ?></td>
                                            <td><?php echo $row['is_active'] == 1 ? '<b style="color : green;">Active</b>' : '<b style="color : red;">In Active</b>'; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success" onclick="updateYear('<?php echo $row['id'] ?>#Activate')"><i class="bi bi-check2"></i></button>
                                                <button type="button" class="btn btn-danger" onclick="updateYear('<?php echo $row['id'] ?>#deactivate')"><i class="bi bi-x-lg"></i></button>
                                            </td>

                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Assign Exco <br> <small style="color: red">Note: Image Size Should 600 × 600 Pixels</small></h4>
                        <form id="formExco">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="year" name="year" aria-label="Year" required>
                                            <option selected>Please Select</option>
                                            <?php
                                            $result_years = mysqli_query($connection, $sql_loadYears);
                                            if (mysqli_num_rows($result_years) > 0) {

                                                while ($row = mysqli_fetch_assoc($result_years)) {
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['display']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingSelect">Year</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="member" name="member" aria-label="Member" required>
                                            <option selected>Please Select</option>
                                            <?php
                                            $result_members = mysqli_query($connection, $sql_loadMembers);
                                            if (mysqli_num_rows($result_members) > 0) {

                                                while ($row = mysqli_fetch_assoc($result_members)) {
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingSelect">Member</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="designation_order" name="designation_order" aria-label="Designation" required>
                                            <option selected>Please Select</option>
                                            <option value="1">President</option>
                                            <option value="2">Immediate Past President</option>
                                            <option value="3">1st Vice President</option>
                                            <option value="4">2nd Vice President</option>
                                            <option value="5">3rd Vice President</option>
                                            <option value="6">Secretary</option>
                                            <option value="7">Treasurer</option>
                                            <option value="8">Assistant Secretary</option>
                                            <option value="9">Assistant Treasurer</option>
                                            <option value="10">Directors</option>
                                        </select>
                                        <label for="floatingSelect">Designation</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation Display" required>
                                        <label for="floatingName">Designation Display</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="file" class="form-control" id="photograph" name="photograph" placeholder="Photograph" required>
                                        <label for="floatingName">Photograph</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter">
                                        <label for="floatingName">Twitter</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook">
                                        <label for="floatingName">Facebook</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="instergram" name="instergram" placeholder="Instergram">
                                        <label for="floatingName">Instagram</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="linkedIn" name="linkedIn" placeholder="LinkedIn">
                                        <label for="floatingName">LinkedIn</label>
                                    </div>
                                </div>

                                <div class="col-md-2">

                                </div>
                                <div class="col-md-8">
                                    <div class="d-grid gap-2 mt-3">
                                        <button class="btn btn-success" type="submit">Assign</button>
                                    </div>
                                </div>
                                <div class="col-md-2">

                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!--Update Member Modal-->
    <div class="modal fade" id="updateMemberModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="updateMemberModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMemberTitle">
                        Update Member (Leo First Name)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateExcoMemberForm" method="post">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twit" value="" name="twit" placeholder="Twitter">
                                    <label for="floatingName">Twitter</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="fb" value="" name="fb" placeholder="Facebook">
                                    <label for="floatingName">Facebook</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="ig" value="" name="ig" placeholder="Instergram">
                                    <label for="floatingName">Instagram</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="linkedin" value="" name="linkedin" placeholder="LinkedIn">
                                    <label for="floatingName">LinkedIn</label>
                                </div>
                            </div>

                            <input type="hidden" id="update_member_id" name="update_member_id"/>
                            <input type="submit" id="btn_login_form_submit" style="display: none;"/>

                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="$('#btn_login_form_submit').trigger('click');">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->

<?php
include './footer.php';
?>

<script>

    setActiveMenu("#config-nav", "#manage_year", "#config-nav-main");

    /**
     * Exco Asign form submit
     */

    $(document).ready(function (e) {
        $("#formExco").on('submit', (function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({

                url: "./controllers/excoSave.php", // Url to which the request is send
                type: "POST", // Type of request to be s", // Url to which the request is send
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    if (data == "Registration Completed") {
                        var toastLive = document.getElementById('liveToast');
                        var toastMessage = document.getElementById('toast-body');

                        toastMessage.innerHTML = data;
                        var toast = new bootstrap.Toast(toastLive);
                        toast.show();

                        var millisecondsToWait = 500;
                        setTimeout(function () {
                            location.reload();
                        }, millisecondsToWait);

                    } else {
                        var toastLive = document.getElementById('liveToastError');
                        var toastMessage = document.getElementById('toast-body-error');

                        toastMessage.innerHTML = data;
                        var toast = new bootstrap.Toast(toastLive);
                        toast.show();
                    }



                }
            });
        })
                );
    });

    function updateYear(data) {

        var data = data.split("#");

        $.ajax({

            url: "./controllers/updateExcoMemberForm.php", // Url to which the request is send
            type: "POST", // Type of request to be s", // Url to which the request is send
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                if (data == "Successfully Updated") {
                    var toastLive = document.getElementById('liveToast');
                    var toastMessage = document.getElementById('toast-body');

                    toastMessage.innerHTML = data;
                    var toast = new bootstrap.Toast(toastLive);
                    toast.show();

                    var millisecondsToWait = 500;
                    setTimeout(function () {
                        location.reload();
                    }, millisecondsToWait);

                } else {
                    var toastLive = document.getElementById('liveToastError');
                    var toastMessage = document.getElementById('toast-body-error');

                    toastMessage.innerHTML = data;
                    var toast = new bootstrap.Toast(toastLive);
                    toast.show();
                }



            }
        });

    }

    /**
     * Update Exco form submit
     */

    $(document).ready(function (e) {
        $("#updateExcoMemberForm").on('submit', (function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({

                url: "./controllers/updateExcoMemberForm.php", // Url to which the request is send
                type: "POST", // Type of request to be s", // Url to which the request is send
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    if (data == "Successfully Updated") {
                        var toastLive = document.getElementById('liveToast');
                        var toastMessage = document.getElementById('toast-body');

                        toastMessage.innerHTML = data;
                        var toast = new bootstrap.Toast(toastLive);
                        toast.show();

                        location.reload();

                    } else {
                        var toastLive = document.getElementById('liveToastError');
                        var toastMessage = document.getElementById('toast-body-error');

                        toastMessage.innerHTML = data;
                        var toast = new bootstrap.Toast(toastLive);
                        toast.show();
                    }



                }
            });
        })
                );
    });

</script>