
<?php
include '../DB/DB.php';
global $connection;

$sql_loadMembers = "SELECT * FROM members WHERE is_active = '1' ORDER BY id DESC";
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
                <li class="breadcrumb-item active">Immediate Pass President Message</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">New Message <br> <small style="color: red">Note: Image Size Should 600 × 600 Pixels</small></h4>
                        <form id="formPresidentMessage">
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
                                        <input type="file" class="form-control" id="photograph" name="photograph" placeholder="Photograph" required>
                                        <label for="floatingName">Photograph</label>
                                    </div>
                                </div>

                                <div class="col-md-12 card">
                                    <h5 class="card-title">Type Your Message</h5>

                                    <!-- Quill Editor Default -->
                                    <div class="message-editor">

                                    </div>
                                    <!-- End Quill Editor Default -->

                                    <br>

                                    <input type="hidden" value="" id="president-message" name='president_message'/>

                                </div>

                                <div class="col-md-2">

                                </div>
                                <div class="col-md-8">
                                    <div class="d-grid gap-2 mt-3">
                                        <button class="btn btn-success" type="submit">Save</button>
                                    </div>
                                </div>
                                <div class="col-md-2">

                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Old Messages</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result_exco = mysqli_query($connection, $sql_loadExco);
                                if (mysqli_num_rows($result_exco) > 0) {

                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($result_exco)) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td> 
                                                <img src="../assets/img/team/<?php echo $row['photograph']; ?>" alt="Profile" class="rounded-circle" style="width: 50%">
                                            </td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <td><?php echo $row['designation']; ?></td>


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

        </div>
    </section>

</main><!-- End #main -->

<?php
include './footer.php';
?>

<script>

    setActiveMenu("#config-nav", "#ipp_message", "#config-nav-main");

    /**
     * Initiate Quill Editor
     */

    var quill = new Quill('.message-editor', {
        placeholder: 'Enter Message',
        theme: 'snow'
    });

    quill.on('text-change', function (delta, oldDelta, source) {
        console.log(quill.container.firstChild.innerHTML);
        $('#president-message').val(quill.container.firstChild.innerHTML);
    });

    /**
     * Exco Asign form submit
     */

    $(document).ready(function (e) {
        $("#formPresidentMessage").on('submit', (function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({

                url: "./controllers/immediatePassPresidentMesssageSave.php", // Url to which the request is send
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
        })
                );
    });

</script>