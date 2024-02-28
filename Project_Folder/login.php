<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Medicare</title>

	<!-- Render All Elements Normally -->
	<link rel="stylesheet" href="css/normalize.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="css/all.min.css">
	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>
	<!-- Tailwind configuration -->
	<style type="text/tailwindcss">
		@layer utilities {
			section {
				@apply py-[75px];
			}
			.container {
				@apply max-w-full px-40 mx-auto;
			}
	
			.btn {
				@apply bg-primaryColor py-[15px] px-[35px] rounded-[50px] text-white font-[600] mt-[38px];
			}
	
			.heading {
				@apply text-[44px] leading-[54px] font-[700] text-headingColor;
			}
	
			.text__para {
				@apply text-[18px] leading-[30px] font-[400] text-textColor mt-[18px];
			}
	
			.header {
				@apply bg-[url('./assets/images/mask.png')] bg-no-repeat bg-center bg-cover w-full h-[100px] leading-[100px];
			}
	
			.hero__section {
				@apply bg-[url('./assets/images/hero-bg.png')] bg-no-repeat bg-center bg-cover	
			}
	
			@media only screen and (max-width: 1024px) {
	
				section {
					@apply py-[35px];
				}
			}
	
			@media only screen and (max-width: 768px) {
				.heading {
					@apply text-[26px] leading-[36px];
				}
	
				.text__para {
					@apply text-[16px] leading-7 mt-3;
				}
				.container {
					@apply  max-w-full px-7 mx-auto;
				}
			}
		}
	</style>

	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						primaryColor: "#0067FF",
						yellowColor: "#FEB60D",
						purpleColor: "#9771FF",
						irisBlueColor: "#01B5C5",
						headingColor: "#181A1E",
						textColor: "#4E545F",
					},
					boxShadow: {
						panelShadow: "rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;",
					},
				},
			},
		};
	</script>
	<!-- Main Template CSS File -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
<!-- Start Notification -->
  <?php
  if (isset($_SESSION['message'])) {
    echo '<div class="message" onclick="this.remove();" >' . $_SESSION['message'] . '</div>';
    echo '<script>setTimeout(function(){document.querySelector(".message").remove()},3000);</script>';
    unset($_SESSION['message']);
  }
  ?>
  <!-- End Notification -->
	<!-- Start Header -->
	<header class="header flex items-center" id="header">
		<div class="container">
			<div class="flex items-center justify-between">
				<div><img src="./assets/images/logo.png" alt=""></div>
				<div class="navigation" id="menu" onclick="toggleMenu()">
					<ul class="menu flex items-center gap-[2.7rem]">
						<li><a aria-current="page" class="text-primaryColor text-[16px] leading-7 font-[600]"
								href="index.php">Home</a></li>
						<li><a class="text-textColor text-[16px] leading-7 font-[500] hover:text-primaryColor"
								href="doctors.php">Find a
								Doctor</a></li>
						<li><a class="text-textColor text-[16px] leading-7 font-[500] hover:text-primaryColor"
								href="services.php">Services</a></li>
						<li><a class="text-textColor text-[16px] leading-7 font-[500] hover:text-primaryColor"
								href="contact.php">Contact</a></li>
					</ul>
				</div>
				<div class="flex items-center gap-4">
					<div class="hidden">
						<a href="index.php">
							<figure class="w-[35px] h-[35px] rounded-full cursor-pointer">
								<img src="./assets/images/avatar-icon.png" class="w-full rounded-full" alt="">
							</figure>
						</a>
					</div>
					<a href="index.php">
						<button
							class="bg-primaryColor py-2 px-6 text-white font-[600] h-[44px] flex items-center justify-center rounded-[50px]">Login</button>
					</a>
					<span class="md:hidden" onclick="toggleMenu()">
						<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
							class="w-6 h-6 cursor-pointer" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
							<path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
						</svg>
					</span>
				</div>
			</div>
		</div>
	</header>
	<!-- End Header -->

	<!-- Start Services Section -->
	<section class="px-5 lg:px-0">
		<div class="w-full max-w-[570px] mx-auto rounded-lg shadow-md md:p-10">
			<h3 class="text-headingColor text-[22px] leading-9 font-bold mb-10">
				Hello! <span class="text-primaryColor">Welcome</span> Back 🎉
			</h3>

			<form action="validation.php" method="post" class="py-4 md:py-0">
				<div class="mb-5">
					<input type="email" placeholder="Enter Your Email"  name="user_email" class="w-full  py-3 border-b border-solid border-[#0066ff61] focus:outline-none focus:border-b-primaryColor text-[16px] leading-7 text-headingColor placeholder:text-textColor  cursor-pointer" required>
				</div>
				<div class="mb-5">
					<input type="password" placeholder="Password" name="user_pass" class="w-full  py-3 border-b border-solid border-[#0066ff61] focus:outline-none focus:border-b-primaryColor text-[16px] leading-7 text-headingColor placeholder:text-textColor  cursor-pointer" required>
				</div>
				<div class="mt-7">
					<button type="submit" class="w-full bg-primaryColor text-white text-[18px] leading-[30px] rounded-lg px-4 py-3">Login</button>
				</div>

				<div class="mt-5 text-textColor text-center">
					Don&apos;t have an account. <a href="signup.php" class="text-primaryColor font-medium ml-1">Register</a>
				</div>



			</form>
		</div>
	</section>
	<!-- End Services Section -->

	<!-- Start Footer -->
	<footer class="pb-16 pt-10">
		<div class="container">
			<div class="flex justify-between flex-col md:flex-row flex-wrap fap-[30px]  ">
				<div><img src="./assets/images/logo.png" alt="">
					<p class="text-[16px] leading-7 font-[400] text-textColor mt-4 ">Copyright © 2024 developed by
						Abdelkarim Douadjia all right reserved.</p>
					<div class="flex items-center gap-3 mt-4"><a
							class="w-9 h-9 border border-solid border-[#181A1E] rounded-full flex items-center justify-center group hover:bg-primaryColor hover:border-none "
							href="https://www.youtube.com/"><svg stroke="currentColor" fill="currentColor"
								stroke-width="0" viewBox="0 0 1024 1024" class="group-hover:text-white w-4 h-5"
								height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M941.3 296.1a112.3 112.3 0 0 0-79.2-79.3C792.2 198 512 198 512 198s-280.2 0-350.1 18.7A112.12 112.12 0 0 0 82.7 296C64 366 64 512 64 512s0 146 18.7 215.9c10.3 38.6 40.7 69 79.2 79.3C231.8 826 512 826 512 826s280.2 0 350.1-18.8c38.6-10.3 68.9-40.7 79.2-79.3C960 658 960 512 960 512s0-146-18.7-215.9zM423 646V378l232 133-232 135z">
								</path>
							</svg></a><a
							class="w-9 h-9 border border-solid border-[#181A1E] rounded-full flex items-center justify-center group hover:bg-primaryColor hover:border-none "
							href="https://www.github.com/"><svg stroke="currentColor" fill="currentColor"
								stroke-width="0" viewBox="0 0 1024 1024" class="group-hover:text-white w-4 h-5"
								height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
								<path
									d="M511.6 76.3C264.3 76.2 64 276.4 64 523.5 64 718.9 189.3 885 363.8 946c23.5 5.9 19.9-10.8 19.9-22.2v-77.5c-135.7 15.9-141.2-73.9-150.3-88.9C215 726 171.5 718 184.5 703c30.9-15.9 62.4 4 98.9 57.9 26.4 39.1 77.9 32.5 104 26 5.7-23.5 17.9-44.5 34.7-60.8-140.6-25.2-199.2-111-199.2-213 0-49.5 16.3-95 48.3-131.7-20.4-60.5 1.9-112.3 4.9-120 58.1-5.2 118.5 41.6 123.2 45.3 33-8.9 70.7-13.6 112.9-13.6 42.4 0 80.2 4.9 113.5 13.9 11.3-8.6 67.3-48.8 121.3-43.9 2.9 7.7 24.7 58.3 5.5 118 32.4 36.8 48.9 82.7 48.9 132.3 0 102.2-59 188.1-200 212.9a127.5 127.5 0 0 1 38.1 91v112.5c.8 9 0 17.9 15 17.9 177.1-59.7 304.6-227 304.6-424.1 0-247.2-200.4-447.3-447.5-447.3z">
								</path>
							</svg></a><a
							class="w-9 h-9 border border-solid border-[#181A1E] rounded-full flex items-center justify-center group hover:bg-primaryColor hover:border-none "
							href="https://www.instagram.com/"><svg class="text-[24px]" stroke="currentColor"
								fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
								class="group-hover:text-white w-4 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M512 306.9c-113.5 0-205.1 91.6-205.1 205.1S398.5 717.1 512 717.1 717.1 625.5 717.1 512 625.5 306.9 512 306.9zm0 338.4c-73.4 0-133.3-59.9-133.3-133.3S438.6 378.7 512 378.7 645.3 438.6 645.3 512 585.4 645.3 512 645.3zm213.5-394.6c-26.5 0-47.9 21.4-47.9 47.9s21.4 47.9 47.9 47.9 47.9-21.3 47.9-47.9a47.84 47.84 0 0 0-47.9-47.9zM911.8 512c0-55.2.5-109.9-2.6-165-3.1-64-17.7-120.8-64.5-167.6-46.9-46.9-103.6-61.4-167.6-64.5-55.2-3.1-109.9-2.6-165-2.6-55.2 0-109.9-.5-165 2.6-64 3.1-120.8 17.7-167.6 64.5C132.6 226.3 118.1 283 115 347c-3.1 55.2-2.6 109.9-2.6 165s-.5 109.9 2.6 165c3.1 64 17.7 120.8 64.5 167.6 46.9 46.9 103.6 61.4 167.6 64.5 55.2 3.1 109.9 2.6 165 2.6 55.2 0 109.9.5 165-2.6 64-3.1 120.8-17.7 167.6-64.5 46.9-46.9 61.4-103.6 64.5-167.6 3.2-55.1 2.6-109.8 2.6-165zm-88 235.8c-7.3 18.2-16.1 31.8-30.2 45.8-14.1 14.1-27.6 22.9-45.8 30.2C695.2 844.7 570.3 840 512 840c-58.3 0-183.3 4.7-235.9-16.1-18.2-7.3-31.8-16.1-45.8-30.2-14.1-14.1-22.9-27.6-30.2-45.8C179.3 695.2 184 570.3 184 512c0-58.3-4.7-183.3 16.1-235.9 7.3-18.2 16.1-31.8 30.2-45.8s27.6-22.9 45.8-30.2C328.7 179.3 453.7 184 512 184s183.3-4.7 235.9 16.1c18.2 7.3 31.8 16.1 45.8 30.2 14.1 14.1 22.9 27.6 30.2 45.8C844.7 328.7 840 453.7 840 512c0 58.3 4.7 183.2-16.2 235.8z">
								</path>
							</svg></a><a
							class="w-9 h-9 border border-solid border-[#181A1E] rounded-full flex items-center justify-center group hover:bg-primaryColor hover:border-none "
							href="https://www.linkedin.com/in/codingwithmuhib"><svg stroke="currentColor"
								fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
								class="group-hover:text-white w-4 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M6.94048 4.99993C6.94011 5.81424 6.44608 6.54702 5.69134 6.85273C4.9366 7.15845 4.07187 6.97605 3.5049 6.39155C2.93793 5.80704 2.78195 4.93715 3.1105 4.19207C3.43906 3.44699 4.18654 2.9755 5.00048 2.99993C6.08155 3.03238 6.94097 3.91837 6.94048 4.99993ZM7.00048 8.47993H3.00048V20.9999H7.00048V8.47993ZM13.3205 8.47993H9.34048V20.9999H13.2805V14.4299C13.2805 10.7699 18.0505 10.4299 18.0505 14.4299V20.9999H22.0005V13.0699C22.0005 6.89993 14.9405 7.12993 13.2805 10.1599L13.3205 8.47993Z">
								</path>
							</svg></a></div>
				</div>
				<div>
					<h2 class="text-[20px] leading-[30px] font-[700] mb-6 text-headingColor">Quick Links</h2>
					<ul>
						<li class="mb-4"><a class="text-[16px] leading-7 font-[400] text-textColor"
								href="index.php">Home</a>
						</li>
						<li class="mb-4"><a class="text-[16px] leading-7 font-[400] text-textColor" href="/">About
								US</a>
						</li>
						<li class="mb-4"><a class="text-[16px] leading-7 font-[400] text-textColor"
								href="services.php">Services</a></li>
						<li class="mb-4"><a class="text-[16px] leading-7 font-[400] text-textColor" href="/">Blog</a>
						</li>
					</ul>
				</div>
				<div>
					<h2 class="text-[20px] leading-[30px] font-[700] mb-6 text-headingColor">I want to:</h2>
					<ul>
						<li class="mb-4"><a class="text-[16px] leading-7 font-[400] text-textColor"
								href="find-a-doctor.php">Find a Doctor</a></li>
						<li class="mb-4"><a class="text-[16px] leading-7 font-[400] text-textColor" href="/">Request an
								Appointment</a></li>
						<li class="mb-4"><a class="text-[16px] leading-7 font-[400] text-textColor" href="/">Find a
								Location</a></li>
						<li class="mb-4"><a class="text-[16px] leading-7 font-[400] text-textColor" href="/">Get a
								Opinion</a></li>
					</ul>
				</div>
				<div>
					<h2 class="text-[20px] leading-[30px] font-[700] mb-6 text-headingColor">Support</h2>
					<ul>
						<li class="mb-4"><a class="text-[16px] leading-7 font-[400] text-textColor" href="/">Donate</a>
						</li>
						<li class="mb-4"><a class="text-[16px] leading-7 font-[400] text-textColor"
								href="contact.php">Contact
								Us</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer -->










	<script src="./js/script.js"></script>

</body>

</html>