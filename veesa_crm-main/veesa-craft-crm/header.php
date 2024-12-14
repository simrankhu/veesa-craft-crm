<?php
include("conn.php");


if (!isset($_SESSION["user_name"]) || $_SESSION['status'] !== true) {
    header('location: login.php');
    exit(); 
}

$username = $_SESSION["user_name"];
?>
<div id="kt_header" style="" class="header align-items-stretch">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between bg-dark">
							<!--begin::Aside mobile toggle-->
							
							<!--end::Aside mobile toggle-->
							<!--begin::Mobile logo-->
							<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
								<a href="../../demo1/dist/index.html" class="d-lg-none">
									<img alt="Logo" src="assets/media/logos/logo-2.png" class="h-20px" />
								</a>
							</div>
							<!--end::Mobile logo-->
							<!--begin::Wrapper-->
							<!--begin::Wrapper-->
							<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
								<!--begin::Navbar-->
								<?php include 'mobile-nav.php'; ?>
								<!--end::Navbar-->
								<!--begin::Toolbar wrapper-->
								<div class="d-flex align-items-stretch flex-shrink-0">
								    
								   
								    
									<!--begin::User menu-->
									<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
										<!--begin::Menu wrapper-->
										<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
											<!--<img src="assets/media/avatars/300-1.jpg" alt="" />-->
											<p style="color:white;"><?php echo $_SESSION['role'];?></p>
										</div>
										<!--begin::User account menu-->
										<div class="menu text-center menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<div class="menu-content justify-content-center d-flex align-items-center px-3">
													<!--begin::Avatar-->
													<div class="symbol  text-center symbol-50px me-5">
														<img alt="Logo" src="assests/uploads/user.png">
													</div>
													<!--end::Avatar-->
													<!--begin::Username-->
													<div class="d-flex flex-column">
														<div class="fw-bolder d-flex align-items-center fs-5"></div>
														
													</div>
													<!--end::Username-->
												</div>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu separator-->
											<div class="separator my-2"></div>
											<!--end::Menu separator-->
											<!--begin::Menu item-->
											<div class="menu-item px-5">
												<h6><?php echo htmlspecialchars($username); ?></h6>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item  justify-content-center px-5">
												<a href="<?=$site?>logout.php" class="menu-link justify-content-center px-5">Sign Out</a>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu separator-->
											<div class="separator my-2"></div>
											<!--end::Menu separator-->
										</div>
										<!--end::User account menu-->
										<!--end::Menu wrapper-->
									</div>
										<!--begin::Heading-->
										
									<!--end::User menu-->
									<!--begin::Header menu toggle-->
									<div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
										<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
											<!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
											<span class="svg-icon svg-icon-1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="currentColor" />
													<path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="currentColor" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</div>
									</div>
									<!--end::Header menu toggle-->
								</div>
								<!--end::Toolbar wrapper-->
							</div>
							<!--end::Wrapper-->
							<!--end::Wrapper-->
						</div>
						<!--end::Container-->
					</div>