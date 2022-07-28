
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
                <li class="breadcrumb-item">Projects</li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add New Project <br> <small style="color: red">Note: Image Size Should 1080 × 720 Pixels</small></h4>
                        <form id="formProjectAdd">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="title" value="" name="title" placeholder="Title">
                                        <label for="floatingName">Title</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="fb" value="" name="fb" placeholder="Facebook Post Link">
                                        <label for="floatingName">Facebook Post Link</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="file" class="form-control" id="photograph" name="photograph" placeholder="Photograph" required>
                                        <label for="floatingName">Photograph</label>
                                    </div>
                                </div>

                                <div class="col-md-12 card">
                                    <h5 class="card-title">Description <br> <small style="color: red">Note: Word count should 43 words.</small></h5>

                                    <!-- Quill Editor Default -->
                                    <div class="message-editor">

                                    </div>
                                    <div id="counter">0 words</div>
                                    <!-- End Quill Editor Default -->

                                    <br>

                                    <input type="hidden" value="" id="description" name='description'/>

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



        </div>
    </section>

</main><!-- End #main -->

<?php
include './footer.php';
?>

<script>

    setActiveMenu("#projects-nav", "#add_projects", "#projects-nav-main");
    /**
     * Initiate Quill Editor
     */

    Quill.register('modules/counter', function (quill, options) {
        var container = document.querySelector(options.container);
        quill.on('text-change', function () {
            var text = quill.getText();
            if (options.unit === 'word') {
                container.innerText = (text.split(/\s+/).length - 1) + ' words';

            } else {
                container.innerText = text.length + ' characters';
            }
        });
    });

    var quill = new Quill('.message-editor', {
        modules: {
            counter: {
                container: '#counter',
                unit: 'word'
            }
        },
        placeholder: 'Enter Message',
        theme: 'snow',
    });

    quill.on('text-change', function (delta, oldDelta, source) {
        console.log(quill.container.firstChild.innerHTML);
        $('#description').val(quill.container.firstChild.innerHTML);
    });

    /**
     * Project Add Form
     */

    $(document).ready(function (e) {
        $("#formProjectAdd").on('submit', (function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({

                url: "./controllers/projectSave.php", // Url to which the request is send
                type: "POST", // Type of request to be s", // Url to which the request is send
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    if (data == "Successfully Saved") {
                        var toastLive = document.getElementById('liveToast');
                        var toastMessage = document.getElementById('toast-body');
                        toastMessage.innerHTML = data;
                        var toast = new bootstrap.Toast(toastLive);
                        toast.show();

                        $("#title").val(null);
                        $("#photograph").val(null);
                        $("#fb").val(null);
                        $("#description").val(null);

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