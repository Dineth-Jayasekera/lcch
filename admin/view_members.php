
<?php
include '../DB/DB.php';
global $connection;

$base_url = "https://colomboheroes.org";
$sql_loadMembers = "SELECT * FROM members ORDER BY id DESC";

include './header.php';
include './menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Members</li>
                <li class="breadcrumb-item active">View All</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All members</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">MyLCI</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Birthday</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Interview Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result_members = mysqli_query($connection, $sql_loadMembers);
                                if (mysqli_num_rows($result_members) > 0) {

                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($result_members)) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <td><?php echo $row['mylci']; ?></td>
                                            <td><?php echo $row['mobile']; ?></td>
                                            <td><?php echo $row['dob']; ?></td>
                                            <td><?php echo $row['is_active'] == 1 ? '<b style="color : green;">Active</b>' : '<b style="color : red;">In Active</b>'; ?></td>
                                            <td><?php echo $row['is_interview_done'] == 1 ? '<b style="color : green;">Done</b>' : '<b style="color : red;">Pending</b>'; ?></td>
                                            <td>
                                                <a class="btn btn-success" href="<?php echo $base_url;?>/admin/member_profile_view.php?tag=<?php echo $row['id']; ?>#<?php echo $row['first_name'].$row['last_name']; ?>" target="_blank"><i class="bi bi-eye"></i></a>
                                                <!--<button type="button" class="btn btn-danger"><i class="bi bi-eraser"></i></button>-->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateMemberModal" onclick="updateMember('<?php echo $row['is_active'] ?>#<?php echo $row['is_interview_done'] ?>#<?php echo $row['id'] ?>#<?php echo $row['first_name']; ?>#<?php echo $row['mylci']; ?>#<?php echo $row['mylci_register_date']; ?>')"><i class="bi bi-pencil"></i></button>
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

    <!--Update Member Modal-->
    <div class="modal fade" id="updateMemberModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="updateMemberModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMemberTitle">
                        Update Member (Leo First Name)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateMemberForm" method="post">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="mylci" name="mylci" placeholder="MyLCI">
                                    <label for="floatingName">MyLCI</label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="mylci_register_date" name="mylci_register_date" placeholder="MyLCI Register Date">
                                    <label for="floatingName">MyLCI Register Date</label>
                                </div>
                            </div>

                            <div class="form-check form-switch mb-3 col-lg-6">
                                <input class="form-check-input" type="checkbox" name="member_status" id="member_status">
                                <label class="form-check-label" for="member_status">Member Status</label>
                            </div>

                            <div class="form-check form-switch mb-3 col-lg-6">
                                <input class="form-check-input" type="checkbox" name="member_interview_status" id="member_interview_status">
                                <label class="form-check-label" for="member_interview_status">Member Interview Status</label>
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

    setActiveMenu("#members-nav", "#view_members", "#members-nav-main");

    function updateMember(data) {

        var data = data.split("#");

        if (data[0] == 1) {
            $("#member_status").prop("checked", true);
        }
        if (data[1] == 1) {
            $("#member_interview_status").prop("checked", true);
        }
        $('#update_member_id').val(data[2]);
        $('#updateMemberTitle').html("Update Member (Leo " + data[3] + ")");
        $('#mylci').val(data[4]);
        $('#mylci_register_date').val(data[5]);

    }

    /**
     * Update Member form submit
     */

    $(document).ready(function (e) {
        $("#updateMemberForm").on('submit', (function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({

                url: "./controllers/updateMemberForm.php", // Url to which the request is send
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