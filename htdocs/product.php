<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'].'/51703181-51703148/htdocs/model/CategoryDb.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/51703181-51703148/htdocs/model/ProductDb.php');
    $cat = new CategoryDb();
    $pro = new ProductDb();
    $id = $_GET['cat'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Đặt vé online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php

                    if (isset($_SESSION['user'])) {

                        $user = $_SESSION['user'];

                        ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><?= $user['name']?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Logout</a>
                                </li>
                        <?php

                    }else{
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                        <?php
                    }
                ?>

            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4">Thể Loại</h1>
            <div class="list-group">
                <?php
                    $categories = $cat->getAll()->data;
                    foreach ($categories as $item){
                        ?>
                            <a href="product.php?cat=<?= $item['id']?>" class="list-group-item"><?= $item['name']?></a>
                        <?php
                    }

                ?>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">



            <div class="row">
                <?php
                    setlocale(LC_MONETARY,"en_US");
                    $products = $pro->getProductById($id)->data;

                    foreach ($products as $item){
                        $name = $item['name'];
                        $image = $item['image'];
                        $price = $item['price'];
                        $description = $item['description'];
                        $vote = $item['vote'];
                        $idPro=$item['id'];

                        ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <a href="#"><img class="card-img-top" src="<?= $image?>" alt="" style='height: 350px'></a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="#"><?= $name?></a>
                                        </h4>
                                        <small class="text-muted"><span>Đánh giá phim</span>
                                            <?php
                                                for ($i = 1; $i <= $vote; $i++ ){
                                                    echo "&#9733";
                                                }
                                                for ($i = 1; $i <= (5-$vote); $i++ ){
                                                    echo "&#9734";
                                                }
                                            ?>
                                        </small>
                                    </div>
                                    <div class="card-footer">
                                    <table>
                                        <tr>
                                            <td>
                                            <form method="post" action="cart.php">
                                                <button type="submit" class="btn btn-primary">Đặt vé</button>
                                            </form>
                                            </td>
                                            <td>
                                            <form method="post" action="info.php">
                                                <a href="info.php?id=<?= $idPro ?>" class="btn btn-primary">Xem thêm</a>
                                            </form>
                                            </td>
                                    </tr>
                                    </table>

                                    </div>

                                </div>
                            </div>
                        <?php
                    }
                ?>


            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<div class="trailer">
</div>
<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
