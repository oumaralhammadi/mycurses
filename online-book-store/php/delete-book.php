<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    include "../init.php";
    if(isset($_GET['id'])){
        $id   = $_GET['id'];
        
        if(empty($id)){
            // error msg
            $em = "Error occurred!";
            header("Location: ../admin.php?error=$em");
        }else{
            $sql2 = "SELECT * FROM books  WHERE id=?";
            $stmt2 = $con->prepare($sql2);
            $stmt2->execute([ $id]);
            $the_book = $stmt2->fetch();
            if($stmt2->rowCount() > 0){
                $sql = "DELETE  FROM books WHERE id=?";
                $stmt = $con->prepare($sql);
                $res = $stmt->execute([$id]);
                if($res){
                    $cover = $the_book['cover'];
                    $file  = $the_book['file'];
                    $c_b_cover = "../uploads/cover/$cover";
                    $c_b_file = "../uploads/files/$file";
                    unlink($c_b_cover);
                    unlink($c_b_file);

                    #success msg 
                    $sm = " Succesfully Delete!";
                    header("Location: ../admin.php?success=$sm");
                }else{
                    #error msg 
                    $sm = "Error occurred !";
                    header("Location: ../admin.php?error=$sm");
                }
            }else{
                // error msg
                $em = "Error occurred!";
                header("Location: ../admin.php?error=$em");
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