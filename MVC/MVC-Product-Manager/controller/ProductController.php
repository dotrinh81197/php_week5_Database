<?php

namespace controller;

use model\DbConnection;
use model\Product;
use model\ProductDb;

class ProductController
{
    public $ProductDb;

    public function __construct()
    {
        $connection = new DbConnection("mysql:host = localhost:3306;dbname=product_manager", "root", "");
        $this->ProductDb = new ProductDb($connection->connect());
    }

    public function index()
    {
        $products = $this->ProductDb->getAll();
        include 'view/list.php';
    }

    public function add()
    {
        // Kiểm tra, nếu request method là GET thì trả về giao diện trang Add.php
        // Nếu không (tức là POST), thì lấy dữ liệu từ form, sau đó thêm vào cơ sở dữ liệu
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include 'view/add.php';
        } else {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $producer = $_POST['producer'];

            $product = new Product($name, $price, $description, $producer);
            $this->ProductDb->create($product);
            $message = 'Customer created';
            include 'view/add.php';
        }
    }


    public function drop()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $product = $this->ProductDb->getById($id);
            include 'view/delete.php';
        } else {
            $id = $_POST['id'];
            $this->ProductDb->delete($id);
            header('Location: index.php');
        }
    }


    public function edit()
    {
        // Kiểm tra, nếu request method là GET thì trả về giao diện trang Edit.php
        // Nếu không (tức là POST), thì lấy dữ liệu từ form, sau đó cập nhật vào cơ sở dữ liệu
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Lấy dữ liệu từ product từ model
            // Lấy id của record muốn sửa
            $id = isset($_GET['id']) ? $_GET['id'] : NULL;

            // Lấy đối tượng product từ model
            $product = $this->ProductDb->getById($id);


            include 'view/edit.php';
        } else {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $producer = $_POST['producer'];
            $id = $_GET['id'];

            $product = new Product($name, $price, $description, $producer);
            $this->ProductDb->update($id, $product);
            $message = 'Product Updated';
            $this->index();
        }
    }

    public function showDetail()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'];
            $product = $this->ProductDb->getById($id);
            include 'view/detail.php';
        } else {
            $id = $_POST['id'];
            $this->ProductDb->getDetail($id);
            header('Location: index.php');
        }
    }

    public function search()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $search = '%' . $_POST['search'] . '%';

            $products = $this->ProductDb->search($search);
            include 'view/list.php';
        } else {
        }
    }
}
