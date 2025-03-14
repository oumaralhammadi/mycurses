<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    include "../init.php";
    if(isset($_POST['category_id']) && isset($_POST['category_name'])){
        $id   = $_POST['category_id'];
        $name = $_POST['category_name'];
        
        if(empty($name)){
            // error msg
            $em = "The category name is required";
            header("Location: ../edit-category.php?error=$em&id=$id");
        }else{
            $sql = "UPDATE  category SET name=? WHERE id=?";
            $stmt = $con->prepare($sql);
            $res = $stmt->execute([$name,$id]);

            if($res){
                #success msg 
                $sm = " Succesfully Updated!";
                header("Location: ../edit-category.php?success=$sm&id=$id");
            }else{
                #error msg 
                $sm = "The category name is required !";
                header("Location: ../edit-category.php?error=$sm&id=$id");
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