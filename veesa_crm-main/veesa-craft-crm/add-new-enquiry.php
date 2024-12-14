<?php
include("conn.php");
session_start();
if (!isset($_SESSION["user_name"]) && ($_SESSION['status']!==true)) {
    header('location: login.php');
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conn.php");

$id = null;
$c_name = $c_contact = $i_product = $priority = "";
$advance_payment = $balance_payment = $total_payment = $payment_mode = $remark = "";

// Check if an ID is provided for editing
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `enquiry` WHERE `id` = ? ");
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Check if the enquiry exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Populate variables with existing data
            $c_name = htmlspecialchars($row['c_name']);
            $c_contact = htmlspecialchars($row['c_contact']);
            $i_product = htmlspecialchars($row['i_product']);
            $priority = htmlspecialchars($row['priority']);
            $advance_payment = htmlspecialchars($row['advance_payment']);
            $balance_payment = htmlspecialchars($row['balance_payment']);
            $total_payment = htmlspecialchars($row['total_payment']);
            $payment_mode = htmlspecialchars($row['payment_mode']);
            $remark = htmlspecialchars($row['remark']);
        } else {
            echo "Enquiry not found.";
            exit();
        }
    } else {
        echo "Error fetching enquiry: " . $stmt->error;
        exit();
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="">
    <title>Veesa Craft - <?php echo isset($id) ? 'Edit' : 'Add'; ?> Enquiry</title>
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
                                    <?php echo isset($id) ? 'Edit' : 'Add'; ?> Enquiry
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
                                        <form action="function.php<?php echo isset($id) ? '?id=' . $id : ''; ?>" method="POST">
                                            <div class="rounded border p-5">
                                                <!-- Hidden ID Field for Editing -->
                                                <?php if (isset($id)) : ?>
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <?php endif; ?>

                                                <!-- Customer Details -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="input-group mb-5">
                                                            <input type="text" class="form-control" placeholder="Customer Name" name="c_name" value="<?php echo $c_name; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="input-group mb-5">
                                                            <input type="text" class="form-control" placeholder="Customer Contact" name="c_contact" value="<?php echo $c_contact; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="input-group mb-5">
                                                            <input type="text" class="form-control" placeholder="Inquire Product" name="i_product" value="<?php echo $i_product; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Payment Details -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-5">
                                                            <select class="form-select form-select-solid" name="priority" required>
                                                                <option value="" disabled <?php echo empty($priority) ? 'selected' : ''; ?>>- Select Priority -</option>
                                                                <option value="hot" <?php echo ($priority == 'hot') ? 'selected' : ''; ?>>HOT</option>
                                                                <option value="green" <?php echo ($priority == 'green') ? 'selected' : ''; ?>>GREEN</option>
                                                                <option value="cold" <?php echo ($priority == 'cold') ? 'selected' : ''; ?>>COLD</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-5">
                                                            <input type="number" class="form-control" placeholder="Advance Payment Amount" name="advance_payment" value="<?php echo $advance_payment; ?>" min="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-5">
                                                            <input type="number" class="form-control" placeholder="Balance Payment Amount" name="balance_payment" value="<?php echo $balance_payment; ?>" min="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-5">
                                                            <input type="number" class="form-control" placeholder="Total Payment Amount" name="total_payment" value="<?php echo $total_payment; ?>" min="0">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Payment Mode -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-5">
                                                            <select class="form-select form-select-solid" name="payment_modes" required>
                                                                <option value="" disabled <?php echo empty($payment_mode) ? 'selected' : ''; ?>>- Select Payment Method -</option>
                                                                <option value="UPI" <?php echo ($payment_mode == 'UPI') ? 'selected' : ''; ?>>UPI</option>
                                                                <option value="Paytm" <?php echo ($payment_mode == 'Paytm') ? 'selected' : ''; ?>>Paytm</option>
                                                                <option value="Phonepay" <?php echo ($payment_mode == 'Phonepay') ? 'selected' : ''; ?>>Phonepay</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Remarks -->
                                                <div class="input-group mb-5">
                                                    <textarea class="form-control" placeholder="Remark" name="remarks"><?php echo $remark; ?></textarea>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="input-group mb-5">
                                                    <button class="btn btn-dark me-2 mb-2" type="submit" name="submit">
                                                        <i class="las la-plus fs-2 me-2"></i>
                                                        <?php echo isset($id) ? 'Update Enquiry' : 'Add Enquiry'; ?>
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
