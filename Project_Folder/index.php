<?php
	session_start();
	include 'configuration.php';

	if (!isset($_SESSION['userid'])) { // it will check if the user is not login then it will redirect to login page
		header('location:login.php');
	}

	// it will got the user id from the session
	$user_id = $_SESSION['userid'];

	// it will got the user pic from the session
	$user_pic = $_SESSION['userpic'];

	// it will check if the user click on logout button or not
	if (isset($_GET['logout'])) {
		unset($_SESSION['userid']);
		session_destroy();
		header('location:login.php');
	}

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
        // show the message one time only
        if (isset($_SESSION['message'])) {
            echo '<div class="message" onclick="this.remove();" >' . $_SESSION['message'] . '</div>';
            echo '<script>setTimeout(function(){document.querySelector(".message").remove()},3000);</script>';
            unset($_SESSION['message']);
        }
        if (isset($message)) {
            echo '<div class="message" onclick="this.remove();" >' . $message . '</div>';
            echo '<script>setTimeout(function(){document.querySelector(".message").remove()},3000);</script>';
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
						<?php
                            $select_user = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'") or die('query failed');
                            // it will check if the user is available or not
                            if (mysqli_num_rows($select_user) > 0) {
                                $fetch_user = mysqli_fetch_assoc($select_user);
                            };
                            ?>
					<div>
						<a href="account.php">
							<figure class="w-[35px] h-[35px] rounded-full cursor-pointer">
								<img src="<?php echo $fetch_user['picture']; ?>" class="w-full rounded-full" alt="">
							</figure>
						</a>
					</div>
					<a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are you sure you want to logout?');">
						<button
							class=" bg-red-600 py-2 px-6 text-white font-[600] h-[44px] flex items-center justify-center rounded-[50px]">Sign out</button>
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

	<!-- Start Hero Section -->
	<section class="hero__section pt-[60px] 2xl:h-[800px]">
		<div class="container">
			<div class="flex flex-col lg:flex-row gap-[90px] items-center justify-between">
				<!-- ========== hero content ==========-->
				<div>
					<div class="lg:w-[570px]">
						<h1
							class="text-[36px] leading-[46px] text-headingColor font-[800] md:text-[60px] md:leading-[70px] ">
							We help patients live a healthy, longer life.
						</h1>
						<p class="text__para">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit.
							Temporibus tempora assumenda eligendi quia, nemo nulla id
							blanditiis praesentium necessitatibus officia, distinctio
							autem perspiciatis alias animi itaque, corrupti ullam numquam
							modi.
						</p>

						<button class="btn">Request an Appointment</button>
					</div>
					<!-- ========== hero counter ==========-->
					<div class="mt-[30px] lg:mt-[70px] flex flex-col lg:flex-row lg:items-center gap-5 lg:gap-[30px]">
						<div>
							<h2
								class="text-[36px] leading-[56px] lg:text-[44px] lg:leading-[54px] font-[700] text-headingColor ">
								30+
							</h2>
							<span class="w-[100px] h-2 bg-yellowColor rounded-full block mt-[-14px]"></span>
							<p class="text__para">Years of Experience</p>
						</div>

						<div>
							<h2
								class="text-[36px] leading-[56px] lg:text-[44px] lg:leading-[54px] font-[700] text-headingColor ">
								15+
							</h2>
							<span class="w-[100px] h-2 bg-purpleColor rounded-full block mt-[-14px]"></span>
							<p class="text__para">Clinic Location</p>
						</div>

						<div>
							<h2
								class="text-[36px] leading-[56px] lg:text-[44px] lg:leading-[54px] font-[700] text-headingColor ">
								100%
							</h2>
							<span class="w-[100px] h-2 bg-irisBlueColor rounded-full block mt-[-14px]"></span>
							<p class="text__para">Patient Satisfaction</p>
						</div>
					</div>
				</div>
				<!-- ========== hero content ==========-->

				<div class="flex gap-[30px] justify-end">
					<div>
						<img class="w-full" src="./assets/images/hero-img01.png" alt="" />
					</div>
					<div class="mt-[30px]">
						<img src="./assets/images/hero-img02.png" alt="" class="w-full mb-[30px]" />
						<img src="./assets/images/hero-img03.png" alt="" class="w-full" />
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Hero Section -->

	<!-- How it works Section Start -->
	<section>
		<div class="container">
			<div class="lg:w-[470px] mx-auto">
				<h2 class="heading text-center">
					Providing the best medical services
				</h2>
				<p class="text__para text-center">
					World-class care for everyone. Our health System offers unmatched,
					expert health care.
				</p>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-[30px] mt-[30px] lg:mt-[55px]">
				<div class="py-[30px] px-5">
					<div class="flex items-center justify-center">
						<img src="./assets/images/icon01.png" alt="" />
					</div>

					<div class="mt-[30px]">
						<h2 class="text-[26px] leading-9 text-headingColor font-[700] text-center">
							Find a Doctor
						</h2>
						<p class="text-[16px] leading-7 text-textColor font-[400] mt-4 text-center ">
							World-class care for everyone. Our health System offers
							unmatched, expert health care. From the lab to the clinic.
						</p>

						<a href="doctors.php"
							class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] mt-[30px] mx-auto flex items-center justify-center group hover:bg-primaryColor hover:border-none">
							<span class="group-hover:text-white w-6 h-5">
								<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
									class="group-hover:text-white w-6 h-5" height="1em" width="1em"
									xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd"
										d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
									</path>
								</svg>
							</span>
						</a>
					</div>
				</div>
				<div class="py-[30px] px-5">
					<div class="flex items-center justify-center ">
						<img src="./assets/images/icon02.png" alt="" />
					</div>

					<div class="mt-[30px]">
						<h2 class="text-[26px] leading-9 text-headingColor font-[700] text-center">
							Find a Location
						</h2>
						<p class="text-[16px] leading-7 text-textColor font-[400] mt-4 text-center ">
							World-class care for everyone. Our health System offers
							unmatched, expert health care. From the lab to the clinic.
						</p>

						<a href="doctors.php"
							class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] mt-[30px] mx-auto flex items-center justify-center group hover:bg-primaryColor hover:border-none">
							<span class="group-hover:text-white w-6 h-5">
								<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
									class="group-hover:text-white w-6 h-5" height="1em" width="1em"
									xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd"
										d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
									</path>
								</svg>
							</span>
						</a>
					</div>
				</div>
				<div class="py-[30px] px-5">
					<div class="flex items-center justify-center ">
						<img src="./assets/images/icon03.png" alt="" />
					</div>

					<div class="mt-[30px]">
						<h2 class="text-[26px] leading-9 text-headingColor font-[700] text-center">
							Book Appointment
						</h2>
						<p class="text-[16px] leading-7 text-textColor font-[400] mt-4 text-center ">
							World-class care for everyone. Our health System offers
							unmatched, expert health care. From the lab to the clinic.
						</p>

						<a href="doctors.php"
							class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] mt-[30px] mx-auto flex items-center justify-center group hover:bg-primaryColor hover:border-none">
							<span class="group-hover:text-white w-6 h-5">
								<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
									class="group-hover:text-white w-6 h-5" height="1em" width="1em"
									xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd"
										d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
									</path>
								</svg>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- How it works Section End -->

	<!-- Start About Section -->
	<section>
		<div class="container">
			<div class="flex justify-between gap-[50px] lg:gap-[130px] xl:gap-0 flex-col lg:flex-row">
				<!-- ======== about img ========  -->
				<div class="relative w-3/4 lg:w-1/2 xl:w-[770px] z-10 order-2 lg:order-1">
					<img src="./assets/images/about.png" alt="" />
					<div
						class="absolute z-20 bottom-4 w-[200px] md:w-[300px] right-[-30%] md:right-[-7%] lg:right-[22%] ">
						<img src="./assets/images/about-card.png" alt="" />
					</div>
				</div>

				<!-- ======== about content ========  -->
				<div class="w-full lg:w-1/2 xl:w-[670px] order-1 lg:order-2 ">
					<h2 class="heading">Proud to be one of the nation's best</h2>
					<p class="text__para">
						For 30 years in a row, U.S. News & World Report has recognized us
						as one of the best public hospitals in the Nation and #1 in
						Texas. Lorem ipsum dolor sit amet consectetur adipisicing elit.
						Quod fugiat ea eum.
					</p>

					<p class="text__para mt-[30px]">
						For 30 years in a row, U.S. News & World Report has recognized us
						as one of the best public hospitals in the Nation and #1 in
						Texas. Lorem ipsum dolor sit amet consectetur adipisicing elit.
						Quod fugiat ea eum.
					</p>

					<a href="#">
						<button class="btn">Learn More</button>
					</a>
				</div>
			</div>
		</div>
	</section>
	<!-- End About Section -->

	<!-- Start Services Section -->
	<section>
		<div class="container">
			<div class="xl:w-[470px] mx-auto">
				<h2 class="heading text-center">Our medical services</h2>
				<p class="text__para text-center "></p>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-[30px] mt-[30px] lg:mt-[55px] ">
				<div class="py-[30px] px-3 lg:px-5 ">
					<h2 class="text-[26px] leading-9 text-headingColor font-[700]">Cancer Care</h2>
					<p class="text-[16px] leading-7 font-[400] text-textColor mt-4">World-class care for everyone. Our
						health System offers unmatched, expert health care. From the lab to the clinic.</p>
					<div class="flex items-center justify-between mt-[30px]">
						<a class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] flex items-center justify-center group hover:bg-primaryColor hover:border-none"
							href="doctors.php">
							<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
								class="group-hover:text-white w-6 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
								</path>
							</svg>
						</a>
						<span
							class="w-[44px] h-[44px] flex items-center justify-center text-[18px] leading-[30px] font-[600]"
							style="background: rgba(254, 182, 13, 0.2); color: rgb(254, 182, 13); border-radius: 6px 0px 0px 6px;">1</span>
					</div>
				</div>
				<div class="py-[30px] px-3 lg:px-5 ">
					<h2 class="text-[26px] leading-9 text-headingColor font-[700]">Labor &amp; Delivery</h2>
					<p class="text-[16px] leading-7 font-[400] text-textColor mt-4">World-class care for everyone. Our
						health System offers unmatched, expert health care. From the lab to the clinic.</p>
					<div class="flex items-center justify-between mt-[30px]">
						<a class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] flex items-center justify-center group hover:bg-primaryColor hover:border-none"
							href="doctors.php">
							<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
								class="group-hover:text-white w-6 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
								</path>
							</svg>
						</a>
						<span
							class="w-[44px] h-[44px] flex items-center justify-center text-[18px] leading-[30px] font-[600]"
							style="background: rgba(151, 113, 255, 0.2); color: rgb(151, 113, 255); border-radius: 6px 0px 0px 6px;">2</span>
					</div>
				</div>
				<div class="py-[30px] px-3 lg:px-5 ">
					<h2 class="text-[26px] leading-9 text-headingColor font-[700]">Heart &amp; Vascular</h2>
					<p class="text-[16px] leading-7 font-[400] text-textColor mt-4">World-class care for everyone. Our
						health System offers unmatched, expert health care. From the lab to the clinic.</p>
					<div class="flex items-center justify-between mt-[30px]">
						<a class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] flex items-center justify-center group hover:bg-primaryColor hover:border-none"
							href="doctors.php">
							<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
								class="group-hover:text-white w-6 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
								</path>
							</svg>
						</a>
						<span
							class="w-[44px] h-[44px] flex items-center justify-center text-[18px] leading-[30px] font-[600]"
							style="background: rgba(1, 181, 197, 0.2); color: rgb(1, 181, 197); border-radius: 6px 0px 0px 6px;">3</span>
					</div>
				</div>
				<div class="py-[30px] px-3 lg:px-5 ">
					<h2 class="text-[26px] leading-9 text-headingColor font-[700]">Mental Health</h2>
					<p class="text-[16px] leading-7 font-[400] text-textColor mt-4">World-class care for everyone. Our
						health System offers unmatched, expert health care. From the lab to the clinic.</p>
					<div class="flex items-center justify-between mt-[30px]">
						<a class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] flex items-center justify-center group hover:bg-primaryColor hover:border-none"
							href="doctors.php">
							<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
								class="group-hover:text-white w-6 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
								</path>
							</svg>
						</a>
						<span
							class="w-[44px] h-[44px] flex items-center justify-center text-[18px] leading-[30px] font-[600]"
							style="background: rgba(1, 181, 197, 0.2); color: rgb(1, 181, 197); border-radius: 6px 0px 0px 6px;">4</span>
					</div>
				</div>
				<div class="py-[30px] px-3 lg:px-5 ">
					<h2 class="text-[26px] leading-9 text-headingColor font-[700]">Neurology</h2>
					<p class="text-[16px] leading-7 font-[400] text-textColor mt-4">World-class care for everyone. Our
						health System offers unmatched, expert health care. From the lab to the clinic.</p>
					<div class="flex items-center justify-between mt-[30px]">
						<a class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] flex items-center justify-center group hover:bg-primaryColor hover:border-none"
							href="doctors.php"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
								viewBox="0 0 16 16" class="group-hover:text-white w-6 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
								</path>
							</svg>
						</a>
						<span
							class="w-[44px] h-[44px] flex items-center justify-center text-[18px] leading-[30px] font-[600]"
							style="background: rgba(254, 182, 13, 0.2); color: rgb(254, 182, 13); border-radius: 6px 0px 0px 6px;">5</span>
					</div>
				</div>
				<div class="py-[30px] px-3 lg:px-5 ">
					<h2 class="text-[26px] leading-9 text-headingColor font-[700]">Burn Treatment</h2>
					<p class="text-[16px] leading-7 font-[400] text-textColor mt-4">World-class care for everyone. Our
						health System offers unmatched, expert health care. From the lab to the clinic.</p>
					<div class="flex items-center justify-between mt-[30px]">
						<a class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] flex items-center justify-center group hover:bg-primaryColor hover:border-none"
							href="doctors.php"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
								viewBox="0 0 16 16" class="group-hover:text-white w-6 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
								</path>
							</svg>
						</a>
						<span
							class="w-[44px] h-[44px] flex items-center justify-center text-[18px] leading-[30px] font-[600]"
							style="background: rgba(151, 113, 255, 0.2); color: rgb(151, 113, 255); border-radius: 6px 0px 0px 6px;">6</span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Services Section -->

	<!-- Start Feature Section -->
	<section>
		<div class="container">
			<div class="flex items-center justify-between flex-col lg:flex-row">
				<!-- ========== feqture content =========== -->
				<div class="xl:w-[670px]">
					<h2 class="heading">
						Get virtual treatment <br /> anytime.
					</h2>
					<ul class="pl-4">
						<li class="text__para">
							1. Schedule the appointment directly.
						</li>
						<li class="text__para">
							2. Search for your physician, and contact their office.
						</li>
						<li class="text__para">
							3. View our physicians who are accepting new patients, use the online scheduling tool to
							select
							an appointment time.
						</li>
					</ul>
					<a href="/">
						<button class="btn">Learn More</button>
					</a>
				</div>

				<!-- ========= feature img ========= -->
				<div class="relative z-10 xl:w-[770px] flex justify-end mt-[50px] lg:mt-0 ">
					<img src="./assets/images/feature-img.png" class="w-3/4" alt="" />

					<div
						class="w-[150px] lg:w-[248px] bg-white absolute bottom-[50px] left-0 md:bottom-[100px] md:left-5 z-20 p-2 pb-3 lg:pt-4 lg:px-4 lg:pb-[26px] rounded-[10px] ">
						<div class="flex items-center justify-between">
							<div class="flex items-center gap-[6px] lg:gap-3 ">
								<p
									class="text-[10px] leading-[10px] lg:text-[14px] lg:leading-5 text-headingColor font-[600] ">
									Tue, 24
								</p>
								<p
									class="text-[10px] leading-[10px] lg:text-[14px] lg:leading-5 text-textColor font-[400] ">
									10:00AM
								</p>
							</div>
							<span
								class="w-5 h-5 lg:w-[34px] flex items-center justify-center bg-yellowColor rounded py-1 px-[6px] lg:py-3 lg:px-[9px] ">
								<img src="./assets/images/video-icon.png" alt="" />
							</span>
						</div>

						<div
							class="w-[65px] lg:w-[96px] bg-[#CCF0F3] py-1 px-2 lg:py-[6px] lg:px-[10px] text-[8px] leading-[8px] lg:text-[12px] lg:leading-4 text-irisBlueColor font-[500] mt-2 lg:mt-4 rounded-full ">
							Consultation
						</div>

						<div class="flex items-center gap-[6px] lg:gap-[10px] mt-2 lg:mt-[18px] ">
							<img src="./assets/images/avatar-icon.png" alt="" />
							<h4
								class="text-[10px] leading-3 lg:text-[16px] lg:leading-[22px] font-[700] text-headingColor ">
								Wayne Collins
							</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Feature Section -->

	<!-- Start Our Great Doctors -->
	<section>
		<div class="container">
			<div class="xl:w-[470px] mx-auto">
				<h2 class="heading text-center
	        ">Our great doctors</h2>
				<p class="text__para text-center "></p>
			</div>
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 lg:gap-[30px] mt-[30px] lg:mt-[55px] ">
				<div class="p-3 lg:p-5">
					<div><img src="./assets/images/doctor-img01.png" class="w-full" alt=""></div>
					<h2
						class="text-[18px] leading-[30px] lg:text-[26px] lg:leading-9 text-headingColor font-[700] mt-3 lg:mt-5">
						Dr. Alfaz Ahmed</h2>
					<div class="mt-2 lg:mt-4 flex items-center justify-between"><span
							class="bg-[#CCF0F3] text-irisBlueColor py-1 px-2 lg:py-2 lg:px-6 text-[12px] leading-4 lg:text-[16px] lg:leading-7 font-semibold rounded ">
							Surgeon </span>
						<div class="flex items-center gap-[6px]"><span
								class="flex items-center gap-[6px] text-[14px] leading-6 lg:text-[16px] lg:leading-7 font-semibold text-headingColor "><img
									src="./assets/images/Star.png" alt="">4.8</span><span
								class="text-[14px] leading-6 lg:text-[16px] lg:leading-7 font-[400] text-textColor ">(272)</span>
						</div>
					</div>
					<div class="mt-[18px] lg:my-5 flex items-center justify-betweenc">
						<div>
							<h3
								class="text-[16px] leading-7 lg:text-[18px] lg:leading-[30px] font-semibold text-headingColor">
								+1500 patients</h3>
							<p class="text-[14px] leading-6 font-[400] text-textColor ">At Mount Adora Hospital, Sylhet.
							</p>
						</div><a
							class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] mt-[30px] mx-auto flex items-center justify-center group hover:bg-primaryColor hover:border-none"
							href="doctors.php"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
								viewBox="0 0 16 16" class="group-hover:text-white w-6 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
								</path>
							</svg></a>
					</div>
				</div>
				<div class="p-3 lg:p-5">
					<div><img src="./assets/images/doctor-img02.png" class="w-full" alt=""></div>
					<h2
						class="text-[18px] leading-[30px] lg:text-[26px] lg:leading-9 text-headingColor font-[700] mt-3 lg:mt-5">
						Dr. Saleh Mahmud</h2>
					<div class="mt-2 lg:mt-4 flex items-center justify-between"><span
							class="bg-[#CCF0F3] text-irisBlueColor py-1 px-2 lg:py-2 lg:px-6 text-[12px] leading-4 lg:text-[16px] lg:leading-7 font-semibold rounded ">
							Neurologist </span>
						<div class="flex items-center gap-[6px]"><span
								class="flex items-center gap-[6px] text-[14px] leading-6 lg:text-[16px] lg:leading-7 font-semibold text-headingColor "><img
									src="./assets/images/Star.png" alt="">4.8</span><span
								class="text-[14px] leading-6 lg:text-[16px] lg:leading-7 font-[400] text-textColor ">(272)</span>
						</div>
					</div>
					<div class="mt-[18px] lg:my-5 flex items-center justify-betweenc">
						<div>
							<h3
								class="text-[16px] leading-7 lg:text-[18px] lg:leading-[30px] font-semibold text-headingColor">
								+1500 patients</h3>
							<p class="text-[14px] leading-6 font-[400] text-textColor ">At Mount Adora Hospital, Sylhet.
							</p>
						</div><a
							class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] mt-[30px] mx-auto flex items-center justify-center group hover:bg-primaryColor hover:border-none"
							href="doctors.php"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
								viewBox="0 0 16 16" class="group-hover:text-white w-6 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
								</path>
							</svg></a>
					</div>
				</div>
				<div class="p-3 lg:p-5">
					<div><img src="./assets/images/doctor-img03.png" class="w-full" alt=""></div>
					<h2
						class="text-[18px] leading-[30px] lg:text-[26px] lg:leading-9 text-headingColor font-[700] mt-3 lg:mt-5">
						Dr. Farid Uddin</h2>
					<div class="mt-2 lg:mt-4 flex items-center justify-between"><span
							class="bg-[#CCF0F3] text-irisBlueColor py-1 px-2 lg:py-2 lg:px-6 text-[12px] leading-4 lg:text-[16px] lg:leading-7 font-semibold rounded ">
							Dermatologist </span>
						<div class="flex items-center gap-[6px]"><span
								class="flex items-center gap-[6px] text-[14px] leading-6 lg:text-[16px] lg:leading-7 font-semibold text-headingColor "><img
									src="./assets/images/Star.png" alt="">4.8</span><span
								class="text-[14px] leading-6 lg:text-[16px] lg:leading-7 font-[400] text-textColor ">(272)</span>
						</div>
					</div>
					<div class="mt-[18px] lg:my-5 flex items-center justify-betweenc">
						<div>
							<h3
								class="text-[16px] leading-7 lg:text-[18px] lg:leading-[30px] font-semibold text-headingColor">
								+1500 patients</h3>
							<p class="text-[14px] leading-6 font-[400] text-textColor ">At Mount Adora Hospital, Sylhet.
							</p>
						</div><a
							class="w-[44px] h-[44px] rounded-full border border-solid border-[#181A1E] mt-[30px] mx-auto flex items-center justify-center group hover:bg-primaryColor hover:border-none"
							href="doctors.php"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
								viewBox="0 0 16 16" class="group-hover:text-white w-6 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
								</path>
							</svg></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Our Great Doctors -->

	<!-- Start Faq Section -->
	<section>
		<div class="container">
			<div class="flex justify-between gap-[50px] lg:gap-0 ">
				<div class="w-1/2 hidden md:block "><img src="./assets/images/faq-img.png" alt=""></div>
				<div class="w-full md:w-1/2 ">
					<h2 class="heading">Most questions by our beloved patients</h2>
					<ul class="mt-[38px]  ">
						<div
							class="p-3 lg:p-5 rounded-[12px] border border-solid border-[#D9DCE2] mb-5 cursor-pointer ">
							<div class="flex items-center justify-between gap-5">
								<h4 class="text-[16px] leading-7 lg:text-[22px] lg:leading-8 text-headingColor ">What is
									your medical care?</h4>
								<div
									class=" false w-7 lg:w-8 lg:h-8 border border-solid border-[#141F21] rounded flex items-center justify-center">
									<svg stroke="currentColor" fill="currentColor" stroke-width="0"
										viewBox="0 0 1024 1024" height="1em" width="1em"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8Z"></path>
										<path d="M192 474h672q8 0 8 8v60q0 8-8 8H160q-8 0-8-8v-60q0-8 8-8Z"></path>
									</svg>
								</div>
							</div>
						</div>
						<div
							class="p-3 lg:p-5 rounded-[12px] border border-solid border-[#D9DCE2] mb-5 cursor-pointer ">
							<div class="flex items-center justify-between gap-5">
								<h4 class="text-[16px] leading-7 lg:text-[22px] lg:leading-8 text-headingColor ">What
									happens if I need to go a hospital?</h4>
								<div
									class=" false w-7 lg:w-8 lg:h-8 border border-solid border-[#141F21] rounded flex items-center justify-center">
									<svg stroke="currentColor" fill="currentColor" stroke-width="0"
										viewBox="0 0 1024 1024" height="1em" width="1em"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8Z"></path>
										<path d="M192 474h672q8 0 8 8v60q0 8-8 8H160q-8 0-8-8v-60q0-8 8-8Z"></path>
									</svg>
								</div>
							</div>
						</div>
						<div
							class="p-3 lg:p-5 rounded-[12px] border border-solid border-[#D9DCE2] mb-5 cursor-pointer ">
							<div class="flex items-center justify-between gap-5">
								<h4 class="text-[16px] leading-7 lg:text-[22px] lg:leading-8 text-headingColor ">What
									happens if I need to go a hospital?</h4>
								<div
									class=" false w-7 lg:w-8 lg:h-8 border border-solid border-[#141F21] rounded flex items-center justify-center">
									<svg stroke="currentColor" fill="currentColor" stroke-width="0"
										viewBox="0 0 1024 1024" height="1em" width="1em"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8Z"></path>
										<path d="M192 474h672q8 0 8 8v60q0 8-8 8H160q-8 0-8-8v-60q0-8 8-8Z"></path>
									</svg>
								</div>
							</div>
						</div>
						<div
							class="p-3 lg:p-5 rounded-[12px] border border-solid border-[#D9DCE2] mb-5 cursor-pointer ">
							<div class="flex items-center justify-between gap-5">
								<h4 class="text-[16px] leading-7 lg:text-[22px] lg:leading-8 text-headingColor ">Can I
									visit
									your medical office?</h4>
								<div
									class=" false w-7 lg:w-8 lg:h-8 border border-solid border-[#141F21] rounded flex items-center justify-center">
									<svg stroke="currentColor" fill="currentColor" stroke-width="0"
										viewBox="0 0 1024 1024" height="1em" width="1em"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8Z"></path>
										<path d="M192 474h672q8 0 8 8v60q0 8-8 8H160q-8 0-8-8v-60q0-8 8-8Z"></path>
									</svg>
								</div>
							</div>
						</div>
						<div
							class="p-3 lg:p-5 rounded-[12px] border border-solid border-[#D9DCE2] mb-5 cursor-pointer ">
							<div class="flex items-center justify-between gap-5">
								<h4 class="text-[16px] leading-7 lg:text-[22px] lg:leading-8 text-headingColor ">Does
									you
									provide urgent care?</h4>
								<div
									class=" false w-7 lg:w-8 lg:h-8 border border-solid border-[#141F21] rounded flex items-center justify-center">
									<svg stroke="currentColor" fill="currentColor" stroke-width="0"
										viewBox="0 0 1024 1024" height="1em" width="1em"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8Z"></path>
										<path d="M192 474h672q8 0 8 8v60q0 8-8 8H160q-8 0-8-8v-60q0-8 8-8Z"></path>
									</svg>
								</div>
							</div>
						</div>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- End Faq Section -->

	<!-- Start Footer -->
	<footer class="pb-16 pt-10">
		<div class="container">
			<div class="flex justify-between flex-col md:flex-row flex-wrap fap-[30px]  ">
				<div><img src="./assets/images/logo.png" alt="">
					<p class="text-[16px] leading-7 font-[400] text-textColor mt-4 ">Copyright © 2024 developed by
						Abdelkarim Douadjia all right reserved.</p>
					<div class="flex items-center gap-3 mt-4"><a
							class="w-9 h-9 border border-solid border-[#181A1E] rounded-full flex items-center justify-center group hover:bg-primaryColor hover:border-none "
							href="https://www.youtube.com/"><svg stroke="currentColor"
								fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024"
								class="group-hover:text-white w-4 h-5" height="1em" width="1em"
								xmlns="http://www.w3.org/2000/svg">
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
							href="https://www.instagram.com/"><svg class="text-[24px]"  stroke="currentColor"
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