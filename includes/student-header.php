<?php  
include 'config/config.php';
include 'includes/classes/Student.php';

// If there is session, set the ic as session 
if(isset($_SESSION['ic'])){
    $LoggedInIC = $_SESSION['ic'];
    $student = new student($con,$LoggedInIC);

    if($_SESSION['login_type']!='student'){
        header("Location: login.php");
    }
}else{ //if there is no Session, send them to login page
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Jquery CDN --><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Favicon --><link rel="icon" type="image/x-icon" href="assets/images/ghgmonitoringlogo.png">
    <!-- Bootstrap CSS CDN --><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap ICON --><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- D3JS --><script src="https://d3js.org/d3.v4.js"></script>
    <!-- Datatable CSS CDN --><link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Datatable JS CDN --><script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- ChartJS CDN --><script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/css/student.css">
    <title>Student | <?php echo $pageTitle; ?></title>
</head>

<body>
<script>
	// prevent form resubmission
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>

    <!-- Outermost Container -->
    <div class="container-fluid">
        <!--Outer Row -->
        <div class="row flex-nowrap">

            <!--////////////////////
                Sidebar Start
            ////////////////////-->

            <div class="col-auto col-md-3 col-lg-3 col-xl-2 px-sm-2 py-4 pe-4 bg-white" id="sidebar", style="width: 250px;">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <!-- Logo Area -->
                    <a class="mx-auto" id="logo" href="student-dashboard.php"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline"><img src="assets/images/ghgmonitoring3.png" alt="GHG Logo"
                                width="150"></span>
                        <span class="fs-5 d-sm-none"><img src="assets/images/ghgmonitoringlogo" alt="GHG Logo"
                                width="30"></span>
                    </a>

                    <!-- Menu Start -->
                    <ul class="mx-auto nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start mt-4"
                        id="menu">
                        <li class="nav-item mt-2">
                            <a href="student-dashboard.php" class="nav-link  menu_a">
                                <i class="fs-5 bi bi-house"></i> <span
                                    class="fs-6 ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item mt-2">
                            <a href="weatherupdates.php" class="nav-link menu_a">
                                <i class="fs-5 bi bi-cloud-drizzle"></i><span
                                    class="fs-6 ms-1 d-none d-sm-inline">Weather Updates</span>
                            </a>
                        </li>

                            <li class="nav-item mt-2">
                                <a href="explore.php" class="nav-link menu_a">
                                    <i class="fs-5 bi bi-compass"></i><span
                                        class="fs-6 ms-1 d-none d-sm-inline">Explore</span>
                                </a>
                            </li>

                            <li class="nav-item mt-2">
                                <a href="newchart.php" class="nav-link menu_a">
                                    <i class="bi bi-file-earmark-bar-graph"></i><span
                                        class="fs-6 ms-1 d-none d-sm-inline">Arduino Charts</span>
                                </a>
                            </li>

                        <li class="nav-item mt-2">
                            <a href="data-forecast.php" class="nav-link  menu_a">
                                <i class="fs-5 bi bi-clipboard-data"></i> <span
                                    class="fs-6 ms-1 d-none d-sm-inline">Data Forecast</span>
                            </a>
                        </li>

                        <li class="nav-item mt-2">
                            <a href="student-report.php" class="nav-link  menu_a">
                                <i class="fs-5 bi bi-file-earmark"></i> <span
                                    class="fs-6 ms-1 d-none d-sm-inline">Report</span>
                            </a>
                        </li>

                    </ul>
                    <!-- Menu End -->
                    <hr>

                   <!-- Profile Start -->
                   <div class="dropdown w-100 mb-5 py-md-2" id="profile">
                            <a href="#" class=" text-decoration-none d-flex align-items-center justify-content-center"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="my-auto">
                                    <img src=<?php echo $student->getProfilePic()?> alt="profile" class="rounded-circle small_profile_picture" width="50" height="50">
                                </div>

                                <span class="d-none d-sm-inline ps-1">
                                    <div class="ms-1">
                                        <h6 class="py-0 my-0"><?php echo $student->getName()?></h6>
                                        <small class="text-muted py-0 my-0"><Student></small>
                                    </div>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">
                                <li>
                                    <a class="dropdown-item mygreen" href="profile.php">
                                        <i class="fs-5 bi bi-person mygreen"></i>
                                        <span class="ms-2 mygreen">Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="includes/controllers/logout.php">
                                        <i class="fs-5 bi bi-box-arrow-right"></i>
                                        <span class="ms-2">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Profile End -->
                    </div>
                </div>


            <!--////////////////////
                Sidebar End
            ////////////////////-->

            <!--////////////////////
                Right Container Start
            ////////////////////-->
            <div class="py-4 mx-4 col" id="right_container">

                <!--////////////////////
                    Top Bar Start
                ////////////////////-->

                <div class="container-fluid ps-2" id="topbar_container">
                    <nav class="navbar navbar-expand-lg navbar-light mt-3" id="topbar">
                        <div class="container-fluid">
                            <h2 class="navbar-brand fw-bolder fs-2 mydarkgreen" id="page_title"><?php echo $pageTitle; ?></h2>

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <span class="collapse navbar-collapse" id="navbarSupportedContent">
                                
                                <ul class="navbar-nav ms-auto align-items-center">
                                    
                                    <!-- topbar profile start -->
                                    <li class="nav-item dropdown ms-auto me-1">
                                        <a href="profile.php" class="text-decoration-none" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="text-nowrap glassmorphism p-2" id="topbar_profile">
                                                <div class="d-flex">
                                                    <div class="my-auto">
                                                        <img class="rounded-circle small_profile_picture" src=<?php echo $student->getProfilePic()?> alt="profile picture" height="40">
                                                    </div>
                                                    <div class="ms-1">
                                                        <h6 class="py-0 my-0"><?php echo $student->getName()?></h6>
                                                        <small class="text-muted py-0 my-0">Student</small>
                                                    </div>
                                                </div>
                                            </div>
                                         </a>
                                         <ul class="dropdown-menu mt-1"
                                            aria-labelledby="dropdownUser2">
                                            <li>
                                                <a class="dropdown-item text-danger" href="includes/controllers/logout.php">
                                                    <i class="fs-5 bi bi-box-arrow-right"></i>
                                                    <span class="ms-2">Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- topbar profile end -->

                                </ul>
                                <!-- <a href="https://mail.google.com/mail/u/0/?view=cm&amp;fs=1&amp;source=mailto&amp;to=itsupport@bonds.com" target="_blank"  title="Send Email" class="mx-1 btn btn_mygreen">
                                    <i class="fa-solid fa-file me-2"></i>Support</a> -->
                            </span>
                        </div>
                    </nav>
                </div>


                <!--////////////////////
                     Top Bar End
                ////////////////////-->

                <!-- Container Under Right Container -->
                <div class="container main_content_container">
                    <div class="row">

                        <!-- ***************************************************************
                                     PUT YOUR CONTENT BELOW 
                 *******************************************************************-->
