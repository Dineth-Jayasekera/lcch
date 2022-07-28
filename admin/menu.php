<?php
$role = $_COOKIE["role"];
?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="index.php" id="dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#members-nav" data-bs-toggle="collapse" href="#" id="members-nav-main">
                <i class="bi bi-menu-button-wide"></i><span>Members</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="members-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="view_members.php" class="" id="view_members">
                        <i class="bi bi-circle"></i><span>View Members</span>
                    </a>
                </li>
                <li>
                    <a href="manage_exco.php" class="" id="manage_exco">
                        <i class="bi bi-circle"></i><span>Manage Exco</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="" id="participation">
                        <i class="bi bi-circle"></i><span>Participation</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Members Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#projects-nav" data-bs-toggle="collapse" href="#" id="projects-nav-main">
                <i class="bi bi-menu-button-wide"></i><span>Projects</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="projects-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="add_projects.php" class="" id="add_projects">
                        <i class="bi bi-circle"></i><span>Add Projects</span>
                    </a>
                </li>
                <li>
                    <a href="manage_projects.php" class="" id="manage_projects">
                        <i class="bi bi-circle"></i><span>Manage Projects</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Members Nav -->

        <?php if ($role == "Super Admin") { ?>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#msg-nav" data-bs-toggle="collapse" href="#" id="msg-nav-main">
                    <i class="bi bi-envelope"></i><span>Messages</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="msg-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="send_SMS.php" class="" id="send_sms">
                            <i class="bi bi-circle"></i><span>SMS</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="" id="send_email">
                            <i class="bi bi-circle"></i><span>E-Mail</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Messages Nav -->
        <?php } ?>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#config-nav" data-bs-toggle="collapse" href="#" id="config-nav-main">
                <i class="bi bi-gear"></i><span>Configurations</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="config-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="configurations_general.php" class="" id="config_general">
                        <i class="bi bi-circle"></i><span>General</span>
                    </a>
                </li>
                <li>
                    <a href="manage_years.php" class="" id="manage_year">
                        <i class="bi bi-circle"></i><span>Manage Year</span>
                    </a>
                </li>
                <?php if ($role == "Super Admin") { ?>
                    <li>
                        <a href="manage_user_accounts.php" class="" id="manage_accounts">
                            <i class="bi bi-circle"></i><span>Manage Accounts</span>
                        </a>
                    </li>
                <?php } ?>
                <li>
                    <a href="president_message.php" class="" id="president_message">
                        <i class="bi bi-circle"></i><span>President Message</span>
                    </a>
                </li>
                <li>
                    <a href="immediate_pass_president_messsage.php" class="" id="ipp_message">
                        <i class="bi bi-circle"></i><span>IPP Message</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Configurations Nav -->

    </ul>

</aside><!-- End Sidebar-->