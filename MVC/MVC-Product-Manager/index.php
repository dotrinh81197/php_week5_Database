<?php
require "model/DbConnection.php";
require "model/ProductDb.php";
require "model/Product.php";
require "controller/ProductController.php";

use controller\ProductController;

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý khách hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'view/search.php';
    ?>

    <div class="container">
        <div class="navbar navbar-default">
            <a class="navbar-brand" href="index.php">Product management</a>
        </div>


        <?php
        $controller = new ProductController();
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : NULL;

        switch ($page) {
            case 'add':
                $controller->add();
                break;
            case 'delete':
                $controller->drop();
                break;
            case 'edit':

                $controller->edit();
                break;
            case 'detail':
                $controller->showDetail();
                break;
            case 'search':
                $controller->search();
                break;
            default:
                $controller->index();
                break;
        }
        ?>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>