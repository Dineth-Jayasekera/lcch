
<?php
$role = $_COOKIE["role"];
if($role != "Super Admin"){
    echo '<script>window.location.replace("https://colomboheroes.org/admin");</script>';
    exit;
}

include './header.php';
include './menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Messages</li>
                <li class="breadcrumb-item active">SMS</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">New Message </h4>
                        <form id="formSendSMS">
                            <div class="row">

                                <div class="col-md-12">
                                    <small style="color: red">Note: you must add Phone number(s) this format <b>94777111111,94777222222</b></small>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" placeholder="Phone Number(s)" id="pnone_number" name="pnone_number" style="height: 100px;"></textarea>
                                        <label for="floatingTextarea">Phone Number(s)</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" placeholder="Message" id="msg" name="msg" style="height: 100px;"></textarea>
                                        <label for="floatingTextarea">Message</label>
                                    </div>
                                </div>

                                <div class="col-md-2">

                                </div>
                                <div class="col-md-8">
                                    <div class="d-grid gap-2 mt-3">
                                        <button class="btn btn-success" type="submit">Send</button>
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

</main><!-- End #main -->

<?php
include './footer.php';
?>

<script>

    setActiveMenu("#msg-nav", "#send_sms", "#msg-nav-main");

    /**
     * Exco Asign form submit
     */

    $(document).ready(function (e) {
        $("#formSendSMS").on('submit', (function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({

                url: "./controllers/sendSMS.php", // Url to which the request is send
                type: "POST", // Type of request to be s", // Url to which the request is send
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    if (data == "Successfully Send") {
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