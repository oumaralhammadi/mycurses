<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    include "./init.php";
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Category</title>
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
                    <a class="nav-link" href="add-book.php">Add Book</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="add-category.php">Add Category</a>
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
            <form action="php/add-category.php" method="POST" class="shadow mt-5 p-4 rounded">
            <h1 class="text-center p-5 display-4 fs-3">Add New Category</h1>
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
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
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