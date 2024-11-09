<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $articleModel;
    private $categoryArticleModel;


    public function __construct()
    {
        $this->articleModel = new Article();
        $this->categoryArticleModel = new CategoryArticle();
    }

    public function articles($id)

    {
        $article = $this->articleModel->findOrFail($id);

        return view('article', compact('article'));
    }

    public function categoryArticle()

    {
        $categoryArticles = $this->categoryArticleModel->categoryArticleAll();
        $articles = [];
        foreach ($categoryArticles as  $categoryArticle) {
            $articles[$categoryArticle->id] = $this->articleModel->articleById($categoryArticle->id);
        }

        return view('categoryArticle', compact('categoryArticles', 'articles'));
    }
}
