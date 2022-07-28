
<?php
include '../DB/DB.php';
global $connection;

$sql_loadConfigurations = "SELECT * FROM configurations LIMIT 1";
$result_configurations = mysqli_query($connection, $sql_loadConfigurations);
$row_configurations = mysqli_fetch_assoc($result_configurations);

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
                <li class="breadcrumb-item active">General</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <form id="formConfigurations" method="post">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Title Text</h4>

                            <div class="row">

                                <div class="col-lg-10">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title Text" value="<?php echo $row_configurations['title']; ?>" required>
                                        <label for="floatingName">Title Text</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="d-grid gap-2 mt-2">
                                        <button class="btn btn-success btn-lg" type="submit">Update</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Slogan Text</h4>

                            <div class="row">

                                <div class="col-lg-10">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="slogan" name="slogan" placeholder="Slogan Text" value="<?php echo $row_configurations['slogan']; ?>" required>
                                        <label for="floatingName">Slogan Text</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="d-grid gap-2 mt-2">
                                        <button class="btn btn-success btn-lg" type="submit">Update</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">YouTube Video Link</h4>

                            <div class="row">

                                <div class="col-lg-10">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="youtube" name="youtube" placeholder="YouTube Video Link" value="<?php echo $row_configurations['video_link']; ?>" required>
                                        <label for="floatingName">YouTube Video Link</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="d-grid gap-2 mt-2">
                                        <button class="btn btn-success btn-lg" type="submit">Update</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>

</main><!-- End #main -->

<?php
include './footer.php';
?>

<script>

    setActiveMenu("#config-nav", "#config_general", "#config-nav-main");


    /**
     * Exco Configurations form submit
     */

    $(document).ready(function (e) {
        $("#formConfigurations").on('submit', (function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({

                url: "./controllers/generalConfigurations.php", // Url to which the request is send
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

//                    location.reload();

                }
            });
        })
                );
    });

</script>