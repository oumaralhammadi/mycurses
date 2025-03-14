<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    include "./init.php";
    $caregoreis = get_all_caregory($con);
    $authers    = get_all_authers($con);
    if(!isset($_GET['id'])){
        header("Location: admin.php ");
        exit();
    }
    $id = $_GET['id'];
    $book = get_book($con,$id);
    if($book == 0){
        header("Location: admin.php ");
        exit();
    }
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Book</title>
        <!-- bootstrap CSS 5 CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- bootstrap js Bundle 5 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="admin.php">Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index.php">Store</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="add-book.php">Add Book</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="add-category.php">Add Category</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="add-auther.php">Add Author</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <form action="php/edit-book.php" method="POST" enctype="multipart/form-data" class="shadow mt-5 mb-5 p-4 rounded">
                <h1 class="text-center p-5 display-4 fs-3">Edit Book</h1>
                <?php if(isset($_GET['error'])){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($_GET['error']) ?>
                    </div>
                <?php } ?>
                <?php if(isset($_GET['success'])){ ?>
                    <div class="alert alert-success" role="alert">
                        <?= htmlspecialchars($_GET['success']) ?>
                    </div>
                <?php } ?>
                <input type="hidden" name="book_id" class="form-control" value="<?=$book['id']?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book title</label>
                    <input type="text" name="book_title" class="form-control" value="<?=$book['title']?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book descrption</label>
                    <input type="text" name="book_desc" class="form-control" value="<?=$book['desc']?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book author</label>
                    <select name="book_author" class="form-control" id="exampleInputEmail1">
                        <option value="0" disabled selected >selecte author </option>
                        <?php 
                        foreach($authers as $auther){ 
                            if($book['auther_id'] == $auther['id']){
                            ?>
                            <option selected value="<?= $auther['id']  ?>" ><?= $auther['name']  ?></option>
                        <?php }else{  ?>
                            <option  value="<?= $auther['id']  ?>" ><?= $auther['name']  ?></option>
                        <?php }  }?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Category</label>
                    <select name="book_category" class="form-control" id="exampleInputEmail1">
                        <option value="0" disabled selected >selecte Category </option>
                        <?php 
                        foreach($caregoreis as $caregory){
                            if($book['Category_id'] == $caregory['id']){
                            ?>
                            <option selected value="<?= $caregory['id']  ?>" ><?= $caregory['name']  ?></option>
                        <?php }else{  ?>
                            <option  value="<?= $caregory['id']  ?>" ><?= $caregory['name']  ?></option>
                        <?php }  }?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book Cover</label>
                    <input type="file" name="book_cover" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <input type="hidden" name="Current_cover" class="form-control" value="<?=$book['cover']?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <a href="uploads/cover/<?=$book['cover']?>" class="link-dark">Current Cover</a>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Book file</label>
                    <input type="file" name="book_file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <input type="hidden" name="Current_file" class="form-control" value="<?=$book['file']?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <a href="uploads/files/<?=$book['file']?>" class="link-dark">Current file</a>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </body>
    </html>
    <?php 
}else{
    header("Location: login.php");
    exit();
}

?>