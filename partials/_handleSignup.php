<?php
$showError = "false";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "_dbconnect.php";
    $user_email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];
    $cpassword = $_POST['csignupPassword'];

    //check whether the email already exists or not
    $existsSQL = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";
    $result = mysqli_query($conn, $existsSQL);
    $numRows = mysqli_num_rows($result);

    if ($user_email != "" && $password != "" && $cpassword != "") {
        if ($numRows > 0) {
            $showError = "Email already in use";
        } else {
            if ($password == $cpassword) {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `users` (`user_email`, `user_password`, `timestamp`) VALUES ('$user_email','$hash' , current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert = true;
                    header("location: /proj3_forum/index.php?signupsuccess=true");
                    exit();
                }
            } else {
                $showError = "Passwords do not match!";
            }
        }
    } else {
        $showError = "Please fill the required fields in Signup form!";
    }


    header("location: /proj3_forum/index.php?signupsuccess=false&error=$showError");
}
