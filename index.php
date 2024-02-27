<?php

    // Get category details .......................................................
    require_once('connect.php');

    $getcat = mysqli_query($db, "SELECT * FROM reg_category WHERE `status`='1'");

    // .............................................................................
    if ( isset($_POST['conferent_form']) ) {

        $otherName      = trim(mysqli_real_escape_string($db, $_POST['othername']));
        $lastname       = trim(mysqli_real_escape_string($db,$_POST['lastname']));
        $emailadd       = trim(mysqli_real_escape_string($db,$_POST['emailadd']));
        $phonenum       = trim(mysqli_real_escape_string($db,$_POST['phonenum']));
        $memberNo       = trim(mysqli_real_escape_string($db,$_POST['memberNo']));
        $courtNo        = trim(mysqli_real_escape_string($db,$_POST['courtNo']));
        $yearofCall     = trim(mysqli_real_escape_string($db,$_POST['yearofCall']));
        $categoryreg    = trim(mysqli_real_escape_string($db,$_POST['categoryreg']));
        $branchname     = trim(mysqli_real_escape_string($db,$_POST['branchname']));
        $memberRegNo    = 'MULANCON'.date('Y').rand(9,9999);

        if ( !isset($_POST['othername']) || empty($_POST['othername']) || isset($_POST['othername']) =="" ) {
            echo "<script> alert('Other Names Can Not Be Empty !!!'); window.location='index' </script>";
        } elseif ( !isset($_POST['lastname']) || empty($_POST['lastname']) || isset($_POST['lastname']) =="" ) {
            echo "<script> alert('Last Name Can Not Be Empty !!!'); window.location='index' </script>";
        } elseif ( !isset($_POST['emailadd']) || empty($_POST['emailadd']) || isset($_POST['emailadd']) ==""  ) {
            echo "<script> alert('Email Address Can Not Be Empty !!!'); window.location='index' </script>";
        } elseif ( !isset($_POST['phonenum']) || empty($_POST['phonenum']) || isset($_POST['phonenum']) ==""  ) {
            echo "<script> alert('Phone Number Can Not Be Empty !!!'); window.location='index' </script>";
        } elseif ( !isset($_POST['memberNo']) || empty($_POST['memberNo']) || isset($_POST['memberNo']) ==""  ) {
            echo "<script> alert('Member Number Can Not Be Empty !!!'); window.location='index' </script>";
        } elseif ( !isset($_POST['courtNo']) || empty($_POST['courtNo']) || isset($_POST['courtNo']) ==""  ) {
            echo "<script> alert('Court Number Can Not Be Empty !!!'); window.location='index' </script>";
        } elseif ( !isset($_POST['yearofCall']) || empty($_POST['yearofCall']) || isset($_POST['yearofCall']) ==""  ) {
            echo "<script> alert('Year of Call Can Not Be Empty !!!'); window.location='index' </script>";
        } elseif ( !isset($_POST['categoryreg']) || empty($_POST['categoryreg']) || isset($_POST['categoryreg']) ==""  ) {
            echo "<script> alert('Registration Category Can Not Be Empty !!!'); window.location='index' </script>";
        } elseif ( !isset($_POST['branchname']) || empty($_POST['branchname']) || isset($_POST['branchname']) ==""  ) {
            echo "<script> alert('Branch Name Can Not Be Empty !!!'); window.location='index' </script>";
        } else {
        
            $sql = mysqli_query($db, "SELECT othername, lastname FROM users WHERE email='$emailadd' ");

            if ( mysqli_num_rows($sql) < 1) {

                $inst = mysqli_query($db, "INSERT INTO users(member_reg_no,lastname,othername,email,phone,membership_number,s_court_no,year_of_call,category,branch) VALUES('$memberRegNo','$lastname','$otherName','$emailadd','$phonenum','$memberNo','$courtNo','$yearofCall','$categoryreg','$branchname')");

                if ($inst) {

                    session_start();
                    $_SESSION['regemailadd']    = $emailadd ;
                    $_SESSION['regfullname']    = $lastname . ' ' . $otherName;
                    $_SESSION['regfonenum']     = $phonenum;
                    $_SESSION['regmemberno']    = $memberNo;
                    $_SESSION['regcategory']    = $categoryreg;
                    $_SESSION['regmemberID']    = $memberRegNo;
                    
                    echo "<script> alert('Account Successfully Registered, You Will Be Redirected To Payment Page ...'); window.location='payment' </script>";

                } else {

                    echo "<script> alert('Account Successfully Registered, You Will Be Redirected To Payment Page ...'); window.location='index' </script>";
                }

            } else {

                echo "<script> alert('Email Address Already Used !!!'); window.location='index' </script>";
            }

        }
        
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mulan - 2024 Confererence Registration</title>

    <!--vendor css ================================================== -->
    <link rel="stylesheet" type="text/css" href="css/vendor.css">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!--Bootstrap ================================================== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- Style Sheet ================================================== -->
    <link rel="stylesheet" type="text/css" href="styles.css">

    <link rel="shortcut icon" href="images/mulan_icon.png" type="image/x-icon">

    <!-- Google Fonts ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,700;1,300&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">


    <!-- script ================================================== -->
    <script src="js/modernizr.js"></script>

</head>

<body data-bs-spy="scroll" data-bs-target="#header-nav" tabindex="0">


    <nav class="navbar navbar-expand-lg bg-black navbar-light container-fluid py-3 position-fixed ">
        <div class="container">
            <a class="navbar-brand" href="index"><img src="images/mulan-logo.png" alt="logo" class="w-50"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
              
            </div>
            <div class="d-flex mt-5 mt-lg-0 ps-lg-3 align-items-center justify-content-center ">
            <ul class="navbar-nav justify-content-end align-items-center">
                <li class="nav-item">
                    <a class="nav-link px-3 phone-no" href="tel:(+234) 803 360 2636">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M18.3274 22.5001C17.4124 22.5001 16.1271 22.1691 14.2024 21.0938C11.862 19.7813 10.0516 18.5696 7.72383 16.2479C5.47946 14.0049 4.38727 12.5527 2.85868 9.77115C1.1318 6.63052 1.42618 4.98427 1.75524 4.28068C2.14712 3.43974 2.72555 2.93677 3.47321 2.43755C3.89787 2.15932 4.34727 1.92081 4.81571 1.72505C4.86258 1.7049 4.90618 1.68568 4.94508 1.66833C5.17712 1.5638 5.52868 1.40583 5.97399 1.57458C6.27118 1.68615 6.53649 1.91443 6.9518 2.32458C7.80352 3.16458 8.96743 5.03537 9.3968 5.95412C9.68508 6.57333 9.87587 6.98208 9.87633 7.44052C9.87633 7.97724 9.60633 8.39115 9.27868 8.83787C9.21727 8.92177 9.15633 9.00193 9.09727 9.07974C8.74055 9.54849 8.66227 9.68396 8.71383 9.92583C8.81837 10.4119 9.5979 11.859 10.879 13.1372C12.1601 14.4155 13.5654 15.1458 14.0534 15.2499C14.3056 15.3038 14.4438 15.2222 14.9276 14.8529C14.997 14.7999 15.0682 14.7451 15.1427 14.6902C15.6424 14.3185 16.0371 14.0555 16.5612 14.0555H16.564C17.0201 14.0555 17.4106 14.2533 18.0574 14.5796C18.9012 15.0052 20.8282 16.1541 21.6734 17.0068C22.0845 17.4211 22.3137 17.6855 22.4257 17.9822C22.5945 18.429 22.4356 18.7791 22.332 19.0135C22.3146 19.0524 22.2954 19.0951 22.2752 19.1424C22.0779 19.61 21.838 20.0585 21.5585 20.4821C21.0602 21.2274 20.5554 21.8044 19.7126 22.1968C19.2798 22.4015 18.8062 22.5052 18.3274 22.5001Z"
                                fill="#313131" />
                        </svg>
                        (+234) 803 360 2636
                    </a>
                </li>
            </ul>
            <a href="login" class="btn btn-primary ms-md-3"> Login </a>
        </div>
        </div>
    </nav>

    <section id="hero" class="position-relative overflow-hidden py-4" style="background: url(images/hero-bg.avif); opacity:1">
        <!-- <div class="pattern-overlay pattern-right position-absolute">
            <img src="images/pattern-hero.png" alt="pattern">
        </div> -->
        <div class="container py-5 mt-5">
            <div class="row align-items-center py-5">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h6 class="text-white">2024 Confererence Registration</h6>
                    <h2 class="text-white fw-bold display-2">PROCEDURE</h2>
                    <p class="text-white">Step by step process to complete MULAN 2024 Conference registration, do not close the page until you complete the whole process</p>
                    <ul class="list-unstyled">
                        <li class="text-white fw-bold bg-dark p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                                fill="none">
                                <g clip-path="url(#clip0_1_359)">
                                    <path
                                        d="M11.5 0.359375C5.34719 0.359375 0.359375 5.34719 0.359375 11.5C0.359375 17.6528 5.34719 22.6406 11.5 22.6406C17.6528 22.6406 22.6406 17.6528 22.6406 11.5C22.6406 5.34719 17.6528 0.359375 11.5 0.359375ZM11.5 2.51562C16.4653 2.51562 20.4844 6.53393 20.4844 11.5C20.4844 16.4653 16.4661 20.4844 11.5 20.4844C6.5347 20.4844 2.51562 16.4661 2.51562 11.5C2.51562 6.5347 6.53393 2.51562 11.5 2.51562ZM17.7982 8.36746L16.7859 7.34693C16.5762 7.13557 16.2349 7.13418 16.0235 7.34387L9.67375 13.6426L6.98778 10.9349C6.77813 10.7235 6.43681 10.7221 6.22545 10.9318L5.20487 11.9441C4.99352 12.1538 4.99212 12.4951 5.20182 12.7065L9.27987 16.8176C9.48952 17.0289 9.83084 17.0303 10.0422 16.8206L17.7952 9.12983C18.0065 8.92014 18.0079 8.57882 17.7982 8.36746Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_359">
                                        <rect width="23" height="23" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            Fill the form appropriately (all fields are required)
                        </li>
                        <li class="text-white fw-bold bg-dark p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                                fill="none">
                                <g clip-path="url(#clip0_1_359)">
                                    <path
                                        d="M11.5 0.359375C5.34719 0.359375 0.359375 5.34719 0.359375 11.5C0.359375 17.6528 5.34719 22.6406 11.5 22.6406C17.6528 22.6406 22.6406 17.6528 22.6406 11.5C22.6406 5.34719 17.6528 0.359375 11.5 0.359375ZM11.5 2.51562C16.4653 2.51562 20.4844 6.53393 20.4844 11.5C20.4844 16.4653 16.4661 20.4844 11.5 20.4844C6.5347 20.4844 2.51562 16.4661 2.51562 11.5C2.51562 6.5347 6.53393 2.51562 11.5 2.51562ZM17.7982 8.36746L16.7859 7.34693C16.5762 7.13557 16.2349 7.13418 16.0235 7.34387L9.67375 13.6426L6.98778 10.9349C6.77813 10.7235 6.43681 10.7221 6.22545 10.9318L5.20487 11.9441C4.99352 12.1538 4.99212 12.4951 5.20182 12.7065L9.27987 16.8176C9.48952 17.0289 9.83084 17.0303 10.0422 16.8206L17.7952 9.12983C18.0065 8.92014 18.0079 8.57882 17.7982 8.36746Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_359">
                                        <rect width="23" height="23" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            Click on "Save & Pay" Button to proceed to payment page.
                        </li>
                        <li class="text-white fw-bold bg-dark p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                                fill="none">
                                <g clip-path="url(#clip0_1_359)">
                                    <path
                                        d="M11.5 0.359375C5.34719 0.359375 0.359375 5.34719 0.359375 11.5C0.359375 17.6528 5.34719 22.6406 11.5 22.6406C17.6528 22.6406 22.6406 17.6528 22.6406 11.5C22.6406 5.34719 17.6528 0.359375 11.5 0.359375ZM11.5 2.51562C16.4653 2.51562 20.4844 6.53393 20.4844 11.5C20.4844 16.4653 16.4661 20.4844 11.5 20.4844C6.5347 20.4844 2.51562 16.4661 2.51562 11.5C2.51562 6.5347 6.53393 2.51562 11.5 2.51562ZM17.7982 8.36746L16.7859 7.34693C16.5762 7.13557 16.2349 7.13418 16.0235 7.34387L9.67375 13.6426L6.98778 10.9349C6.77813 10.7235 6.43681 10.7221 6.22545 10.9318L5.20487 11.9441C4.99352 12.1538 4.99212 12.4951 5.20182 12.7065L9.27987 16.8176C9.48952 17.0289 9.83084 17.0303 10.0422 16.8206L17.7952 9.12983C18.0065 8.92014 18.0079 8.57882 17.7982 8.36746Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_359">
                                        <rect width="23" height="23" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            The payment form is not editable, click on "Make Payment" button
                        </li>
                        <li class="text-white fw-bold bg-dark p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                                fill="none">
                                <g clip-path="url(#clip0_1_359)">
                                    <path
                                        d="M11.5 0.359375C5.34719 0.359375 0.359375 5.34719 0.359375 11.5C0.359375 17.6528 5.34719 22.6406 11.5 22.6406C17.6528 22.6406 22.6406 17.6528 22.6406 11.5C22.6406 5.34719 17.6528 0.359375 11.5 0.359375ZM11.5 2.51562C16.4653 2.51562 20.4844 6.53393 20.4844 11.5C20.4844 16.4653 16.4661 20.4844 11.5 20.4844C6.5347 20.4844 2.51562 16.4661 2.51562 11.5C2.51562 6.5347 6.53393 2.51562 11.5 2.51562ZM17.7982 8.36746L16.7859 7.34693C16.5762 7.13557 16.2349 7.13418 16.0235 7.34387L9.67375 13.6426L6.98778 10.9349C6.77813 10.7235 6.43681 10.7221 6.22545 10.9318L5.20487 11.9441C4.99352 12.1538 4.99212 12.4951 5.20182 12.7065L9.27987 16.8176C9.48952 17.0289 9.83084 17.0303 10.0422 16.8206L17.7952 9.12983C18.0065 8.92014 18.0079 8.57882 17.7982 8.36746Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_359">
                                        <rect width="23" height="23" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            Input your card details or select transfer method.
                        </li>
                        <li class="text-white fw-bold bg-dark p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                                fill="none">
                                <g clip-path="url(#clip0_1_359)">
                                    <path
                                        d="M11.5 0.359375C5.34719 0.359375 0.359375 5.34719 0.359375 11.5C0.359375 17.6528 5.34719 22.6406 11.5 22.6406C17.6528 22.6406 22.6406 17.6528 22.6406 11.5C22.6406 5.34719 17.6528 0.359375 11.5 0.359375ZM11.5 2.51562C16.4653 2.51562 20.4844 6.53393 20.4844 11.5C20.4844 16.4653 16.4661 20.4844 11.5 20.4844C6.5347 20.4844 2.51562 16.4661 2.51562 11.5C2.51562 6.5347 6.53393 2.51562 11.5 2.51562ZM17.7982 8.36746L16.7859 7.34693C16.5762 7.13557 16.2349 7.13418 16.0235 7.34387L9.67375 13.6426L6.98778 10.9349C6.77813 10.7235 6.43681 10.7221 6.22545 10.9318L5.20487 11.9441C4.99352 12.1538 4.99212 12.4951 5.20182 12.7065L9.27987 16.8176C9.48952 17.0289 9.83084 17.0303 10.0422 16.8206L17.7952 9.12983C18.0065 8.92014 18.0079 8.57882 17.7982 8.36746Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_359">
                                        <rect width="23" height="23" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            Click the green button.
                        </li>
                        <li class="text-white fw-bold bg-dark p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                                fill="none">
                                <g clip-path="url(#clip0_1_359)">
                                    <path
                                        d="M11.5 0.359375C5.34719 0.359375 0.359375 5.34719 0.359375 11.5C0.359375 17.6528 5.34719 22.6406 11.5 22.6406C17.6528 22.6406 22.6406 17.6528 22.6406 11.5C22.6406 5.34719 17.6528 0.359375 11.5 0.359375ZM11.5 2.51562C16.4653 2.51562 20.4844 6.53393 20.4844 11.5C20.4844 16.4653 16.4661 20.4844 11.5 20.4844C6.5347 20.4844 2.51562 16.4661 2.51562 11.5C2.51562 6.5347 6.53393 2.51562 11.5 2.51562ZM17.7982 8.36746L16.7859 7.34693C16.5762 7.13557 16.2349 7.13418 16.0235 7.34387L9.67375 13.6426L6.98778 10.9349C6.77813 10.7235 6.43681 10.7221 6.22545 10.9318L5.20487 11.9441C4.99352 12.1538 4.99212 12.4951 5.20182 12.7065L9.27987 16.8176C9.48952 17.0289 9.83084 17.0303 10.0422 16.8206L17.7952 9.12983C18.0065 8.92014 18.0079 8.57882 17.7982 8.36746Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_359">
                                        <rect width="23" height="23" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            After a successful payment, you will be redirected to the login page.
                        </li>
                        <li class="text-white fw-bold bg-dark p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"
                                fill="none">
                                <g clip-path="url(#clip0_1_359)">
                                    <path
                                        d="M11.5 0.359375C5.34719 0.359375 0.359375 5.34719 0.359375 11.5C0.359375 17.6528 5.34719 22.6406 11.5 22.6406C17.6528 22.6406 22.6406 17.6528 22.6406 11.5C22.6406 5.34719 17.6528 0.359375 11.5 0.359375ZM11.5 2.51562C16.4653 2.51562 20.4844 6.53393 20.4844 11.5C20.4844 16.4653 16.4661 20.4844 11.5 20.4844C6.5347 20.4844 2.51562 16.4661 2.51562 11.5C2.51562 6.5347 6.53393 2.51562 11.5 2.51562ZM17.7982 8.36746L16.7859 7.34693C16.5762 7.13557 16.2349 7.13418 16.0235 7.34387L9.67375 13.6426L6.98778 10.9349C6.77813 10.7235 6.43681 10.7221 6.22545 10.9318L5.20487 11.9441C4.99352 12.1538 4.99212 12.4951 5.20182 12.7065L9.27987 16.8176C9.48952 17.0289 9.83084 17.0303 10.0422 16.8206L17.7952 9.12983C18.0065 8.92014 18.0079 8.57882 17.7982 8.36746Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_359">
                                        <rect width="23" height="23" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            Thank you!
                        </li>
                    </ul>
                </div>
                <div class=" col-md-5 offset-md-1">
                    <form class="hero-form p-5" method="POST" action="">
                        <h3>Conference Registration</h3>

                        <div class="mb-3">
                            <label for="exampleInputEmail2" class="form-label mb-0">Surname</label>
                            <input type="text" class="form-control border-0" name="lastname" id="exampleInputEmail2" required>
                        </div>

                        <div class="mb-4">
                            <label for="exampleInputEmail1" class="form-label mb-0">Other Names</label>
                            <input type="text" class="form-control border-0" name="othername" id="exampleInputEmail1" required>
                            <input type="hidden" name="conferent_form" value="<?= uniqid() ?>">
                            
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail3" class="form-label mb-0">email</label>
                            <input type="email" class="form-control border-0" name="emailadd" id="exampleInputEmail3" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail4" class="form-label mb-0">phone</label>
                            <input type="tel" class="form-control border-0" name="phonenum" id="exampleInputEmail4" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail5" class="form-label mb-0">Membership Number</label>
                            <input type="tel" class="form-control border-0" name="memberNo" id="exampleInputEmail5" placeholder="eg. MULAN - 01234" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail6" class="form-label mb-0">Supreme Court Number</label>
                            <input type="tel" class="form-control border-0" name="courtNo" id="exampleInputEmail6" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail7" class="form-label mb-0">Year of Call</label>
                            <input type="number" class="form-control border-0" name="yearofCall" id="exampleInputEmail7" placeholder="eg. 2023" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryInputField" class="form-label mb-0">Category</label>
                            <select id="categoryInputField" class="form-control border-0" name="categoryreg" required>
                                <option value="" selected>-- Select Registration Category --</option>
                                <?php 
                                if (mysqli_num_rows($getcat) > 0) {
                                    while( $cat = mysqli_fetch_array($getcat)){?>

                                    <option value="<?= $cat['category_id'] ?>"><?= $cat['category_name'] ?></option>

                                <?php }} ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="categoryInputField" class="form-label mb-0">Branch</label>
                            <select id="categoryInputField" class="form-control border-0" name="branchname" required>
                                <option value="" selected>-- Select State Branch --</option>
                                <option value="FCT Abuja">FCT Abuja</option>
                                <option value="Abia">Abia</option>
                                <option value="Adamawa">Adamawa</option>
                                <option value="Akwa Ibom">Akwa Ibom</option>
                                <option value="Anambra">Anambra</option>
                                <option value="Bauchi">Bauchi</option>
                                <option value="Bayelsa">Bayelsa</option>
                                <option value="Benue">Benue</option>
                                <option value="Borno">Borno</option>
                                <option value="Cross River">Cross River</option>
                                <option value="Delta">Delta</option>
                                <option value="Ebonyi">Ebonyi</option>
                                <option value="Edo">Edo</option>
                                <option value="Ekiti">Ekiti</option>
                                <option value="Enugu">Enugu</option>
                                <option value="Gombe">Gombe</option>
                                <option value="Imo">Imo</option>
                                <option value="Jigawa">Jigawa</option>
                                <option value="Kaduna">Kaduna</option>
                                <option value="Kano">Kano</option>
                                <option value="Katsina">Katsina</option>
                                <option value="Kebbi">Kebbi</option>
                                <option value="Kogi">Kogi</option>
                                <option value="Kwara">Kwara</option>
                                <option value="Lagos">Lagos</option>
                                <option value="Nasarawa">Nasarawa</option>
                                <option value="Niger">Niger</option>
                                <option value="Ogun">Ogun</option>
                                <option value="Ondo">Ondo</option>
                                <option value="Osun">Osun</option>
                                <option value="Oyo">Oyo</option>
                                <option value="Plateau">Plateau</option>
                                <option value="Rivers">Rivers</option>
                                <option value="Sokoto">Sokoto</option>
                                <option value="Taraba">Taraba</option>
                                <option value="Yobe">Yobe</option>
                                <option value="Zamfara">Zamfara</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Save & Pay</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <section id="footer">

        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-2 pt-4">
                <div class="col-md-6 d-flex align-items-center">
                    <p>Copyright Ⓒ 2018. Muslim Lawyers Association of Nigeria. All rights reserved. </p>

                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-end">
                    <p class="">© 2023 Website By:<a href="https://templatesjungle.com/" class="website-link"
                            target="_blank"> <b><u>TemplatesJungle</u></b></a> <br> Distributed By: <a href="https://themewagon.com"><b><u>ThemeWagon</b></u></a></p>
                </div>

            </footer>
        </div>
    </section>

    <!-- script ================================================== -->
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>


</body>

</html>