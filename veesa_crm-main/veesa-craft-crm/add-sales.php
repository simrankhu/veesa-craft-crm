<?php
include("conn.php");
session_start();
if (!isset($_SESSION["user_name"]) && ($_SESSION['status']!==true)) {
    header('location: login.php');
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="">
    <title>Veesa Craft - <?php echo isset($id) ? 'Edit' : 'Add'; ?> Sales</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!-- Global Stylesheets -->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    <!-- Main Structure -->
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <!-- Aside -->
            <?php include 'sidebar.php'; ?>
            <!-- Wrapper -->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                 <!--header-start-->
                <?php include("header.php");?>
                <!--header_end-->

                <!-- Content -->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!-- Toolbar -->
                    <div class="toolbar" id="kt_toolbar">
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                            <!-- Page Title -->
                            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                                    <?php echo isset($id) ? 'Edit' : 'Add'; ?> Sales
                                </h1>
                                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                            </div>
                            <!-- End Page Title -->
                        </div>
                    </div>
                    <!-- End Toolbar -->

                    <!-- Post -->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-fluid">
                            <!-- Card -->
                            <div class="card card-docs flex-row-fluid mb-2">
                                <!-- Card Body -->
                                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                    <!-- Form Section -->
                                    <div class="pt-10">
                                        <form action="" method="POST">
                                            <div class="rounded border p-5">
                                             
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="input-group mb-5">
                                                            <input type="text" class="form-control" placeholder="Sale Person Name" name="sale_person" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="input-group mb-5">
                                                            <input type="number" class="form-control" placeholder="Sale Amount" name="amount" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="input-group mb-5">
                                                            <input type="number" class="form-control" placeholder="Commission %" name="commission" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="input-group mb-5">
                                                    <button class="btn btn-dark me-2 mb-2" type="submit" name="submit"> Submit
                                                        <i class="las la-plus fs-2 me-2"></i>
                                                    
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Form Section -->
                                </div>
                                <!-- End Card Body -->
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Container -->
                    </div>
                    <!-- End Post -->
                </div>
                <!-- End Content -->

                <!-- Footer -->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">© Veesa Craft 2024 All Rights Reserved. Design & Developed by </span>
                            <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Web2tech Solution</a>
                        </div>
                    </div>
                </div>
                <!-- End Footer -->
            </div>
            <!-- End Wrapper -->
        </div>
        <!-- End Page -->
    </div>
    <!-- End Root -->

    <!-- Javascript -->
    <script>var hostUrl = "assets/";</script>
    <!-- Global Javascript Bundle (used by all pages) -->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
</body>
</html>

<?php

if(isset($_POST['submit'])){
    $sale_person = $_POST['sale_person'];
    $amount = $_POST['amount'];
    $commission = $_POST['commission'];
    $c_amount = $amount*$commission/100;
    $sql = "INSERT INTO `sale`(`sale_person`, `amount`, `commission`, `c_amount`) 
    VALUES ('$sale_person','$amount','$commission','$c_amount')";
    $res = mysqli_query($conn,$sql);
    
    if($res){
        echo "<script>
    window.location.href = 'sale-list.php'; // Redirect to sale_list.php
</script>";
    }
    
    
    
}












?>