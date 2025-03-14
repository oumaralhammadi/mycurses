<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    include "../init.php";
    include "./func-file-uploads.php";
    if( isset($_POST['book_id'])        && 
        isset($_POST['book_title'])     && 
        isset($_POST['book_desc'])      &&
        isset($_POST['book_author'])    &&
        isset($_POST['book_category'])  &&
        isset($_FILES['book_cover'])    &&
        isset($_FILES['book_file'])     &&
        isset($_POST['Current_cover'])  &&
        isset($_POST['Current_file'])   ){
        
        $id         = $_POST['book_id'];
        $title      = $_POST['book_title'];
        $desc       = $_POST['book_desc'];
        $author     = $_POST['book_author'];
        $category   = $_POST['book_category'];


        $Current_cover = $_POST['Current_cover'];  
        $Current_file  = $_POST['Current_file'];  

        $text = "Book title";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
        is_empty($title,$text,$location,$ms,'');
        
        $text = "Book description";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
        is_empty($desc,$text,$location,$ms,'');

        $text = "Book author";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
        is_empty($author,$text,$location,$ms,'');

        $text = "Book category";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
        is_empty($category,$text,$location,$ms, '');


        if(!empty($_FILES['book_cover']['name'])){
            if(!empty($_FILES['book_file']['name'])){
                # update  both 
                $allowed_image_exs = array("jpg","jpeg","png");
                $path = "cover";
                $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);


                $allowed_file_exs = array("pdf","docx","pptx");
                $path = "files";
                $book_file = upload_file($_FILES['book_file'], $allowed_file_exs, $path);

                
                if($book_cover['status'] == "error" || $book_file['status'] == "error"){
                    $em = $book_cover['data'];
                    header("Location: ../edit-book.php?error=$em&id=$id");
                    exit(); 
                }else{
                    # crrent book_cover location
                    $c_p_book_cover = "../uploads/cover/$Current_cover"; 
                    $c_p_file = "../uploads/files/$Current_file"; 


                    unlink($c_p_book_cover);
                    unlink($c_p_file);


                    $file_URL = $book_file['data'];
                    $book_cover_URL = $book_cover['data'];

                    $sql = "UPDATE books SET title=?, auther_id=?, `desc`=?, Category_id=?, cover=?, `file`=? WHERE id=?";
                    $stmt = $con->prepare($sql);
                    $res = $stmt->execute([$title,$author,$desc,$category,$book_cover_URL,$file_URL  ,$id]);
                    if($res){
                        #success msg 
                        $sm = "Succesfully!";
                        header("Location: ../edit-book.php?success=$sm&id=$id");
                    }else{
                        #error msg 
                        $sm = "Unknown Error Occurred!";
                        header("Location: ../edit-book.php?error=$sm&id=$id");
                    }
                }
            }else{
                # update  just the  book cover
                $allowed_image_exs = array("jpg","jpeg","png");
                $path = "cover";
                $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

                
                if($book_cover['status'] == "error"){
                    $em = $book_cover['data'];
                    header("Location: ../edit-book.php?error=$em&id=$id");
                    exit(); 
                }else{
                    # crrent book_cover location
                    $c_p_book_cover = "../uploads/cover/$Current_cover";
                    unlink($c_p_book_cover);
                    $book_cover_URL = $book_cover['data'];

                    $sql = "UPDATE books SET title=?, auther_id=?, `desc`=?, Category_id=?, cover=? WHERE id=?";
                    $stmt = $con->prepare($sql);
                    $res = $stmt->execute([$title,$author,$desc,$category,$book_cover_URL, $id]);
                    if($res){
                        #success msg 
                        $sm = "Succesfully!";
                        header("Location: ../edit-book.php?success=$sm&id=$id");
                    }else{
                        #error msg 
                        $sm = "Unknown Error Occurred!";
                        header("Location: ../edit-book.php?error=$sm&id=$id");
                    }
                }
            }
        }else if(!empty($_FILES['book_file']['name'])){
                # update  just the  file
                $allowed_file_exs = array("pdf","docx","pptx");
                $path = "files";
                $book_file = upload_file($_FILES['book_file'], $allowed_file_exs, $path);

                
                if($book_file['status'] == "error"){
                    $em = $book_file['data'];
                    header("Location: ../edit-book.php?error=$em&id=$id");
                    exit(); 
                }else{
                    # crrent book_file location
                    $c_p_file = "../uploads/files/$Current_file";
                    unlink($c_p_file);
                    $file_URL = $book_file['data'];

                    $sql = "UPDATE books SET title=?, auther_id=?, `desc`=?, Category_id=?, `file`=? WHERE id=?";
                    $stmt = $con->prepare($sql);
                    $res = $stmt->execute([$title,$author,$desc,$category,$file_URL, $id]);
                    if($res){
                        #success msg 
                        $sm = "Succesfully!";
                        header("Location: ../edit-book.php?success=$sm&id=$id");
                    }else{
                        #error msg 
                        $sm = "Unknown Error Occurred!";
                        header("Location: ../edit-book.php?error=$sm&id=$id");
                    }
                }
        }else{
            # update  just the data
            $sql = "UPDATE books SET title=?, auther_id=?, `desc`=?, Category_id=? WHERE id=?";
            $stmt = $con->prepare($sql);
            $res = $stmt->execute([$title,$author,$desc,$category,$id]);
            if($res){
                #success msg 
                $sm = "Succesfully!";
                header("Location: ../edit-book.php?success=$sm&id=$id");
            }else{
                #error msg 
                $sm = "Unknown Error Occurred!";
                header("Location: ../edit-book.php?error=$sm&id=$id");
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