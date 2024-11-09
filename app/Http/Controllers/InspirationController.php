<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\CommentImages;

class InspirationController extends Controller
{
    private $commentImageModel;
    private $commentModel;

    public function __construct()
    {
        $this->commentImageModel = new CommentImages();
        $this->commentModel = new Comment();
    }

    public function inspiration()
    {
        $inspirations = $this->commentModel->inspirationBuildImage();
        $inspirationBuildImageById = [];
        foreach ($inspirations as $inspiration) {
            if ($inspiration->commentImages->count() > 0) {
                $randomImage = $inspiration->commentImages->random();
                $inspirationBuildImageById[] = $randomImage;
            }
        }
        return view('inspiration', compact('inspirations', 'inspirationBuildImageById'));
    }
}