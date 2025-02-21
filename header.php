<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- FAVICONS ICON -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    <!-- PAGE TITLE HERE -->
    <title>Placement-Portal</title>
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="css/plugins.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/templete.css">
    <link class="skin" rel="stylesheet" type="text/css" href="css/skin/skin-1.css">
    <link rel="stylesheet" href="plugins/datepicker/css/bootstrap-datetimepicker.min.css" />
    <!-- Revolution Slider Css -->
    <link rel="stylesheet" type="text/css" href="plugins/revolution/revolution/css/layers.css">
    <link rel="stylesheet" type="text/css" href="plugins/revolution/revolution/css/settings.css">
    <link rel="stylesheet" type="text/css" href="plugins/revolution/revolution/css/navigation.css">
    <!-- Revolution Navigation Style -->
     <style>
        .logo-header {
    width: auto; /* Or a specific width like 200px, or 100% if it should fill its parent */
    white-space: nowrap; /* Prevents wrapping */
    overflow: hidden; /* Hide any overflowing text */
    text-overflow: ellipsis; /* Add "..." if the text overflows */
    display: inline-block; /* Or block, flex, etc. if needed for layout */
    margin-top: 25px;
}
     </style>
</head>

<body id="bg">
    <div id="loading-area"></div>
    <div class="page-wraper">
        <!-- header -->
        <header class="site-header mo-left header fullwidth">
            <!-- main header -->
            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar clearfix">
                    <div class="container clearfix">
                        <!-- website logo -->
                        <div class="logo-header mostion">
                            <a href="/placement-portal/index.php" style="font-size:20px">Placement Portal</a>
                        </div> 
                        <!-- nav toggle button -->
                        <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <!-- extra nav -->
                        <div class="extra-nav">
                            <?php if (isset($_SESSION['user'])) : ?>
                                <div class="extra-cell">
                                    <?php echo $_SESSION['user']->name ?>
                                    <a href="logout.php" class="site-button"><i class="fa fa-lock"></i> logout</a>
                                </div>
                            <?php else : ?>
                                <div class="extra-cell">
                                    <a href="./register-choice.php" class="btn btn-primary"><i class="fa fa-user"></i> Sign Up</a>
                                    <a href="login.php" class="btn btn-primary"><i class="fa fa-lock"></i> login</a>
                                </div>
                            <?php endif ?>
                        </div>
                        <!-- Quik search -->
                        <div class="dez-quik-search bg-primary">
                            <form action="#">
                                <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                                <span id="quik-search-remove"><i class="flaticon-close"></i></span>
                            </form>
                        </div>
                        <!-- main nav -->
                        <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="/placement-portal/index.php">Home</a>
                                </li>
                                <?php if (isset($_SESSION['user']) && $_SESSION['type']  == 'user') : ?>
                                    <li>
                                        <a href="./my-jobs.php">My Applied Jobs</a>
                                    </li>
                                <?php endif ?>
                                <?php if (isset($_SESSION['type']) && $_SESSION['type']  == 'recruiter') : ?>
                                    <li>
                                        <a href="./recruiter-dashboard.php">Recruiter Dashboard</a>
                                    </li>
                                <?php endif ?>
                                <?php if (isset($_SESSION['type']) && $_SESSION['type']  == 'recruiter') : ?>
                                    <li>
                                        <a href="./profile.php">Post Job</a>
                                    </li>
                                <?php endif ?>
                                <li>
                                    <a href="./browse-job.php">Current Openings</a>
                                </li>
                                <?php if (isset($_SESSION['user']) && $_SESSION['type']  == 'user') : ?>
                                    <li>
                                        <a href="./candidate-profile.php">Profile</a>
                                    </li>
                                <?php endif ?>
                           
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main header END -->
        </header>
        <!-- header END -->