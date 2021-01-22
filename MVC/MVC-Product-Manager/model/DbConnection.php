<?php

namespace model;

use PDO;

class DbConnection
{
    public $dsn;
    public $user;
    public $password;

    public function __construct($dsn, $user, $password)
    {
        $this->dsn = $dsn;
        $this->password = $password;
        $this->user = $user;
    }

    public function connect()
    {
        return new PDO($this->dsn, $this->user, $this->password);
    }
}
