<?php

class Database
{
    private $dbh;

    function __construct(string $source, string $username, string $password) {
        $this->dbh = new PDO($source, $username, $password);
    }

    public function query(string $sqlquery): PDOStatement|false {
        return $this->dbh->query($sqlquery);
    }
}
