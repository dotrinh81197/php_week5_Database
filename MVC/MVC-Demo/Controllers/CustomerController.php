<?php

namespace Controllers;

use Models\Customer;
use Models\CustomerDB;
use Models\DBConnection;

class CustomerController
{

  public $customerDB;

  public function __construct()
  {
    $connection = new DBConnection("mysql:host=localhost:3306;dbname=customer_manager", "root", "");
    $this->customerDB = new CustomerDB($connection->connect());
  }

  public function index()
  {
    $customers = $this->customerDB->getAll();
    include 'views/list.php';
  }

  public function add()
  {
    // Kiểm tra, nếu request method là GET thì trả về giao diện trang Add.php
    // Nếu không (tức là POST), thì lấy dữ liệu từ form, sau đó thêm vào cơ sở dữ liệu
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      include 'Views/Add.php';
    } else {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $address = $_POST['address'];

      $customer = new Customer($name, $email, $address);
      $this->customerDB->create($customer);
      $message = 'Customer created';
      include 'Views/Add.php';
    }
  }

  public function edit()
  {
    // Kiểm tra, nếu request method là GET thì trả về giao diện trang Edit.php
    // Nếu không (tức là POST), thì lấy dữ liệu từ form, sau đó cập nhật vào cơ sở dữ liệu
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      // Lấy dữ liệu từ Customer từ model
      // Lấy id của record muốn sửa
      $id = isset($_GET['id']) ? $_GET['id'] : NULL;

      // Lấy đối tượng Customer từ model
      $customer = $this->customerDB->getById($id);


      include 'Views/Edit.php';
    } else {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $id = $_GET['id'];

      $customer = new Customer($name, $email, $address);

      $this->customerDB->update($id, $customer);
      $message = 'Customer Updated';
      $this->index();
    }
  }

  public function drop()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $id = $_GET['id'];
      $customer = $this->customerDB->getById($id);
      include 'Views/Delete.php';
    } else {
      $id = $_POST['id'];
      $this->customerDB->delete($id);
      header('Location: index.php');
    }
  }
}
