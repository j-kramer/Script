<?php

class Database
{
    private $dbh;
    private $addProductStmt;
    private $listGroceriesStmt;

    function __construct(string $source, string $username, string $password) {
        $this->dbh = new PDO($source, $username, $password);
        $this->addProductStmt = $this->dbh->prepare("INSERT INTO groceries (name, amount, price) VALUES (:name, :amount, :price)");
        $this->listGroceriesStmt = $this->dbh->prepare("SELECT name, amount, price FROM groceries");
    }

    public function query(string $sqlquery): PDOStatement|false {
        return $this->dbh->query($sqlquery);
    }

    public function addProduct(string $name, int $amount, float $price) {
        $this->addProductStmt->execute([
            ":name" => $name,
            ":amount" => $amount,
            ":price" => $price,
        ]);
    }

    public function listGroceries(): PDOStatement|false {
        return $this->listGroceriesStmt->execute();
    }
}
