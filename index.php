<?php
include './DB/DB.php';
global $connection;

$sql_getCurentYear = "SELECT * FROM years WHERE is_active=1;";
$result_curentYear = mysqli_query($connection, $sql_getCurentYear);
$row_curentYear = mysqli_fetch_assoc($result_curentYear);

$curentYearID = $row_curentYear['id'];
$curentYear = $row_curentYear['display'];

//Get Configurations
$sql_loadConfigurations = "SELECT * FROM configurations LIMIT 1";
$result_configurations = mysqli_query($connection, $sql_loadConfigurations);
$row_configurations = mysqli_fetch_assoc($result_configurations);

$sql_loadExco = "SELECT m.first_name, m.last_name, e.designation, m.mobile, m.email, e.photograph, e.twitter, e.ig, e.fb, e.linkedin, e.designation_order FROM exco e INNER JOIN members m ON e.member_id=m.id WHERE e.year_id = '$curentYearID' ORDER BY e.designation_order";

$sql_loadPastPresidents = "SELECT m.first_name, m.last_name, e.designation, m.mobile, m.email, e.photograph, e.twitter, e.ig, e.fb, e.linkedin, y.display as year FROM exco e INNER JOIN members m ON e.member_id=m.id INNER JOIN years y ON e.year_id=y.id WHERE e.year_id != '$curentYearID' AND e.designation_order = '1' ORDER BY e.year_id DESC";

$sql_presidentMesssage = "SELECT * FROM president_message WHERE year_id = '$curentYearID' ORDER BY id DESC LIMIT 1";

$sql_ImmediatePassPresidentMesssage = "SELECT * FROM immediate_pass_president_message WHERE year_id = '$curentYearID' ORDER BY id DESC LIMIT 1";

//Get Project Data
$sql_getProjectCount = "SELECT count(id) as project_count FROM projects;";
$result_projectCount = mysqli_query($connection, $sql_getProjectCount);
$row_projectCount = mysqli_fetch_assoc($result_projectCount);
$projectCount = $row_projectCount['project_count'];

$sql_getLeterst3Projects = "SELECT * FROM projects WHERE status='1' ORDER by id DESC LIMIT 3;";

$sql_getAllProjects = "SELECT * FROM projects WHERE status='1' ORDER by id DESC LIMIT $projectCount OFFSET 3;";

$sql_loadProvince = "SELECT * FROM provinces";
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Colombo Heroes</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/leo-logo.png" rel="icon">
        <link href="assets/img/leo-logo.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">

    </head>

    <body>

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top ">
            <div class="container d-flex align-items-center">

                <h1 class="logo me-auto"><a href="index.php">Leo Club of Colombo Heroes</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

                <nav id="navbar" class="navbar">
                    <ul>
                        <!--<li><a class="nav-link scrollto" href="#about">About</a></li>-->
                        <li class="dropdown"><a href="#about"><span>About</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="#president-message">President Message</a></li>
                                <li><a href="#ipp-message">Past President Message</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#"><span>Leos</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="#team">Executive Board</a></li>
                                <li><a href="#ipps">Past Presidents</a></li>
                                <li><a target="_blank" href="https://bit.ly/3JaQRzO">E-Directory</a></li>
                                <li><a class="nav-link scrollto" href="#join-newsletter">Newsletters</a></li>
                            </ul>
                        </li>
                        <li><a class="nav-link scrollto" href="#">Achievements</a></li>
                        <li><a class="nav-link scrollto" href="#services">Services</a></li>
                       
                        <li><a class="nav-link scrollto" href="#contact">Reach Us</a></li>
                        <li><a class="nav-link scrollto" href="#">Shop Now</a></li>
                        <li><a class="getstarted scrollto" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->

        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                        <h1><?php echo $row_configurations['title']; ?></h1>
                        <h2><?php echo $row_configurations['slogan']; ?></h2>
                        <div class="d-flex justify-content-center justify-content-lg-start">
                            <button type="button" class="btn-get-started" data-bs-toggle="modal" data-bs-target="#registrationFormModal">
                                Be a Part of Us
                            </button>
                            <a href="<?php echo $row_configurations['video_link']; ?>" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                        <img src="assets/img/leo-logo.png" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>
        </section><!-- End Hero -->

        <main id="main">

            <!-- ======= Clients Section ======= -->
            <section id="clients" class="clients section-bg">
                <div class="container">

                    <div class="row" data-aos="zoom-in">

                        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
                        </div>

                        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="assets/img/clients/logo-dinethwa.png" class="img-fluid" alt="">
                        </div>

                        <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                            <img src="assets/img/clients/client-7.png" class="img-fluid" alt="">
                        </div>


                    </div>

                </div>
            </section><!-- End Cliens Section -->

            <!-- ======= About Us Section ======= -->
            <section id="about" class="about">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>About Us</h2>
                    </div>

                    <div class="row content">
                        <div class="col-lg-12">
                            <p>
                                We are the official youth program of Lions Clubs International. Our purpose is to provide an opportunity for youngsters to address the physical and social needs of their communities, enhance the knowledge and skills in them that will assist them in personal development and to promote better relations worldwide through a framework of friendship and service. It offers something of singular and enduring value: the chance to be part of a global network of youngsters who have the talent and the drive to change the world. We believe in the power of community action to make a global impact and together, we have the capacity and the resources to achieve almost anything. We are Leo Club of Colombo Heroes.
                            </p>
                        </div>
<!--                        <div class="col-lg-6">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                                <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
                                <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0">
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                            <a href="#" class="btn-learn-more">Learn More</a>
                        </div>-->
                    </div>

                </div>
            </section><!-- End About Us Section -->

            <!-- ======= President Message Section ======= -->
            <?php
            $result_PresidentMessage = mysqli_query($connection, $sql_presidentMesssage);
            $row_PresidentMessage = mysqli_fetch_assoc($result_PresidentMessage);
            ?>
            <section id="president-message" class="why-us section-bg">
                <div class="container-fluid" data-aos="fade-up">

                    <div class="section-title">
                        <h2>President Message</h2>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                            <div class="content">
                                <?php echo $row_PresidentMessage['message']; ?>
                            </div>

                        </div>

                        <div class="col-lg-6 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets/img/president_messages/<?php echo $row_PresidentMessage['image']; ?>");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
                    </div>

                </div>
            </section><!-- End Why Us Section -->

            <!-- ======= Immediate Past President Message ======= -->
            <?php
            $result_ImmediatePassPresidentMessage = mysqli_query($connection, $sql_ImmediatePassPresidentMesssage);
            $row_ImmediatePassPresidentMessage = mysqli_fetch_assoc($result_ImmediatePassPresidentMessage);
            ?>
            <section id="ipp-message" class="skills">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Immediate Past President Message</h2>
                    </div>



                    <div class="row">

                        <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="200">
                            <img src="assets/img/Immediate_Pass_president_messages/<?php echo $row_ImmediatePassPresidentMessage['image']; ?>" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="200">

                            <?php echo $row_ImmediatePassPresidentMessage['message']; ?>

                        </div>
                    </div>

                </div>
            </section><!-- End Skills Section -->

            <!-- ======= Services Section ======= -->
            <section id="services" class="services section-bg">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Services</h2>
                        <p>
                            The Leos of Colombo Heroes work on numerous projects involving health care, the elderly, children, individuals with disabilities, literacy and education, and self-improvement. Below are a few of our key projects where we are recognized for being active, inventive, positive, and eager to take leadership in work interactions. 
                        </p>
                    </div>

                    <section class="pt-5 pb-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">

                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="row">
                                                    <?php
                                                    $result_getLeterst3Projects = mysqli_query($connection, $sql_getLeterst3Projects);
                                                    if (mysqli_num_rows($result_getLeterst3Projects) > 0) {

                                                        $i = 1;

                                                        while ($row = mysqli_fetch_assoc($result_getLeterst3Projects)) {
                                                            ?>
                                                            <div class="col-md-4 mb-3">
                                                                <div class="card">                                                     
                                                                    <img class="img-fluid" alt="<?php echo $row['title']; ?>" src="assets/img/projects/<?php echo $row['image']; ?>">
                                                                    <div class="card-body d-flex flex-column" style="min-height: 300px;">
                                                                        <h4 class="card-title"><?php echo $row['title']; ?></h4>
                                                                        <p class="card-text">
                                                                            <?php echo $row['description']; ?>    
                                                                        </p>
                                                                        <div class="d-grid gap-2 mt-auto">
                                                                            <a href="<?php echo $row['fb']; ?>" target="_blank" class="btn btn-primary" type="button">View On Facebook</a>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            $result_getAllProjects = mysqli_query($connection, $sql_getAllProjects);
                                            if (mysqli_num_rows($result_getAllProjects) > 0) {

                                                $i = 0;

                                                while ($row = mysqli_fetch_assoc($result_getAllProjects)) {
                                                    if ($i == 0) {
                                                        ?>
                                                        <div class="carousel-item">
                                                            <div class="row">
                                                                <?php
                                                            }
                                                            ?>
                                                            <div class="col-md-4 mb-3">
                                                                <div class="card">                                                     
                                                                    <img class="img-fluid" alt="<?php echo $row['title']; ?>" src="assets/img/projects/<?php echo $row['image']; ?>">
                                                                    <div class="card-body d-flex flex-column" style="min-height: 300px;">
                                                                        <h4 class="card-title"><?php echo $row['title']; ?></h4>
                                                                        <p class="card-text">
                                                                            <?php echo $row['description']; ?>    
                                                                        </p>
                                                                        <div class="d-grid gap-2 mt-auto">
                                                                            <a href="<?php echo $row['fb']; ?>" target="_blank" class="btn btn-primary" type="button">View On Facebook</a>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <?php
                                                            $i++;

                                                            if ($i == 3) {
                                                                ?>

                                                            </div>
                                                        </div>

                                                        <?php
                                                        $i = 0;
                                                    }
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">

                                </div>
                                <div class="col-6 text-right aligns-items-center">
                                    <a class="btn btn-primary mb-3 mr-1" data-bs-target="#carouselExampleIndicators2" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="btn btn-primary mb-3 " data-bs-target="#carouselExampleIndicators2" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>

            </section><!-- End Services Section -->

            <!-- ======= Cta Section ======= -->
            <section id="cta" class="cta">
                <div class="container" data-aos="zoom-in">

                    <div class="row">
                        <div class="col-lg-9 text-center text-lg-start">
                            <h3>Call To Action</h3>
                            <p> Be a part of us and let’s server the community together? 
                                <br><?php echo $row_configurations['slogan']; ?></p>
                        </div>
                        <div class="col-lg-3 cta-btn-container text-center">
                            <a class="cta-btn align-middle" target="_blank" href="https://wa.me/+94707437637?text=Hello, How Can I Be a Colombo Hero?">Call To Action</a>
                        </div>
                    </div>

                </div>
            </section><!-- End Cta Section -->

            <!--             ======= Portfolio Section ======= 
                        <section id="portfolio" class="portfolio">
                            <div class="container" data-aos="fade-up">
            
                                <div class="section-title">
                                    <h2>Portfolio</h2>
                                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                                </div>
            
                                <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                                    <li data-filter="*" class="filter-active">All</li>
                                    <li data-filter=".filter-app">App</li>
                                    <li data-filter=".filter-card">Card</li>
                                    <li data-filter=".filter-web">Web</li>
                                </ul>
            
                                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            
                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                        <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt=""></div>
                                        <div class="portfolio-info">
                                            <h4>App 1</h4>
                                            <p>App</p>
                                            <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
                                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
            
                                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                                        <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt=""></div>
                                        <div class="portfolio-info">
                                            <h4>Web 3</h4>
                                            <p>Web</p>
                                            <a href="assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
            
                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                        <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt=""></div>
                                        <div class="portfolio-info">
                                            <h4>App 2</h4>
                                            <p>App</p>
                                            <a href="assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
                                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
            
                                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                                        <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt=""></div>
                                        <div class="portfolio-info">
                                            <h4>Card 2</h4>
                                            <p>Card</p>
                                            <a href="assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
                                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
            
                                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                                        <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt=""></div>
                                        <div class="portfolio-info">
                                            <h4>Web 2</h4>
                                            <p>Web</p>
                                            <a href="assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
            
                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                        <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt=""></div>
                                        <div class="portfolio-info">
                                            <h4>App 3</h4>
                                            <p>App</p>
                                            <a href="assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
                                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
            
                                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                                        <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt=""></div>
                                        <div class="portfolio-info">
                                            <h4>Card 1</h4>
                                            <p>Card</p>
                                            <a href="assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
                                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
            
                                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                                        <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt=""></div>
                                        <div class="portfolio-info">
                                            <h4>Card 3</h4>
                                            <p>Card</p>
                                            <a href="assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
                                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
            
                                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                                        <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt=""></div>
                                        <div class="portfolio-info">
                                            <h4>Web 3</h4>
                                            <p>Web</p>
                                            <a href="assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                                            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
            
                                </div>
            
                            </div>
                        </section> End Portfolio Section -->

            <!-- ======= Team Section ======= -->
            <section id="team" class="team section-bg">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>EXCO <?php echo $curentYear; ?></h2>
                        <p>
                            We are delighted to introduce the Colombo Heroes Leo Club Executive Committee for the Leoistic Year 2022–2023. Congratulations to the dynamic group of young leaders that will carry on the Leo Club of Colombo Heroes tradition for another fantastic year!
                        </p>
                    </div>

                    <div class="row">

                        <?php
                        $result_exco = mysqli_query($connection, $sql_loadExco);
                        if (mysqli_num_rows($result_exco) > 0) {

                            $i = 1;

                            while ($row = mysqli_fetch_assoc($result_exco)) {

                                $namePrefix = $row['designation_order'] == "0" ? "Lion" : "Leo";
                                ?>

                                <div class="col-lg-6 mt-4">
                                    <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="300">
                                        <div class="pic"><img src="assets/img/team/<?php echo $row['photograph']; ?>" class="img-fluid" alt=""></div>
                                        <div class="member-info">
                                            <h4><?php echo $namePrefix . ' ' . $row['first_name'] . ' ' . $row['last_name']; ?></h4>
                                            <span><?php echo $row['designation']; ?></span>

                                            <ul style="list-style-type: none;"> 
                                                <li><i class="ri-phone-fill" aria-hidden="true"></i> <?php echo $row['mobile']; ?></li>
                                                <li><i class="ri-mail-fill" aria-hidden="true"></i>  <?php echo $row['email']; ?></li>
                                            </ul>
                                            <div class="social">
                                                <a href="<?php echo $row['twitter']; ?>" target="_blank"><i class="ri-twitter-fill"></i></a>
                                                <a href="<?php echo $row['fb']; ?>" target="_blank"><i class="ri-facebook-fill"></i></a>
                                                <a href="<?php echo $row['ig']; ?>" target="_blank"><i class="ri-instagram-fill"></i></a>
                                                <a href="<?php echo $row['linkedin']; ?>" target="_blank"> <i class="ri-linkedin-box-fill"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                        ?>

                    </div>

                </div>
            </section><!-- End Team Section -->


            <!-- ======= Team Section ======= -->
            <section id="ipps" class="team">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Past Presidents</h2>
                    </div>

                    <div class="row">

                        <?php
                        $result_exco = mysqli_query($connection, $sql_loadPastPresidents);
                        if (mysqli_num_rows($result_exco) > 0) {

                            $i = 1;

                            while ($row = mysqli_fetch_assoc($result_exco)) {
                                ?>

                                <div class="col-lg-6 mt-4">
                                    <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="300">
                                        <div class="pic"><img src="assets/img/team/<?php echo $row['photograph']; ?>" class="img-fluid" alt=""></div>
                                        <div class="member-info">
                                            <h4>Leo <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h4>
                                            <span><?php echo $row['year']; ?></span>

                                            <ul style="list-style-type: none;"> 
                                                <li><i class="ri-phone-fill" aria-hidden="true"></i> <?php echo $row['mobile']; ?></li>
                                                <li><i class="ri-mail-fill" aria-hidden="true"></i>  <?php echo $row['email']; ?></li>
                                            </ul>
                                            <div class="social">
                                                <a href="<?php echo $row['twitter']; ?>" target="_blank"><i class="ri-twitter-fill"></i></a>
                                                <a href="<?php echo $row['fb']; ?>" target="_blank"><i class="ri-facebook-fill"></i></a>
                                                <a href="<?php echo $row['ig']; ?>" target="_blank"><i class="ri-instagram-fill"></i></a>
                                                <a href="<?php echo $row['linkedin']; ?>" target="_blank"> <i class="ri-linkedin-box-fill"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                        ?>

                    </div>

                </div>
            </section><!-- End Team Section -->




            <!-- ======= Contact Section ======= -->
            <section id="contact" class="contact section-bg">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Contact</h2>
                        <p>
                            We are here to help and answer any question you might have. We'd love to hear from you.
                        </p>
                    </div>

                    <div class="row">

                        <div class="col-lg-5 d-flex align-items-stretch">
                            <div class="info">
                                <div class="address">
                                    <i class="bi bi-geo-alt"></i>
                                    <h4>Location:</h4>
                                    <p>44/44, Veediya Bandara Mawatha, Ethul Kotte</p>
                                </div>

                                <div class="email">
                                    <i class="bi bi-envelope"></i>
                                    <h4>Email:</h4>
                                    <p>reach@colomboheroes.org</p>
                                </div>

                                <div class="phone">
                                    <i class="bi bi-phone"></i>
                                    <h4>Call:</h4>
                                    <p>+9470 743 7637</p>
                                </div>

                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1417.48035665576!2d79.90347339663573!3d6.902002555803501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2591ca1c38b2d%3A0x3ed403804ed29688!2sVGC%20-%20Kotte!5e0!3m2!1sen!2slk!4v1656875983982!5m2!1sen!2slk" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                            </div>

                        </div>

                        <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Your Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Your Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Subject</label>
                                    <input type="text" class="form-control" name="subject" id="subject" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Message</label>
                                    <textarea class="form-control" name="message" rows="10" required></textarea>
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center"><button type="submit">Send Message</button></div>
                            </form>
                        </div>

                    </div>

                </div>
            </section><!-- End Contact Section -->

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        <footer id="footer">

            <div class="footer-newsletter" id="join-newsletter">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h4>Join Our Newsletter</h4>
                            <p>
                                Subscribe now to get updates about the latest events straight to your inbox.
                            </p>
                            <form action="" method="post">
                                <input type="email" name="email"><input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h3>Leo Club of Colombo Heroes</h3>
                            <p>
                                44/44<br>
                                Veediya Bandara Mawatha, Ethul Kotte<br>
                                Sri Lanka <br><br>
                                <strong>Phone:</strong> +9470 743 7637<br>
                                <strong>Email:</strong> reach@colomboheroes.org<br>
                            </p>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <!--                            <h4>Useful Links</h4>
                                                        <ul>
                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                                                        </ul>-->
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <!--                            <h4>Our Services</h4>
                                                        <ul>
                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                                                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                                                        </ul>-->
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Social Networks</h4>
                            <p>
                                Why don't you stay updated?<br>Just follow us!
                            </p>
                            <div class="social-links mt-3">
                                <a href="https://twitter.com/Leosofch" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="https://www.facebook.com/LeoClubofColomboHeroes" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="https://www.instagram.com/leosofch/" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" target="_blank" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="https://www.linkedin.com/in/leo-club-of-colombo-heroes-b4a745216" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container footer-bottom clearfix">
                <div class="copyright">
                    &copy; Copyright <strong><span>LCCH</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Designed by <a href="https://www.facebook.com/dineth.jayasekera.5">Dineth Jayasekera</a>
                </div>
            </div>
        </footer><!-- End Footer -->

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!--Registration Form Modal -->

        <div class="modal fade" id="registrationFormModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="registrationFormModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Membership Form
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="membership_form" method="post">
                            <div class="row">
                                <div class="mb-3 col-lg-12">
                                    <label for="firstName" class="form-label"><b>Note</b></label>
                                    <br>
                                    <small class="text-muted">
                                        Please note that the Annual Membership Fee is LKR.2000.00.
                                        Participants are provided with a Club PIN, Member Certificate and other resources. In Addition to the member fee, there will be a charge of LKR.1500 for the Club T-shirt and LKR.1500 for the Club Pin.
                                        <br>
                                        <b style="color: red;">Red Color Fields Are Mandatory.</b>
                                    </small>
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="firstName" class="form-label"><b class="required">First Name</b></label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Dineth" required>
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="middleName" class="form-label"><b>Middle Name</b></label>
                                    <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Wasuka">
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="lastName" class="form-label"><b class="required">Last Name</b></label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Jayasekera" required>
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="mostUsedName" class="form-label"><b>Most Used Name</b></label>
                                    <input type="text" class="form-control" id="mostUsedName" name="mostUsedName" placeholder="Most Used Name">
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="email" class="form-label"><b class="required">Email</b></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="dob" class="form-label"><b class="required">Date of Birth</b></label>
                                    <input type="date" class="form-control" id="dob" name="dob" placeholder="" required>
                                </div>

                                <!--                                <div class="mb-3 col-lg-6">
                                                                    <label for="address" class="form-label"><b class="required">Address</b></label>
                                                                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                                                </div>-->

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">

                                        <input type="text" class="form-control" id="address_line1" name="address_line1" placeholder="Address Line 1" required>

                                        <label for="floatingName" class="required">Address Line 1</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">

                                        <input type="text" class="form-control" id="address_line2" name="address_line2" placeholder="Address Line 2" required>

                                        <label for="floatingName" class="required">Address Line 2</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating mb-3">

                                        <input type="text" class="form-control" id="address_line3" name="address_line3" placeholder="Address Line 3">

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
                                        <label for="floatingSelect" class="required">Province</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="district" name="district" aria-label="District" onchange="loadCities()" required>
                                            <option selected>Please Select</option>

                                        </select>
                                        <label for="floatingSelect" class="required">District</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="city" name="city" aria-label="City" required>
                                            <option selected>Please Select</option>

                                        </select>
                                        <label for="floatingSelect" class="required">City</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" required>
                                        <label for="floatingName" class="required">Postal Code</label>
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

                                <div class="mb-3 col-lg-6">
                                    <label for="working_place" class="form-label"><b>Working Place (If still a student, leave blank)</b></label>
                                    <input type="text" class="form-control" id="working_place" name="working_place" placeholder="Working Place">
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="designation" class="form-label"><b>If Working, Designation?</b></label>
                                    <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="telephone_residence" class="form-label"><b class="required">Telephone - Residence</b></label>
                                    <input type="text" class="form-control" id="telephone_residence" name="telephone_residence" placeholder="Telephone - Residence" required>
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="mobile" class="form-label"><b class="required">Mobile</b></label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" required>
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="secondary_mobile" class="form-label"><b>Secondary Mobile</b></label>
                                    <input type="text" class="form-control" id="secondary_mobile" name="secondary_mobile" placeholder="Secondary Mobil">
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="nic" class="form-label"><b class="required">National Identity Card Number</b></label>
                                    <input type="text" class="form-control" id="nic" name="nic" placeholder="National Identity Card Number" required>
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="school" class="form-label"><b>School / University</b></label>
                                    <input type="text" class="form-control" id="school" name="school" placeholder="School / Universit">
                                </div>

                                <div class="mb-3 col-lg-4">
                                    <label for="referral" class="form-label"><b>Referral</b></label>
                                    <input type="text" class="form-control" id="referral" name="referral" placeholder="Referral">
                                </div>

                                <div class="mb-3 col-lg-12">
                                    <label for="referral" class="form-label"><b class="required">Photograph</b></label>
                                    <input type="file" class="form-control" id="photograph" name="photograph" placeholder="Photograph" required>
                                </div>


                            </div>
                            <input type="submit" id="btn_membership_form_submit" style="display: none;"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="$('#btn_membership_form_submit').trigger('click');">Register</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Login Model-->
        <div class="modal fade" id="loginModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Login
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="login_form" method="post">
                            <div class="row">

                                <div class="mb-3 col-lg-6">
                                    <label for="username" class="form-label"><b>Username</b></label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                </div>

                                <div class="mb-3 col-lg-6">
                                    <label for="password" class="form-label"><b>Password</b></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>

                                <input type="submit" id="btn_login_form_submit" style="display: none;"/>

                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="$('#btn_login_form_submit').trigger('click');">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--Notification Toast Message-->

        <div class="position-fixed top-0 end-0 translate-middle- p-3" style="z-index: 20;margin-top: 80px;">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header" style="background-color: #33691E">
                    <img src="assets/img/leo-logo-favicon3.jpeg" class="rounded me-2" alt="...">
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
                    <img src="assets/img/leo-logo-favicon3.jpeg" class="rounded me-2" alt="...">
                    <strong class="me-auto" style="color: white">Notification</strong>
                    <small style="color: white">Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="toast-body-error" style="background-color: #FF3D00; color: white">
                    Hello, world! This is a toast message.
                </div>
            </div>
        </div>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>

                                /**
                                 * Membership form submit
                                 */

                                $(document).ready(function (e) {
                                    $("#membership_form").on('submit', (function (e) {

                                        $("#registrationFormModal").hide();

                                        e.preventDefault();
                                        e.stopImmediatePropagation();
                                        $.ajax({

                                            url: "./controllers/membershipSubmit.php", // Url to which the request is send
                                            type: "POST", // Type of request to be s", // Url to which the request is send
                                            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                            contentType: false, // The content type used when sending data to the server.
                                            cache: false, // To unable request pages to be cached
                                            processData: false, // To send DOMDocument or non processed data file it is set to false
                                            success: function (data)   // A function to be called if request succeeds
                                            {
                                                if (data == "Registration Failed") {
                                                    var toastLive = document.getElementById('liveToastError');
                                                    var toastMessage = document.getElementById('toast-body-error');

                                                    toastMessage.innerHTML = data;
                                                    var toast = new bootstrap.Toast(toastLive);
                                                    toast.show();
                                                } else {
                                                    var toastLive = document.getElementById('liveToast');
                                                    var toastMessage = document.getElementById('toast-body');

                                                    toastMessage.innerHTML = data;
                                                    var toast = new bootstrap.Toast(toastLive);
                                                    toast.show();
                                                }

                                                $("#firstName").val(null);
                                                $("#middleName").val(null);
                                                $("#lastName").val(null);
                                                $("#mostUsedName").val(null);
                                                $("#email").val(null);
                                                $("#dob").val(null);
                                                $("#address").val(null);
                                                $("#working_place").val(null);
                                                $("#designation").val(null);
                                                $("#telephone_residence").val(null);
                                                $("#mobile").val(null);
                                                $("#secondary_mobile").val(null);
                                                $("#nic").val(null);
                                                $("#school").val(null);
                                                $("#referral").val(null);
                                            }
                                        });
                                    })
                                            );
                                });


                                /**
                                 * Login form submit
                                 */

                                $(document).ready(function (e) {
                                    $("#login_form").on('submit', (function (e) {

                                        $("#loginModal").hide();

                                        e.preventDefault();
                                        e.stopImmediatePropagation();
                                        $.ajax({

                                            url: "./controllers/login.php", // Url to which the request is send
                                            type: "POST", // Type of request to be s", // Url to which the request is send
                                            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                            contentType: false, // The content type used when sending data to the server.
                                            cache: false, // To unable request pages to be cached
                                            processData: false, // To send DOMDocument or non processed data file it is set to false
                                            success: function (data)   // A function to be called if request succeeds
                                            {
                                                if (data == "Failed") {
                                                    var toastLive = document.getElementById('liveToastError');
                                                    var toastMessage = document.getElementById('toast-body-error');

                                                    toastMessage.innerHTML = "Invalid Username or Password";
                                                    var toast = new bootstrap.Toast(toastLive);
                                                    toast.show();
                                                } else {
                                                    window.location.replace("https://colomboheroes.org/admin");
                                                }

                                            }
                                        });
                                    })
                                            );
                                });


                                function loadDistricts() {

                                    var id = $('#province').val();
                                    const formData = new FormData();
                                    formData.append("province_id", id);

                                    $.ajax({

                                        url: "./admin/controllers/loadAddressDetails.php", // Url to which the request is send
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

                                        url: "./admin/controllers/loadAddressDetails.php", // Url to which the request is send
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


        </script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

        <?php if (isset($_GET['loginInvalid'])) { ?>
            <script>

                                var toastLive = document.getElementById('liveToastError');
                                var toastMessage = document.getElementById('toast-body-error');

                                toastMessage.innerHTML = "Please Login First";
                                var toast = new bootstrap.Toast(toastLive);
                                toast.show();

            </script>
        <?php } ?>
    </body>

</html>