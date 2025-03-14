<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    include "../init.php";
    include "./func-file-uploads.php";
    if( isset($_POST['book_title'])     || 
        isset($_POST['book_desc'])      ||
        isset($_POST['book_author'])    ||
        isset($_POST['book_category'])  ||
        isset($_FILES['book_cover'])    ||
        isset($_FILES['book_file'])     ){
        
        $title      = $_POST['book_title'];
        $desc       = $_POST['book_desc'];
        $author     = $_POST['book_author'];
        $category   = $_POST['book_category'];
        
        // making URL data format 
        $user_input = 'title='.$title.'&category='.$category.'&desc='.$desc.'&author='.$author;

        

        $text = "Book title";
        $location = "../add-book.php";
        $ms = 'error';
        is_empty($title,$text,$location,$ms,$user_input);
        
        $text = "Book description";
        $location = "../add-book.php";
        $ms = 'error';
        is_empty($desc,$text,$location,$ms,$user_input);

        $text = "Book author";
        $location = "../add-book.php";
        $ms = 'error';
        is_empty($author,$text,$location,$ms,$user_input);

        $text = "Book category";
        $location = "../add-book.php";
        $ms = 'error';
        is_empty($category,$text,$location,$ms,$user_input );
        

        $allowed_image_exs = array("jpg","jpeg","png");
        $path = "cover";
        $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);
        if($book_cover['status'] == "error"){
            $em = $book_cover['data'];
            header("Location: ../add-book.php?error=$em&$user_input");
            exit(); 
        }else{
            $allowed_file_exs = array("pdf","docx","pptx");
            $path = "files";
            $file = upload_file($_FILES['book_file'], $allowed_file_exs, $path);
            if($file['status'] == "error"){
                $em = $file['data'];
                header("Location: ../add-book.php?error=$em&$user_input");
                exit(); 
            }else{
                $file_URL = $file['data'];
                $book_cover_URL = $book_cover['data'];
                $sql = "INSERT INTO books (title,auther_id,`desc`,Category_id,cover,`file`) VALUES (?,?,?,?,?,?)";
                $stmt = $con->prepare($sql);
                $res = $stmt->execute([$title,$author,$desc,$category,$book_cover_URL, $file_URL  ]);
    
                if($res){
                    #success msg 
                    $sm = "Succesfully!";
                    header("Location: ../add-book.php?success=$sm");
                }else{
                    #error msg 
                    $sm = "The book name is required !";
                    header("Location: ../add-book.php?error=$sm");
                }
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