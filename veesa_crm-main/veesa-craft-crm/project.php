<?php
include("conn.php");
session_start();
if (!isset($_SESSION["user_name"]) && ($_SESSION['status']!==true)) {
    header('location: login.php');
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
	<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
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
									<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Projects</h1>
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
								<!--begin::Row-->
								
							
							<div class="py-5">
											<!--begin::Card-->
											<div class="card card-p-0 card-flush">
												<!--begin::Card header-->
											<div class="card-header align-items-center py-5 gap-2 gap-md-5">
													<!--begin::Card title-->
													<div class="card-title">
														<!--begin::Search-->
														
														<!--end::Search-->
														<!--begin::Export buttons-->
														<div id="kt_datatable_example_1_export" class="d-none"></div>
														<!--end::Export buttons-->
													</div>
													<!--end::Card title-->
													<!--begin::Card toolbar-->
													<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
														<!--begin::Export dropdown-->
														<?php
						if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    
						?>
															<a href="add_new_project.php" class="btn btn-dark me-2 mb-2"><i class="las la-plus fs-2 me-2"></i>Add Project </a>
												<?php
						}
						?>
													</div>
													<!--end::Card toolbar-->
												</div>
												<!--end::Card header-->
												<!--begin::Card body-->
												<div class="card-body">
													<!--begin::Table-->
													<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example_1">
														<thead>
															<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
															    
																<th class="min-w-100px">S.N.</th>
																<th class="min-w-100px">Customer Name</th>
																	<th class="min-w-100px">Team Name</th>
																		<th class="min-w-100px">Project Start</th>
																			<th class="min-w-100px">Project End</th>
																<th class="min-w-100px">Project Status</th>
																<th class="min-w-100px">Live View</th>
																	<?php
						if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    
						?>
																<th class="text-center min-w-100px pe-5">Action</th>
																<?php
						}
						?>
															</tr>
														</thead>
														<tbody class="fw-bold text-gray-600">
															
																<?php
															$i = 1;
															$sql="SELECT * FROM `project` ORDER BY `id` DESC ";
															$res=mysqli_query($conn,$sql);
															while($row = mysqli_fetch_assoc($res)){
															?>
															<tr>
															    <td>
																	<a href="#" class="text-dark text-hover-primary"><?php echo $i++; ?></a>
																</td>
															    <td>
																	<a href="#" class="text-dark text-hover-primary"><?php echo $row['customer_name'];?></a>
																</td>
																<td>
																	<a href="#" class="text-dark text-hover-primary"><?php echo $row['team_name'];?></a>
																</td>
																
																	<td>
																	<a href="#" class="text-dark text-hover-primary"><?php echo $row['project_start'];?></a>
																</td>
																	<td>
																	<a href="#" class="text-dark text-hover-primary"><?php echo $row['project_end'];?></a>
																</td>
																		
																<td class="text-end">
																	<div class="d-flex flex-column w-100 me-2">
																		<div class="d-flex flex-stack mb-2">
																			<span class="text-muted me-2 fs-7 fw-bold"><?php echo $row['project_status'];?></span>
																		</div>
																		<div class="progress h-6px w-100">
																			<div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $row['project_status'];?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																		</div>
																	</div>
																</td>
																	<td>
																	<a href="#" class="text-dark text-hover-primary">Live Preview</a>
																</td>
																
															
																		<?php
                                                    					if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                                                    					?>
																<td class="text-center">
														
														           <!--<a href="add-product.php?id=<?php echo $row['id']; ?>" title="Edit">-->
                         <!--                                               <i class="fas fa-edit"></i>-->
                         <!--                                           </a>-->
                                                                    <a href="delete_project.php?id=<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this Project?');">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
														</td>
														<?php
						                                 }
						                                 ?>
															</tr>
															<?php
															}
															?>
														</tbody>
													</table>
													<!--end::Table-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Card-->
										</div>
							
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
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/documentation/documentation.js"></script>
		<script src="assets/js/custom/documentation/search.js"></script>
		<script src="assets/js/custom/documentation/general/datatables/buttons.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>