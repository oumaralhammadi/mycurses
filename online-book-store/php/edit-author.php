<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    include "../init.php";
    if(isset($_POST['author_id']) && isset($_POST['author_name'])){
        $id   = $_POST['author_id'];
        $name = $_POST['author_name'];
        
        if(empty($name)){
            // error msg
            $em = "The author name is required";
            header("Location: ../edit-author.php?error=$em&id=$id");
        }else{
            $sql = "UPDATE  auther SET name=? WHERE id=?";
            $stmt = $con->prepare($sql);
            $res = $stmt->execute([$name,$id]);

            if($res){
                #success msg 
                $sm = " Succesfully Updated!";
                header("Location: ../edit-author.php?success=$sm&id=$id");
            }else{
                #error msg 
                $sm = "The author name is required !";
                header("Location: ../edit-author.php?error=$sm&id=$id");
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