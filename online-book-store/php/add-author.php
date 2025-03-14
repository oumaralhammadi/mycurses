<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    include "../init.php";
    if(isset($_POST['author_name'])){
        $name = $_POST['author_name'];
        
        if(empty($name)){
            // error msg
            $em = "The Author name is required";
            header("Location: ../add-auther.php?error=$em");
        }else{
            $sql = "INSERT INTO auther (name) VALUES (?)";
            $stmt = $con->prepare($sql);
            $res = $stmt->execute([$name]);

            if($res){
                #success msg 
                $sm = "Succesfully!";
                header("Location: ../add-auther.php?success=$sm");
            }else{
                #error msg 
                $sm = "The Author name is required !";
                header("Location: ../add-auther.php?error=$sm");
            }
        }




    }else{
        header("Location: ../admin.php");
        exit();
    }
}else{
    header("Location: ../login.php");
    exit();
}