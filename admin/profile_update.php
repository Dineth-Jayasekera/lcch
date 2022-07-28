
<?php
include '../DB/DB.php';
global $connection;

$member_id = $_COOKIE['member_id'];

$sql_loadProvince = "SELECT * FROM provinces";

$sql_loadMemberDetails = "SELECT * FROM members WHERE id='$member_id'";
$result_memberDetails = mysqli_query($connection, $sql_loadMemberDetails);
$row_memberDetails = mysqli_fetch_assoc($result_memberDetails);

include './header.php';
include './menu.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>My Profile</h1>

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <br>

                        <div class="col-md-12">
                            <img src="assets/img/myProfile-background.jpeg" class="img-fluid" style="border-radius: 30px">
                            <img src="assets/img/profile_imgs/<?php echo $row_memberDetails['image']; ?>" class="rounded-circle float-left" style="width: 200px; border-style: solid; border-width: 10px; border-color: white; margin-top: -90px; margin-left: 50px">                          
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <center>
                                    <button type="button" id="about-btn" class="btn btn-outline-secondary" onclick="viewBlock('#about')">About</button>
                                    <button type="button" id="education-btn" class="btn btn-outline-secondary" onclick="viewBlock('#education')">Education</button>
                                    <button type="button" id="profession-btn" class="btn btn-outline-secondary" onclick="viewBlock('#profession')">Employment</button>
                                    <button type="button" id="social-btn" class="btn btn-outline-secondary" onclick="viewBlock('#social')">Social Media</button>
                                    <button type="button" id="settings-btn" class="btn btn-outline-secondary" onclick="viewBlock('#settings')">Settings</button>
                                </center>
                            </div>
                            <div class="col-md-2"></div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <form>
            <!--About Card-->
            <div class="col-lg-12 slide-top" style="display: none" id="about">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">About</h4>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $row_memberDetails['first_name']; ?>" required>
                                    <label for="floatingName">First Name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="<?php echo $row_memberDetails['middle_name']; ?>" required>
                                    <label for="floatingName">Middle Name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row_memberDetails['last_name']; ?>" placeholder="Last Name">
                                    <label for="floatingName">Last Name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="most_used_name" name="most_used_name" placeholder="Most Used Name" value="<?php echo $row_memberDetails['most_used_name']; ?>">
                                    <label for="floatingName">Most Used Name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $row_memberDetails['email']; ?>">
                                    <label for="floatingName">Email Address</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" value="<?php echo $row_memberDetails['dob']; ?>">
                                    <label for="floatingName">Date of Birth</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <?php if ($row_memberDetails['address_line1'] == "") { ?>
                                        <input type="text" class="form-control" id="address_line1" name="address_line1" placeholder="Address Line 1">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="address_line1" name="address_line1" placeholder="Address Line 1" value="<?php echo $row_memberDetails['address_line1'];?>" disabled>
                                    <?php } ?>
                                    <label for="floatingName">Address Line 1</label>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <?php if ($row_memberDetails['address_line2'] == "") { ?>
                                        <input type="text" class="form-control" id="address_line2" name="address_line2" placeholder="Address Line 2">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="address_line2" name="address_line2" placeholder="Address Line 2" value="<?php echo $row_memberDetails['address_line2'];?>" disabled>
                                    <?php } ?>
                                    <label for="floatingName">Address Line 2</label>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <?php if ($row_memberDetails['address_line3'] == "") { ?>
                                        <input type="text" class="form-control" id="address_line3" name="address_line3" placeholder="Address Line 3">
                                    <?php } else { ?>
                                        <input type="text" class="form-control" id="address_line3" name="address_line3" placeholder="Address Line 3" value="<?php echo $row_memberDetails['address_line3'];?>" disabled>
                                    <?php } ?>
                                    <label for="floatingName">Address Line 3</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="province" name="province" aria-label="Province" onchange="loadDistricts()" required>
                                        <option selected>Please Select</option>
                                        <?php
                                        $result_province = mysqli_query($connection, $sql_loadProvince);
                                        if (mysqli_num_rows($result_province) > 0) {

                                            while ($row = mysqli_fetch_assoc($result_province)) {
                                                ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name_en'] . ' Province'; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>                               
                                    </select>
                                    <label for="floatingSelect">Province</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="district" name="district" aria-label="District" onchange="loadCities()" required>
                                        <option selected>Please Select</option>

                                    </select>
                                    <label for="floatingSelect">District</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="city" name="city" aria-label="City" required>
                                        <option selected>Please Select</option>

                                    </select>
                                    <label for="floatingSelect">City</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Postal Code">
                                    <label for="floatingName">Postal Code</label>
                                </div>
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="gender" class="form-label"><b class="required">Gender</b></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Male" name="gender" id="gender">
                                    <label class="form-check-label" for="gender">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Female" name="gender" id="gender">
                                    <label class="form-check-label" for="gender">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Prefer not to say" name="gender" id="gender" checked>
                                    <label class="form-check-label" for="gender">
                                        Prefer not to say
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="gender" class="form-label"><b class="required">Preferred Language</b></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Sinhala" name="preferred_language" id="preferred_language" checked>
                                    <label class="form-check-label" for="preferred_language">
                                        Sinhala
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="English" name="preferred_language" id="preferred_language">
                                    <label class="form-check-label" for="preferred_language">
                                        English
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Tamil" name="preferred_language" id="preferred_language">
                                    <label class="form-check-label" for="preferred_language">
                                        Tamil
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Telephone - Residence">
                                    <label for="floatingName">Telephone - Residence</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Mobile">
                                    <label for="floatingName">Mobile</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Secondary Mobile">
                                    <label for="floatingName">Secondary Mobile</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Secondary Mobile">
                                    <label for="floatingName">National Identity Card Number</label>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="designation_order" name="designation_order" aria-label="Civil Status" required>
                                        <option selected>Please Select</option>
                                        <option value="Married">Married</option>
                                        <option value="Unmarried">Unmarried</option>                          
                                    </select>
                                    <label for="floatingSelect">Civil Status</label>
                                </div>
                            </div>

                            <div class="col-md-2">

                            </div>
                            <div class="col-md-8">
                                <div class="d-grid gap-2 mt-3">
                                    <button class="btn btn-danger" type="submit">Update</button>
                                </div>
                            </div>
                            <div class="col-md-2">

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <!--Education Card-->
            <div class="col-lg-12 slide-top" style="display: none" id="education">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Education</h4>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="School Name">
                                    <label for="floatingName">School Name</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="month" class="form-control" id="twitter" name="twitter" placeholder="Start Date">
                                    <label for="floatingName">Start Date</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="month" class="form-control" id="twitter" name="twitter" placeholder="End Date">
                                    <label for="floatingName">End Date</label>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="University Name">
                                    <label for="floatingName">University Name</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="designation_order" name="designation_order" aria-label="Level of Educations" required>
                                        <option selected>Please Select</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Degree">Degree</option>                          
                                        <option value="Master">Master</option>                          
                                        <option value="PhD">PhD</option>                          
                                    </select>
                                    <label for="floatingSelect">Level of Education</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="month" class="form-control" id="twitter" name="twitter" placeholder="Start Date">
                                    <label for="floatingName">Start Date</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="month" class="form-control" id="twitter" name="twitter" placeholder="End Date">
                                    <label for="floatingName">End Date</label>
                                </div>
                            </div>

                            <div class="col-md-2">

                            </div>
                            <div class="col-md-8">
                                <div class="d-grid gap-2 mt-3">
                                    <button class="btn btn-danger" type="submit">Update</button>
                                </div>
                            </div>
                            <div class="col-md-2">

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <!--Profession Card-->
            <div class="col-lg-12 slide-top" style="display: none" id="profession">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Employment</h4>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="School Name">
                                    <label for="floatingName">Company Name</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Start Date">
                                    <label for="floatingName">Profession</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="designation_order" name="designation_order" aria-label="Level of Educations" required>
                                        <option selected>Please Select</option>
                                        <option value="Agriculture, Food and Natural Resources" data-v-12350772=""> Agriculture, Food and Natural Resources </option>
                                        <option value="Architecture and Construction" data-v-12350772=""> Architecture and Construction </option>
                                        <option value="Education and Training" data-v-12350772=""> Education and Training </option>
                                        <option value="Business Management and Administration" data-v-12350772=""> Business Management and Administration </option>
                                        <option value="Arts, Audio/Video Technology and Communications" data-v-12350772=""> Arts, Audio/Video Technology and Communications </option>
                                        <option value="Finance" data-v-12350772="">Finance</option>
                                        <option value="Government and Public Administration" data-v-12350772=""> Government and Public Administration </option>
                                        <option value="Health & Health Sciences" data-v-12350772=""> Health &amp; Health Sciences </option>
                                        <option value="Hospitality and Tourism" data-v-12350772=""> Hospitality and Tourism </option>
                                        <option value="Human Services" data-v-12350772="">Human Services</option>
                                        <option value="Information Technology" data-v-12350772=""> Information Technology </option>
                                        <option value="Law, Public Safety, Corrections and Security" data-v-12350772=""> Law, Public Safety, Corrections and Security </option>
                                        <option value="Manufacturing" data-v-12350772="">Manufacturing</option>
                                        <option value="Marketing, Sales and Service" data-v-12350772=""> Marketing, Sales and Service </option>
                                        <option value="Science, Technology, Engineering and Mathematics" data-v-12350772=""> Science, Technology, Engineering and Mathematics </option>
                                        <option value="Transportation, Distribution and Logistics" data-v-12350772=""> Transportation, Distribution and Logistics </option>                          
                                    </select>
                                    <label for="floatingSelect">Category of Profession</label>
                                </div>
                            </div>

                            <div class="col-md-2">

                            </div>
                            <div class="col-md-8">
                                <div class="d-grid gap-2 mt-3">
                                    <button class="btn btn-danger" type="submit">Update</button>
                                </div>
                            </div>
                            <div class="col-md-2">

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <!--Social Media Card-->
            <div class="col-lg-12 slide-top" style="display: none" id="social">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Social Media</h4>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="School Name">
                                    <label for="floatingName">Facebook</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Start Date">
                                    <label for="floatingName">Instagram</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Start Date">
                                    <label for="floatingName">Twitter</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Start Date">
                                    <label for="floatingName">LinkedIn</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Start Date">
                                    <label for="floatingName">TikTok</label>
                                </div>
                            </div>

                            <div class="col-md-12"></div>

                            <div class="col-md-2">

                            </div>
                            <div class="col-md-8">
                                <div class="d-grid gap-2 mt-3">
                                    <button class="btn btn-danger" type="submit">Update</button>
                                </div>
                            </div>
                            <div class="col-md-2">

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </form>
        <!--Settings Card-->
        <div class="col-lg-12 slide-top" style="display: none" id="settings">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Settings</h4>

                    <div class="row">

                        <!--Password Change Section-->
                        <form>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Change Password</h4>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="twitter" name="twitter" placeholder="School Name">
                                                <label for="floatingName">Current Password</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Start Date">
                                                <label for="floatingName">New Password</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12"></div>

                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-grid gap-2 mt-3">
                                                <button class="btn btn-danger" type="submit">Update Password</button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </form>

                        <!--Pro pic Change Section-->
                        <form>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Change Profile Picture</h4>

                                    <div class="row">

                                        <div class="col-md-12">

                                            <input class="form-control" type="file" id="formFile">

                                        </div>

                                        <div class="col-md-12"></div>

                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-grid gap-2 mt-3">
                                                <button class="btn btn-danger" type="submit">Update Profile Picture</button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </form>



                    </div>

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

    function viewBlock(id) {
        $("#about").css("display", "none");
        $("#education").css("display", "none");
        $("#profession").css("display", "none");
        $("#social").css("display", "none");
        $("#settings").css("display", "none");

        $("#about-btn").removeClass("btn-danger");
        $("#education-btn").removeClass("btn-danger");
        $("#profession-btn").removeClass("btn-danger");
        $("#social-btn").removeClass("btn-danger");
        $("#settings-btn").removeClass("btn-danger");

        $("#about-btn").addClass("btn-outline-secondary");
        $("#education-btn").addClass("btn-outline-secondary");
        $("#profession-btn").addClass("btn-outline-secondary");
        $("#social-btn").addClass("btn-outline-secondary");
        $("#settings-btn").addClass("btn-outline-secondary");

        $(id + "-btn").removeClass("btn-outline-secondary");
        $(id + "-btn").addClass("btn-danger");

        $(id).css("display", "block");
    }

    function loadDistricts() {

        var id = $('#province').val();
        const formData = new FormData();
        formData.append("province_id", id);

        $.ajax({

            url: "./controllers/loadAddressDetails.php", // Url to which the request is send
            type: "POST", // Type of request to be s", // Url to which the request is send
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                $('#district')[0].options.length = 0;
                $('#district').append($('<option>', {
                    value: "",
                    text: "Please Select"
                }));
                $.each(JSON.parse(data), function (i, district) {
                    $('#district').append($('<option>', {
                        value: district.id,
                        text: district.name
                    }));
                });

            }
        });
    }

    function loadCities() {

        var id = $('#district').val();
        const formData = new FormData();
        formData.append("district_id", id);

        $.ajax({

            url: "./controllers/loadAddressDetails.php", // Url to which the request is send
            type: "POST", // Type of request to be s", // Url to which the request is send
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                $('#city')[0].options.length = 0;
                $('#city').append($('<option>', {
                    value: "",
                    text: "Please Select"
                }));
                $.each(JSON.parse(data), function (i, district) {
                    $('#city').append($('<option>', {
                        value: district.id,
                        text: district.name
                    }));
                });

            }
        });
    }

    viewBlock('#about');
</script>