<?php
function get_all_books($con){
    $sql = "SELECT * FROM books ORDER BY id DESC";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount() > 0 ){
        $books = $stmt->fetchAll();
    }else{
        $books = 0;
    }
    return $books ;
}



function get_book($con,$id){
    $sql = "SELECT * FROM books WHERE  id=? ";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
    if($stmt->rowCount() > 0 ){
        $book = $stmt->fetch();
    }else{
        $book = 0;
    }
    return $book ;
}







function search_books($con, $key){
    $key = "%{$key}%";

    $sql = "SELECT * FROM books WHERE title LIKE ? OR `desc` LIKE ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$key,$key]);
    if($stmt->rowCount() > 0 ){
        $books = $stmt->fetchAll();
    }else{
        $books = 0;
    }
    return $books ;
}
//get_books_by_cat

function get_book_by_cat($con,$id){
    $sql = "SELECT * FROM books WHERE  Category_id=? ";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
    if($stmt->rowCount() > 0 ){
        $book = $stmt->fetchAll();
    }else{
        $book = 0;
    }
    return $book ;
}

// get_book_by_author

function get_book_by_author($con,$id){
    $sql = "SELECT * FROM books WHERE  auther_id=? ";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
    if($stmt->rowCount() > 0 ){
        $book = $stmt->fetchAll();
    }else{
        $book = 0;
    }
    return $book ;
}