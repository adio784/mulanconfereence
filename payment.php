<?php

use function PHPSTORM_META\type;

    session_start();
    require_once('connect.php');

    // Get Category type and amount --------------------------------------------------
    $getcat = mysqli_query($db, "SELECT * FROM reg_category WHERE `status`='1' AND category_id='$_SESSION[regcategory]'");
    if ( mysqli_num_rows($getcat) > 0) {
        $getAmt = mysqli_fetch_array($getcat);
    }
    // --------------------------------------------------------------------------------

    if (!isset($_SESSION['regemailadd']) && !isset($_SESSION['regmemberID']) ) {
        header('location: index');
    } else {

        // redeclaration of variable ................
        $payEmail   = $_SESSION['regemailadd'] ;
        $payName    = $_SESSION['regfullname'] ;
        $payPhone   = $_SESSION['regfonenum'] ;
        $payMemNo   = $_SESSION['regmemberno'];
        $payCat     = $_SESSION['regcategory'] ;
        $payMemID   = $_SESSION['regmemberID'] ;
        $amountTopay= ((0.015 * $getAmt['amount_topay']) + 100 ) + $getAmt['amount_topay'];
        $amtNoChar  = $getAmt['amount_topay'];
        $catName    = $getAmt['category_name'];
    }

    // Validate payment and create record 
    if (isset($_GET['memberid']) && isset($_GET['payment_type']) ) {

        $reference = $_GET['ref'];
        
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/transaction/verify/". $reference,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "json",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_3604bec52d5c01974e219c9b2341c1cdfd808c2c",
            "Cache-Control: no-cache",
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
      
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $request = json_decode($response);
            // print_r($request);
            if ($request->status == true) {

                $memberID   = $_GET['memberid'];
                $amountP    = ($request->data->amount / 100);
                $amtPerc    = (0.015 * $amountP) + 100;
                $amountPaid = $_GET['amount'];
                $status     = $request->status;
                $message    = $request->message;
                $trx        = $request->data->id;

                $checkPay = mysqli_query($db, "SELECT member_id FROM payment_history WHERE member_id='$memberID' AND status=1 AND transaction_id !='' AND reference !='' ");

                if ( mysqli_num_rows($checkPay) > 0) {
                    echo "<script> alert('Payment Already Verified, Thanks You !!!'); window.location='login' </script>";                  
                } else {

                    $insPay     = mysqli_query($db, "INSERT INTO payment_history(member_id, transaction_id, amount_paid, reference, status, message) VALUES('$memberID', '$trx', '$amountPaid', '$reference', '$status', '$message')");

                    if ($insPay) {
                        session_destroy();
                        echo "<script> alert('Payment Successfully Made And Verified ... '); window.location='login' </script>";
                    } else {
                        echo "<script> alert('Error Occured While Verifying Your Payment, Please Refresh This Page !!!'); </script>";
                    }

                }
            }
            // 
            // var_dump($request);
            // echo $response;
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
        <!-- <div class="pattern-overlay pattern-right position-absolute">
            <img src="images/pattern-hero.png" alt="pattern">
        </div> -->
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
                    <form id="paymentForm" method="POST" class="hero-form p-5">
                        <h3>Proceed to payment</h3>
                        <div class="mb-3">
                            <label for="exampleInputEmail3" class="form-label mb-0">email</label>
                            <input type="text" class="form-control border-0" name="emailadd" id="email-address" readonly value="<?= $payEmail ?>">
                        </div>
                        <input type="hidden" name="fullname" id="fullname" readonly value="<?= $payName ?>">
                        <input type="hidden" name="phone_number" id="phone_number" readonly value="<?= $payPhone ?>">
                        <input type="hidden" name="category" id="category" readonly value="<?= $catName ?>">
                        <input type="hidden" name="amtNoCharg" id="amtNoCharg" readonly value="<?= $amtNoChar ?>">
                        <div class="mb-3">
                            <label for="exampleInputEmail4" class="form-label mb-0">member id</label>
                            <input type="text" class="form-control border-0" name="memberid" id="memberid" readonly value="<?= $payMemNo ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail3" class="form-label mb-0">Amount to pay</label>
                            <input type="tel" class="form-control border-0" name="amount" id="amount" readonly value="<?= $amountTopay ?>">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg" onsubmit="payWithPaystack()">Make Payment</button>
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
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>

    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);

        var amtNoCharges = document.getElementById('amtNoCharg').value;
        function payWithPaystack(e) {
          e.preventDefault();
        //   alert('Welcome');
          let handler = PaystackPop.setup({
            key: 'pk_live_d753eb9b3caca8b5d7ce49212b25a6768391be2b', //'pk_test_c9ca3055dbbb92e1f0009295a4402c5caeb938b4',
            // key: 'pk_live_ed261d3beb7cae41f315b2d8e6a40228d1f1d280',
            // pk_test_672f1e2c554539b410e97df8cbde393abf6b5aa4

            // pk_live_d753eb9b3caca8b5d7ce49212b25a6768391be2b
            
            email: document.getElementById("email-address").value,
            amount: document.getElementById("amount").value * 100,
            ref: ''+Math.floor((Math.random() * 1000000000) + 1), 
            // subaccount: "ACCT_5g4xz4l7apdon1y",
            // bearer: "subaccount",
            metadata: {
                custom_fields: 
                [
                    {
                        display_name:"Full Name",
                        variable_name: "mem_name", 
                        value: document.getElementById('fullname').value,
                    },
                    {
                        display_name:"Member Number",
                        variable_name: "mem_mo", 
                        value: document.getElementById('memberid').value,
                    },
                    {
                        display_name: "Phone Number",
                        variable_name: "mem_phone", 
                        value: document.getElementById('phone_number').value,
                    },
                    {
                        display_name: "Email",
                        variable_name: "mem_email", 
                        value: document.getElementById('email-address').value,
                    },
                    {
                        display_name: "Amount Paid",
                        variable_name: "mem_amountpaid", 
                        value: document.getElementById('amtNoCharg').value,
                    },
                    {
                        display_name: "Purpose",
                        variable_name: "mem_purpose", 
                        value: 'Mulan 2024 Conference ' + document.getElementById('category').value,
                    },
                ],
            },
            onClose: function(){
              alert('Trasaction terminated.');
            },
            callback: function(response){
              let message = 'Payment complete! Reference: ' + response.reference;
              window.location.replace("payment.php?memberid=<?= $payMemID ?>&amount=" + amtNoCharges + "&payment_type=<?= 'mulancon2024' ?>&ref=" + response.reference);
            //   alert(message);
            }
          });
        
          handler.openIframe();
        }
    </script>

</body>

</html>