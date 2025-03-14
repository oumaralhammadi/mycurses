<?php
session_start();
if(!isset($_GET['key']) || empty($_GET['key'])){
    header("Location: index.php ");
    exit();
}
include "./init.php";
$key = $_GET['key'];

$books   = search_books($con ,$key);
$authers = get_all_authers($con);
$caregoreis = get_all_caregory($con);

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Store</title>
        <!-- bootstrap CSS 5 CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- bootstrap js Bundle 5 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Book Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Store</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <?php if(isset($_SESSION['user_id'])){ ?>
                    <a class="nav-link" href="admin.php">admin</a>
                <?php }else{?>
                    <a class="nav-link" href="login.php">Login</a>
                <?php  } ?>
            </li>
        </ul>
        </div>
    </div>
    </nav>
        <div class="container">
            <h4 class="my-3">search result for <b><?=$key ?></b></h4>   
            <div class="d-flex">
                <?php if($books == 0){ ?>
                    <div class="alert alert-warning text-center p-5 mt-3" style="width: 100%;" role="alert">
                        The Key <b><?=$key ?></b> didnt match to any record in the database
                    </div>
                <?php }else{ ?>
                    <div class="pdf-list d-flex flex-wrap">
                        <?php foreach($books as $book){ ?>
                            <div class="card m-1">
                                <img src="uploads/cover/<?=$book['cover']?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?=$book['title']?></h5>
                                    <p  class="card-text">
                                        <i><b>By:<?php foreach($authers as $auther){ 
                                            if($auther['id'] == $book['auther_id']){
                                                echo $auther['name'] ;
                                                break;
                                            }
                                        }?> </b></i>
                                        <br><?=$book['desc']?><br>
                                        <i><b>caregory:<?php foreach($caregoreis as $caregory){ 
                                            if($caregory['id'] == $book['Category_id']){
                                                echo $caregory['name'] ;
                                                break;
                                            }
                                        }?> </b></i>
                                    </p>
                                    <a href="uploads/files/<?=$book['file']?>" class="btn btn-success">Open</a>
                                    <a href="uploads/files/<?=$book['file']?>" download="The title" class="btn btn-primary">Download</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>
