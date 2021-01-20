<?php

namespace Models;

class CustomerDB
{
  // DbConnection
  public $connection;

  public function __construct($connection)
  {
    $this->connection = $connection;
  }

  public function getAll()
  {
    // Lấy dữ liệu từ trong bảng customers
    $sql = "SELECT * FROM customers";
    $statement = $this->connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(); // Associative Array

    $customers = [];

    // Chuyển result từ Associative Array sang mảng các đối tượng Customer
    foreach ($result as $row) {
      $customer = new Customer($row['name'], $row['email'], $row['address']);
      $customer->id = $row['id'];
      $customers[] = $customer;
    }

    return $customers;
  }

  public function getById($id)
  {
    $sql = "SELECT * FROM customers WHERE id = ?";
    $statement = $this->connection->prepare($sql);
    $statement->bindParam(1, $id);
    $statement->execute();
    $result = $statement->fetchAll(); // Associative Array

    $customer = new Customer(
      $result[0]['name'],
      $result[0]['email'],
      $result[0]['address'],
    );

    $customer->id = $result[0]['id'];

    return ($customer);
  }

  public function create($customer)
  {
    $sql = "INSERT INTO customers (`name`, `email`, `address`) VALUES (?, ?, ?)";
    $statement = $this->connection->prepare($sql);
    $statement->bindParam(1, $customer->name);
    $statement->bindParam(2, $customer->email);
    $statement->bindParam(3, $customer->address);
    return $statement->execute();
  }

  public function update($id, $customer)
  {
    $sql = "UPDATE customers SET `name` = ?, `email` = ?, `address` = ? WHERE id = ?";

    $statement = $this->connection->prepare($sql);

    $statement->bindParam(1, $customer->name);
    $statement->bindParam(2, $customer->email);
    $statement->bindParam(3, $customer->address);
    $statement->bindParam(4, $id);

    return $statement->execute();
  }

  public function delete($id)
  {
    $sql = "DELETE FROM `customers` WHERE `id` = ?";
    $statement = $this->connection->prepare($sql);
    $statement->bindParam(1, $id);
    return $statement->execute();
  }
}
