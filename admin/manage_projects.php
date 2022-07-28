
<?php
include '../DB/DB.php';
global $connection;

$sql_getAllProjects = "SELECT * FROM projects WHERE status='1' ORDER by id DESC";

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
                <li class="breadcrumb-item active">Manage</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Projects</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col" style="width: 50%">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result_getAllProjects = mysqli_query($connection, $sql_getAllProjects);
                                if (mysqli_num_rows($result_getAllProjects) > 0) {

                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($result_getAllProjects)) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td> 
                                                <img src="../assets/img/projects/<?php echo $row['image']; ?>" alt="Profile"  style="width: 200px">
                                            </td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" onclick="deletePost('<?php echo $row['id'] ?>')"><i class="bi bi-trash"></i></button>
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


        </div>
    </section>



</main><!-- End #main -->

<?php
include './footer.php';
?>

<script>

    setActiveMenu("#projects-nav", "#manage_projects", "#projects-nav-main");

    function deletePost(id) {
        const formData = new FormData();
        formData.append("id", id);

        $.ajax({

            url: "./controllers/deleteProject.php", // Url to which the request is send
            type: "POST", // Type of request to be s", // Url to which the request is send
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
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


</script>