<?php
    session_start();
    if ( !isset($_SESSION['username']) && !isset($_SESSION['password']) ) {
        header('location: index');
    } else {
        require_once('../connect.php');

        // All registered users
        $tUsers      = mysqli_query($db, "SELECT *, reg_category.category_name, reg_category.color_code FROM users INNER JOIN reg_category ON users.category = reg_category.category_id");
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
    <link rel="stylesheet" type="text/css" href="../styles.css">

    <link rel="shortcut icon" href="images/mulan_icon.png" type="../image/x-icon">

    <!-- Google Fonts ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,700;1,300&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">


    <!-- script ================================================== -->
    <script src="js/modernizr.js"></script>

</head>

<body>
    <div class="container-fluid p-3">
        <div class="row align-items-center">

            <?php
                if (mysqli_num_rows($tUsers) > 0){
                while ($row = mysqli_fetch_array($tUsers)) {
                $cls = $row['color_code'];
            ?>
            <div class="col-md-3 p-3 m-3" style="border: solid 2px #000;">
              
                <h5>MULAN CONFERENCE - 2024 </h5>

                <div class="mb-2">
                    <label for="name" class="form-label mb-0">Member Number</label>
                    <h6> <?= $row['membership_number'] ?> </h6>
                </div>
                <div class="mb-2">
                    <label for="name" class="form-label mb-0">Member Name</label>
                    <h6> <?= $row['lastname'] .' ' . $row['othername'] ?> </h6>
                </div>

                <div class="mb-2">
                    <label for="name" class="form-label mb-0">Tag Code</label>
                    <h6> <?= $row['member_reg_no'] ?> </h6>
                </div>

                <div class="mb-2">
                    <label for="name" class="form-label mb-0">Category</label>
                    <h6> <?= $row['category_name'] ?> </h6>
                </div>

                <div class="d-grid">
                    <a class="btn btn-lg" style="background-color: <?= $cls ?>;"></a>
                </div>

            </div>
            <?php
                } 
            } else {
                echo "No record found !!!";
            }?>
        </div>

        <button type="button" onclick="window.print()" class="btn btn-primary btn-sm"> Print</button>
    </div>

    <!-- script ================================================== -->
    <script src="../js/jquery-1.11.0.min.js"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>


</body>

</html>