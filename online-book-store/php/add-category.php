<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    include "../init.php";
    if(isset($_POST['category_name'])){
        $name = $_POST['category_name'];
        
        if(empty($name)){
            // error msg
            $em = "The category name is required";
            header("Location: ../add-category.php?error=$em");
        }else{
            $sql = "INSERT INTO category (name) VALUES (?)";
            $stmt = $con->prepare($sql);
            $res = $stmt->execute([$name]);

            if($res){
                #success msg 
                $sm = "Succesfully!";
                header("Location: ../add-category.php?success=$sm");
            }else{
                #error msg 
                $sm = "The category name is required !";
                header("Location: ../add-category.php?error=$sm");
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