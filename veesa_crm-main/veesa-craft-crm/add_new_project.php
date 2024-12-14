<?php

include("conn.php");
session_start();
if (!isset($_SESSION["user_name"]) && ($_SESSION['status']!==true)) {
    header('location: login.php');
}

$id = null;
$customer_name = $team_name = $project_start = $project_end = $project_status = $project_url = "";

// Check if an ID is provided for editing
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `project` WHERE `id` = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Check if the project exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Populate variables with existing data
            $customer_name = $row['customer_name'];
            $team_name = $row['team_name'];
            $project_start = $row['project_start'];
            $project_end = $row['project_end'];
            $project_status = $row['project_status'];
            $project_url = $row['project_url'];
        } else {
            echo "Project not found.";
            exit();
        }
    } else {
        echo "Error fetching project: " . $stmt->error;
        exit();
    }

    $stmt->close();
}

// Populate POST data after form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $team_name = $_POST['team_name'];
    $project_start = $_POST['project_start'];
    $project_end = $_POST['project_end'];
    $project_status = $_POST['project_status'];
    $project_url = $_POST['project_url'];
}
?>


<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title>Veesa Craft</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
	
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">


				<!--begin::Aside-->
				<?php include 'sidebar.php'; ?>
				<!--end::Aside-->


				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				 <!--header-start-->
                <?php include("header.php");?>
                <!--header_end-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Toolbar-->
						<div class="toolbar" id="kt_toolbar">
							<!--begin::Container-->
							<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
								<!--begin::Page title-->
								<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
									<!--begin::Title-->
								
									<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Add New Project</h1>
									<!--begin::Separator-->
									<span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
									
								</div>
								<!--end::Page title-->
							
							</div>
							<!--end::Container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-fluid">
							<!--begin::Card-->
							<div class="card card-docs flex-row-fluid mb-2">
								<!--begin::Card Body-->
								<div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
									<!--begin::Section-->
							
									
									<!--end::Section-->
									<!--begin::Section-->
									<div class="pt-10">
										<!--end::Block-->
										<!--begin::Block-->
										<form action="function_project.php<?php echo isset($id) ? '?id=' . $id : ''; ?>" method="POST">
										<div class="">
											<div class="rounded border ">
											    <?php if (isset($id)) : ?>
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <?php endif; ?>
												<!--begin::Input group-->
												<div class="row">
													<div class="col-lg-6">
														<div class="input-group mb-5">
													
													<input type="text" class="form-control" placeholder="Customer Name" name="customer_name"  value="<?php echo $customer_name; ?>">
												</div>
													</div>
														<div class="col-lg-6">
														<div class="input-group mb-5">
													<input type="text" class="form-control" placeholder="Team Name" name="team_name"  value="<?php echo $team_name; ?>">
												</div>
													</div>
													<div class="col-lg-6">
														<div class="input-group mb-5">
													   <input type="datetime-local" class="form-control" placeholder="Project Start" name="project_start"  value="<?php echo $project_start; ?>">
												      </div>
												     </div>
													<div class="col-lg-6">
													<div class="input-group mb-5">
                                                        <input type="datetime-local" class="form-control" name="project_end" value="<?php echo $project_end; ?>" placeholder="Project End Date">
                                                    </div>
                                                    
                                                    <!--<div class="input-group mb-5">-->
                                                    <!--    <select class="form-control" name="project_end_time">-->
                                                    <!--        <option value="12:00 AM">12:00 AM</option>-->
                                                    <!--        <?php for ($hour = 1; $hour <= 11; $hour++): ?>-->
                                                    <!--            <option value="<?php echo $hour; ?>:00 AM"><?php echo $hour; ?>:00 AM</option>-->
                                                    <!--            <option value="<?php echo $hour; ?>:30 AM"><?php echo $hour; ?>:30 AM</option>-->
                                                    <!--        <?php endfor; ?>-->
                                                    <!--        <option value="12:00 PM">12:00 PM</option>-->
                                                    <!--        <?php for ($hour = 1; $hour <= 11; $hour++): ?>-->
                                                    <!--            <option value="<?php echo $hour; ?>:00 PM"><?php echo $hour; ?>:00 PM</option>-->
                                                    <!--            <option value="<?php echo $hour; ?>:30 PM"><?php echo $hour; ?>:30 PM</option>-->
                                                    <!--        <?php endfor; ?>-->
                                                    <!--    </select>-->
                                                    <!--</div>-->
                                                    

													</div>
													
													 <div class="col-lg-6">
													 <div class="input-group mb-5">
                                                            <select class="form-select form-select-solid" name="project_status" required>
                                                                <option value="" disabled <?php echo empty($project_status) ? 'selected' : ''; ?>>- select-project-status -</option>
                                                                <option value="10%" <?php echo ($project_status == '10%') ? 'selected' : ''; ?>>10%</option>
                                                                <option value="20%" <?php echo ($project_status == '20%') ? 'selected' : ''; ?>>20%</option>
                                                                <option value="30%" <?php echo ($project_status == '30%') ? 'selected' : ''; ?>>30%</option>
                                                                <option value="40%" <?php echo ($project_status == '40%') ? 'selected' : ''; ?>>40%</option>
                                                                <option value="50%" <?php echo ($project_status == '50%') ? 'selected' : ''; ?>>50%</option>
                                                                <option value="60%" <?php echo ($project_status == '60%') ? 'selected' : ''; ?>>60%</option>
                                                                <option value="70%" <?php echo ($project_status == '70%') ? 'selected' : ''; ?>>70%</option>
                                                                <option value="80%" <?php echo ($project_status == '80%') ? 'selected' : ''; ?>>80%</option>
                                                                <option value="90%" <?php echo ($project_status == '90%') ? 'selected' : ''; ?>>90%</option>
                                                                <option value="100%" <?php echo ($project_status == '100%') ? 'selected' : ''; ?>>100%</option>
                                                            </select>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
														<div class="input-group mb-5">
													<input type="text" class="form-control" placeholder="Project URL" name="project_url"  value="<?php echo $project_url; ?>">
												</div>
													</div>
											
											
												<!--end::Input group-->
											</div>
											<div class="input-group mb-5">
                                                    <button class="btn btn-dark me-2 mb-2" type="submit" name="submit">
                                                        <i class="las la-plus fs-2 me-2"></i>
                                                        <?php echo isset($id) ? 'Update Project' : 'Add Project'; ?>
                                                    </button>
                                                </div>
										</div>
										<!--end::Block-->
										</form>
									
									</div>
									<!--end::Section-->
								</div>
								<!--end::Card Body-->
							</div>
							<!--end::Card-->
						
					
							
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<!--begin::Copyright-->
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted fw-bold me-1">© Veesa Craft 2024 All Rights Reserved. Dedign & Developed by </span>
								<a href="#" target="_blank" class="text-gray-800 text-hover-primary">Web2tech Solution</a>
							</div>
							<!--end::Copyright-->
							<!--begin::Menu-->
							
							<!--end::Menu-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->


		<!--end::Modal - Users Search-->
		<!--end::Modals-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		
	</body>
	<!--end::Body-->
</html>

// <?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $project_end_date = $_POST['project_end_date']; // Get the date
//     $project_end_time = $_POST['project_end_time']; // Get the time
//     $project_end = $project_end_date . ' ' . $project_end_time; // Combine date and time
// }
// ?>









