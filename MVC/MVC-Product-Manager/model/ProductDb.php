<?php

namespace model;

class ProductDb
{
    // db connection
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        // lay du lieu tu database
        $sql = "SELECT * FROM `products`;";

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(); // Associative Array

        $products = [];

        // Chuyển result từ Associative Array sang mảng các đối tượng Customer
        foreach ($result as $row) {
            $product = new Product($row['name'], $row['price'], $row['description'], $row['producer']);
            $product->id = $row['id'];
            $products[] = $product;
        }

        return $products;
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM `products` WHERE `id` = ?";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->execute();
        $row = $statement->fetch();
        $product = new Product($row['name'], $row['price'], $row['description'], $row['producer']);
        $product->id = $row['id'];
        return $product;
    }

    public function create($product)
    {
        $sql = "INSERT INTO products (`name`, `price`, `description`, `producer`) VALUES (?, ?, ?, ?)";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $product->name);
        $statement->bindParam(2, $product->price);
        $statement->bindParam(3, $product->description);
        $statement->bindParam(4, $product->producer);
        return $statement->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `products` WHERE `id` = ?;";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);
        return $statement->execute();
    }

    public function update($id, $product)
    {
        $sql = "UPDATE products SET `name` =?, `price` =?, `description` =?, `producer` = ? WHERE id =? ;";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(1, $product->name);
        $statement->bindParam(2, $product->price);
        $statement->bindParam(3, $product->description);
        $statement->bindParam(4, $product->producer);
        $statement->bindParam(5, $id);

        return $statement->execute();
    }

    public function getDetail($id)
    {
        $sql = "SELECT * FROM `products` WHERE id = ?;";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);
        return $statement->execute();
    }

    public function search($search)
    {

        // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
        if (empty($search)) {
            echo "Yeu cau nhap du lieu vao o trong";
        } else {
            $sql = "SELECT *FROM `products` WHERE `name` LIKE '$search' ;";

            $statement = $this->connection->prepare($sql);
            // $statement->bindParam(1, $search);
            $statement->execute();
            $result = $statement->fetchAll(); // Associative Array
            $products = [];

            // Chuyển result từ Associative Array sang mảng các đối tượng product
            foreach ($result as $row) {
                $product = new Product($row['name'], $row['price'], $row['description'], $row['producer']);
                $product->id = $row['id'];
                $products[] = $product;
            }

            return $products;
        }
    }
}
