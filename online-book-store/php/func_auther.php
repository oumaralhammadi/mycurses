<?php
function get_all_authers($con){
    $sql = "SELECT * FROM auther ";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount() > 0 ){
        $authers = $stmt->fetchAll();
    }else{
        $authers = 0;
    }
    return $authers ;
}



function get_authers($con,$id){
    $sql = "SELECT * FROM auther WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
    if($stmt->rowCount() > 0 ){
        $auther = $stmt->fetch();
    }else{
        $auther = 0;
    }
    return $auther ;
}


