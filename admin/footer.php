
<!--Notification Toast Message-->

<div class="position-fixed top-0 end-0 translate-middle- p-3" style="z-index: 20;margin-top: 80px;">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #33691E">
            <img src="../assets/img/leo-logo-favicon3.jpeg" class="rounded me-2" alt="...">
            <strong class="me-auto" style="color: white">Notification</strong>
            <small style="color: white">Just Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-body" style="background-color: #558B2F; color: white">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>

<!--Error Notification Toast Message-->

<div class="position-fixed top-0 end-0 translate-middle- p-3" style="z-index: 20;margin-top: 80px;">
    <div id="liveToastError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #DD2C00">
            <img src="../assets/img/leo-logo-favicon3.jpeg" class="rounded me-2" alt="...">
            <strong class="me-auto" style="color: white">Notification</strong>
            <small style="color: white">Just Now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-body-error" style="background-color: #FF3D00; color: white">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>LCCH</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Designed by <a href="https://www.facebook.com/dineth.jayasekera.5">Dineth Jayasekera</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<script>
    /**
     * Set Active Menu
     */

    function setActiveMenu(colupsId = null, menuId = null, mainMenuId = null) {

        /**
         * Remove Show From Colups
         */

        $("#members-nav").removeClass("show");
        $("#config-nav").removeClass("show");
        $("#projects-nav").removeClass("show");
        $("#msg-nav").removeClass("show");

        /**
         * Remove active From Menu
         */

        $("#view_members").removeClass("active");
        $("#dashboard").removeClass("active");
        $("#president_message").removeClass("active");
        $("#ipp_message").removeClass("active");
        $("#ipp_message").removeClass("active");
        $("#config_general").removeClass("active");
        $("#add_projects").removeClass("active");
        $("#manage_projects").removeClass("active");
        $("#manage_accounts").removeClass("active");
        $("#participation").removeClass("active");
        $("#send_sms").removeClass("active");
        $("#send_email").removeClass("active");

        /**
         * Add active to main Menu
         */

        $("#members-nav-main").addClass("collapsed");
        $("#projects-nav-main").addClass("collapsed");
        $("#config-nav-main").addClass("collapsed");
        $("#dashboard").addClass("collapsed");
        $("#msg-nav-main").addClass("collapsed");

        if (colupsId != null) {
            $(colupsId).addClass("show");
        }
        if (menuId != null) {
            $(menuId).addClass("active");
        }
        if (mainMenuId != null) {
            $(mainMenuId).removeClass("collapsed");
    }
    }
</script>

</body>

</html>