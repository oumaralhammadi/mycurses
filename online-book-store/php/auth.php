<?php
ob_start();// output beffering start 
session_start();
if(isset($_POST['email']) && isset($_POST['email'])){
    
    include "../init.php";
    //Get data from POST request
    $email      = $_POST['email'];
    $password   = $_POST['pass'];
    $passhash   = sha1($password);
    //simple from validation
    $text = "Email";
    $location = "../login.php";
    $ms = "error";
    is_empty($email,$text,$location,$ms,'');

    $text = "Password";
    $location = "../login.php";
    $ms = "error";
    is_empty($password,$text,$location,$ms,'');

    //search for the email
    $sql = "SELECT * FROM admin WHERE email=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$email]);
    // if the name is exist
    if($stmt->rowCount() === 1){
        $user =$stmt->fetch();
        $user_id    = $user['id'];
        $user_email = $user['email'];
        $user_pass  = $user['password'];
        if($email === $user_email){
            if($passhash === $user_pass){
                $_SESSION['user_id']    = $user_id;
                $_SESSION['user_email'] = $user_email;
                header("Location: ../admin.php");
            }else{
                // error msg
                $em = "incorrect User name or Password e";
                header("Location: ../login.php?error=$em");
            }
        }else{
            // error msg
            $em = "incorrect User name or Password";
            header("Location: ../login.php?error=$em");
        }

    }else{
        // error msg
        $em = "incorrect User name or Password";
        header("Location: ../login.php?error=$em");
    }
}else{
    header("Location:../login.php");
}




ob_end_flush();
?>