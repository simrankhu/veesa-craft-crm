<?php

include("conn.php");
session_start();
if (!isset($_SESSION["user_name"]) && ($_SESSION['status']!==true)) {
    header('location: login.php');
}


$id = null;
$team_name = $member_name = $post = $date = $status = "";

// Check if an ID is provided for editing
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM `manpower_team_attendence` WHERE `id` = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Check if the project exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Populate variables with existing data
            $team_name = $row['team_name'];
            $member_name = $row['member_name'];
            $post = $row['post'];
            $date = $row['date'];
            $status = $row['status'];
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
   $team_name = mysqli_real_escape_string($conn, $_POST['team_name']);
    $member_name = mysqli_real_escape_string($conn, $_POST['member_name']);
    $post = mysqli_real_escape_string($conn, $_POST['post']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
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
								
									<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Add Team Attendence</h1>
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
										<form action="function_team_attendence.php<?php echo isset($id) ? '?id=' . $id : ''; ?>" method="POST">
										<div class="">
											<div class="rounded border ">
											    <?php if (isset($id)) : ?>
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <?php endif; ?>
												<!--begin::Input group-->
												<div class="row">
													<div class="col-lg-6">
														<div class="input-group mb-5">
													
													<input type="text" class="form-control" placeholder="Team Name" name="team_name"  value="<?php echo $team_name; ?>">
												</div>
													</div>
														<div class="col-lg-6">
														<div class="input-group mb-5">
												    	<input type="text" class="form-control" placeholder="Member Name" name="member_name"  value="<?php echo $member_name; ?>">
											       	    </div>
												    	</div>
														<div class="col-lg-6">
														<div class="input-group mb-5">
												    	<input type="text" class="form-control" placeholder="post" name="post"  value="<?php echo $post; ?>">
											       	    </div>
												    	</div>
													<div class="col-lg-6">
														<div class="input-group mb-5">
													   <input type="date" class="form-control" placeholder="date" name="date"  value="<?php echo $date; ?>">
												      </div>
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
                                                            <select class="form-select form-select-solid" name="status" required>
                                                                <option value="" disabled <?php echo empty($status) ? 'selected' : ''; ?>>- select-status -</option>
                                                                <option value="present" <?php echo ($status == 'present') ? 'selected' : ''; ?>>Present</option>
                                                                <option value="absent" <?php echo ($status == 'absent') ? 'selected' : ''; ?>>Absent</option>
                                                                <option value="leave" <?php echo ($status == 'leave') ? 'selected' : ''; ?>>Leave</option>
                                                            </select>
                                                    </div>
                                                    </div>
                                              
												<!--end::Input group-->
											</div>
											<div class="input-group mb-5">
                                                    <button class="btn btn-dark me-2 mb-2" type="submit" name="submit">
                                                        <i class="las la-plus fs-2 me-2"></i>
                                                        <?php echo isset($id) ? 'Update Attendence' : 'Add Attendence'; ?>
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









