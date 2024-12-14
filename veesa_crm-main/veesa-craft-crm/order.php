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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
									<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Order
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
													
													<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
														
														<a href="add-new-enquiry.php" class="btn btn-dark me-2 mb-2 "><i class="las la-plus fs-2 me-2"></i>Add New Enquiry</a>
														<button type="button" class="btn btn-light-primary me-2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
														
														<!--<span class="svg-icon svg-icon-2">-->
														<!--	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">-->
														<!--		<rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor" />-->
														<!--		<path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor" />-->
														<!--		<path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />-->
														<!--	</svg>-->
														<!--</span>-->
														<!--Export Report</button>-->
														<!--<div id="kt_datatable_example_1_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">-->
															
														<!--	<div class="menu-item px-3">-->
														<!--		<a href="#" class="menu-link px-3" data-kt-export="copy">Copy to clipboard</a>-->
														<!--	</div>-->
															
														<!--	<div class="menu-item px-3">-->
														<!--		<a href="#" class="menu-link px-3" data-kt-export="excel">Export as Excel</a>-->
														<!--	</div>-->
															
														<!--	<div class="menu-item px-3">-->
														<!--		<a href="#" class="menu-link px-3" data-kt-export="csv">Export as CSV</a>-->
														<!--	</div>-->
															
														<!--	<div class="menu-item px-3">-->
														<!--		<a href="#" class="menu-link px-3" data-kt-export="pdf">Export as PDF</a>-->
														<!--	</div>-->
															
														<!--</div>-->
														
													</div>
													
												</div>
												<!--end::Card header-->
												<!--begin::Card body-->
												<div class="card-body">
													<!--begin::Table-->
													<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example_1">
														<thead>
															<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
															   	<th class="min-w-100px">S.NO</th>
																<th class="min-w-100px">Customer Name</th>
																<th class="min-w-100px">Customer Contact</th>
																<th class="min-w-100px">Inquire Product</th>
																<th class="min-w-100px">Type of Inquiry</th>
																<th class="min-w-100px">Advance Payment</th>
																	<?php
						if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    
						?>
																<!--<th class="text-end min-w-75px">Payment Mode</th>-->
																<th class="text-end min-w-100px pe-5">Action</th>
																<?php
						}
						?>
															</tr>
														</thead>
														<tbody class="fw-bold text-gray-600">
															
															<?php
															$i=1;
                                                            $sql = "SELECT * FROM `enquiry` ORDER BY `id` DESC";
															$result = mysqli_query($conn,$sql);
															while($row = mysqli_fetch_assoc($result)){
															?>
															<tr>
															    <td>
																	<?php echo $i++;?></a>
																</td>
																<td>
																	<a href="#" class="text-dark text-hover-primary"><?php echo $row['c_name'];?></a>
																</td>
																<td>
																	<a href="#" class="text-dark text-hover-primary"><?php echo $row['c_contact'];?></a>
																</td>
																	<td>
																	<a href="#" class="text-dark text-hover-primary"><?php echo $row['i_product'];?></a>
																</td>
																<td>
                                                                    <?php
                                                                        // Define the background color based on priority value
                                                                        if ($row['priority'] == 'hot') {
                                                                            $badge_class = 'badge-danger'; // Red for hot
                                                                        } elseif ($row['priority'] == 'cold') {
                                                                            $badge_class = 'badge-primary'; // Blue for cold
                                                                        } else {
                                                                            $badge_class = 'badge-success'; // Green for other cases like warm or normal
                                                                        }
                                                                    ?>
                                                                    <div class="badge <?php echo $badge_class; ?>">
                                                                        <?php echo ucfirst($row['priority']); ?>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo number_format($row['advance_payment'], 2); ?></td>
															    <!--<td class="text-end pe-0"><?php echo number_format($row['balance_payment'], 2); ?></td>-->
                   <!--                                             <td class="text-end pe-0"><?php echo number_format($row['total_payment'], 2); ?></td>-->
																<!--<td class="text-end pe-0"><?php echo $row['payment_mode'];?></td>-->
																<!--<td class="text-end pe-0"><?php echo $row['remark'];?></td>-->
															
																<?php
						if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    
						?>	
															<td class="text-end">
                                                                <a href="view-enquiry.php?id=<?php echo $row['id']; ?>" title="View">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="add-new-enquiry.php?id=<?php echo $row['id']; ?>" title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="delete-enquiry.php?id=<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this enquiry?');">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </td>
                                                            <?php
						}
						?>
														<?php
															}
															?>
															</tr>
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