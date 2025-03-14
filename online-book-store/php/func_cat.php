<?php
function get_all_caregory($con){
    $sql = "SELECT * FROM category ";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount() > 0 ){
        $categorys = $stmt->fetchAll();
    }else{
        $categorys = 0;
    }
    return $categorys ;
}




// get cat by id
function get_caregory($con,$id){
    $sql = "SELECT * FROM category WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
    if($stmt->rowCount() > 0 ){
        $category = $stmt->fetch();
    }else{
        $category = 0;
    }
    return $category ;
}



