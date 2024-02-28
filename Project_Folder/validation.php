<?php
session_start();
include 'configuration.php';


// $name = $_POST['user_name'];


$email = $_POST['user_email'];
$pass = $_POST['user_pass'];


$s = "select * from users where email = '$email' && password = '$pass'"; // it will match the email and password from database
$result = mysqli_query($conn, $s); // it will execute the query and store in database
$num = mysqli_num_rows($result); // it will count the number of rows in database  and how many times this email exist in database

// now select the name of user from database
$row = mysqli_fetch_array($result); // it will fetch the data from database
$name = $row['nom']; // it will fetch the name of user from database
$prenom = $row['prenom']; // it will fetch the prenom of user from database


if ($num == 1) {
    // if the email and password is match then it will redirect to index page
    $_SESSION['userid'] = $row['id'];
    // get the picture
    $_SESSION['userpic'] = $row['picture'];

    $_SESSION['message'] = "login successfully";
    header('location:index.php');
} else {
    header('location:login.php'); // if the email and password is not match then it will redirect to login page
    $_SESSION['message'] = "incorrect email or password";
}
