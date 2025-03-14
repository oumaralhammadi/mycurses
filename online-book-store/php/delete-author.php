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
                $sql = "DELETE  FROM auther WHERE id=?";
                $stmt = $con->prepare($sql);
                $res = $stmt->execute([$id]);
                if($res){
                    #success msg 
                    $sm = " Succesfully Delete!";
                    header("Location: ../admin.php?success=$sm");
                }else{
                    #error msg 
                    $sm = "Error occurred !";
                    header("Location: ../admin.php?error=$sm");
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