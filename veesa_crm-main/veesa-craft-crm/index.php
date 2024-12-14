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
	
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
									<h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Dashboard
									<!--begin::Separator-->
									<span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
									
								</div>
								<!--end::Page title-->
							
							</div>
							<!--end::Container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Post-->
						<div class="post d-flex justify-space-between" id="kt_post">
							<!--begin::Container-->
						<div id="kt_content_container" class="container-fluid">
    <!--begin::Row-->
    
   <?php
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $sql = "
        SELECT 
            SUM(CASE WHEN priority = 'hot' THEN 1 ELSE 0 END) AS hot_count,
            SUM(CASE WHEN priority = 'green' THEN 1 ELSE 0 END) AS green_count,
            SUM(CASE WHEN priority = 'cold' THEN 1 ELSE 0 END) AS cold_count
        FROM enquiry
    ";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit;
    }

    $row = mysqli_fetch_assoc($result);
    $hot_count = $row['hot_count'];
    $green_count = $row['green_count'];
    $cold_count = $row['cold_count'];
?>

    <div class="row">
        <!-- Column for Chart (50% width) -->
        <div class="col-md-6">
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <canvas id="inquiryChart" style="max-width: 100%; height: 400px;"></canvas>
            </div>
        </div>

        <!-- Column for Table (50% width) -->
        <div class="col-md-6">
            <div id="kt_content_container" class="container-fluid">
                <div class="py-5">
                    <!-- Card for the table -->
                    <div class="card card-p-0 card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <!-- Add Subadmin button -->
                                <a href="request-password.php" class="btn btn-dark me-2 mb-2">
                                    <i class="las la-plus fs-2 me-2"></i>Add Subadmin
                                </a>
                            </div>
                        </div>

                        <!-- Card body with table -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle border rounded table-row-dashed fs-6 g-5 dataTable no-footer" id="kt_datatable_example_1">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
                                            <th class="min-w-100px">S.N.</th>
                                            <th class="min-w-100px">Email</th>
                                            <th class="min-w-100px">Password</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">
                                        <tr>
                                            <td><a href="#" class="text-dark text-hover-primary">1</a></td>
                                            <td><a href="#" class="text-dark text-hover-primary">admin</a></td>
                                            <td><a href="#" class="text-dark text-hover-primary">@dmin1234</a></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><a href="#" class="text-dark text-hover-primary">2</a></td>
                                            <td><a href="#" class="text-dark text-hover-primary">ksuraj.2me@gmail.com</a></td>
                                            <td><a href="#" class="text-dark text-hover-primary">ZUMROH81CI</a></td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End card body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Chart -->
    <script>
        var hotCount = <?php echo $hot_count; ?>;
        var greenCount = <?php echo $green_count; ?>;
        var coldCount = <?php echo $cold_count; ?>;

        var ctx = document.getElementById('inquiryChart').getContext('2d');
        var inquiryChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Hot Inquiry', 'Green Inquiry', 'Cold Inquiry'],
                datasets: [{
                    data: [hotCount, greenCount, coldCount],
                    backgroundColor: ['#dc3545', '#28a745', '#007bff'], 
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
    </script>

<?php
} else {
    echo '<div class="alert alert-danger" role="alert">You do not have permission to view this content.</div>';
}
?>



								<div class="col-xl-12 mt-4">
										<!--begin::Tables Widget 9-->
										<div class="card card-xl-stretch mb-5 mb-xl-8">
											<!--begin::Header-->
											<div class="card-header border-0 pt-5">
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label fw-bolder fs-3 mb-1">Our Products</span>
													<span class="text-muted mt-1 fw-bold fs-7">Over 500+ products</span>
												</h3>
												<div class="card-toolbar">
													<a href="<?=$site?>product-list.php" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
													<!--end::Svg Icon-->View All</a>
												</div>
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
									<!--begin::Col-->
										<?php
															$i=1;
															$sql = "SELECT * FROM `product` ORDER BY `id` DESC";
															$res = mysqli_query($conn,$sql);
															while($row = mysqli_fetch_assoc($res)){
															?>
								
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-sm-6 col-xxl-3">
										<!--begin::Card widget 14-->
										<div class="card card-flush h-xl-100">
											<!--begin::Body-->
											<div class="card-body text-center pb-5">
												<!--begin::Overlay-->
													<!--begin::Image-->
													<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded mb-7" style="height: 266px;background-image:url('<?=$site?>uploads/<?php echo $row['image']?>')"></div>
													<!--end::Image-->
												
												<!--end::Overlay-->
												<!--begin::Info-->
												<div class="d-flex align-items-end flex-stack mb-1">
													<!--begin::Title-->
													<div class="text-start">
														<span class="fw-bolder text-gray-800 cursor-pointer text-hover-primary fs-4 d-block"><?php echo $row['product_name']?>(<span><?php echo $row['product_desc']?></span>)</span>
														<span class="text-gray-400 mt-1 fw-bolder fs-6">Price</span>
													</div>
													<!--end::Title-->
													<!--begin::Total-->
													<span class="text-gray-600 text-end fw-bolder fs-6"> ₹<?php echo $row['price']?></span>
													<!--end::Total-->
												</div>
												<!--end::Info-->
											</div>
											<!--end::Body-->
											<!--begin::Footer-->
											<div class="card-footer d-flex flex-stack pt-0">
												<!--begin::Link-->
												<a class="btn btn-sm btn-primary flex-shrink-0 me-2" data-bs-target="#kt_modal_bidding" data-bs-toggle="modal">Stock: ₹<?php echo $row['stock']?></a>
												<!--end::Link-->
												
														 
												<!--begin::Link-->
												<a class="btn btn-sm btn-light btn-success flex-shrink-0" href="#">Buy Now</a>
												<!--<a href="add-product.php?id=<?php echo $row['id']; ?>" title="Edit">-->
            <!--                                                            <i class="fas fa-edit"></i>-->
            <!--                                                        </a>-->
            <!--                                                        <a href="product-delete.php?id=<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this Data?');">-->
            <!--                                                            <i class="fas fa-trash-alt"></i>-->
            <!--                                                        </a>-->
												<!--end::Link-->
											</div>
											<!--end::Footer-->
										</div>
										<!--end::Card widget 14-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
								
									<!--end::Col-->
									<?php
									
										}
										
										?>
					
								</div>
									<!--end::Section-->
								</div>
									</div>
							
				
							
							
							
							
							
							
							
							
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
						
					
					</div>
					
					
					
				
					
				
				
				
			
					
					
					
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
						<div class="d-flex gap-2 mb-2">
																	<a href="#">
																		<img src="assets/media/svg/brand-logos/facebook-4.svg" class="w-20px" alt="">
																	</a>
																	<a href="#">
																		<img src="assets/media/svg/brand-logos/twitter-2.svg" class="w-20px" alt="">
																	</a>
																	<a href="#">
																		<img src="assets/media/svg/brand-logos/linkedin-2.svg" class="w-20px" alt="">
																	</a>
																	<a href="#">
																		<img src="assets/media/svg/brand-logos/youtube-3.svg" class="w-20px" alt="">
																	</a>
																</div>
							<!--end::Menu-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
					
					
					
					<!--begin::Chat drawer-->
		<div id="kt_drawer_chat" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="chat" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_chat_toggle" data-kt-drawer-close="#kt_drawer_chat_close">
			<!--begin::Messenger-->
			<div class="card w-100 rounded-0 border-0" id="kt_drawer_chat_messenger">
				<!--begin::Card header-->
				<div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
					<!--begin::Title-->
					<div class="card-title">
						<!--begin::User-->
						<div class="d-flex justify-content-center flex-column me-3">
							<a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Notifications</a>
						
						</div>
						<!--end::User-->
					</div>
					<!--end::Title-->
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
						<!--begin::Menu-->
					
						<!--end::Menu-->
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_chat_close">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body" id="kt_drawer_chat_messenger_body">
					<!--begin::Messages-->
					<div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px">
						<!--begin::Message(in)-->
						<div class="d-flex justify-content-start mb-10">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column align-items-start">
								<!--begin::User-->
								<div class="d-flex align-items-center mb-2">
									<!--begin::Avatar-->
									<div class="symbol symbol-35px symbol-circle">
										<img alt="Logo" src="assests/uploads/user.png">
									</div>
									<!--end::Avatar-->
									<!--begin::Details-->
									<div class="ms-3">
										<a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Brian Cox</a>
										<span class="text-muted fs-7 mb-1">2 mins</span>
									</div>
									<!--end::Details-->
								</div>
								<!--end::User-->
								<!--begin::Text-->
								<div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">How likely are you to recommend our company to your friends and family ?</div>
								<!--end::Text-->
							</div>
							<!--end::Wrapper-->
						</div>
					
					</div>
					<!--end::Messages-->
				</div>
			
				<!--end::Card footer-->
			</div>
			<!--end::Messenger-->
		</div>
		<!--end::Chat drawer-->
		<!--end::Drawers-->
		<!--end::Main-->
					
					
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