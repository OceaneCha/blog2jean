<?php

namespace Oce\Blog\Models;

class ArticleManager
{
    private \PDO $pdo;

    public function __construct()
    {
        $connection = new Connection();
        $this->pdo = $connection->getConnection();
    }

    public function getAllArticles(): array
    {
        $query = "SELECT * FROM article";
        $stmt = $this->pdo->query($query);

        return $stmt->fetchAll();
    }

    public function getArticleByID(int $id): array
    {
        $query = "SELECT * FROM article WHERE id=:id";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
}