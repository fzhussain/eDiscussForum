<?php
$showError = "false";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "_dbconnect.php";
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
    $sql = "SELECT * FROM `users` WHERE `user_email` = '$email'";
    $result = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($result);

    if ($email != "" && $password != "") {
        if ($numRows == 1) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password,$row['user_password'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['useremail'] = $email;
                $_SESSION['sno'] = $row['sno'];
                // echo "Logged in. $email";
                header("location: /proj3_forum/index.php?login=true");
                exit();  
            }else{
                $showError = "Invalid credentials";
                header("location: /proj3_forum/index.php?login=false&error=$showError");
            }
        }else{
            $showError = "Invalid credentials";
                header("location: /proj3_forum/index.php?login=false&error=$showError");
        }
    }else{
        $showError = "Please fill the required fields in Login form!";   
        header("location: /proj3_forum/index.php?login=false&error=$showError");
    }
    
    

}