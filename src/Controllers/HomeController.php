<?php

namespace Oce\Blog\Controllers;

use Oce\Blog\Models\ArticleManager;
use Oce\Blog\Models\Connection;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class HomeController
{
    private Environment $twig;
    private ArticleManager $manager;

    public function __construct()
    {
        $loader = new FilesystemLoader('../src/Views');
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => true,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
        $this->manager = new ArticleManager;
    }

    public function index(): string //TODO: rename into getAllArticles
    {
        $articles = $this->manager->getAllArticles();

        return $this->twig->render('index.html.twig', ['articles' => $articles]);
    }

    public function display(int $id): string //TODO: rename into getArticleByID
    {
        $article = $this->manager->getArticleByID($id);

        return $this->twig->render('article.html.twig', ['article' => $article]);
    }

    // public function process(?int $id = null): string //TODO: validation
    // {
        
    // }

    public function form(): string //TODO: split add & edit
    {
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $this->process();
        // }

        if (isset($_GET['id'])) {
            $article = $this->manager->getArticleByID($_GET['id']);
            return $this->twig->render('edit.html.twig', ['article' => $article]);
        } else {
            return $this->twig->render('add.html.twig');
        }
    }
}