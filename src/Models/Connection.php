<?php

namespace Oce\Blog\Models;

use \PDO as PDO;

class Connection
{
    private PDO $connection;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    private string $dbName = DB_NAME;
    private string $dbHost = DB_HOST;

    public function __construct()
    {
        $this->connection = new PDO(
            'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName . ';charset=utf8',
            $this->user,
            $this->pass
        );
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}