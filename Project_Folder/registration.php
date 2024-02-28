<?php
session_start();
include 'configuration.php';

header('location:login.php');

$name = $_POST['user_name'];
$role = $_POST['user_role'];
$email = $_POST['user_email'];
$pass = $_POST['user_pass'];
$sexe = $_POST['user_sex'];
$pic = $_POST['user_pic'];


$s = "select * from users where email = '$email'";
$result = mysqli_query($conn, $s); // it will execute the query and store in database
$num = mysqli_num_rows($result); // it will count the number of rows in database  and how many times this email exist in database


//


if ($num > 0) {
    // if the email and password is match then it will redirect to index page
    $_SESSION['message'] = "Email Already Taken";
} else {

   // Check if the user uploaded a picture
if(isset($_FILES['user_pic'])) {
    $img_name = $_FILES['user_pic']['name']; 
    $img_new_name = "./assets/images/" . $img_name;
    
} else {
    // Set a default image if no picture is provided
    $img_new_name = "./assets/images/patient-avatar.png";
}


            $reg = "insert into users(name, role ,email, password, sex, picture) values ('$name', '$role', '$email', '$pass', '$sexe' , '$img_new_name')"; // it will insert the data in database

            // if the user is doctor insert it in the doctor table else insert it in the patient table


            mysqli_query($conn, $reg); // it will execute the query and store in database
            $_SESSION['message'] = "Registration Successful!";
}
