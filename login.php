<?php
    
    session_start();

    if ( isset($_SESSION['username']) && isset($_SESSION['password']) ) {
        header('location: user_home');
    }

    if ( isset($_POST['login']) ) {

        require_once('connect.php');

        $username = trim(mysqli_real_escape_string($db, $_POST['username']));
        $password = trim(mysqli_real_escape_string($db,$_POST['password']));

        if ( !isset($_POST['username']) || isset($_POST['username']) == "" || empty($_POST['username'])) {

            echo "<script> alert('Email Address Can Not Be Empty !!!'); window.location='login' </script>";

        } else if (!isset($_POST['password']) || isset($_POST['password']) == "" || empty($_POST['password'])) {

            echo "<script> alert('Member No. Can Not Be Empty !!!'); window.location='login' </script>";

        } else {

        
            $sql = mysqli_query($db, "SELECT * FROM `users` WHERE email='$username' ");

            if ( mysqli_num_rows($sql) > 0) {

                $fetchUser  = mysqli_fetch_array($sql);
                $fetchPass  = $fetchUser['membership_number'];

                if ( $password == $fetchPass ) {

                    $_SESSION['username']    = $fetchUser['email'];
                    $_SESSION['password']    = $fetchUser['membership_number'];
                    $_SESSION['memberId']    = $fetchUser['member_reg_no'];

                    echo "<script> alert('Account Successfully LoggedIn ... '); window.location='user_home' </script>";

                } else {

                    echo "<script> alert('Invalid Password !!!'); window.location='login' </script>";
                }

            } else {

                echo "<script> alert('Email Address Does Not Exist, Kindly Recheck Or Register From The Home Page With A valid Email Address !!!'); window.location='login' </script>";
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

    <section id="hero" class="position-relative overflow-hidden py-4" style="background: url(images/hero-bg.avif);">
        <div class="container py-5">
            <div class="row align-items-center py-5 mt-5">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h6 class="text-white">2024 Confererence Registration</h6>
                    <h2 class="text-white fw-bold display-2">MULAN</h2>
                    <ul class="list-unstyled">
                        <li class="text-white fw-bold">
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
                            Our Mission

                            <p>To promote sound, religious and professional ethics amongst members, and also see to the welfare of all members and well-being of all people on the principles of Islam and Justice. </p>
                        </li>
                    </ul>
                </div>
                <div class=" col-md-5 offset-md-1">
                    <form class="hero-form p-5" method="POST" action="">
                        <h3>USER Login</h3>

                        <div class="mb-3">
                            <label for="exampleInputEmail3" class="form-label mb-0">email</label>
                            <input type="text" class="form-control border-0" name="username" placeholder="abc@gmail.com" id="exampleInputEmail3">
                            <input type="hidden" name="login" value="<?= uniqid() ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail4" class="form-label mb-0">member no</label>
                            <input type="password" class="form-control border-0" name="password" placeholder="******" id="exampleInputEmail4">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Login</button>
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
                    <p>Copyright Ⓒ 2024. Muslim Lawyers Association of Nigeria. All rights reserved. </p>

                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-end">
                    <p class="">© 2023 Website By:<a href="https://templatesjungle.com/" class="website-link"
                            target="_blank"> <b><u>TemplatesJungle</u></b></a> </p>
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