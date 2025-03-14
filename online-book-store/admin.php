<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
    include "./init.php";
    $books      = get_all_books($con);
    $authers    = get_all_authers($con);
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
        <form action="search.php" style="width: 100%;max-width:30rem;">    
            <div class="input-group my-5">
                <input type="text" name="key" class="form-control" placeholder="Search Book..." aria-label="Search Book..." aria-describedby="basic-addon2">
                <button class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
            </div>
        </form>    
            <?php if(isset($_GET['error'])){ ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php } ?>
            <?php if(isset($_GET['success'])){ ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?= htmlspecialchars($_GET['success']) ?>
                </div>
            <?php } ?>
            <h4 class="mt-5">All Books</h4>
        <?php 
        if($books == 0){?>
            <div class="alert alert-warning text-center p-5 mt-3" role="alert">
                There is No book in the datbase
            </div>
        <?php }else{?>
            <table class="table table-bordered shadow">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">cover</th>
                    <th scope="col">Title</th>
                    <th scope="col">Auther</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0 ;
                    foreach($books as $book){ $i++;?>
                        <tr>
                            <th scope="row"><?=$i ?></th>
                            <td>
                                <img class="rounded " width="100" src="./uploads/cover/<?=$book['cover'] ?>" >
                            </td>
                            <td><a class="linm-dark d-block text-center" href="./uploads/files/<?=$book['file'] ?>" ><?=$book['title'] ?></a></td>
                            <td>
                            <?php 
                                if($authers == 0){
                                    echo "Undefined";}else{
                                        foreach($authers as $auther){
                                            if($auther['id'] == $book['auther_id']){
                                                echo $auther['name'];
                                            }
                                        }
                                    }
                            ?>
                            </td>
                            <td><?=$book['desc'] ?></td>
                            <td>
                            <?php 
                                if($caregoreis == 0){
                                    echo "Undefined";}else{
                                        foreach($caregoreis as $caregory){
                                            if($caregory['id'] == $book['Category_id']){
                                                echo $caregory['name'];
                                            }
                                        }
                                    }
                            ?>
                            </td>
                            <td>
                                <a href="edit-book.php?id=<?=$book['id'] ?>" class="btn btn-warning">Edit</a>
                                <a href="php/delete-book.php?id=<?=$book['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        <h4 class="mt-5">All Categories</h4>
        <?php 
        if($caregoreis == 0){  ?>
            <div class="alert alert-warning text-center p-5 mt-3" role="alert">
                There is no Category in the datbase
            </div>
        <?php }else{?>
            
            <table class="table table-bordered shadow">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>    
                    <?php 
                    $j = 0;
                    foreach($caregoreis as $caregory){
                    $j++;
                    ?>
                    <tr>
                        <td scope="row"><?=$j ?></td>   
                        <td><?=$caregory['name']  ?></td>
                        <td>
                            <a href="edit-category.php?id=<?=$caregory['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="php/delete-category.php?id=<?=$caregory['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>       
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        <h4 class="mt-5">All Authors</h4>
        <?php 
        if($authers == 0){ ?>
            <div class="alert alert-warning text-center p-5 mt-3" role="alert">
                There is no Author  in the datbase
            </div>
        <?php }else{?>
            <table class="table table-bordered shadow">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Author name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>    
                    <?php 
                    $k = 0;
                    foreach($authers as $auther){
                        $k++;
                        ?>
                        <tr>
                            <td scope="row"><?=$k ?></td>   
                            <td><?=$auther['name']  ?></td>
                            <td>
                                <a href="edit-author.php?id=<?=$auther['id'] ?>" class="btn btn-warning">Edit</a>
                                <a href="php/delete-author.php?id=<?=$auther['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>       
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        </div>
    </body>
    </html>
    <?php 
}else{
    header("Location: login.php");
    exit();
}

?>