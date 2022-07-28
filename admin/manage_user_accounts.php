
<?php
$role = $_COOKIE["role"];
if($role != "Super Admin"){
    echo '<script>window.location.replace("https://colomboheroes.org/admin");</script>';
    exit;
}

include '../DB/DB.php';
global $connection;

$sql_loadUsers = "SELECT u.id, m.first_name, m.last_name, m.mylci, u.username, u.is_active, m.mobile, u.role FROM users u INNER JOIN members m ON u.member_id = m.id ORDER BY u.id DESC";
$sql_loadMembers = "SELECT * FROM members WHERE is_active = '1' AND having_account = '0' ORDER BY id DESC";

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
                <li class="breadcrumb-item active">Manage User Accounts</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create User Account</h4>
                        <form id="formCreateAccount">
                            <div class="row">

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
                                        <select class="form-select" id="user_role" name="user_role" aria-label="User Role" required>
                                            <option selected>Please Select</option>
                                            <option value="Super Admin">Super Admin</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Exco">Exco</option>
                                            <option value="Member">Member</option>

                                        </select>
                                        <label for="floatingSelect">User Role</label>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="d-grid gap-2 mt-1">
                                        <button class="btn btn-success btn-lg" type="submit">Create Acount</button>
                                    </div>
                                </div>

                                <input type="hidden" name="for" value="CreateAccount"/>

                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Accounts</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Holder Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result_users = mysqli_query($connection, $sql_loadUsers);
                                if (mysqli_num_rows($result_users) > 0) {

                                    $i = 1;

                                    while ($row = mysqli_fetch_assoc($result_users)) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                            <td><?php echo $row['role']; ?></td>
                                            <td><?php echo $row['mobile']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['is_active'] == 1 ? '<b style="color : green;">Unlocked</b>' : '<b style="color : red;">Locked</b>'; ?></td>
                                            <td>
                                                <?php if ($row['is_active'] == 1) { ?>
                                                    <button type="button" class="btn btn-danger" onclick="changeAccountStatus('<?php echo $row['id'] . '#0'; ?>')"><i class="bi bi-lock-fill"></i></button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-success" onclick="changeAccountStatus('<?php echo $row['id'] . '#1'; ?>')"><i class="bi bi-unlock-fill"></i></button>
                                                    <?php } ?>
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

    setActiveMenu("#config-nav", "#manage_accounts", "#config-nav-main");


    /**
     * Create Account form submit
     */

    $(document).ready(function (e) {
        $("#formCreateAccount").on('submit', (function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({

                url: "./controllers/manageAccounts.php", // Url to which the request is send
                type: "POST", // Type of request to be s", // Url to which the request is send
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    console.log(data);
                    if (data == "Message has been sent") {
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

    function changeAccountStatus(data) {

        var data = data.split("#");


        const formData = new FormData();
        formData.append("for", "AccountStatusChange");
        formData.append("id", data[0]);
        formData.append("status", data[1]);

        $.ajax({

            url: "./controllers/manageAccounts.php", // Url to which the request is send
            type: "POST", // Type of request to be s", // Url to which the request is send
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
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


</script>